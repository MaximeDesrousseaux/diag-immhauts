<?php
/**
 * « Une commande prend deux minutes » : texte et carte « Ligne directe
 * partenaires » (devis + appel) à gauche, quatre étapes numérotées à droite.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-section l-process">
	<div class="l-process__grille">
		<div class="l-process__texte">
			<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<p class="l-process__para"><?php echo esc_html( $args['texte'] ); ?></p>
			<div class="l-process__ligne">
				<h3 class="l-process__ligne-titre"><?php echo esc_html( $args['ligne_titre'] ); ?></h3>
				<p class="l-process__ligne-texte"><?php echo esc_html( $args['ligne_texte'] ); ?></p>
				<?php
				echo dih_bouton( $args['ligne_cta'], dih_attr_rappel(), 'enveloppe', 'c-btn--vert l-process__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo dih_bouton( esc_html( dih_info( 'telephone' ) ), 'href="tel:' . esc_attr( dih_info( 'telephone_lien' ) ) . '"', 'telephone', 'c-btn--vert l-process__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</div>
		</div>
		<ol class="l-process__etapes">
			<?php foreach ( $args['etapes'] as $dih_e ) : ?>
				<li class="c-card c-card--etape-pro">
					<span class="c-card__num"><?php echo esc_html( $dih_e[0] ); ?></span>
					<h3 class="c-card__titre"><?php echo esc_html( $dih_e[1] ); ?></h3>
					<p class="c-card__texte"><?php echo esc_html( $dih_e[2] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
