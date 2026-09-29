<?php
/**
 * Balises de gabarit communes : logo, liens de navigation, déclencheurs du rappel.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Marque graphique du logo, selon le réglage global logo_site.
 *
 * - toitures (défaut) : SVG en ligne, deux tracés c-logo__a / c-logo__b dont les
 *   remplissages suivent la nav (blanc sur fond transparent, verts de la charte
 *   sur nav blanche). Piège : les tracés descendent à y=124 alors que le viewBox
 *   coupe à 116, sinon un liseré d'un pixel apparaît en bas. La cheminée est
 *   soudée au chevron droit (maquettes v10) : sa base plonge dans le chevron.
 * - terrils : SVG en ligne en currentColor, terril avant en --techBright.
 * - actuel : l'ancien logo PNG (pas de version pour fond transparent).
 *
 * @return string
 */
function dih_logo_marque() {
	switch ( dih_option( 'logo_site' ) ) {
		case 'terrils':
			return '<svg class="c-logo__marque" width="51" height="28" viewBox="4 43 104 57" fill="none" aria-hidden="true" focusable="false">'
				. '<mask id="logo-masque-terrils" maskUnits="userSpaceOnUse" x="4" y="43" width="104" height="57"><rect x="4" y="43" width="104" height="57" fill="#fff"/><path d="M2 96 L38 60 L74 96 Z" fill="#000"/></mask>'
				. '<path d="M44 96 L74 66 L104 96 Z" fill="currentColor" mask="url(#logo-masque-terrils)"/>'
				. '<path d="M8 77 L38 47 L56 65 L74 47 L104 77 L104 85 L74 55 L56 73 L38 55 L8 85 Z" fill="currentColor"/>'
				. '<path d="M8 96 L38 66 L68 96 Z" style="fill:var(--techBright)"/>'
				. '</svg>';

		case 'actuel':
			return sprintf(
				'<img class="c-logo__img" src="%s" alt="" width="93" height="26">',
				esc_url( dih_img( 'logo-diag.png', 'logos' ) )
			);

		case 'toitures':
		default:
			return '<svg class="c-logo__svg" width="77" height="22" viewBox="0 0 404 116" fill="none" aria-hidden="true" focusable="false">'
				. '<defs><mask id="logo-masque" maskUnits="userSpaceOnUse" x="0" y="0" width="404" height="116"><rect x="0" y="0" width="404" height="116" fill="#fff"/><path d="M130 124 L262 1 L398 124 Z" fill="#000"/></mask></defs>'
				. '<g mask="url(#logo-masque)"><path class="c-logo__a" d="M1 124 L138 1 L275 124 L225 124 L138 43 L51 124 Z"/></g>'
				. '<path class="c-logo__b" d="M130 124 L262 1 L398 124 L348 124 L262 44 L180 124 Z"/>'
				. '<path class="c-logo__b" d="M290 34 L290 14 L324 9 L324 66 Z"/>'
				. '</svg>';
	}
}

/**
 * Lien de navigation : un <a>, ou un <span aria-current="page"> s'il s'agit
 * de la page affichée (comme en maquette : la page en cours n'est pas un lien).
 *
 * @param string $cle    Clé de dih_chemins().
 * @param string $texte  Libellé (HTML autorisé : &nbsp;).
 * @param string $classe Classe(s) CSS.
 * @return string
 */
function dih_lien_nav( $cle, $texte, $classe = '' ) {
	$classe = $classe ? ' class="' . esc_attr( $classe ) . '"' : '';
	if ( dih_est_courante( $cle ) ) {
		return sprintf( '<span%s aria-current="page">%s</span>', $classe, wp_kses_post( $texte ) );
	}
	return sprintf( '<a%s href="%s">%s</a>', $classe, esc_url( dih_url( $cle ) ), wp_kses_post( $texte ) );
}

/**
 * Attributs d'un lien qui ouvre la popup « Demande de rappel ».
 * Sans JS, le lien mène au formulaire détaillé de la page Contact.
 *
 * @return string
 */
function dih_attr_rappel() {
	return sprintf( 'href="%s" data-dih-rappel', esc_url( dih_url( 'contact', 'devis' ) ) );
}

/**
 * CTA du header, propre à chaque gabarit (libellés relevés sur les maquettes).
 *
 * @return array{texte:string, href:string, popup:bool}
 */
function dih_cta_header() {
	$cta = array(
		'texte' => 'Rappel gratuit',
		'href'  => dih_url( 'contact', 'devis' ),
		'popup' => true,
	);

	switch ( dih_page_courante() ) {
		case 'accueil':
			$cta['texte'] = 'Demande de rappel';
			break;
		case 'contact':
			$cta = array(
				'texte' => 'Devis gratuit',
				'href'  => '#devis',
				'popup' => false,
			);
			break;
		case 'pros':
			$cta['texte'] = 'Devenir partenaire';
			break;
		case 'actualites':
		case 'actualite':
		case 'mentions':
			$cta['popup'] = false; // maquettes : lien direct vers Contact
			break;
	}

	return apply_filters( 'dih_cta_header', $cta );
}

