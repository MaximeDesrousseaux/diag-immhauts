<?php
/**
 * Point d'accroche ACF : groupes de champs, blocs verrouillés et page d'options.
 *
 * Tout ce qui dépend d'ACF est enregistré sur 'acf/init' : si ACF Pro est absent,
 * ce hook ne se déclenche jamais et rien ne plante (voir inc/dependances.php).
 * Les modules s'accrochent à dih_core_acf_init : inc/personnalisation.php
 * (pages d'options « Personnalisation » et « Formulaires », réglages de page).
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
