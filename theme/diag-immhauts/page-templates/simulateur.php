<?php
/**
 * Template Name: Simulateur
 *
 * « De quoi ai-je besoin ? » (/simulateur-diagnostics-obligatoires/) : hero,
 * questionnaire (motif, type, année, précisions), dossier de résultats en
 * mosaïque ou en liste, bloc rappel. Règles : assets/js/simulateur.js.
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c = dih_contenu( 'simulateur' );
?>
<main id="contenu" class="l-main l-main--simulateur">
	<?php
	get_template_part( 'template-parts/simulateur/hero', null, $dih_c['hero'] );
	get_template_part( 'template-parts/simulateur/questionnaire', null, $dih_c );
	get_template_part(
		'template-parts/composants/rappel',
		null,
		array(
			'variante' => 'fiche',
			'options'  => array( 'ample' ),
			'titre'    => $dih_c['rappel']['titre'],
			'texte'    => $dih_c['rappel']['texte'],
		)
	);
	?>
</main>
<?php
get_footer();
