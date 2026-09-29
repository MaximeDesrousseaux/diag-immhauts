<?php
/**
 * « Copropriétés & collectivités » (#copro) : texte + CTA, illustration dans un
 * cadre vert pâle, puis quatre prestations en cards illustrées.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-copro" id="copro">
	<div class="l-copro__int">
		<div class="l-copro__haut">
			<div>
				<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
				<p class="l-copro__texte"><?php echo esc_html( $args['texte'] ); ?></p>
				<?php echo dih_bouton( $args['cta'], 'href="#rappel"', 'fleche-courte', 'c-btn--vert l-copro__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<div class="l-copro__image">
				<img src="<?php echo esc_url( dih_img( $args['image'] ) ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>" loading="lazy" decoding="async">
			</div>
		</div>
		<ul class="l-copro__cartes">
			<?php foreach ( $args['cartes'] as $dih_c ) : ?>
				<li class="c-card c-card--prestation">
					<span class="c-card__cadre" aria-hidden="true">
						<span class="c-card__illus" style="background-image:url('<?php echo esc_url( dih_img( $dih_c[0] ) ); ?>')"></span>
					</span>
					<span class="c-card__corps">
						<span class="c-card__titre"><?php echo esc_html( $dih_c[1] ); ?></span>
						<span class="c-card__texte"><?php echo esc_html( $dih_c[2] ); ?></span>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
