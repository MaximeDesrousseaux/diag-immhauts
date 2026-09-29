<?php
/**
 * « Les packs les plus commandés » : bande blanche, trois packs (pastille de
 * couleur, titre, texte, diagnostics en étiquettes, note), lien vers le simulateur.
 *
 * @package DiagImmHauts
 */

$dih_teintes = array(
	'vert'   => '',
	'jaune'  => ' c-badge--jaune',
	'orange' => ' c-badge--orange',
);
?>
<section class="l-packs">
	<div class="l-packs__int">
		<div class="l-section__tete l-packs__tete">
			<div>
				<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2 class="l-section__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			</div>
			<a class="c-lien c-lien--vert" href="<?php echo esc_url( dih_url( 'simulateur' ) ); ?>"><?php echo esc_html( $args['lien'] ); ?> <span class="c-fleche"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
		</div>
		<div class="l-packs__grille">
			<?php foreach ( $args['cartes'] as $dih_c ) : ?>
				<div class="c-card c-card--pack">
					<span class="c-badge<?php echo esc_attr( $dih_teintes[ $dih_c[1] ] ); ?>"><?php echo esc_html( $dih_c[0] ); ?></span>
					<h3 class="c-card__titre"><?php echo esc_html( $dih_c[2] ); ?></h3>
					<p class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></p>
					<ul class="c-card__etiquettes">
						<?php foreach ( $dih_c[4] as $dih_e ) : ?>
							<li><?php echo esc_html( $dih_e ); ?></li>
						<?php endforeach; ?>
					</ul>
					<p class="c-card__note"><?php echo esc_html( $dih_c[5] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
