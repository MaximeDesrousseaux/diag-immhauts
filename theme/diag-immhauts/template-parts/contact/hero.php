<?php
/**
 * Hero de Contact : fil d'Ariane, titre, chapeau, trois promesses cochées,
 * illustration à halo lumineux. Téléphone : titre | illustration (36 %).
 *
 * @package DiagImmHauts
 */

$dih_coche = '<circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.5 2.5 4.5-5"></path>';
?>
<section class="l-hero l-hero--contact">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<div class="l-hero__texte">
			<?php dih_ariane( array( array( $args['ariane'] ) ), 'c-ariane--fiche c-ariane--espace' ); ?>
			<h1 class="l-hero__titre"><?php echo esc_html( $args['titre_1'] ); ?><br class="l-br-mobile"> <?php echo esc_html( $args['titre_2'] ); ?><br class="l-br-mobile"> <span class="l-hero__accent"><?php echo esc_html( $args['accent'] ); ?></span></h1>
			<p class="l-hero__chapeau"><?php echo esc_html( $args['chapeau'] ); ?></p>
			<ul class="l-contact__promesses">
				<?php foreach ( $args['promesses'] as $dih_p ) : ?>
					<li><span class="l-contact__coche"><?php echo dih_svg( $dih_coche, 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php echo esc_html( $dih_p ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="l-contact__illus">
			<div class="l-hero__illus-halo l-hero__illus-halo--lumineux" aria-hidden="true"></div>
			<img src="<?php echo esc_url( dih_img( $args['illus'] ) ); ?>" alt="<?php echo esc_attr( $args['illus_alt'] ); ?>" fetchpriority="high" decoding="async">
		</div>
	</div>
</section>
