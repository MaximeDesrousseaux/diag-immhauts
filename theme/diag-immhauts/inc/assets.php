<?php
/**
 * Feuille de style compilée, polices et scripts.
 *
 * - style.css est produit par Dart Sass (npm run build) depuis scss/main.scss ;
 * - les polices sont auto-hébergées (assets/fonts, woff2) et préchargées ;
 * - chaque composant a son petit script natif, chargé en defer.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version d'un fichier du thème : sa date de modification (cache navigateur
 * invalidé à chaque build), ou la version du thème à défaut.
 *
 * @param string $relatif Chemin relatif au thème.
 * @return string
 */
function dih_version_fichier( $relatif ) {
	$chemin = DIH_DIR . '/' . ltrim( $relatif, '/' );
	return file_exists( $chemin ) ? (string) filemtime( $chemin ) : DIH_VERSION;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'diag-immhauts', get_stylesheet_uri(), array(), dih_version_fichier( 'style.css' ) );

		$scripts = array(
			'dih-nav'   => 'assets/js/nav.js',   // header épinglé, nav transparente, burger, menus
			'dih-popup' => 'assets/js/popup.js', // popup « Demande de rappel »
			'dih-glide' => 'assets/js/glide.js', // défilement d'ancre 1,2 s
		);
		foreach ( $scripts as $poignee => $fichier ) {
			if ( ! file_exists( DIH_DIR . '/' . $fichier ) ) {
				continue;
			}
			wp_enqueue_script(
				$poignee,
				DIH_URI . '/' . $fichier,
				array(),
				dih_version_fichier( $fichier ),
				array(
					'in_footer' => true,
					'strategy'  => 'defer',
				)
			);
		}
	}
);

/**
 * Préchargement des deux graisses visibles au-dessus de la ligne de flottaison
 * (titres Manrope 800, texte Inter 400) : évite le saut de police du header.
 */
add_action(
	'wp_head',
	function () {
		$polices = array( 'manrope-latin-800-normal', 'manrope-latin-700-normal', 'inter-latin-400-normal', 'inter-latin-500-normal' );
		foreach ( $polices as $police ) {
			printf(
				'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
				esc_url( DIH_URI . '/assets/fonts/' . $police . '.woff2' )
			);
		}
	},
	2
);

/**
 * URL d'une image du thème (assets/img ou assets/logos).
 *
 * @param string $fichier Nom du fichier, ex. 'hero_bg_sans_maison_large.webp'.
 * @param string $dossier 'img' ou 'logos'.
 * @return string
 */
function dih_img( $fichier, $dossier = 'img' ) {
	return DIH_URI . '/assets/' . $dossier . '/' . $fichier;
}
