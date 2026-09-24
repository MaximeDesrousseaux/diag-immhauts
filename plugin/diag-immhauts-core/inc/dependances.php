<?php
/**
 * Dépendances : ACF Pro (blocs, champs, page d'options) et Fluent Forms Pro (formulaires).
 *
 * Tant qu'elles manquent, rien ne plante : le site s'affiche avec ses valeurs par
 * défaut et un message d'administration indique ce qu'il reste à installer.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * ACF Pro est-il actif ? (les blocs et la page d'options exigent la version Pro)
 *
 * @return bool
 */
function dih_core_acf_actif() {
	return class_exists( 'ACF' ) && defined( 'ACF_PRO' ) && ACF_PRO;
}

/**
 * Fluent Forms est-il actif ?
 *
 * @return bool
 */
function dih_core_fluentforms_actif() {
	return defined( 'FLUENTFORM' ) || function_exists( 'wpFluentForm' );
}

/**
 * Message d'administration listant les extensions manquantes.
 */
add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$manquants = array();
		if ( ! dih_core_acf_actif() ) {
			$manquants[] = '<strong>ACF Pro</strong> (blocs éditables et page « Personnalisation »)';
		}
		if ( ! dih_core_fluentforms_actif() ) {
			$manquants[] = '<strong>Fluent Forms Pro</strong> (formulaires de rappel, devis et contact)';
		} elseif ( ! defined( 'FLUENTFORMPRO' ) ) {
			$manquants[] = '<strong>Fluent Forms Pro</strong> (la version gratuite est active ; Turnstile et les champs avancés demandent la version Pro)';
		}

		if ( ! $manquants ) {
			return;
		}

		echo '<div class="notice notice-warning"><p><strong>Diag Imm\'Hauts — Cœur :</strong> il manque ';
		echo wp_kses_post( implode( ' et ', $manquants ) );
		echo '. En attendant, le site utilise ses réglages par défaut et affiche un emplacement à la place des formulaires.</p></div>';
	}
);
