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
 * - toitures (défaut) : SVG en ligne, deux tracés dih-lg-a / dih-lg-b dont les
 *   remplissages suivent la nav (blanc sur fond transparent, verts de la charte
 *   sur nav blanche). Piège : les tracés descendent à y=124 alors que le viewBox
 *   coupe à 116, sinon un liseré d'un pixel apparaît en bas.
 * - terrils : SVG en ligne en currentColor, terril avant en --techBright.
 * - actuel : l'ancien logo PNG (pas de version pour fond transparent).
 *
 * @return string
 */
function dih_logo_marque() {
	switch ( dih_option( 'logo_site' ) ) {
		case 'terrils':
			return '<svg class="dih-logo-mark" width="51" height="28" viewBox="4 43 104 57" fill="none" aria-hidden="true" focusable="false">'
				. '<mask id="dih-lg-mk" maskUnits="userSpaceOnUse" x="4" y="43" width="104" height="57"><rect x="4" y="43" width="104" height="57" fill="#fff"/><path d="M2 96 L38 60 L74 96 Z" fill="#000"/></mask>'
				. '<path d="M44 96 L74 66 L104 96 Z" fill="currentColor" mask="url(#dih-lg-mk)"/>'
				. '<path d="M8 77 L38 47 L56 65 L74 47 L104 77 L104 85 L74 55 L56 73 L38 55 L8 85 Z" fill="currentColor"/>'
				. '<path d="M8 96 L38 66 L68 96 Z" style="fill:var(--techBright)"/>'
				. '</svg>';

		case 'actuel':
			return sprintf(
				'<img class="dih-logo-img" src="%s" alt="" width="93" height="26">',
				esc_url( dih_img( 'logo-diag.png', 'logos' ) )
			);

		case 'toitures':
		default:
			return '<svg class="dih-logo-svg" width="77" height="22" viewBox="0 0 404 116" fill="none" aria-hidden="true" focusable="false">'
				. '<defs><mask id="dih-lg-mask" maskUnits="userSpaceOnUse" x="0" y="0" width="404" height="116"><rect x="0" y="0" width="404" height="116" fill="#fff"/><path d="M130 124 L262 1 L398 124 Z" fill="#000"/></mask></defs>'
				. '<g mask="url(#dih-lg-mask)"><path class="dih-lg-a" d="M1 124 L138 1 L275 124 L225 124 L138 43 L51 124 Z"/></g>'
				. '<path class="dih-lg-b" d="M130 124 L262 1 L398 124 L348 124 L262 44 L180 124 Z"/>'
				. '<path class="dih-lg-b" d="M290 25 L290 14 L324 9 L324 53 Z"/>'
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
