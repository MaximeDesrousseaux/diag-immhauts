<?php
/**
 * Template Name: Fiche diagnostic
 *
 * Gabarit commun aux 12 fiches (DPE, amiante, plomb…) : hero, repères, sessions
 * (blocs typés, dans l'ordre des contenus), 4 étapes + préparation, FAQ,
 * diagnostics liés, rappel. Les contenus viennent de inc/contenus/fiche-<clé>.php,
 * la clé étant celle de la page dans dih_chemins() (ex. « dpe », « amiante »).
 *
 * @package DiagImmHauts
 */

get_header();

$dih_cle   = dih_page_courante();
$dih_fiche = dih_contenu( 'fiche-' . $dih_cle );
?>
<main id="contenu" class="l-main l-main--fiche">
	<?php
	if ( ! $dih_fiche ) :
		get_template_part( 'template-parts/hero/page' );
	else :
		get_template_part( 'template-parts/fiche/hero', null, $dih_fiche );
		get_template_part( 'template-parts/fiche/reperes', null, array( 'reperes' => $dih_fiche['reperes'] ) );

		foreach ( $dih_fiche['sessions'] as $dih_session ) {
			get_template_part( 'template-parts/fiche/session', $dih_session['type'], $dih_session );
		}

		get_template_part( 'template-parts/fiche/etapes', null, $dih_fiche['etapes'] );
		get_template_part( 'template-parts/composants/faq', null, $dih_fiche['faq'] );
		get_template_part( 'template-parts/fiche/lies', null, $dih_fiche['lies'] );
		get_template_part(
			'template-parts/composants/rappel',
			null,
			array(
				'variante' => 'fiche',
				'titre'    => $dih_fiche['rappel']['titre'],
				'texte'    => $dih_fiche['rappel']['texte'],
				'options'  => isset( $dih_fiche['rappel']['options'] ) ? $dih_fiche['rappel']['options'] : array(),
				'boutons'  => isset( $dih_fiche['rappel']['boutons'] ) ? $dih_fiche['rappel']['boutons'] : '',
			) + (
				isset( $dih_fiche['rappel']['formulaire'] ) ? array( 'formulaire' => $dih_fiche['rappel']['formulaire'] ) : array()
			)
		);
	endif;
	?>
</main>
<?php
get_footer();
