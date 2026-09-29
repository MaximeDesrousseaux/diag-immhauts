<?php
/**
 * Hero de « Nos diagnostics » — VERROUILLÉ (bureau et déplié).
 * Pas de bouton vert : les trois entrées sont les accès principaux (réglage global
 * entrees_hero : sommaire, ou cartes-blanches). En déplié, elles passent en ligne
 * de trois au bas du hero.
 * Illustration : réglage de la page hero_illustration (livrets ou maison-verte).
 * Téléphone : titre à gauche, illustration à droite (48 %), puis chapeau et entrées.
 *
 * @package DiagImmHauts
 */

$dih_entrees = 'cartes-blanches' === dih_option( 'entrees_hero' ) ? ' c-entrees--cartes' : '';
$dih_illus_v = dih_option_page( 'hero_illustration' );
$dih_illus   = $args['illustrations'][ $dih_illus_v ];
?>
<section class="l-hero l-hero--nos">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<div class="l-hero__texte">
			<?php dih_ariane( array( array( 'Nos diagnostics' ) ), 'c-ariane--fiche c-ariane--espace' ); ?>
			<h1 class="l-hero__titre">
				<?php echo esc_html( $args['titre_1'] ); ?><br class="l-br-mobile"> <?php echo esc_html( $args['titre_2'] ); ?><br>
				<span class="l-hero__accent"><?php echo esc_html( $args['accent_1'] ); ?><br class="l-br-deplie"> <?php echo esc_html( $args['accent_2'] ); ?></span>
			</h1>
			<p class="l-hero__chapeau"><?php echo esc_html( $args['chapeau'] ); ?></p>
			<div class="l-hero__entrees">
				<ul class="c-entrees<?php echo esc_attr( $dih_entrees ); ?>">
					<?php foreach ( $args['entrees'] as $dih_e ) : ?>
						<li>
							<a class="c-entrees__lien" href="#<?php echo esc_attr( $dih_e[3] ); ?>">
								<span class="c-entrees__num"><?php echo esc_html( $dih_e[0] ); ?></span>
								<span class="c-entrees__corps">
									<span class="c-entrees__titre"><?php echo esc_html( $dih_e[1] ); ?></span>
									<span class="c-entrees__sous"><?php echo esc_html( $dih_e[2] ); ?></span>
								</span>
								<span class="c-entrees__fleche c-fleche" aria-hidden="true"><?php echo dih_icone( 'fleche', 15, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="l-hero__illus-nos l-hero__illus-nos--<?php echo esc_attr( $dih_illus_v ); ?>">
			<div class="l-hero__illus-cadre">
				<?php if ( 'maison-verte' === $dih_illus_v ) : ?>
					<div class="l-hero__illus-lueur" aria-hidden="true"></div>
				<?php endif; ?>
				<img src="<?php echo esc_url( dih_img( $dih_illus[0] ) ); ?>" alt="<?php echo esc_attr( $dih_illus[1] ); ?>" fetchpriority="high" decoding="async">
			</div>
		</div>
	</div>
</section>
