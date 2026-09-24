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
<div class="l-entete__actions">
	<a class="l-entete__tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>">
		<span class="l-entete__tel-libelle">Ligne directe</span>
		<span class="l-entete__tel-numero"><?php echo esc_html( dih_info( 'telephone' ) ); ?></span>
	</a>
	<span class="l-entete__cta">
		<a class="c-btn c-btn--vert" href="<?php echo esc_url( $dih_cta['href'] ); ?>"<?php echo $dih_cta['popup'] ? ' data-dih-rappel' : ''; ?> aria-label="<?php echo esc_attr( $dih_cta['texte'] ); ?>">
			<span class="c-btn__texte"><?php echo esc_html( $dih_cta['texte'] ); ?></span>
			<span class="c-btn__icone"><?php echo dih_icone( 'enveloppe', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</a>
	</span>
</div>
