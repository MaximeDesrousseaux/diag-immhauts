<?php
/**
 * Dépendances : ACF Pro ou Secure Custom Fields (champs, pages d'options) et Fluent
 * Forms (formulaires ; la version gratuite suffit, Turnstile compris).
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
			$manquants[] = '<strong>Fluent Forms</strong> (formulaires de rappel, de devis et de compte partenaire)';
		} elseif ( dih_core_acf_actif() && ! array_filter( dih_core_formulaires_ids() ) ) {
			$manquants[] = 'les <strong>formulaires</strong> (à créer avec <code>wp eval-file outils/importer-formulaires.php</code>)';
		}

		if ( ! $manquants ) {
			return;
		}

		echo '<div class="notice notice-warning"><p><strong>Diag Imm\'Hauts — Cœur :</strong> il manque ';
		echo wp_kses_post( implode( ' et ', $manquants ) );
		echo '. En attendant, le site utilise ses réglages par défaut et affiche un emplacement à la place des formulaires.</p></div>';
	}
);
