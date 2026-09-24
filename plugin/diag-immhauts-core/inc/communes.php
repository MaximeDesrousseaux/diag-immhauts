<?php
/**
 * « Vérifier ma commune » (accueil, #zones) : table des codes postaux et communes.
 *
 * Le fichier donnees/communes.json est servi tel quel (fichier statique, mis en
 * cache par le navigateur) ; assets/js/commune.js, dans le thème, le charge à
 * la première ouverture du champ.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * URL publique de la table, versionnée par sa date de modification.
 *
 * @return string
 */
function dih_core_url_communes() {
	$fichier = DIH_CORE_DIR . 'donnees/communes.json';
	$version = file_exists( $fichier ) ? filemtime( $fichier ) : DIH_CORE_VERSION;
	return add_query_arg( 'ver', $version, DIH_CORE_URL . 'donnees/communes.json' );
}
