<?php
/**
 * Thème Diag Imm'Hauts — point d'entrée.
 *
 * Le thème porte l'apparence (gabarits, partials, SCSS, JS natif).
 * Le plugin diag-immhauts-core porte le contenu structuré (CPT, blocs ACF,
 * page d'options, formulaires). Le thème reste utilisable sans lui : chaque
 * appel au plugin passe par function_exists() et retombe sur une valeur par défaut.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

define( 'DIH_VERSION', '0.2.0' );
define( 'DIH_DIR', get_template_directory() );
define( 'DIH_URI', get_template_directory_uri() );

require DIH_DIR . '/inc/options.php';     // dih_option() : réglages globaux (page d'options ACF, défauts en dur)
require DIH_DIR . '/inc/infos.php';       // dih_info()   : coordonnées et chiffres arrêtés
require DIH_DIR . '/inc/liens.php';       // dih_url(), page et section en cours
require DIH_DIR . '/inc/setup.php';       // supports du thème, classes du body
require DIH_DIR . '/inc/assets.php';      // style.css, polices, scripts
require DIH_DIR . '/inc/icones.php';      // pictos SVG en ligne
require DIH_DIR . '/inc/gabarits.php';    // balises de gabarit : logo, CTA, liens de nav
require DIH_DIR . '/inc/formulaires.php'; // emplacements de formulaires (Fluent Forms)
require DIH_DIR . '/inc/contenus.php';    // dih_contenu() : textes par défaut des gabarits
require DIH_DIR . '/inc/seo.php';         // titre, description, canonique, og, JSON-LD
