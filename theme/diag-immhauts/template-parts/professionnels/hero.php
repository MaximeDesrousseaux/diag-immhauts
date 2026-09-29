<?php
/**
 * Hero de la page Professionnels : même charpente que le hero des fiches
 * (pastille, titre, chapeau, deux boutons, illustration à halo lumineux), avec
 * sa propre grille (1,15 fr | 1 fr, alignée en bas) et un bouton d'appel.
 *
 * @package DiagImmHauts
 */

$dih_tel = 'Appeler le ' . esc_html( dih_info( 'telephone' ) );
?>
<section class="l-hero l-hero--fiche l-hero--pros">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<?php dih_ariane( array( array( $args['ariane'] ) ), 'c-ariane--fiche' ); ?>
		<div class="l-hero__grille">
			<div class="l-hero__texte">
				<div class="c-pastille c-pastille--fiche"><span aria-hidden="true"></span><?php echo esc_html( $args['pastille'] ); ?></div>
				<h1 class="l-hero__titre"><?php echo esc_html( $args['titre'] ); ?><br><span class="l-hero__accent"><?php echo esc_html( $args['accent'] ); ?></span></h1>
				<p class="l-hero__chapeau"><?php echo esc_html( $args['chapeau'] ); ?></p>
				<div class="l-hero__actions">
					<?php
					echo dih_bouton( $args['cta'], dih_attr_rappel(), 'fleche-courte', 'c-btn--vert c-btn--fiche' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo dih_bouton( $dih_tel, 'href="tel:' . esc_attr( dih_info( 'telephone_lien' ) ) . '"', 'telephone', 'c-btn--contour c-btn--fiche-2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</div>
			</div>
			<div class="l-hero__illus-fiche l-hero__illus-pros">
				<div class="l-hero__illus-halo l-hero__illus-halo--lumineux" aria-hidden="true"></div>
				<img src="<?php echo esc_url( dih_img( $args['illus'] ) ); ?>" alt="<?php echo esc_attr( $args['illus_alt'] ); ?>" fetchpriority="high" decoding="async">
			</div>
		</div>
	</div>
</section>
