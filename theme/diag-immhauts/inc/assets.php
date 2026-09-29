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
		if ( is_front_page() ) {
			$scripts['dih-commune'] = 'assets/js/commune.js'; // « Vérifier ma commune »
			$scripts['dih-avis']    = 'assets/js/avis.js';    // flèches du carrousel des avis
		}
		if ( is_page_template( 'page-templates/simulateur.php' ) ) {
			$scripts['dih-simulateur'] = 'assets/js/simulateur.js'; // règles et dossier du simulateur
		}
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
 * Préchargement des graisses visibles au-dessus de la ligne de flottaison
 * (titres 800 et 700, texte 400 et 500) des polices choisies dans la page
 * d'options : évite le saut de police du header.
 */
add_action(
	'wp_head',
	function () {
		$titre = dih_option( 'police_titre' );
		$texte = dih_option( 'police_texte' );
		// Space Grotesk s'arrête à 700 : son 700 sert aussi les titres en 800.
		$gras    = 'space-grotesk' === $titre ? '700' : '800';
		$polices = array_unique(
			array(
				$titre . '-latin-' . $gras . '-normal',
				$titre . '-latin-700-normal',
				$texte . '-latin-400-normal',
				$texte . '-latin-500-normal',
			)
		);
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

/**
 * Favicon (README § Favicon) : SVG, PNG 32 px et icône Apple 180 px, servis par le
 * thème. Si une « Icône du site » est définie dans Personnaliser, WordPress la sert
 * lui-même et le thème s'efface.
 */
add_action(
	'wp_head',
	function () {
		if ( has_site_icon() ) {
			return;
		}
		$base = DIH_URI . '/assets/favicon/';
		printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "
", esc_url( $base . 'favicon.svg' ) );
		printf( '<link rel="icon" href="%s" sizes="32x32" type="image/png">' . "
", esc_url( $base . 'favicon-32.png' ) );
		printf( '<link rel="apple-touch-icon" href="%s">' . "
", esc_url( $base . 'apple-touch-icon.png' ) );
	},
	3
);
