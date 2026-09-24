<?php
/**
 * Nav de bureau (> 900 px). Pas d'item « Accueil » : le logo fait le lien.
 * « Actualités » vient avant « Qui suis-je ».
 *
 * La rubrique en cours est en gras (.is-courant) ; dans les menus déroulants,
 * la page en cours est un <span aria-current="page">.
 *
 * @package DiagImmHauts
 */

$dih_rubrique = dih_rubrique_courante();

/**
 * Item de 1er niveau (lien, ou span si c'est la page affichée).
 *
 * @param string $cle      Clé de page.
 * @param string $texte    Libellé.
 * @param string $rubrique Rubrique de l'item.
 * @param bool   $trigger  Ouvre un menu déroulant.
 */
$dih_item = function ( $cle, $texte, $rubrique, $trigger = false ) use ( $dih_rubrique ) {
	$classes = array( 'dih-nav-top' );
	if ( $rubrique === $dih_rubrique ) {
		$classes[] = 'is-courant';
	}
	$attr = ' class="' . esc_attr( implode( ' ', $classes ) ) . '"' . ( $trigger ? ' data-navtrigger' : '' );

	if ( dih_est_courante( $cle ) ) {
		printf( '<span%s aria-current="page">%s</span>', $attr, wp_kses_post( $texte ) );
	} else {
		printf( '<a%s href="%s">%s</a>', $attr, esc_url( dih_url( $cle ) ), wp_kses_post( $texte ) );
	}
};

$dih_col = function ( $titre, $items ) {
	echo '<div class="dih-navpanel-col">';
	echo '<div class="dih-navpanel-h">' . esc_html( $titre ) . '</div>';
	foreach ( $items as $cle => $texte ) {
		echo dih_lien_nav( $cle, $texte, 'dih-navpanel-a' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '</div>';
};
?>
<nav class="dih-navrow" aria-label="Navigation principale">
	<div class="dih-nav-dd" data-dih-dd>
		<?php $dih_item( 'diagnostics', 'Nos diagnostics', 'diagnostics', true ); ?>
		<div class="dih-navpanel dih-navpanel-lg">
			<?php
			$dih_col(
				'Pour les particuliers',
				array(
					'dpe'         => 'DPE',
					'audit'       => 'Audit énergétique',
					'amiante'     => 'Amiante',
					'plomb'       => 'Plomb (CREP)',
					'electricite' => 'Électricité',
					'gaz'         => 'Gaz',
				)
			);
			$dih_col(
				'Selon la situation',
				array(
					'termites'       => 'Termites',
					'merule'         => 'Mérule',
					'erp'            => 'État des risques (ERP)',
					'mesurage'       => 'Mesurage Carrez / Boutin',
					'assainissement' => 'Assainissement',
				)
			);
			$dih_col(
				'Pour les professionnels',
				array(
					'dtg'  => 'DTG &amp; DPE collectif',
					'pros' => 'Syndics, agences &amp; bailleurs',
				)
			);
			?>
			<div class="dih-navpanel-pied">
				<a class="dih-link dih-link--fonce" href="<?php echo esc_url( dih_url( 'simulateur' ) ); ?>">De quoi ai-je besoin&nbsp;?<span class="dih-arrow"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
				<a class="dih-link dih-link--vert" href="<?php echo esc_url( dih_url( 'diagnostics' ) ); ?>">Tous les diagnostics<span class="dih-arrow"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
			</div>
		</div>
	</div>
	<div class="dih-nav-dd" data-dih-dd>
		<?php $dih_item( 'pros', 'Professionnels', 'pros', true ); ?>
		<div class="dih-navpanel dih-navpanel-sm">
			<div class="dih-navpanel-h">Pour les professionnels</div>
			<?php
			echo dih_lien_nav( 'dtg', 'DTG &amp; DPE collectif', 'dih-navpanel-a' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dih_lien_nav( 'pros', 'Syndics, agences &amp; bailleurs', 'dih-navpanel-a' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	</div>
	<?php
	$dih_item( 'actualites', 'Actualités', 'actualites' );
	$dih_item( 'qui', 'Qui suis-je&nbsp;?', 'qui' );
	?>
</nav>
