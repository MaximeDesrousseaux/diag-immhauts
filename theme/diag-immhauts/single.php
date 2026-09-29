<?php
/**
 * Article du journal (/actualites/<slug>/) : hero (fil d'Ariane à trois niveaux,
 * catégorie, date et durée de lecture, chapeau, illustration) et corps de
 * l'article (.c-art : composants du journal, voir composants/_article.scss).
 *
 * Champs : dih_ariane (maillon court du fil d'Ariane), dih_chapeau,
 * dih_lecture, dih_illustration (outils/importer-articles.php).
 *
 * @package DiagImmHauts
 */

get_header();
?>
<main id="contenu" class="l-main l-main--article">
	<?php
	while ( have_posts() ) :
		the_post();
		$dih_id    = get_the_ID();
		$dih_cat   = get_the_category();
		$dih_court = get_post_meta( $dih_id, 'dih_ariane', true );
		$dih_lire  = get_post_meta( $dih_id, 'dih_lecture', true );

		get_template_part(
			'template-parts/hero/page',
			null,
			array(
				'titre'        => dih_titre_insecable( get_the_title() ),
				'ariane'       => $dih_court ? $dih_court : get_the_title(),
				'parent'       => array( 'Actualités', dih_url( 'actualites' ) ),
				'pastille'     => $dih_cat ? $dih_cat[0]->name : '',
				'date'         => dih_date_article( $dih_id ) . ( $dih_lire ? ' · ' . $dih_lire . ' min de lecture' : '' ),
				'chapeau'      => get_post_meta( $dih_id, 'dih_chapeau', true ),
				'illustration' => get_post_meta( $dih_id, 'dih_illustration', true ),
				'variante'     => 'article',
			)
		);
		?>
		<article class="c-art">
			<?php the_content(); ?>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
