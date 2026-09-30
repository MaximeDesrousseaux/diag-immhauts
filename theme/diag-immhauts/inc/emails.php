<?php
/**
 * E-mails des formulaires (maquettes 1.14, design_diagimmhauts_theme_wp/emails/) :
 * accusé de réception du client (piste 1a) et notification de Max (piste 1c).
 *
 * Les notifications Fluent Forms « dih_client » et « dih_max » (créées par
 * outils/importer-formulaires.php) reçoivent ici leur objet et leur corps : les
 * gabarits template-parts/emails/client.php et max.php, remplis selon la variante
 * (rappel, devis, simulateur, partenaire) et les textes de inc/contenus/emails.php.
 * Note Google et statut de zone : plugin, inc/emails.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * URL d'une image des e-mails (assets/emails/), servie en https en ligne.
 *
 * @param string $fichier Nom du fichier.
 * @return string
 */
function dih_email_image( $fichier ) {
	return DIH_URI . '/assets/emails/' . $fichier;
}

/**
 * Valeur saisie d'un champ, en texte (listes jointes par des virgules).
 *
 * @param array  $donnees Données envoyées.
 * @param string $nom     Nom du champ.
 * @return string
 */
function dih_email_valeur( $donnees, $nom ) {
	if ( ! isset( $donnees[ $nom ] ) ) {
		return '';
	}
	$v = $donnees[ $nom ];
	if ( is_array( $v ) ) {
		$v = implode( ', ', array_filter( array_map( 'trim', $v ) ) );
	}
	$v = trim( wp_strip_all_tags( (string) $v ) );
	if ( '' !== $v && 'surface' === $nom ) {
		$v .= "\u{00A0}m²";
	}
	return $v;
}

/**
 * Tout ce que les gabarits affichent, pour une demande envoyée.
 *
 * @param string $cle     Formulaire : 'rappel' | 'devis' | 'partenaire'.
 * @param array  $donnees Données envoyées.
 * @param object $form    Formulaire Fluent Forms.
 * @return array
 */
function dih_email_modele( $cle, $donnees, $form ) {
	$t        = dih_contenu( 'emails' );
	$variante = $cle;
	if ( 'rappel' === $cle && '' !== dih_email_valeur( $donnees, 'sim_projet' ) ) {
		$variante = 'simulateur';
	}
	$v   = function ( $nom ) use ( $donnees ) {
		return dih_email_valeur( $donnees, $nom );
	};
	$def = function_exists( 'dih_core_formulaires_definitions' ) ? dih_core_formulaires_definitions() : array();
	$def = isset( $def[ $cle ] ) ? $def[ $cle ]['champs'] : array();

	// Page d'origine : celle où le formulaire a été envoyé.
	$page_id = isset( $donnees['__fluent_form_embded_post_id'] ) ? (int) $donnees['__fluent_form_embded_post_id'] : 0;
	$page    = array(
		'titre' => $page_id ? get_the_title( $page_id ) : '',
		'url'   => $page_id ? get_permalink( $page_id ) : home_url( '/' ),
	);

	// Récapitulatif du client : lignes omises quand elles sont vides.
	$recap = array();
	foreach ( isset( $t['recap'][ $variante ] ) ? $t['recap'][ $variante ] : array() as $libelle => $champs ) {
		$texte = implode( ' · ', array_filter( array_map( $v, $champs ) ) );
		if ( '' !== $texte ) {
			$recap[] = array( $libelle, $texte );
		}
	}

	// Détail de Max : une ligne par champ du formulaire (ordre de la variante s'il en a un).
	$libelles = array();
	foreach ( $def as $champ ) {
		if ( ! in_array( $champ['type'], array( 'separateur', 'rgpd' ), true ) ) {
			$libelles[ $champ['nom'] ] = isset( $t['libelles'][ $champ['nom'] ] ) ? $t['libelles'][ $champ['nom'] ] : ( function_exists( 'dih_core_libelle_champ' ) ? dih_core_libelle_champ( $champ ) : $champ['nom'] );
		}
	}
	$ordre  = isset( $t['detail'][ $variante ] ) ? $t['detail'][ $variante ] : array_keys( $libelles );
	$exclus = array( 'nom', 'message', 'precisions', 'provenance', 'sim_obligatoires' );
	$detail = array();
	foreach ( $ordre as $nom ) {
		$texte = $v( $nom );
		if ( in_array( $nom, $exclus, true ) || '' === $texte || ! isset( $libelles[ $nom ] ) ) {
			continue;
		}
		if ( 'commune' === $nom && function_exists( 'dih_core_zone_statut' ) ) {
			$zone  = dih_core_zone_statut( $texte );
			$texte = $zone ? $texte . ' · ' . $zone : $texte;
		}
		$detail[] = array( $libelles[ $nom ], $texte );
	}

	// Ligne de synthèse sous le nom (maquette : line).
	switch ( $variante ) {
		case 'devis':
			$synthese = implode( ' · ', array_filter( array( $v( 'qualite' ), trim( $v( 'type_bien' ) . ' ' . $v( 'surface' ) ), $v( 'commune' ) ) ) );
			break;
		case 'simulateur':
			$synthese = implode( ' · ', array_filter( array( $v( 'sim_projet' ), trim( $v( 'type_bien' ) . ' ' . $v( 'sim_annee' ) ), $v( 'commune' ) ) ) );
			break;
		case 'partenaire':
			$synthese = implode( ' · ', array_filter( array( $v( 'structure' ), $v( 'dossiers' ) ? $v( 'dossiers' ) . ' dossiers par mois' : '' ) ) );
			break;
		default:
			$synthese = $page['titre'] ? sprintf( $t['max']['rappel_de'], $page['titre'] ) : '';
	}

	$texte_v = isset( $t['variantes'][ $variante ] ) ? $t['variantes'][ $variante ] : array();

	return array(
		'variante'   => $variante,
		'textes'     => $t,
		'v'          => $texte_v,
		'nom'        => $v( 'nom' ),
		'prenom'     => function_exists( 'dih_core_prenom' ) ? dih_core_prenom( $v( 'nom' ) ) : $v( 'nom' ),
		'telephone'  => $v( 'telephone' ),
		'tel_lien'   => preg_replace( '/[^0-9+]/', '', $v( 'telephone' ) ),
		'email'      => is_email( $v( 'email' ) ) ? $v( 'email' ) : '',
		'commune'    => $v( 'commune' ),
		'message'    => '' !== $v( 'message' ) ? $v( 'message' ) : $v( 'precisions' ),
		'recap'      => $recap,
		'detail'     => $detail,
		'synthese'   => $synthese,
		'page'       => $page,
		'provenance' => $v( 'provenance' ),
		'rgpd'       => ! empty( $donnees['rgpd'] ),
		'formulaire' => is_object( $form ) ? $form->title : '',
		'date'       => current_time( 'd/m' ),
		'heure'      => current_time( 'H:i' ),
		'avis'       => function_exists( 'dih_core_avis_google' ) ? dih_core_avis_google() : array(
			'note'   => '',
			'nombre' => '',
			'url'    => '',
		),
	);
}

