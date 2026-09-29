<?php
/**
 * Hero du simulateur : fil d'Ariane, titre, chapeau, bouton vers le questionnaire,
 * illustration « maison et outils » (350 px en bureau, 240 px en déplié, sans halo :
 * maquettes v10). Téléphone : titre | illustration (44 %), puis chapeau et bouton.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-hero l-hero--simulateur">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<?php dih_ariane( array( array( 'Nos diagnostics', dih_url( 'diagnostics' ) ), array( $args['ariane'] ) ), 'c-ariane--fiche c-ariane--espace' ); ?>
		<h1 class="l-hero__titre"><?php echo esc_html( $args['titre_1'] ); ?><span class="l-hero__accent"><?php echo esc_html( $args['accent'] ); ?></span><?php echo esc_html( $args['titre_2'] ); ?></h1>
		<p class="l-hero__chapeau"><?php echo esc_html( $args['chapeau'] ); ?></p>
		<div class="l-hero__actions">
			<?php echo dih_bouton( $args['cta'], 'href="#simulateur"', 'descendre', 'c-btn--vert c-btn--fiche' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<img class="l-hero__illus-sim" src="<?php echo esc_url( dih_img( $args['illus'] ) ); ?>" alt="<?php echo esc_attr( $args['illus_alt'] ); ?>" width="700" height="700" fetchpriority="high" decoding="async">
	</div>
</section>
