<?php
/**
 * Pied de page : présentation + CTA, deux colonnes de liens, communes desservies,
 * puis la ligne des mentions. Le lien de la page en cours passe en vert clair.
 *
 * @package DiagImmHauts
 */

$dih_lien = function ( $cle, $texte ) {
	$courant = dih_est_courante( $cle ) ? ' class="is-courant" aria-current="page"' : '';
	printf( '<a href="%s"%s>%s</a>', esc_url( dih_url( $cle ) ), $courant, wp_kses_post( $texte ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
};
$dih_cta = dih_cta_header();
?>
<footer class="l-pied">
	<div class="l-pied__int">
		<div class="l-pied__grille">
			<div>
				<div class="l-pied__nom"><?php echo esc_html( dih_info( 'nom' ) ); ?></div>
				<p class="l-pied__desc"><?php echo esc_html( dih_info( 'description' ) ); ?></p>
				<a class="c-btn c-btn--pied l-pied__rappel" <?php echo $dih_cta['popup'] ? dih_attr_rappel() : 'href="' . esc_url( dih_url( 'contact', 'devis' ) ) . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<span class="c-btn__texte">Demander un rappel</span>
					<span class="c-btn__icone"><?php echo dih_icone( 'enveloppe', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
				<a class="c-btn c-btn--pied l-pied__tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>">
					<span class="c-btn__texte"><?php echo esc_html( dih_info( 'telephone' ) ); ?></span>
					<span class="c-btn__icone"><?php echo dih_icone( 'telephone', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
			</div>
			<div>
				<div class="l-pied__titre">Les diagnostics</div>
				<div class="l-pied__liens">
					<?php
					$dih_lien( 'simulateur', 'De quoi ai-je besoin&nbsp;?' );
					$dih_lien( 'diagnostics', 'Tous les diagnostics' );
					$dih_lien( 'dpe', 'DPE' );
					$dih_lien( 'amiante', 'Amiante' );
					?>
				</div>
			</div>
			<div>
				<div class="l-pied__titre">Le diagnostiqueur</div>
				<div class="l-pied__liens">
					<?php
					$dih_lien( 'qui', 'Qui suis-je&nbsp;?' );
					$dih_lien( 'pros', 'Professionnels' );
					$dih_lien( 'contact', 'Contact &amp; devis' );
					$dih_lien( 'mentions', 'Mentions légales' );
					?>
				</div>
			</div>
			<div>
				<div class="l-pied__titre">Les communes desservies</div>
				<p class="l-pied__communes"><?php echo esc_html( dih_info( 'communes' ) ); ?></p>
			</div>
		</div>
		<div class="l-pied__bas">
			<span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( dih_info( 'nom' ) ); ?> — <?php echo esc_html( dih_info( 'dirigeant' ) ); ?>. Tous droits réservés.</span>
			<span class="l-pied__bas-liens">
				<a href="<?php echo esc_url( dih_url( 'mentions' ) ); ?>">Mentions légales</a>
				<a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">Confidentialité</a>
				<a href="<?php echo esc_url( dih_info( 'avis_google' ) ); ?>" target="_blank" rel="noopener">Google Business</a>
			</span>
		</div>
	</div>
</footer>
