<?php
/**
 * Gabarit des pages de texte (Mentions légales et pages sans gabarit dédié).
 *
 * @package DiagImmHauts
 */

get_header();
?>
<main id="contenu" class="l-main">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/hero/page' );

		if ( '' !== trim( get_the_content() ) ) :
			?>
			<div class="c-article">
				<?php the_content(); ?>
			</div>
			<?php
		endif;
	endwhile;
	?>
</main>
<?php
get_footer();
