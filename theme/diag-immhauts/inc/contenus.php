<?php
/**
 * Contenus par défaut des gabarits (textes relevés sur les maquettes).
 *
 * Chaque page a son fichier inc/contenus/<page>.php qui retourne un tableau.
 * Les contenus modifiables dans l'admin (plugin, inc/contenus-modifiables.php) les
 * remplacent section par section via le filtre dih_contenu, sans que les gabarits
 * changent : ils ne lisent QUE dih_contenu().
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Contenus d'une page, ou d'une de ses sections.
 *
 * @param string $page    Nom du fichier de inc/contenus (ex. 'accueil').
 * @param string $section Section facultative (ex. 'hero').
 * @return array
 */
function dih_contenu( $page, $section = '' ) {
	static $cache = array();

	if ( ! isset( $cache[ $page ] ) ) {
		$fichier = DIH_DIR . '/inc/contenus/' . sanitize_file_name( $page ) . '.php';
		$donnees = file_exists( $fichier ) ? require $fichier : array();

		/**
		 * Remplace tout ou partie des contenus d'une page (blocs ACF, étape 5).
		 *
		 * @param array  $donnees Contenus par défaut.
		 * @param string $page    Nom de la page.
		 */
		$cache[ $page ] = (array) apply_filters( 'dih_contenu', $donnees, $page );
	}

	if ( '' === $section ) {
		return $cache[ $page ];
	}
	return isset( $cache[ $page ][ $section ] ) ? (array) $cache[ $page ][ $section ] : array();
}

/**
 * URL d'une cible de lien écrite dans les contenus : clé de page (dih_chemins),
 * ancre de la page courante (« #zones »), tableau [ clé, ancre ], ou adresse
 * complète (champ « lien » des contenus modifiables dans l'admin).
 *
 * @param string|array $cible Cible.
 * @return string
 */
function dih_url_cible( $cible ) {
	if ( is_array( $cible ) ) {
		return dih_url( $cible[0] ) . ( isset( $cible[1] ) ? $cible[1] . '/' : '' );
	}
	if ( 0 === strpos( (string) $cible, '#' ) || preg_match( '#^(https?:)?//|^/#', (string) $cible ) ) {
		return $cible;
	}
	return dih_url( $cible );
}

/**
 * URL de la table des communes (plugin diag-immhauts-core), ou chaîne vide :
 * sans elle, commune.js répond encore à partir du code postal saisi.
 *
 * @return string
 */
function dih_url_communes() {
	return function_exists( 'dih_core_url_communes' ) ? dih_core_url_communes() : '';
}
