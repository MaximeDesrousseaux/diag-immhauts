<?php
/**
 * Plugin Name:       Diag Imm'Hauts — Cœur
 * Plugin URI:        https://diagimmhauts.fr/
 * Description:       Contenu structuré du site Diag Imm'Hauts : types de contenus, blocs ACF verrouillés, page d'options « Personnalisation », intégration Fluent Forms. Rien d'autre : l'apparence est portée par le thème.
 * Version:           0.2.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Diag Imm'Hauts
 * Text Domain:       diag-immhauts-core
 * License:           Propriétaire — tous droits réservés
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

define( 'DIH_CORE_VERSION', '0.2.0' );
define( 'DIH_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'DIH_CORE_URL', plugin_dir_url( __FILE__ ) );

require DIH_CORE_DIR . 'inc/dependances.php'; // ACF Pro et Fluent Forms : détection + message d'admin
require DIH_CORE_DIR . 'inc/formulaires.php'; // rendu des formulaires Fluent Forms
require DIH_CORE_DIR . 'inc/acf.php';         // point d'accroche des champs, blocs et options ACF
require DIH_CORE_DIR . 'inc/personnalisation.php'; // page d'options « Personnalisation », formulaires, réglages de page
require DIH_CORE_DIR . 'inc/communes.php';    // table des codes postaux de « Vérifier ma commune »
