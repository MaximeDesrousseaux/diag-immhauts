<?php
/**
 * Session « Réforme » du DPE : étiquette datée, explication, frise des
 * coefficients (passés barrés, actuel en vert, futur en pointillés), deux notes,
 * CTA et lien vers l'audit.
 *
 * Arguments : id, etiquette, source, titre, texte, valeurs, notes, cta, lien.
 *
 * @package DiagImmHauts
 */

$dih_sup = array( 'sup' => array() );
?>
<section class="l-session l-session--reforme" id="<?php echo esc_attr( $args['id'] ); ?>">
	<div class="c-card c-card--reforme">
		<div class="c-card__tete">
			<span class="c-pastille c-pastille--nouveau"><?php echo wp_kses( $args['etiquette'], $dih_sup ); ?></span>
			<span class="c-card__source"><?php echo esc_html( $args['source'] ); ?></span>
		</div>
		<h2 class="c-card__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
		<p class="c-card__texte"><?php echo wp_kses( $args['texte'], $dih_sup ); ?></p>
		<ul class="c-frise">
			<?php foreach ( $args['valeurs'] as $dih_v ) : ?>
				<li class="c-frise__item c-frise__item--<?php echo esc_attr( $dih_v[2] ); ?>">
					<span class="c-frise__valeur"><?php echo esc_html( $dih_v[0] ); ?></span>
					<span class="c-frise__legende"><?php echo wp_kses( $dih_v[1], $dih_sup ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="c-card__notes">
			<?php foreach ( $args['notes'] as $dih_n ) : ?>
				<p><strong><?php echo esc_html( $dih_n[0] ); ?></strong> <?php echo esc_html( $dih_n[1] ); ?></p>
			<?php endforeach; ?>
		</div>
		<div class="c-card__actions">
			<?php echo dih_bouton( $args['cta'], dih_attr_rappel() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<a class="c-lien c-lien--fonce" href="<?php echo esc_url( dih_url_cible( $args['lien'][1] ) ); ?>"><?php echo esc_html( $args['lien'][0] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
		</div>
	</div>
</section>
