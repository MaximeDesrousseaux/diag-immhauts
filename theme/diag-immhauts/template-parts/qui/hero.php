<?php
/**
 * Hero portrait de Qui suis-je.
 *
 * Bureau et déplié : texte | portrait sur un voile vert foncé, étalonné (maquettes
 * 1.14e), alignés en bas. Boutons :
 * devis + « Découvrir mon parcours » en bureau, devis + appel en déplié.
 * Téléphone : pastille, titre, chapeau court, portrait de 250 px et bouton
 * d'appel posé sur le portrait (maquette : « propal 1b »).
 *
 * @package DiagImmHauts
 */

$dih_tel_lien = 'tel:' . dih_info( 'telephone_lien' );
?>
<section class="l-hero l-hero--qui">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<?php dih_ariane( array( array( $args['ariane'] ) ), 'c-ariane--fiche' ); ?>
		<div class="l-qui__grille">
			<div class="l-qui__texte">
				<div class="c-pastille c-pastille--fiche c-pastille--qui"><span aria-hidden="true"></span><?php echo esc_html( $args['pastille'] ); ?></div>
				<h1 class="l-hero__titre"><?php echo esc_html( $args['titre'] ); ?><br><span class="l-hero__accent"><?php echo esc_html( $args['accent_1'] ); ?><br class="l-br-mobile"> <?php echo esc_html( $args['accent_2'] ); ?></span></h1>
				<p class="l-hero__chapeau l-qui__chapeau"><?php echo esc_html( $args['chapeau'] ); ?></p>
				<p class="l-hero__chapeau l-qui__chapeau-court"><?php echo esc_html( $args['chapeau_court'] ); ?></p>
				<div class="l-hero__actions l-qui__actions">
					<?php
					echo dih_bouton( $args['cta'], dih_attr_rappel(), 'enveloppe', 'c-btn--vert c-btn--fiche l-qui__devis' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
					<a class="c-btn c-btn--contour c-btn--fiche-2 l-qui__parcours" href="#parcours"><?php echo esc_html( $args['cta_parcours'] ); ?><span class="l-qui__descendre" aria-hidden="true"><?php echo dih_icone( 'fleche-bas', 17, array( 'epaisseur' => 2.4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
					<?php
					echo dih_bouton( 'Appeler le <span class="l-insecable">' . esc_html( dih_info( 'telephone' ) ) . '</span>', 'href="' . esc_attr( $dih_tel_lien ) . '"', 'telephone', 'c-btn--vert c-btn--fiche l-qui__appel-deplie' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</div>
			</div>
			<div class="l-qui__photo">
				<span class="l-qui__voile" aria-hidden="true"></span>
				<span class="l-qui__halo" aria-hidden="true"></span>
				<div class="l-qui__cadre">
					<img src="<?php echo esc_url( dih_img( $args['photo'] ) ); ?>" alt="<?php echo esc_attr( $args['photo_alt'] ); ?>" fetchpriority="high" decoding="async">
					<?php // Étalonnage limité à la silhouette : calque découpé par la photo elle-même. ?>
					<span class="l-qui__etalonnage" aria-hidden="true" style="--photo:url('<?php echo esc_url( dih_img( $args['photo'] ) ); ?>')"></span>
				</div>
				<a class="l-qui__appel" href="<?php echo esc_attr( $dih_tel_lien ); ?>"><?php echo dih_icone( 'telephone', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( dih_info( 'telephone' ) ); ?></a>
			</div>
		</div>
	</div>
</section>
