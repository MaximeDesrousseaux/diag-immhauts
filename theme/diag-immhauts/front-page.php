<?php
/**
 * Accueil (maquette « Diag Imm'Hauts - Accueil »).
 *
 * @package DiagImmHauts
 */

get_header();
$dih_faq = dih_contenu( 'accueil', 'faq' );
?>
<main id="contenu" class="l-main l-main--accueil">
	<?php
	get_template_part( 'template-parts/accueil/hero' );
	get_template_part( 'template-parts/composants/confiance' );
	get_template_part( 'template-parts/accueil/une' );
	get_template_part( 'template-parts/accueil/prestations' );
	get_template_part( 'template-parts/accueil/detail' );
	get_template_part( 'template-parts/accueil/expert' );
	get_template_part( 'template-parts/accueil/zones' );
	get_template_part( 'template-parts/accueil/avis' );
	get_template_part( 'template-parts/composants/faq', null, $dih_faq );
	get_template_part( 'template-parts/composants/rappel' );
	?>
</main>
<?php
get_footer();
