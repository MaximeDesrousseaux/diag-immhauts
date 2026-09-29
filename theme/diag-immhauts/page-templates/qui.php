<?php
/**
 * Template Name: Qui suis-je
 *
 * Présentation de Maxime Dillies (/maxime-dillies-diagnostiqueur/) : hero
 * portrait, bandeau de confiance, parcours et frise, engagements,
 * certifications, déroulé d'une intervention, bloc rappel.
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c = dih_contenu( 'qui' );
?>
<main id="contenu" class="l-main l-main--qui">
	<?php
	get_template_part( 'template-parts/qui/hero', null, $dih_c['hero'] );
	get_template_part(
		'template-parts/composants/confiance',
		null,
		array(
			'items'    => $dih_c['confiance'],
			'variante' => 'qui',
		)
	);
	get_template_part( 'template-parts/qui/parcours', null, $dih_c['parcours'] );
	get_template_part( 'template-parts/qui/engagements', null, $dih_c['engagements'] );
	get_template_part( 'template-parts/qui/certifications', null, $dih_c['certifications'] );
	get_template_part( 'template-parts/fiche/etapes', null, $dih_c['etapes'] );
	get_template_part(
		'template-parts/composants/rappel',
		null,
		array(
			'variante'   => 'fiche',
			'options'    => array( 'ample' ),
			'titre'      => $dih_c['rappel']['titre'],
			'texte'      => $dih_c['rappel']['texte'],
			'formulaire' => $dih_c['rappel']['formulaire'],
		)
	);
	?>
</main>
<?php
get_footer();
