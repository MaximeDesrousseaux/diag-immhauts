<?php
/**
 * Réglages globaux du site : page d'options ACF « Personnalisation du site »
 * (plugin diag-immhauts-core, menu « Diag Imm'Hauts »).
 *
 * Les gabarits ne lisent QUE dih_option(). Sans ACF Pro, ou tant qu'un réglage
 * n'a pas été enregistré, chaque réglage prend sa valeur par défaut.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valeurs autorisées de chaque réglage ; la première est la valeur par défaut.
 * Source : README § Réglages globaux. step_icons n'a pas de champ dans la page
 * d'options (maquette d'admin : socle vert en dur) ; il ne change que par le filtre.
 *
 * @return array<string, string[]>
 */
function dih_options_valeurs() {
	return array(
		'logo_site'     => array( 'toitures', 'actuel', 'terrils' ),
		'forme_boutons' => array( 'pilule', 'arrondi' ),
		'police_titre'  => array( 'manrope', 'outfit', 'space-grotesk', 'archivo' ),
		'police_texte'  => array( 'inter', 'instrument-sans', 'source-sans-3' ),
		'hero_accueil'  => array( 'terrils-boutons', 'terrils-barre', 'max-bandeau', 'sansBG' ),
		'detail_style'  => array( 'ouvert', 'clair', 'damier' ),
		'decor_hero'    => array( 'terrils', 'grille' ),
		'entrees_hero'  => array( 'sommaire', 'cartes-blanches' ),
		'etapes_dispo'  => array( 'en-ligne', 'deux-colonnes' ),
		'step_icons'    => array( 'socle-vert', 'socle-blanc' ),
	);
}

/**
 * Lit un réglage global.
 *
 * @param string $cle Nom du champ (ex. 'forme_boutons').
 * @return string|null Valeur validée, ou null si la clé est inconnue.
 */
function dih_option( $cle ) {
	$valeurs = dih_options_valeurs();
	if ( ! isset( $valeurs[ $cle ] ) ) {
		return null;
	}

	$defaut = $valeurs[ $cle ][0];

	$valeur = function_exists( 'get_field' ) ? get_field( $cle, 'option' ) : null;
	if ( ! is_string( $valeur ) || '' === $valeur ) {
		$valeur = $defaut;
	}

	/**
	 * Permet de forcer un réglage (tests, aperçu) sans toucher aux gabarits.
	 *
	 * @param string $valeur Valeur lue.
	 * @param string $cle    Nom du réglage.
	 */
	$valeur = apply_filters( 'dih_option', $valeur, $cle );

	return in_array( $valeur, $valeurs[ $cle ], true ) ? $valeur : $defaut;
}

/**
 * Valeurs autorisées des réglages propres à une page (champ ACF de la page,
 * README § Réglages globaux) ; la première est la valeur par défaut.
 *
 * @return array<string, string[]>
 */
function dih_options_page_valeurs() {
	return array(
		'citation' => array( 'comprendre', 'mesurer', 'terrain', 'interlocuteur', 'preparation' ),
	);
}

/**
 * Lit un réglage propre à la page affichée.
 *
 * @param string $cle Nom du champ (ex. 'citation').
 * @return string|null Valeur validée, ou null si la clé est inconnue.
 */
function dih_option_page( $cle ) {
	$valeurs = dih_options_page_valeurs();
	if ( ! isset( $valeurs[ $cle ] ) ) {
		return null;
	}

	$defaut = $valeurs[ $cle ][0];

	$valeur = function_exists( 'get_field' ) ? get_field( $cle, get_queried_object_id() ) : null;
	if ( ! is_string( $valeur ) || '' === $valeur ) {
		$valeur = $defaut;
	}

	/**
	 * Permet de forcer un réglage de page (tests, aperçu), comme dih_option.
	 *
	 * @param string $valeur Valeur lue.
	 * @param string $cle    Nom du réglage.
	 */
	$valeur = apply_filters( 'dih_option_page', $valeur, $cle );

	return in_array( $valeur, $valeurs[ $cle ], true ) ? $valeur : $defaut;
}
