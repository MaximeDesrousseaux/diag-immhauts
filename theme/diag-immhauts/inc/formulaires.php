<?php
/**
 * Formulaires : rendu Fluent Forms mis en forme par le thème.
 *
 * Le plugin diag-immhauts-core décrit les formulaires et fournit
 * dih_core_formulaire( $cle ) ; tant qu'il n'est pas branché (plugin ou Fluent
 * Forms absent, formulaire non créé), le thème affiche un emplacement balisé.
 *
 * Ici, la présentation : enveloppe .c-form (composants/_formulaire.scss), bouton
 * d'envoi au gabarit .c-btn, attributs des champs (autocomplete, téléphone),
 * message de confirmation des maquettes. La feuille « par défaut » de Fluent Forms
 * n'est pas chargée : seule sa feuille de structure l'est.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Affiche le formulaire demandé ou son emplacement balisé.
 *
 * @param string $cle      'rappel' | 'devis' | 'partenaire'.
 * @param string $variante '' ou 'sombre' (sur fond vert : haut de l'accueil).
 *                         Le formulaire court « rappel » sert à la popup et au haut
 *                         de l'accueil ; la variante règle sa présentation.
 */
function dih_formulaire( $cle, $variante = '' ) {
	$html = function_exists( 'dih_core_formulaire' ) ? dih_core_formulaire( $cle ) : '';

	if ( $html ) {
		printf(
			'<div class="c-form c-form--%1$s%2$s" data-dih-form="%1$s">%3$s</div>',
			esc_attr( $cle ),
			$variante ? ' c-form--' . esc_attr( $variante ) : '',
			$html // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu Fluent Forms
		);
		return;
	}

	$noms = array(
		'rappel'     => 'Demande de rappel',
		'devis'      => 'Demande de devis',
		'partenaire' => 'Compte partenaire',
	);
	$nom  = isset( $noms[ $cle ] ) ? $noms[ $cle ] : $cle;
	?>
	<div class="c-formulaire__emplacement<?php echo $variante ? ' c-formulaire__emplacement--' . esc_attr( $variante ) : ''; ?>" data-dih-form="<?php echo esc_attr( $cle ); ?>">
		<strong>Formulaire « <?php echo esc_html( $nom ); ?> »</strong>
		<span>Emplacement réservé à Fluent Forms (à brancher).</span>
	</div>
	<?php
}

/**
 * Clé du site d'un formulaire Fluent Forms (objet ou identifiant), ou chaîne vide.
 *
 * @param object|int $form Formulaire Fluent Forms.
 * @return string
 */
function dih_formulaire_cle( $form ) {
	if ( ! function_exists( 'dih_core_formulaire_cle' ) ) {
		return '';
	}
	return dih_core_formulaire_cle( is_object( $form ) ? (int) $form->id : (int) $form );
}

// Seule la feuille de structure de Fluent Forms : l'habillage est celui du thème.
add_filter( 'fluentform/load_default_public', '__return_false' );

/**
 * Attributs des champs : saisie automatique, clavier téléphone, suggestions de
 * communes (formulaire court et devis), placeholders du message sur fond vert
 * (haut de l'accueil : assets/js/formulaires.js).
 */
$dih_attributs_champ = function ( $data, $form ) {
	$cle = dih_formulaire_cle( $form );
	if ( '' === $cle || empty( $data['attributes']['name'] ) ) {
		return $data;
	}
	$saisie = array(
		'nom'       => 'name',
		'telephone' => 'tel',
		'email'     => 'email',
		'commune'   => 'address-level2',
		'structure' => 'organization',
	);
	$nom = $data['attributes']['name'];
	if ( isset( $saisie[ $nom ] ) ) {
		$data['attributes']['autocomplete'] = $saisie[ $nom ];
	}
	if ( 'telephone' === $nom ) {
		$data['attributes']['type'] = 'tel';
	}
	if ( 'commune' === $nom ) {
		$data['attributes']['autocomplete']      = 'off'; // suggestions du thème
		$data['attributes']['data-dih-communes'] = function_exists( 'dih_core_url_communes' ) ? dih_core_url_communes() : '';
	}
	if ( 'rappel' === $cle && 'email' === $nom ) {
		$data['attributes']['data-sombre'] = dih_contenu( 'formulaires' )['email_sombre'];
	}
	if ( 'rappel' === $cle && 'message' === $nom ) {
		$textes                            = dih_contenu( 'formulaires' );
		$data['attributes']['data-sombre'] = $textes['message_sombre'];
		$data['attributes']['data-court']  = $textes['message_court'];
	}
	return $data;
};
add_filter( 'fluentform/rendering_field_data_input_text', $dih_attributs_champ, 10, 2 );
add_filter( 'fluentform/rendering_field_data_input_email', $dih_attributs_champ, 10, 2 );
add_filter( 'fluentform/rendering_field_data_textarea', $dih_attributs_champ, 10, 2 );

