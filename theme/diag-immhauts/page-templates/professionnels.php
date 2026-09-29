<?php
/**
 * Template Name: Professionnels
 *
 * Page partenaires (/professionnels-agences-notaires-syndics/) : hero, profils
 * (agences, notaires, syndics), six engagements, packs, commande en 4 étapes,
 * FAQ des professionnels, bloc rappel « compte partenaire ».
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c = dih_contenu( 'professionnels' );
?>
<main id="contenu" class="l-main l-main--pros">
	<?php
	get_template_part( 'template-parts/professionnels/hero', null, $dih_c['hero'] );
	get_template_part( 'template-parts/professionnels/profils', null, $dih_c['profils'] );
	get_template_part( 'template-parts/professionnels/engagements', null, $dih_c['engagements'] );
	get_template_part( 'template-parts/professionnels/packs', null, $dih_c['packs'] );
	get_template_part( 'template-parts/professionnels/process', null, $dih_c['process'] );
	get_template_part( 'template-parts/composants/faq', null, $dih_c['faq'] + array( 'variante' => 'pros' ) );
	get_template_part(
		'template-parts/composants/rappel',
		null,
		array(
			'variante'   => 'fiche',
			'titre'      => $dih_c['rappel']['titre'],
			'texte'      => $dih_c['rappel']['texte'],
			'formulaire' => $dih_c['rappel']['formulaire'],
		)
	);
	?>
</main>
<?php
get_footer();
