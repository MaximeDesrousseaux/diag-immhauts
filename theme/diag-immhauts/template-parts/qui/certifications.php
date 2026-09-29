<?php
/**
 * « Certifié, assuré, contrôlé » : bande vert profond, texte et garanties à
 * gauche, six domaines certifiés à droite.
 *
 * @package DiagImmHauts
 */

$dih_coche = '<circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.5 2.5 4.5-5"></path>';
?>
<section class="l-certifs">
	<div class="l-certifs__int">
		<div class="l-certifs__grille">
			<div>
				<?php echo dih_surtitre( $args['surtitre'], 'c-surtitre--clair' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2 class="l-section__titre l-certifs__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
				<p class="l-certifs__texte"><?php echo esc_html( $args['texte'] ); ?></p>
				<ul class="l-certifs__garanties">
					<?php foreach ( $args['garanties'] as $dih_g ) : ?>
						<li><span class="l-certifs__coche"><?php echo dih_svg( $dih_coche, 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo esc_html( $dih_g ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="l-certifs__domaines">
				<?php foreach ( $args['domaines'] as $dih_d ) : ?>
					<div class="c-card c-card--obligation c-card--domaine">
						<span class="c-card__picto"><?php echo dih_svg( $dih_d[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3 class="c-card__titre"><?php echo esc_html( $dih_d[1] ); ?></h3>
						<p class="c-card__texte"><?php echo esc_html( $dih_d[2] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
