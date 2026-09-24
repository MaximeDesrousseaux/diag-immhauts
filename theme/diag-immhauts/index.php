<?php
/**
 * Gabarit de repli (WordPress l'exige). Chaque page a son gabarit dédié ;
 * celui-ci ne sert qu'aux vues imprévues (recherche, archive, 404…).
 *
 * @package DiagImmHauts
 */

get_header();

if ( is_404() ) {
	$dih_titre = 'Page introuvable';
} elseif ( is_search() ) {
	$dih_titre = sprintf( 'Recherche : %s', get_search_query() );
} elseif ( is_archive() ) {
	$dih_titre = wp_strip_all_tags( get_the_archive_title() );
} elseif ( is_singular() ) {
	$dih_titre = get_the_title();
} else {
	$dih_titre = get_bloginfo( 'name' );
}
?>
<main id="contenu" class="l-main">
	<?php get_template_part( 'template-parts/hero/page', null, array( 'titre' => $dih_titre ) ); ?>
	<div class="c-article">
		<?php
		if ( is_404() ) :
			printf( '<p>Cette page n\'existe pas ou plus. <a href="%s">Retour à l\'accueil</a>.</p>', esc_url( dih_url( 'accueil' ) ) );
		elseif ( is_singular() ) :
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		elseif ( have_posts() ) :
			echo '<ul>';
			while ( have_posts() ) :
				the_post();
				printf( '<li><a href="%s">%s</a></li>', esc_url( get_permalink() ), esc_html( get_the_title() ) );
			endwhile;
			echo '</ul>';
		endif;
		?>
	</div>
</main>
<?php
get_footer();
