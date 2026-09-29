<?php
/**
 * Formulaires Fluent Forms : rappel (popup), devis (page Contact), contact,
 * compte partenaire (popup de Professionnels).
 *
 * Le thème appelle dih_core_formulaire( $cle ) ; une chaîne vide lui signale
 * d'afficher son emplacement balisé (Fluent Forms absent ou formulaire non créé).
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Identifiants Fluent Forms de chaque formulaire du site, saisis dans
 * Diag Imm'Hauts → Formulaires (page d'options ACF, inc/personnalisation.php).
 *
 * @return array<string, int>
 */
function dih_core_formulaires_ids() {
	$ids = array(
		'rappel'     => 0,
		'devis'      => 0,
		'contact'    => 0,
		'partenaire' => 0,
	);
	if ( dih_core_acf_actif() ) {
		foreach ( array_keys( $ids ) as $cle ) {
			$ids[ $cle ] = absint( get_field( 'formulaire_' . $cle, 'option' ) );
		}
	}
	return apply_filters( 'dih_formulaires_ids', $ids );
}

/**
 * HTML du formulaire demandé, ou chaîne vide s'il n'est pas disponible.
 *
 * @param string $cle 'rappel' | 'devis' | 'contact' | 'partenaire'.
 * @return string
 */
function dih_core_formulaire( $cle ) {
	$ids = dih_core_formulaires_ids();
	$id  = isset( $ids[ $cle ] ) ? absint( $ids[ $cle ] ) : 0;

	if ( ! $id || ! dih_core_fluentforms_actif() || ! shortcode_exists( 'fluentform' ) ) {
		return '';
	}

	return do_shortcode( sprintf( '[fluentform id="%d"]', $id ) );
}
