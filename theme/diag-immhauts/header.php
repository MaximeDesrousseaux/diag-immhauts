<?php
/**
 * En-tête commun aux 22 pages.
 *
 * Header épinglé (position: fixed) + espaceur dans le flux. Le hero de la page
 * (1re section .l-hero) remonte sous le header : la nav est transparente
 * en haut de page et passe au blanc au défilement (assets/js/nav.js).
 *
 * @package DiagImmHauts
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php dih_attributs_body(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#contenu">Aller au contenu</a>

<header class="l-entete" data-dih-hdr>
	<div class="l-entete__barre">
		<?php get_template_part( 'template-parts/header/logo' ); ?>
		<?php get_template_part( 'template-parts/header/nav-bureau' ); ?>
		<?php get_template_part( 'template-parts/header/actions' ); ?>
		<button type="button" class="l-entete__burger" aria-expanded="false" aria-controls="menu-burger" data-dih-burger>
			<span class="screen-reader-text">Menu</span>
			<span class="l-entete__trait l-entete__trait--h" aria-hidden="true"></span>
			<span class="l-entete__trait l-entete__trait--m" aria-hidden="true"></span>
			<span class="l-entete__trait l-entete__trait--b" aria-hidden="true"></span>
		</button>
	</div>
	<?php get_template_part( 'template-parts/header/burger' ); ?>
</header>
<div class="l-entete__espaceur" aria-hidden="true"></div>
