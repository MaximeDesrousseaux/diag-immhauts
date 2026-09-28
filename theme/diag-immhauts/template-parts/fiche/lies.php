<?php
/**
 * « Souvent réalisés avec… » : cards vers les diagnostics liés.
 *
 * Arguments : titre, cartes [ clé de page, titre, texte ], variante ('' : picto de
 * 38 px ; 'grand' : picto de 50 px, fiche DPE). Illustration : jeu normalisé
 * img/diag_<clé>.webp (dih_illus_diagnostic), sans miroir ni coefficient par fichier.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-lies">
	<div class="l-section__tete l-lies__tete">
		<h2 class="l-lies__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
		<a class="c-lien c-lien--vert" href="<?php echo esc_url( dih_url( 'diagnostics' ) ); ?>">Tous les diagnostics<span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
	</div>
	<div class="l-lies__grille">
		<?php foreach ( $args['cartes'] as $dih_c ) : ?>
			<a class="c-card c-card--lie<?php echo ! empty( $args['variante'] ) ? ' c-card--lie-' . esc_attr( $args['variante'] ) : ''; ?>" href="<?php echo esc_url( dih_url( $dih_c[0] ) ); ?>">
				<span class="c-card__picto" aria-hidden="true">
					<span class="c-card__illus" style="background-image:url('<?php echo esc_url( dih_img( dih_illus_diagnostic( $dih_c[0] ) ) ); ?>')"></span>
				</span>
				<span class="c-card__titre"><?php echo esc_html( $dih_c[1] ); ?></span>
				<span class="c-card__texte"><?php echo esc_html( $dih_c[2] ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
