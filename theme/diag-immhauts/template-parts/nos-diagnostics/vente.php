<?php
/**
 * « Diagnostics pour la vente & la location » (#vente) : les 12 diagnostics en
 * cards (validité, titre, texte, condition, « Détail »), en damier blanc / vert
 * clair, puis le CTA du simulateur SOUS la grille (VERROUILLÉ).
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-vente" id="vente">
	<div class="l-vente__tete">
		<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
		<p class="l-vente__intro"><?php echo esc_html( $args['texte'] ); ?></p>
	</div>
	<div class="l-vente__grille">
		<?php foreach ( $args['cartes'] as $dih_c ) : ?>
			<?php $dih_illus = ! empty( $dih_c[5] ) ? $dih_c[5] : dih_illus_diagnostic( $dih_c[0] ); ?>
			<a class="c-card c-card--validite" href="<?php echo esc_url( dih_url( $dih_c[0] ) ); ?>">
				<span class="c-card__illus" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( $dih_illus ) ); ?>')"></span>
				<span class="c-card__validite"><?php echo esc_html( $dih_c[1] ); ?></span>
				<h3 class="c-card__titre"><?php echo esc_html( $dih_c[2] ); ?></h3>
				<p class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></p>
				<span class="c-card__condition"><?php echo esc_html( $dih_c[4] ); ?></span>
				<span class="c-card__bouton">Détail<span class="c-fleche"><?php echo dih_icone( 'fleche', 15, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>
			</a>
		<?php endforeach; ?>
	</div>
	<div class="l-vente__pied">
		<?php echo dih_bouton( $args['cta'], 'href="' . esc_url( dih_url( 'simulateur' ) ) . '"', 'fleche-courte', 'c-btn--vert l-vente__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</section>
