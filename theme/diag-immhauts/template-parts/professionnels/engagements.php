<?php
/**
 * « Six engagements, sans contrat d'exclusivité » : panneau vert, six cards
 * pictogramme + titre + texte.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-engagements">
	<div class="l-engagements__panneau">
		<div class="l-engagements__halo" aria-hidden="true"></div>
		<div class="l-engagements__int">
			<?php echo dih_surtitre( $args['surtitre'], 'c-surtitre--clair c-surtitre--serre' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-engagements__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<div class="l-engagements__grille">
				<?php foreach ( $args['cartes'] as $dih_c ) : ?>
					<div class="c-card c-card--obligation c-card--engagement">
						<span class="c-card__picto"><?php echo dih_svg( $dih_c[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3 class="c-card__titre"><?php echo esc_html( $dih_c[1] ); ?></h3>
						<p class="c-card__texte"><?php echo esc_html( $dih_c[2] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