/**
 * Gabarit d'e-mail rempli.
 *
 * @param string $gabarit 'client' | 'max'.
 * @param array  $modele  dih_email_modele().
 * @return string
 */
function dih_email_rendu( $gabarit, $modele ) {
	ob_start();
	get_template_part( 'template-parts/emails/' . $gabarit, null, $modele );
	return trim( ob_get_clean() );
}

/**
 * La notification est-elle l'une des nôtres ? Renvoie [ gabarit, clé du formulaire ].
 *
 * @param array  $notification Réglages de la notification.
 * @param object $form         Formulaire.
 * @return array|null
 */
function dih_email_notification( $notification, $form ) {
	$nom = isset( $notification['name'] ) ? $notification['name'] : '';
	if ( ! in_array( $nom, array( 'dih_client', 'dih_max' ), true ) || ! function_exists( 'dih_formulaire_cle' ) ) {
		return null;
	}
	$cle = dih_formulaire_cle( $form );
	return '' === $cle ? null : array( 'dih_client' === $nom ? 'client' : 'max', $cle );
}

add_filter(
	'fluentform/email_subject',
	function ( $objet, $notification, $donnees, $form ) {
		$n = dih_email_notification( $notification, $form );
		if ( ! $n ) {
			return $objet;
		}
		$m = dih_email_modele( $n[1], $donnees, $form );
		if ( 'client' === $n[0] ) {
			return isset( $m['v']['objet'] ) ? $m['v']['objet'] : $objet;
		}
		// Max : « [Tag] Prénom Nom · Commune »
		return '[' . $m['v']['tag'] . '] ' . implode( ' · ', array_filter( array( $m['nom'], $m['commune'] ) ) );
	},
	10,
	4
);

add_filter(
	'fluentform/email_body',
	function ( $corps, $notification, $donnees, $form ) {
		$n = dih_email_notification( $notification, $form );
		if ( ! $n ) {
			return $corps;
		}
		return dih_email_rendu( $n[0], dih_email_modele( $n[1], $donnees, $form ) );
	},
	10,
	4
);
