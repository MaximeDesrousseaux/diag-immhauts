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
 * Classes du body pilotées par les réglages globaux.
 */
add_filter(
	'body_class',
	function ( $classes ) {
		$classes[] = 'dih';
		$classes[] = 'dih-btn-' . dih_option( 'forme_boutons' );
		$classes[] = 'dih-logo-' . dih_option( 'logo_site' );
		$classes[] = 'dih-decor-' . dih_option( 'decor_hero' );
		return $classes;
	}
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