/**
 * Bouton d'envoi au gabarit .c-btn du thème : libellé qui glisse et icône téléphone
 * au survol pour le formulaire court (sans effet dans la popup, comme la maquette :
 * composants/_form.scss) ; mention « Réponse sous 24 h… » à côté de celui du devis.
 */
add_filter(
	'fluentform/rendering_field_html_button',
	function ( $html, $data, $form ) {
		$cle = dih_formulaire_cle( $form );
		if ( '' === $cle ) {
			return $html;
		}
		$texte  = isset( $data['settings']['button_ui']['text'] ) ? $data['settings']['button_ui']['text'] : '';
		$bouton = sprintf(
			'<button type="submit" class="ff-btn ff-btn-submit c-btn c-btn--vert c-form__envoi%s"%s>%s</button>',
			'rappel' === $cle ? '' : ' c-btn--sans-icone',
			isset( $data['attributes']['tabindex'] ) ? ' tabindex="' . esc_attr( $data['attributes']['tabindex'] ) . '"' : '',
			'rappel' === $cle
				? '<span class="c-btn__texte">' . esc_html( $texte ) . '</span><span class="c-btn__icone">' . dih_icone( 'telephone', 17 ) . '</span>'
				: '<span class="c-btn__texte">' . esc_html( $texte ) . '</span>'
		);
		$note = 'devis' === $cle ? '<span class="c-form__note">' . esc_html( dih_contenu( 'formulaires' )['note_devis'] ) . '</span>' : '';
		return '<div class="ff-el-group ff_submit_btn_wrapper c-form__pied">' . $bouton . $note . '</div>';
	},
	10,
	3
);

/**
 * Message affiché après l'envoi : celui des maquettes, par formulaire. Le filtre de
 * confirmation y dépose un shortcode, que Fluent Forms rend après avoir nettoyé le
 * message (le filtre « submission_message_parse » sert aussi au corps des e-mails).
 */
add_filter(
	'fluentform/form_submission_confirmation',
	function ( $confirmation, $donnees, $form ) {
		$cle = dih_formulaire_cle( $form );
		if ( '' !== $cle && 'samePage' === ( isset( $confirmation['redirectTo'] ) ? $confirmation['redirectTo'] : '' ) ) {
			$confirmation['messageToShow'] = '[dih_confirmation cle="' . $cle . '"]';
		}
		return $confirmation;
	},
	10,
	3
);

/**
 * Un message de confirmation (inc/contenus/formulaires.php, section confirmations).
 *
 * @param string $cle Message : 'rappel' (popup), 'accueil' (haut de l'accueil), 'devis', 'partenaire'.
 * @return string
 */
function dih_formulaire_merci( $cle ) {
	$c = dih_contenu( 'formulaires', 'confirmations' );
	if ( empty( $c[ $cle ] ) ) {
		return '';
	}
	$c   = $c[ $cle ];
	$tel = 'tel:' . dih_info( 'telephone_lien' );

	ob_start();
	?>
	<div class="c-form__merci c-form__merci--<?php echo esc_attr( $cle ); ?>">
		<?php if ( 'devis' === $cle ) : ?>
			<span class="c-form__merci-picto"><?php echo dih_svg( '<circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.5 2.5 4.5-5"></path>', 26 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php endif; ?>
		<?php if ( $c['titre'] ) : ?>
			<?php $dih_balise = 'devis' === $cle ? 'h2' : 'p'; // le devis remplace le titre de son bloc ?>
			<<?php echo $dih_balise; ?> class="c-form__merci-titre"><?php echo esc_html( $c['titre'] ); ?></<?php echo $dih_balise; ?>>
		<?php endif; ?>
		<p class="c-form__merci-texte"><?php echo esc_html( $c['texte'] ); ?><?php echo ! empty( $c['urgent'] ) ? ' <span class="c-form__merci-urgent">' . esc_html( $c['urgent'] ) . '</span>' : ''; ?></p>
		<?php if ( 'accueil' === $cle ) : ?>
			<?php echo dih_bouton( esc_html( $c['bouton'] ), 'href="' . esc_attr( $tel ) . '"', 'telephone', 'c-btn--vert c-form__appel' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php elseif ( 'devis' === $cle ) : ?>
			<a class="c-form__autre" href="<?php echo esc_url( dih_url( 'contact', 'devis' ) ); ?>"><?php echo esc_html( $c['bouton'] ); ?></a>
		<?php else : ?>
			<button type="button" class="c-form__fermer" data-dih-popup-fermer><?php echo esc_html( $c['bouton'] ); ?></button>
		<?php endif; ?>
	</div>
	<?php
	return trim( ob_get_clean() );
}

// Le formulaire court porte les deux messages : celui de la popup et celui du haut
// de l'accueil ; le CSS n'affiche que celui de l'endroit où il a été envoyé.
add_shortcode(
	'dih_confirmation',
	function ( $atts ) {
		$cle = isset( $atts['cle'] ) ? sanitize_key( $atts['cle'] ) : '';
		return 'rappel' === $cle ? dih_formulaire_merci( 'rappel' ) . dih_formulaire_merci( 'accueil' ) : dih_formulaire_merci( $cle );
	}
);
