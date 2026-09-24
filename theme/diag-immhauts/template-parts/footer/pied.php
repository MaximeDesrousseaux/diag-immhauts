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
<footer class="dih-pied">
	<div class="dih-pied-in">
		<div class="dih-pied-grille">
			<div>
				<div class="dih-pied-nom"><?php echo esc_html( dih_info( 'nom' ) ); ?></div>
				<p class="dih-pied-desc"><?php echo esc_html( dih_info( 'description' ) ); ?></p>
				<a class="dih-cta dih-cta--pied dih-pied-rappel" <?php echo $dih_cta['popup'] ? dih_attr_rappel() : 'href="' . esc_url( dih_url( 'contact', 'devis' ) ) . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<span class="dih-cta-t">Demander un rappel</span>
					<span class="dih-cta-i"><?php echo dih_icone( 'enveloppe', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
				<a class="dih-cta dih-cta--pied dih-pied-tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>">
					<span class="dih-cta-t"><?php echo esc_html( dih_info( 'telephone' ) ); ?></span>
					<span class="dih-cta-i"><?php echo dih_icone( 'telephone', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
			</div>
			<div>
				<div class="dih-pied-h">Les diagnostics</div>
				<div class="dih-pied-liens">
					<?php
					$dih_lien( 'simulateur', 'De quoi ai-je besoin&nbsp;?' );
					$dih_lien( 'diagnostics', 'Tous les diagnostics' );
					$dih_lien( 'dpe', 'DPE' );
					$dih_lien( 'amiante', 'Amiante' );
					?>
				</div>
			</div>
			<div>
				<div class="dih-pied-h">Le diagnostiqueur</div>
				<div class="dih-pied-liens">
					<?php
					$dih_lien( 'qui', 'Qui suis-je&nbsp;?' );
					$dih_lien( 'pros', 'Professionnels' );
					$dih_lien( 'contact', 'Contact &amp; devis' );
					$dih_lien( 'mentions', 'Mentions légales' );
					?>
				</div>
			</div>
			<div>
				<div class="dih-pied-h">Les communes desservies</div>
				<p class="dih-pied-communes"><?php echo esc_html( dih_info( 'communes' ) ); ?></p>
			</div>
		</div>
		<div class="dih-pied-bas">
			<span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( dih_info( 'nom' ) ); ?> — <?php echo esc_html( dih_info( 'dirigeant' ) ); ?>. Tous droits réservés.</span>
			<span class="dih-pied-bas-liens">
				<a href="<?php echo esc_url( dih_url( 'mentions' ) ); ?>">Mentions légales</a>
				<a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">Confidentialité</a>
				<a href="<?php echo esc_url( dih_info( 'avis_google' ) ); ?>" target="_blank" rel="noopener">Google Business</a>
			</span>
		</div>
	</div>
</footer>
