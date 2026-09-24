<?php
/**
 * Emplacements de formulaires.
 *
 * Les formulaires sont confiés à Fluent Forms Pro (rappel, devis, contact).
 * Le plugin diag-immhauts-core fournit dih_core_formulaire() qui rend le bon
 * formulaire ; tant qu'il n'est pas branché (plugin ou Fluent Forms absent,
 * identifiant non renseigné), le thème affiche un emplacement balisé.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Affiche le formulaire demandé ou son emplacement balisé.
 *
 * @param string $cle      'rappel' | 'devis' | 'contact'.
 * @param string $variante '' ou 'sombre' (sur fond vert : carte du hero mobile).
 */
function dih_formulaire( $cle, $variante = '' ) {
	if ( function_exists( 'dih_core_formulaire' ) ) {
		$html = dih_core_formulaire( $cle );
		if ( $html ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendu Fluent Forms
			return;
		}
	}

	$noms = array(
		'rappel'  => 'Demande de rappel',
		'devis'   => 'Demande de devis',
		'contact' => 'Contact',
	);
	$nom  = isset( $noms[ $cle ] ) ? $noms[ $cle ] : $cle;
	?>
	<div class="c-formulaire__emplacement<?php echo $variante ? ' c-formulaire__emplacement--' . esc_attr( $variante ) : ''; ?>" data-dih-form="<?php echo esc_attr( $cle ); ?>">
		<strong>Formulaire « <?php echo esc_html( $nom ); ?> »</strong>
		<span>Emplacement réservé à Fluent Forms (à brancher).</span>
	</div>
	<?php
}
