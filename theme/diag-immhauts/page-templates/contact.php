<?php
/**
 * Template Name: Contact
 *
 * Contact & devis (/contact-devis/) : hero à promesses, formulaire de devis
 * (#devis, Fluent Forms) et colonne de contact (téléphone, horaires, zone,
 * coordonnées).
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c = dih_contenu( 'contact' );
?>
<main id="contenu" class="l-main l-main--contact">
	<?php
	get_template_part( 'template-parts/contact/hero', null, $dih_c['hero'] );
	get_template_part( 'template-parts/contact/devis', null, $dih_c );
	?>
</main>
<?php
get_footer();
