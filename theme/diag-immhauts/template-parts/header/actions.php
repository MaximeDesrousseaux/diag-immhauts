<?php
/**
 * Téléphone et CTA du header (bureau).
 *
 * Entre 1061 et 1232 px, le CTA devient une pastille ronde de 42 px à icône
 * enveloppe. Le CTA reste masqué tant que le CTA vert du hero est visible
 * (assets/js/nav.js).
 *
 * @package DiagImmHauts
 */

$dih_cta = dih_cta_header();
?>
<div class="dih-hdr-actions">
	<a class="dih-hdr-tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>">
		<span class="dih-tel-l">Ligne directe</span>
		<span class="dih-tel-n"><?php echo esc_html( dih_info( 'telephone' ) ); ?></span>
	</a>
	<span class="dih-hdr-cta">
		<a class="dih-cta dih-cta--vert" href="<?php echo esc_url( $dih_cta['href'] ); ?>"<?php echo $dih_cta['popup'] ? ' data-dih-rappel' : ''; ?> aria-label="<?php echo esc_attr( $dih_cta['texte'] ); ?>">
			<span class="dih-cta-t"><?php echo esc_html( $dih_cta['texte'] ); ?></span>
			<span class="dih-cta-i"><?php echo dih_icone( 'enveloppe', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</a>
	</span>
</div>
