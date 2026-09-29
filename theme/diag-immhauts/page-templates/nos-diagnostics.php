<?php
/**
 * Template Name: Nos diagnostics
 *
 * Catalogue des diagnostics (/diagnostics-immobiliers/) : hero à trois entrées
 * (réglages entrees_hero et hero_illustration), vente & location, 4 étapes, copropriétés,
 * audits énergétiques, FAQ, rappel. VERROUILLÉE en bureau et en déplié.
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c = dih_contenu( 'nos-diagnostics' );
?>
<main id="contenu" class="l-main l-main--nos">
	<?php
	get_template_part( 'template-parts/nos-diagnostics/hero', null, $dih_c['hero'] );
	get_template_part( 'template-parts/nos-diagnostics/vente', null, $dih_c['vente'] );
	get_template_part( 'template-parts/fiche/etapes', null, $dih_c['etapes'] );
	get_template_part( 'template-parts/nos-diagnostics/copro', null, $dih_c['copro'] );
	get_template_part( 'template-parts/nos-diagnostics/audit', null, $dih_c['audit'] );
	get_template_part( 'template-parts/composants/faq', null, $dih_c['faq'] + array( 'variante' => 'filet' ) );
	get_template_part(
		'template-parts/composants/rappel',
		null,
		array(
			'variante'   => 'page',
			'titre'      => $dih_c['rappel']['titre'],
			'texte'      => $dih_c['rappel']['texte'],
			'formulaire' => $dih_c['rappel']['formulaire'],
		)
	);
	?>
</main>
<?php
get_footer();
