<?php
/**
 * Point d'accroche ACF : groupes de champs et pages d'options.
 *
 * Tout ce qui dépend d'ACF est enregistré sur 'acf/init' : sans ACF Pro ni Secure
 * Custom Fields, ce hook ne se déclenche jamais et rien ne plante (inc/dependances.php).
 * Les modules s'accrochent à dih_core_acf_init : inc/personnalisation.php (pages
 * d'options « Personnalisation » et « Formulaires », réglages de page) et
 * inc/contenus-modifiables.php (avis clients, FAQ).
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'acf/init',
	function () {
		if ( ! dih_core_acf_actif() ) {
			return;
		}

		/**
		 * Les modules ACF du plugin s'accrochent ici.
		 */
		do_action( 'dih_core_acf_init' );
	}
);
