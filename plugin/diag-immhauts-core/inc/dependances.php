<?php
/**
 * Dépendances : ACF Pro ou Secure Custom Fields (champs, pages d'options) et Fluent
 * Forms Pro (formulaires).
 *
 * Tant qu'elles manquent, rien ne plante : le site s'affiche avec ses valeurs par
 * défaut et un message d'administration indique ce qu'il reste à installer.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * ACF Pro, ou Secure Custom Fields (reprise gratuite d'ACF par WordPress.org, qui
 * inclut les fonctions Pro), est-il actif ? Pages d'options et champs répétables
 * exigent l'un ou l'autre : ACF gratuit ne suffit pas.
 *
 * @return bool
 */
function dih_core_acf_actif() {
	if ( ! class_exists( 'ACF' ) ) {
		return false;
	}
	return ( defined( 'ACF_PRO' ) && ACF_PRO ) || function_exists( 'acf_add_options_page' );
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
			$manquants[] = '<strong>ACF Pro</strong> ou <strong>Secure Custom Fields</strong> (contenus modifiables et page « Personnalisation »)';
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
