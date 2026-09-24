<?php
/**
 * Coordonnées et contenus arrêtés (README § Contenus arrêtés).
 * Centralisés ici pour qu'un changement de numéro ne touche qu'une ligne.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * @param string $cle Clé de l'information.
 * @return string
 */
function dih_info( $cle ) {
	$infos = array(
		'nom'            => "Diag Imm'Hauts",
		'baseline'       => 'Diagnostics immobiliers',
		'dirigeant'      => 'Maxime Dillies',
		'telephone'      => '06 35 88 43 00',
		'telephone_lien' => '+33635884300',
		'adresse'        => '19 route nationale, 62690 Berles-Monchel',
		'avis_google'    => 'https://www.google.com/search?q=Diag+Imm%27Hauts+Avis',
		'description'    => 'Diagnostics immobiliers pour la vente, la location, les copropriétés et les audits énergétiques dans le Pas-de-Calais et les Hauts-de-France.',
		'communes'       => 'Arras · Lens · Liévin · Béthune · Saint-Pol-sur-Ternoise · Aubigny-en-Artois · Avesnes-le-Comte · Tincques · Savy-Berlette · Houdain · Douai · Cambrai · et alentours.',
	);

	$valeur = isset( $infos[ $cle ] ) ? $infos[ $cle ] : '';

	return apply_filters( 'dih_info', $valeur, $cle );
}
