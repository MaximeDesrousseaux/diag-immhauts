<?php
/**
 * En-tête commun aux 22 pages.
 *
 * Header épinglé (position: fixed) + espaceur dans le flux. Le hero de la page
 * (1re section .dih-hero) remonte sous le header : la nav est transparente
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
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#contenu">Aller au contenu</a>

<header class="dih-hdr" data-dih-hdr>
	<div class="dih-hdr-row">
		<?php get_template_part( 'template-parts/header/logo' ); ?>
		<?php get_template_part( 'template-parts/header/nav-bureau' ); ?>
		<?php get_template_part( 'template-parts/header/actions' ); ?>
		<button type="button" class="dih-hdr-burger" aria-expanded="false" aria-controls="dih-burger-panel" data-dih-burger>
			<span class="screen-reader-text">Menu</span>
			<span class="dih-burg-l dih-burg-l--h" aria-hidden="true"></span>
			<span class="dih-burg-l dih-burg-l--m" aria-hidden="true"></span>
			<span class="dih-burg-l dih-burg-l--b" aria-hidden="true"></span>
		</button>
	</div>
	<?php get_template_part( 'template-parts/header/burger' ); ?>
</header>
<div class="dih-hdr-spacer" aria-hidden="true"></div>
