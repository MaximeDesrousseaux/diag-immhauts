<?php
/**
 * Bande des quatre repères sous le hero d'une fiche (validité, durée, délai…).
 *
 * Arguments : reperes [ picto, valeur, légende ].
 *
 * @package DiagImmHauts
 */

?>
<section class="c-reperes" aria-label="En bref">
	<ul class="c-reperes__int">
		<?php foreach ( $args['reperes'] as $dih_r ) : ?>
			<li class="c-reperes__item">
				<span class="c-reperes__picto" aria-hidden="true"><?php echo dih_icone( $dih_r[0], 22, array( 'epaisseur' => 1.7 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span>
					<span class="c-reperes__valeur"><?php echo esc_html( $dih_r[1] ); ?></span>
					<span class="c-reperes__legende"><?php echo esc_html( $dih_r[2] ); ?></span>
				</span>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
