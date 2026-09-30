<?php
/**
 * Template Name: Mentions légales
 *
 * Mentions légales & confidentialité (/mentions-legales/, noindex, follow :
 * inc/setup.php) : hero de page de texte, puis une carte par rubrique
 * (#confidentialite pour la politique de confidentialité).
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c = dih_contenu( 'mentions' );

/**
 * Valeur d'une rubrique : liens et gras autorisés ; {a completer: …} devient
 * une mention surlignée (information que le client doit encore fournir) ;
 * {adresse}, {telephone} et {email} : coordonnées du site (dih_info).
 */
$dih_valeur = function ( $html ) {
	$html = wp_kses(
		$html,
		array(
			'a'      => array( 'href' => true ),
			'strong' => array(),
		)
	);
	$html = preg_replace( '/\{a completer: ([^}]*)\}/u', '<mark class="c-mentions__a-completer">$1</mark>', $html );
	return strtr(
		$html,
		array(
			'{adresse}'   => esc_html( dih_info( 'adresse' ) ),
			'{telephone}' => '<a href="tel:' . esc_attr( dih_info( 'telephone_lien' ) ) . '">' . esc_html( dih_info( 'telephone' ) ) . '</a>',
			'{email}'     => '<a href="mailto:' . esc_attr( dih_info( 'email_rgpd' ) ) . '">' . esc_html( dih_info( 'email_rgpd' ) ) . '</a>',
		)
	);
};
?>
<main id="contenu" class="l-main l-main--mentions">
	<?php get_template_part( 'template-parts/hero/page', null, $dih_c['hero'] ); ?>
	<div class="c-mentions">
		<?php foreach ( $dih_c['blocs'] as $dih_b ) : ?>
			<section class="c-mentions__bloc<?php echo ! empty( $dih_b['id'] ) ? ' c-mentions__bloc--accent' : ''; ?>"<?php echo ! empty( $dih_b['id'] ) ? ' id="' . esc_attr( $dih_b['id'] ) . '"' : ''; ?>>
				<?php
				if ( ! empty( $dih_b['surtitre'] ) ) {
					echo dih_surtitre( $dih_b['surtitre'], 'c-surtitre--serre c-mentions__surtitre' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
				<h2 class="c-mentions__titre"><?php echo esc_html( $dih_b['titre'] ); ?></h2>

				<?php if ( ! empty( $dih_b['raison'] ) ) : ?>
					<div class="c-mentions__raison">
						<strong><?php echo esc_html( $dih_b['raison'] ); ?></strong>
						<?php foreach ( $dih_b['paragraphes'] as $dih_p ) : ?>
							<p><?php echo $dih_valeur( $dih_p ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<?php foreach ( $dih_b['paragraphes'] as $dih_p ) : ?>
						<p class="c-mentions__para"><?php echo $dih_valeur( $dih_p ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php if ( ! empty( $dih_b['definitions'] ) ) : ?>
					<?php if ( ! empty( $dih_b['sous_titre'] ) ) : ?>
						<div class="c-mentions__encart">
							<h3 class="c-mentions__sous-titre"><?php echo esc_html( $dih_b['sous_titre'] ); ?></h3>
					<?php endif; ?>
					<dl class="c-mentions__definitions">
						<?php foreach ( $dih_b['definitions'] as $dih_d ) : ?>
							<dt><?php echo esc_html( $dih_d[0] ); ?></dt>
							<dd><?php echo $dih_valeur( $dih_d[1] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></dd>
						<?php endforeach; ?>
					</dl>
					<?php if ( ! empty( $dih_b['sous_titre'] ) ) : ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( ! empty( $dih_b['actions'] ) ) : ?>
					<div class="c-mentions__actions">
						<?php foreach ( $dih_b['actions'] as $dih_i => $dih_a ) : ?>
							<?php $dih_href = 0 === strpos( $dih_a[1], 'mailto:' ) ? $dih_a[1] : dih_url( $dih_a[1] ); ?>
							<a class="c-mentions__action<?php echo 0 === $dih_i ? ' c-mentions__action--plein' : ''; ?>" href="<?php echo esc_url( $dih_href ); ?>"><?php echo esc_html( $dih_a[0] ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</section>
		<?php endforeach; ?>
	</div>
</main>
<?php
get_footer();
