<?php
/**
 * Supports du thème et classes du body.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'diag-immhauts', DIH_DIR . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'responsive-embeds' );

		// Thème classique : pas d'éditeur de site, pas de styles de blocs imposés.
		remove_theme_support( 'block-templates' );
	}
);

/**
 * Réglages globaux exposés sur le body en attributs data-* (et non en classes :
 * le nommage des classes reste réservé aux composants c- et mises en page l-).
 * Le SCSS s'y accroche : [data-boutons="arrondi"], [data-decor="grille"]…
 */
function dih_attributs_body() {
	$attributs = array(
		'data-boutons' => dih_option( 'forme_boutons' ),
		'data-logo'    => dih_option( 'logo_site' ),
		'data-decor'   => dih_option( 'decor_hero' ),
	);
	foreach ( $attributs as $nom => $valeur ) {
		printf( ' %s="%s"', esc_attr( $nom ), esc_attr( $valeur ) );
	}
}

/**
 * Réglage « Polices de caractères » exposé sur <html> : la correction de taille
 * du texte change la taille racine, base de tous les rem() (voir base/_typographie).
 * Le front seulement : l'administration garde ses propres polices.
 */
add_filter(
	'language_attributes',
	function ( $sortie, $doctype ) {
		if ( is_admin() || 'html' !== $doctype ) {
			return $sortie;
		}
		return $sortie . sprintf(
			' data-police-titre="%s" data-police-texte="%s"',
			esc_attr( dih_option( 'police_titre' ) ),
			esc_attr( dih_option( 'police_texte' ) )
		);
	},
	10,
	2
);

/**
 * Allège le <head> : emojis et liens inutiles pour ce site vitrine.
 */
add_action(
	'init',
	function () {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator' );
	}
);

/**
 * Les styles globaux de blocs (theme.json par défaut de WP) imposeraient
 * des couleurs et marges hors charte sur le front : on les retire.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'wp-block-library' );
	},
	100
);

/**
 * Mentions légales : noindex, follow (README § Pages). Les autres balises SEO
 * (title, description, og, JSON-LD) arrivent à l'étape 6.
 */
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( 'mentions' === dih_page_courante() ) {
			unset( $robots['max-image-preview'] );
			$robots['noindex'] = true;
			$robots['follow']  = true;
		}
		return $robots;
	}
);

/**
 * Typographie : les textes sont saisis avec leur typographie définitive
 * (apostrophes et espaces insécables des maquettes) ; WordPress ne doit pas
 * convertir les apostrophes droites ni les guillemets.
 */
add_filter( 'run_wptexturize', '__return_false' );
