<?php
/**
 * Panneau du burger (déplié et mobile, ≤ 900 px). « Accueil » y reste.
 *
 * @package DiagImmHauts
 */

$dih_lien = function ( $cle, $texte ) {
	echo dih_lien_nav( $cle, $texte, 'dih-burger-a' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
};
?>
<div class="dih-burger-panel" id="dih-burger-panel" hidden>
	<?php
	$dih_lien( 'accueil', 'Accueil' );
	$dih_lien( 'diagnostics', 'Tous les diagnostics' );
	$dih_lien( 'simulateur', 'De quoi ai-je besoin&nbsp;?' );
	?>
	<div class="dih-burger-h">Diagnostics</div>
	<?php
	foreach ( array(
		'dpe'            => 'DPE',
		'audit'          => 'Audit énergétique',
		'amiante'        => 'Amiante',
		'plomb'          => 'Plomb (CREP)',
		'electricite'    => 'Électricité',
		'gaz'            => 'Gaz',
		'termites'       => 'Termites',
		'merule'         => 'Mérule',
		'erp'            => 'État des risques (ERP)',
		'mesurage'       => 'Mesurage Carrez / Boutin',
		'assainissement' => 'Assainissement',
	) as $dih_cle => $dih_texte ) {
		$dih_lien( $dih_cle, $dih_texte );
	}
	?>
	<div class="dih-burger-h">Professionnels</div>
	<?php
	$dih_lien( 'dtg', 'DTG &amp; DPE collectif' );
	$dih_lien( 'pros', 'Syndics, agences &amp; bailleurs' );
	?>
	<div class="dih-burger-h">Le diagnostiqueur</div>
	<?php
	$dih_lien( 'actualites', 'Actualités' );
	$dih_lien( 'qui', 'Qui suis-je&nbsp;?' );
	$dih_lien( 'contact', 'Contact &amp; devis' );
	?>
	<a class="dih-burger-tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>">Appeler le <span class="dih-nowrap"><?php echo esc_html( dih_info( 'telephone' ) ); ?></span></a>
</div>
