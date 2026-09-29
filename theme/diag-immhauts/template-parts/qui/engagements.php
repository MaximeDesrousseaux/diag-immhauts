<?php
/**
 * « Mes engagements » : quatre cards picto + titre + texte.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-qui-engagements" id="engagements">
	<div class="l-qui-engagements__tete">
		<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<h2 class="l-section__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
	</div>
	<div class="l-qui-engagements__grille">
		<?php foreach ( $args['cartes'] as $dih_c ) : ?>
			<div class="c-card c-card--engagement-qui">
				<span class="c-card__picto"><?php echo dih_svg( $dih_c[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="c-card__titre"><?php echo esc_html( $dih_c[1] ); ?></h3>
				<p class="c-card__texte"><?php echo esc_html( $dih_c[2] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
