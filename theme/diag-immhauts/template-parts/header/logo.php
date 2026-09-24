<?php
/**
 * Logo du header : marque (réglage logo_site) + nom en toutes lettres.
 * Sur l'accueil, le logo n'est pas un lien (page en cours).
 *
 * @package DiagImmHauts
 */

$dih_accueil = dih_est_courante( 'accueil' );
$dih_balise  = $dih_accueil ? 'span' : 'a';
$dih_attrs   = $dih_accueil ? 'aria-current="page"' : 'href="' . esc_url( dih_url( 'accueil' ) ) . '"';
?>
<<?php echo $dih_balise; ?> class="dih-hdr-logo" <?php echo $dih_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php echo dih_logo_marque(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG statique ?>
	<span class="dih-logo-txt">
		<span class="dih-logo-word"><?php echo esc_html( dih_info( 'nom' ) ); ?></span>
		<span class="dih-hdr-tag"><?php echo esc_html( dih_info( 'baseline' ) ); ?></span>
	</span>
</<?php echo $dih_balise; ?>>
