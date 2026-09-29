<?php
/**
 * « Ce que j'apporte à votre organisation » : trois cards métier (agences,
 * notaires, syndics & bailleurs) en damier, illustration en débord, points cochés.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-profils">
	<div class="l-profils__tete">
		<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<h2 class="l-section__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
	</div>
	<div class="l-profils__grille">
		<?php foreach ( $args['cartes'] as $dih_c ) : ?>
			<article class="c-card c-card--profil">
				<span class="c-card__illus" aria-hidden="true" style="width:<?php echo (int) $dih_c[2]; ?>px;height:<?php echo (int) $dih_c[2]; ?>px;background-image:url('<?php echo esc_url( dih_img( $dih_c[1] ) ); ?>')"></span>
				<h3 class="c-card__titre"><?php echo esc_html( $dih_c[0] ); ?></h3>
				<p class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></p>
				<ul class="c-card__points">
					<?php foreach ( $dih_c[4] as $dih_point ) : ?>
						<li><span class="c-card__coche" aria-hidden="true">✓</span><?php echo esc_html( $dih_point ); ?></li>
					<?php endforeach; ?>
				</ul>
			</article>
		<?php endforeach; ?>
	</div>
</section>
