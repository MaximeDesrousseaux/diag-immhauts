<?php
/**
 * Bloc « 4 étapes » des fiches + « À préparer avant ma visite ».
 *
 * Bureau : 4 socles illustrés reliés par un filet, 4 cards dessous.
 * Déplié et téléphone : illustration à gauche, card à droite, rail vertical.
 * Réglages globaux : etapes_dispo (en-ligne ; deux-colonnes à l'étape 5) et
 * step_icons (socle-vert : ill_stb_* ; socle-blanc : ill_st_*).
 *
 * Variantes (clé « variante » des contenus) :
 * - integree : fond blanc, préparation dans le même bloc (DPE, page de référence) ;
 * - standard : sur le fond de page, lien « Demander un devis », préparation dessous.
 *
 * @package DiagImmHauts
 */

$dih_args = wp_parse_args(
	$args,
	array(
		'variante'    => 'standard',
		'surtitre'    => '',
		'titre'       => '',
		'liste'       => array(),
		'preparation' => array(),
	)
);

$dih_prefixe = 'socle-blanc' === dih_option( 'step_icons' ) ? 'ill_st_' : 'ill_stb_';
$dih_pictos  = array( 'tel', 'cal', 'maison', 'rapport' );
$dih_integre = 'integree' === $dih_args['variante'];
$dih_prep    = $dih_args['preparation'];
?>
<section class="c-etapes c-etapes--<?php echo esc_attr( $dih_args['variante'] ); ?>">
	<div class="c-etapes__int">
		<div class="c-etapes__tete">
			<div>
				<?php echo dih_surtitre( $dih_args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2 class="c-etapes__titre"><?php echo esc_html( $dih_args['titre'] ); ?></h2>
			</div>
			<?php if ( ! $dih_integre ) : ?>
				<a class="c-lien c-lien--vert" href="<?php echo esc_url( dih_url( 'contact' ) ); ?>">Demander un devis<span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
			<?php endif; ?>
		</div>

		<ol class="c-etapes__liste">
			<?php foreach ( $dih_args['liste'] as $dih_i => $dih_e ) : ?>
				<li class="c-etapes__item">
					<span class="c-etapes__socle" aria-hidden="true">
						<span class="c-etapes__picto" style="background-image:url('<?php echo esc_url( dih_img( $dih_prefixe . $dih_pictos[ $dih_i % 4 ] . '.webp' ) ); ?>')"></span>
					</span>
					<div class="c-etapes__card">
						<div class="c-etapes__ligne">
							<span class="c-etapes__num"><?php echo esc_html( $dih_e[0] ); ?></span>
							<h3 class="c-etapes__nom"><?php echo esc_html( $dih_e[1] ); ?></h3>
						</div>
						<p class="c-etapes__texte"><?php echo esc_html( $dih_e[2] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>

		<?php
		if ( $dih_prep ) {
			// DPE : préparation intégrée au bloc, en style large.
			if ( $dih_integre ) {
				$dih_prep['style'] = 'large';
			}
			get_template_part( 'template-parts/composants/preparation', null, $dih_prep );
		}
		?>
	</div>
</section>
