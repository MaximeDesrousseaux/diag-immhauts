<?php
/**
 * « À la une » : card de l'actualité mise en avant (réforme du DPE 2026).
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'une' );
?>
<section class="l-section l-section--une">
	<?php echo dih_surtitre( $dih_c['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<article class="c-card c-card--une">
		<div class="c-card__chiffre">
			<div class="c-card__illus" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( $dih_c['illustration'] ) ); ?>')"></div>
			<span class="c-card__legende"><?php echo esc_html( $dih_c['legende'] ); ?></span>
			<div class="c-card__evolution">
				<span class="c-card__avant"><?php echo esc_html( $dih_c['avant'] ); ?></span>
				<span class="c-card__vers" aria-hidden="true">→</span>
				<span class="c-card__apres"><?php echo esc_html( $dih_c['apres'] ); ?></span>
			</div>
			<p class="c-card__note"><?php echo wp_kses( $dih_c['note'], array( 'sup' => array() ) ); ?></p>
		</div>
		<div class="c-card__corps">
			<span class="c-pastille c-pastille--nouveau"><?php echo esc_html( $dih_c['etiquette'] ); ?></span>
			<h2 class="c-card__titre"><?php echo wp_kses( $dih_c['titre'], array( 'span' => array( 'class' => true ) ) ); ?></h2>
			<p class="c-card__texte"><?php echo esc_html( $dih_c['texte'] ); ?></p>
			<div class="c-card__actions">
				<?php echo dih_bouton( $dih_c['cta'], dih_attr_rappel() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<a class="c-lien c-lien--fonce" href="<?php echo esc_url( dih_url_cible( $dih_c['lien_url'] ) ); ?>"><?php echo esc_html( $dih_c['lien'] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
			</div>
		</div>
	</article>
</section>
