<?php
/**
 * « Audits énergétiques » (#audit) : texte + CTA à gauche, étiquette A→G et
 * légende à droite (deux colonnes fixes, VERROUILLÉ en déplié).
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-audit" id="audit">
	<div class="l-audit__grille">
		<div class="l-audit__texte">
			<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<p class="l-audit__para"><?php echo wp_kses( $args['texte'], array( 'sup' => array() ) ); ?></p>
			<?php echo dih_bouton( $args['cta'], 'href="#rappel"', 'fleche-courte', 'c-btn--vert l-audit__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<figure class="l-audit__image">
			<img src="<?php echo esc_url( dih_img( $args['image'] ) ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>" loading="lazy" decoding="async">
			<figcaption class="l-audit__legende"><?php echo esc_html( $args['legende'] ); ?></figcaption>
		</figure>
	</div>
</section>
