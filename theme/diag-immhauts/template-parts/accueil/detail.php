<?php
/**
 * « Le détail » (#detail) : les 12 diagnostics en tuiles, puis le CTA du simulateur.
 * Réglage detail_style : ouvert (défaut), clair, damier.
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'detail' );
?>
<section class="l-section l-section--detail" id="detail" data-style="<?php echo esc_attr( dih_option( 'detail_style' ) ); ?>">
	<div class="l-section__tete">
		<div>
			<?php echo dih_surtitre( $dih_c['surtitre'], 'c-surtitre--serre' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-section__titre--detail"><?php echo esc_html( $dih_c['titre'] ); ?></h2>
		</div>
	</div>
	<div class="l-grille-tuiles">
		<?php foreach ( $dih_c['tuiles'] as $dih_t ) : ?>
			<a class="c-card c-card--tuile" href="<?php echo esc_url( dih_url( $dih_t[1] ) ); ?>">
				<span class="c-card__cadre">
					<span class="c-card__illus" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( dih_illus_diagnostic( $dih_t[1] ) ) ); ?>')"></span>
				</span>
				<span class="c-card__titre"><?php echo wp_kses( $dih_t[0], array() ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
	<div class="l-section__pied">
		<?php echo dih_bouton( $dih_c['cta'], 'href="' . esc_url( dih_url( 'simulateur' ) ) . '"', 'fleche-courte', 'c-btn--vert c-btn--ombre-douce' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</section>
