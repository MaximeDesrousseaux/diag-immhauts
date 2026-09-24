<?php
/**
 * Plan du site : URL canoniques (README § Pages) et repérage de la page en cours.
 *
 * Les gabarits ne codent jamais une URL en dur : ils passent par dih_url( 'cle' ).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Les 22 pages du site : clé => chemin canonique.
 *
 * @return array<string, string>
 */
function dih_chemins() {
	return apply_filters(
		'dih_chemins',
		array(
			'accueil'        => '/',
			'diagnostics'    => '/diagnostics-immobiliers/',
			'dpe'            => '/dpe/',
			'audit'          => '/audit-energetique/',
			'dtg'            => '/dtg-dpe-collectif/',
			'amiante'        => '/diagnostic-amiante/',
			'plomb'          => '/diagnostic-plomb-crep/',
			'electricite'    => '/diagnostic-electricite/',
			'gaz'            => '/diagnostic-gaz/',
			'termites'       => '/diagnostic-termites/',
			'merule'         => '/diagnostic-merule/',
			'erp'            => '/etat-des-risques-erp/',
			'mesurage'       => '/mesurage-carrez-boutin/',
			'assainissement' => '/assainissement-non-collectif/',
			'simulateur'     => '/simulateur-diagnostics-obligatoires/',
			'pros'           => '/professionnels-agences-notaires-syndics/',
			'actualites'     => '/actualites/',
			'qui'            => '/maxime-dillies-diagnostiqueur/',
			'contact'        => '/contact-devis/',
			'mentions'       => '/mentions-legales/',
		)
	);
}

/**
 * URL absolue d'une page du site.
 *
 * @param string $cle   Clé de dih_chemins().
 * @param string $ancre Ancre facultative, sans « # ».
 * @return string
 */
function dih_url( $cle, $ancre = '' ) {
	$chemins = dih_chemins();
	$url     = home_url( isset( $chemins[ $cle ] ) ? $chemins[ $cle ] : '/' );
	return $ancre ? $url . '#' . $ancre : $url;
}

/**
 * Clé de la page affichée (ou null si elle ne figure pas au plan).
 *
 * @return string|null
 */
function dih_page_courante() {
	static $courante = false;
	if ( false !== $courante ) {
		return $courante;
	}

	$courante = null;
	$requete  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/'; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$chemin   = (string) wp_parse_url( $requete, PHP_URL_PATH );
	$base     = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ); // site installé dans un sous-dossier
	if ( '' !== $base && '/' !== $base && 0 === strpos( $chemin, $base ) ) {
		$chemin = substr( $chemin, strlen( $base ) - 1 );
	}
	$chemin = trailingslashit( '/' . ltrim( $chemin, '/' ) );

	if ( is_front_page() ) {
		$chemin = '/';
	}

	foreach ( dih_chemins() as $cle => $candidat ) {
		if ( $candidat === $chemin ) {
			$courante = $cle;
			break;
		}
	}

	// Articles du journal : rattachés à l'index des actualités.
	if ( null === $courante && is_singular( 'post' ) ) {
		$courante = 'actualite';
	}

	$courante = apply_filters( 'dih_page_courante', $courante );
	return $courante;
}

/**
 * Rubrique de 1er niveau de la nav de bureau à mettre en gras.
 *
 * @return string|null 'diagnostics' | 'pros' | 'actualites' | 'qui' | null
 */
function dih_rubrique_courante() {
	$page      = dih_page_courante();
	$rubriques = array(
		'diagnostics' => array( 'diagnostics', 'simulateur', 'dpe', 'audit', 'dtg', 'amiante', 'plomb', 'electricite', 'gaz', 'termites', 'merule', 'erp', 'mesurage', 'assainissement' ),
		'pros'        => array( 'pros' ),
		'actualites'  => array( 'actualites', 'actualite' ),
		'qui'         => array( 'qui' ),
	);

	foreach ( $rubriques as $rubrique => $pages ) {
		if ( in_array( $page, $pages, true ) ) {
			return $rubrique;
		}
	}
	return null;
}

/**
 * Vrai si la clé désigne la page affichée.
 *
 * @param string $cle Clé de dih_chemins().
 * @return bool
 */
function dih_est_courante( $cle ) {
	return dih_page_courante() === $cle;
}
