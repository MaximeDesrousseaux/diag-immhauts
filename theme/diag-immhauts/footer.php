<?php
/**
 * Pied de page commun aux 22 pages, popup « Demande de rappel »
 * et bouton d'appel fixe (déplié et mobile).
 *
 * @package DiagImmHauts
 */

get_template_part( 'template-parts/footer/pied' );
get_template_part( 'template-parts/composants/popup-rappel' );
?>
<a class="c-appel-fixe" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Appeler %s au %s', dih_info( 'dirigeant' ), dih_info( 'telephone' ) ) ); ?>">
	<?php echo dih_icone( 'telephone-plein', 27 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</a>
<?php wp_footer(); ?>
</body>
</html>