/**
 * Bouton animé (.c-btn) : le libellé glisse de −15 px au survol, l'icône entre
 * depuis la droite (README § Boutons).
 *
 * @param string $texte   Libellé (HTML autorisé : <span>, &nbsp;).
 * @param string $attrs   Attributs du lien, déjà échappés (href, data-dih-rappel…).
 * @param string $icone   Picto de dih_icone().
 * @param string $classes Classes supplémentaires (c-btn--vert par défaut).
 * @param string $balise  'a' ou 'button'.
 * @return string
 */
function dih_bouton( $texte, $attrs, $icone = 'fleche-courte', $classes = 'c-btn--vert', $balise = 'a' ) {
	return sprintf(
		'<%1$s class="c-btn %2$s" %3$s><span class="c-btn__texte">%4$s</span><span class="c-btn__icone">%5$s</span></%1$s>',
		'button' === $balise ? 'button' : 'a',
		esc_attr( $classes ),
		$attrs,
		wp_kses( $texte, array( 'span' => array( 'class' => true ) ) ),
		dih_icone( $icone, 17, array( 'epaisseur' => 2.2 ) )
	);
}

/**
 * Surtitre de section : petites capitales vertes précédées d'un filet.
 *
 * @param string $texte   Libellé.
 * @param string $classes Modificateurs (c-surtitre--clair sur fond foncé…).
 * @return string
 */
function dih_surtitre( $texte, $classes = '' ) {
	return sprintf(
		'<div class="c-surtitre %s"><span aria-hidden="true"></span>%s</div>',
		esc_attr( $classes ),
		esc_html( $texte )
	);
}

/**
 * Titre échappé où « peut-être » reste insécable (README, contenus arrêtés).
 *
 * @param string $titre Titre brut.
 * @return string HTML.
 */
function dih_titre_insecable( $titre ) {
	return str_replace( 'peut-être', '<span class="l-insecable">peut-être</span>', esc_html( $titre ) );
}

/**
 * Date d'un article du journal, en toutes lettres (« 16 septembre 2026 »).
 *
 * @param int|WP_Post $article Article.
 * @return string
 */
function dih_date_article( $article ) {
	return wp_date( 'j F Y', get_post_timestamp( $article ) );
}

/**
 * Illustration normalisée d'un diagnostic (jeu img/diag_<clé>.webp, maquettes v10) :
 * toile 800 × 640, orientation déjà appliquée, poids visuel égalisé. Aucun miroir
 * ni coefficient de taille par fichier : une seule taille par contexte, en CSS.
 *
 * @param string $cle Clé de page (dih_chemins) : dpe, amiante, electricite…
 * @return string Nom du fichier, ou chaîne vide si la page n'est pas un diagnostic.
 */
function dih_illus_diagnostic( $cle ) {
	$fichiers = array(
		'dpe'            => 'diag_dpe',
		'audit'          => 'diag_audit',
		'amiante'        => 'diag_amiante',
		'plomb'          => 'diag_plomb',
		'electricite'    => 'diag_elec',
		'gaz'            => 'diag_gaz',
		'termites'       => 'diag_termites',
		'merule'         => 'diag_merule',
		'erp'            => 'diag_erp',
		'mesurage'       => 'diag_mesurage',
		'assainissement' => 'diag_assainissement',
		'dtg'            => 'diag_dtg',
	);
	return isset( $fichiers[ $cle ] ) ? $fichiers[ $cle ] . '.webp' : '';
}

/**
 * Fil d'Ariane des heros : « Accueil / … / page en cours ». Ses niveaux sont
 * aussi transmis au JSON-LD BreadcrumbList (inc/seo.php).
 *
 * @param array  $niveaux Niveaux après « Accueil » : [ libellé, url ] pour un
 *                        lien, [ libellé ] pour la page en cours (le dernier).
 * @param string $classes Modificateurs (c-ariane--fiche, c-ariane--espace…).
 */
function dih_ariane( $niveaux, $classes = '' ) {
	array_unshift( $niveaux, array( 'Accueil', dih_url( 'accueil' ) ) );
	if ( function_exists( 'dih_seo_ariane' ) ) {
		dih_seo_ariane( $niveaux );
	}

	$morceaux = array();
	foreach ( $niveaux as $dih_niveau ) {
		$morceaux[] = isset( $dih_niveau[1] )
			? sprintf( '<a href="%s">%s</a>', esc_url( $dih_niveau[1] ), esc_html( $dih_niveau[0] ) )
			: sprintf( '<span aria-current="page">%s</span>', esc_html( $dih_niveau[0] ) );
	}

	printf(
		'<nav class="%s" aria-label="%s">%s</nav>',
		esc_attr( trim( 'c-ariane ' . $classes ) ),
		esc_attr( "Fil d'Ariane" ),
		implode( '<span class="c-ariane__sep" aria-hidden="true">/</span>', $morceaux ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- morceaux échappés ci-dessus
	);
}
