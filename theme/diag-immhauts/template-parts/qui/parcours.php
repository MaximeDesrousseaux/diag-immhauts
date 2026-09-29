<?php
/**
 * « Mon parcours » (#parcours) : texte et citation à gauche, frise à droite.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-parcours" id="parcours">
	<div class="l-parcours__grille">
		<div>
			<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-parcours__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<?php foreach ( $args['paragraphes'] as $dih_p ) : ?>
				<p class="l-parcours__para"><?php echo esc_html( $dih_p ); ?></p>
			<?php endforeach; ?>
			<figure class="l-parcours__citation">
				<blockquote><p><?php echo esc_html( $args['citation'] ); ?></p></blockquote>
				<figcaption><?php echo esc_html( $args['signature'] ); ?></figcaption>
			</figure>
		</div>
		<ol class="c-frise-annees">
			<?php foreach ( $args['frise'] as $dih_f ) : ?>
				<li class="c-frise-annees__item">
					<span class="c-frise-annees__annee"><?php echo esc_html( $dih_f[0] ); ?></span>
					<div class="c-frise-annees__corps">
						<h3 class="c-frise-annees__titre"><?php echo esc_html( $dih_f[1] ); ?></h3>
						<p class="c-frise-annees__texte"><?php echo esc_html( $dih_f[2] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
