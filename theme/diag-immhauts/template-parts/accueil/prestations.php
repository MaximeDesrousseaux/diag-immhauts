<?php
/**
 * « Nos prestations » : les 4 cards « accueil » (bordure 2 px, illustration
 * qui déborde, alternance de fonds). Illustrations en background-image.
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'prestations' );
?>
<section class="l-section l-section--prestations" id="diagnostics">
	<div class="l-section__tete">
		<div>
			<?php echo dih_surtitre( $dih_c['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre"><?php echo esc_html( $dih_c['titre'] ); ?></h2>
		</div>
		<p class="l-section__intro"><?php echo esc_html( $dih_c['texte'] ); ?></p>
	</div>
	<div class="l-grille-cards">
		<?php foreach ( $dih_c['cards'] as $dih_i => $dih_card ) : ?>
			<a class="c-card c-card--accueil c-card--<?php echo esc_attr( $dih_card['teinte'] ); ?>" href="<?php echo esc_url( dih_url( $dih_card['lien'] ) ); ?>">
				<span class="c-card__illus c-card__illus--<?php echo (int) $dih_i + 1; ?>" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( $dih_card['image'] ) ); ?>')"></span>
				<span class="c-card__num"><span><?php echo esc_html( $dih_card['num'] ); ?></span><span class="c-card__tag"><?php echo esc_html( $dih_card['tag'] ); ?></span></span>
				<h3 class="c-card__titre"><?php echo esc_html( $dih_card['titre'] ); ?></h3>
				<p class="c-card__texte"><?php echo esc_html( $dih_card['texte'] ); ?></p>
				<span class="c-card__bouton">En savoir plus<span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
