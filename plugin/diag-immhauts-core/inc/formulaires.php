<?php
/**
 * Formulaires Fluent Forms : rappel (popup), devis (page Contact), contact.
 *
 * Le thème appelle dih_core_formulaire( $cle ) ; une chaîne vide lui signale
 * d'afficher son emplacement balisé (Fluent Forms absent ou formulaire non créé).
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Identifiants Fluent Forms de chaque formulaire du site.
 * À renseigner une fois les formulaires créés (étape 5 : champ de la page d'options).
 *
 * @return array<string, int>
 */
function dih_core_formulaires_ids() {
	return apply_filters(
		'dih_formulaires_ids',
		array(
			'rappel'  => 0,
			'devis'   => 0,
			'contact' => 0,
		)
	);
}

/**
 * HTML du formulaire demandé, ou chaîne vide s'il n'est pas disponible.
 *
 * @param string $cle 'rappel' | 'devis' | 'contact'.
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
