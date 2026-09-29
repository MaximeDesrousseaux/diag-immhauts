<?php
/**
 * Bloc « 4 étapes » des fiches + « À préparer avant ma visite ».
 *
 * Bureau, réglage global etapes_dispo :
 * - en-ligne (défaut) : 4 socles illustrés reliés par un filet, 4 cards dessous ;
 * - deux-colonnes : grande illustration à gauche, cards en damier 2 × 2 à droite
 *   (illustration au-dessus jusqu'à 1150 px). Pas sur Qui suis-je (variante qui),
 *   que la page d'options ne compte pas parmi les pages du bloc.
 * Déplié et téléphone : illustration à gauche, card à droite, rail vertical,
 * quelle que soit la disposition (page d'options : « même rendu »).
 * Réglage global step_icons (socle-vert : ill_stb_* ; socle-blanc : ill_st_*).
 *
 * Variantes (clé « variante » des contenus) :
 * - integree : fond blanc, préparation dans le même bloc (DPE, page de référence) ;
 * - standard : sur le fond de page, lien « Demander un devis », préparation dessous ;
 * - qui : comme standard, titre plus grand, étiquette « ÉTAPE 01 » en bureau
 *   (4e élément de chaque étape), lien propre (Qui suis-je).
 * lien : [ libellé, cible ] du lien de l'en-tête (défaut : « Demander un devis »).
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
		'lien'        => array( 'Demander un devis', 'contact' ),
	)
);

$dih_prefixe = 'socle-blanc' === dih_option( 'step_icons' ) ? 'ill_st_' : 'ill_stb_';
$dih_pictos  = array( 'tel', 'cal', 'maison', 'rapport' );
$dih_integre = 'integree' === $dih_args['variante'];
$dih_deux    = 'qui' !== $dih_args['variante'] && 'deux-colonnes' === dih_option( 'etapes_dispo' );
$dih_prep    = $dih_args['preparation'];
?>
<section class="c-etapes c-etapes--<?php echo esc_attr( 'qui' === $dih_args['variante'] ? 'standard c-etapes--qui' : $dih_args['variante'] ); ?><?php echo $dih_deux ? ' c-etapes--deux-colonnes' : ''; ?>">
	<div class="c-etapes__int">
		<div class="c-etapes__tete">
			<div>
				<?php echo dih_surtitre( $dih_args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2 class="c-etapes__titre"><?php echo esc_html( $dih_args['titre'] ); ?></h2>
			</div>
			<?php if ( ! $dih_integre ) : ?>
				<a class="c-lien c-lien--vert" href="<?php echo esc_url( dih_url_cible( $dih_args['lien'][1] ) ); ?>"><?php echo esc_html( $dih_args['lien'][0] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
			<?php endif; ?>
		</div>

		<?php if ( $dih_deux ) : ?>
			<div class="c-etapes__deux">
				<div class="c-etapes__illus">
					<img src="<?php echo esc_url( dih_img( 'ill_4etapes_det.webp' ) ); ?>" alt="Les quatre étapes : appel, devis, visite, rapport" width="1000" height="631" loading="lazy" decoding="async">
				</div>
		<?php endif; ?>
		<ol class="c-etapes__liste">
			<?php foreach ( $dih_args['liste'] as $dih_i => $dih_e ) : ?>
				<li class="c-etapes__item">
					<span class="c-etapes__socle" aria-hidden="true">
						<span class="c-etapes__picto" style="background-image:url('<?php echo esc_url( dih_img( $dih_prefixe . $dih_pictos[ $dih_i % 4 ] . '.webp' ) ); ?>')"></span>
					</span>
					<div class="c-etapes__card">
						<?php if ( ! empty( $dih_e[3] ) ) : ?>
							<span class="c-etapes__etiquette"><?php echo esc_html( $dih_e[3] ); ?></span>
						<?php endif; ?>
						<div class="c-etapes__ligne">
							<span class="c-etapes__num"><?php echo esc_html( $dih_e[0] ); ?></span>
							<h3 class="c-etapes__nom"><?php echo esc_html( $dih_e[1] ); ?></h3>
						</div>
						<p class="c-etapes__texte"><?php echo esc_html( $dih_e[2] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
		<?php if ( $dih_deux ) : ?>
			</div>
		<?php endif; ?>

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
