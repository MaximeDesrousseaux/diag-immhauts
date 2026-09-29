<?php
/**
 * Nav de bureau (> 900 px). Pas d'item « Accueil » : le logo fait le lien.
 * « Actualités » vient avant « Qui suis-je ».
 *
 * La rubrique en cours est en gras (.is-courant), avec un filet vert permanent
 * dessous ; dans les menus déroulants, la page en cours est un
 * <span aria-current="page"> sur fond clair, marqué d'un filet vertical vert.
 * Menu « Professionnels » : la page Professionnels d'abord, puis le DTG.
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
	$classes = array( 'l-nav__item' );
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
	echo '<div class="l-nav__panneau-col">';
	echo '<div class="l-nav__panneau-titre">' . esc_html( $titre ) . '</div>';
	foreach ( $items as $cle => $texte ) {
		echo dih_lien_nav( $cle, $texte, 'l-nav__panneau-lien' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '</div>';
};
?>
<nav class="l-nav" aria-label="Navigation principale">
	<div class="l-nav__deroulant" data-dih-dd>
		<?php $dih_item( 'diagnostics', 'Nos diagnostics', 'diagnostics', true ); ?>
		<div class="l-nav__panneau l-nav__panneau--large">
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
					'pros' => 'Syndics, agences &amp; bailleurs',
					'dtg'  => 'DTG &amp; DPE collectif',
				)
			);
			?>
			<div class="l-nav__panneau-pied">
				<a class="c-lien c-lien--fonce" href="<?php echo esc_url( dih_url( 'simulateur' ) ); ?>">De quoi ai-je besoin&nbsp;?<span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
				<a class="c-lien c-lien--vert" href="<?php echo esc_url( dih_url( 'diagnostics' ) ); ?>">Tous les diagnostics<span class="c-fleche"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
			</div>
		</div>
	</div>
	<div class="l-nav__deroulant" data-dih-dd>
		<?php $dih_item( 'pros', 'Professionnels', 'pros', true ); ?>
		<div class="l-nav__panneau l-nav__panneau--etroit">
			<div class="l-nav__panneau-titre">Pour les professionnels</div>
			<?php
			echo dih_lien_nav( 'pros', 'Syndics, agences &amp; bailleurs', 'l-nav__panneau-lien' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dih_lien_nav( 'dtg', 'DTG &amp; DPE collectif', 'l-nav__panneau-lien' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	</div>
	<?php
	$dih_item( 'actualites', 'Actualités', 'actualites' );
	$dih_item( 'qui', 'Qui suis-je&nbsp;?', 'qui' );
	?>
</nav>
