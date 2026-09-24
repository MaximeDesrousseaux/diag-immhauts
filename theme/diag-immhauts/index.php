<?php
/**
 * Gabarit de repli (WordPress l'exige). Les pages ont chacune leur gabarit.
 *
 * @package DiagImmHauts
 */

get_header();
?>
<main id="contenu" class="dih-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'dih-conteneur' ); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			<?php
		endwhile;
	endif;
	?>
</main>
<?php
get_footer();
