<?php
/**
 * Réglages globaux du site (future page d'options ACF « Personnalisation »).
 *
 * Jusqu'à l'étape 5, chaque réglage prend sa valeur par défaut, écrite en dur
 * ci-dessous. L'étape 5 branchera dih_option() sur ACF (get_field( $cle, 'option' ))
 * sans rien changer côté gabarits : ils ne lisent QUE dih_option().
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valeurs autorisées de chaque réglage ; la première est la valeur par défaut.
 * Source : README § Réglages globaux.
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

	// Étape 5 : $valeur = function_exists( 'get_field' ) ? get_field( $cle, 'option' ) : null;
	$valeur = $defaut;

	/**
	 * Permet de forcer un réglage (tests, aperçu) sans toucher aux gabarits.
	 *
	 * @param string $valeur Valeur lue.
	 * @param string $cle    Nom du réglage.
	 */
	$valeur = apply_filters( 'dih_option', $valeur, $cle );

	return in_array( $valeur, $valeurs[ $cle ], true ) ? $valeur : $defaut;
}
