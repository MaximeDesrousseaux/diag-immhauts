<?php
/**
 * Bandeau de confiance : note Google + trois engagements.
 * Même composant sur l'accueil et Qui suis-je (README).
 * Arguments : items [ picto, titre, légende ] (défaut : ceux de l'accueil),
 * variante ('' | 'qui' : en ligne, calée à gauche en déplié).
 *
 * @package DiagImmHauts
 */

$dih_items    = ! empty( $args['items'] ) ? $args['items'] : dih_contenu( 'accueil', 'confiance' );
$dih_variante = ! empty( $args['variante'] ) ? ' c-confiance--' . $args['variante'] : '';
?>
<section class="c-confiance<?php echo esc_attr( $dih_variante ); ?>" aria-label="Nos garanties">
	<div class="c-confiance__int">
		<div class="c-confiance__google">
			<span class="c-confiance__logo" aria-hidden="true" style="background-image:url('<?php echo esc_url( dih_img( 'google.svg', 'logos' ) ); ?>')"></span>
			<span class="c-confiance__note">
				<span class="c-confiance__ligne">
					<span class="c-confiance__chiffre"><?php echo esc_html( dih_info( 'avis_note' ) ); ?></span>
					<span class="c-etoiles" aria-label="5 étoiles sur 5">★★★★★</span>
				</span>
				<span class="c-confiance__legende">Note Google · <?php echo esc_html( dih_info( 'avis_nombre' ) ); ?> avis clients</span>
			</span>
		</div>
		<?php foreach ( $dih_items as $dih_item ) : ?>
			<span class="c-confiance__filet" aria-hidden="true"></span>
			<div class="c-confiance__item">
				<span class="c-confiance__picto" aria-hidden="true"><?php echo dih_icone( $dih_item[0], 22, array( 'epaisseur' => 1.7 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span>
					<span class="c-confiance__titre"><?php echo esc_html( $dih_item[1] ); ?></span>
					<span class="c-confiance__legende"><?php echo esc_html( $dih_item[2] ); ?></span>
				</span>
			</div>
		<?php endforeach; ?>
	</div>
</section>
