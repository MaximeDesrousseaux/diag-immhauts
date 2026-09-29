<?php
/**
 * Hero d'une fiche diagnostic : fil d'Ariane, pastille, titre (h1), chapeau,
 * deux CTA, illustration.
 *
 * Téléphone : deux colonnes en tête (titre à gauche, illustration à droite),
 * puis chapeau et CTA pleine largeur ; la colonne texte passe en display:contents.
 *
 * Arguments : le tableau de la fiche (clés « nom » et « hero »).
 * Illustration : jeu normalisé img/diag_<clé>.webp à 370 / 326 px / 100 % de la
 * colonne (maquettes v10) ; une fiche peut garder une illustration dédiée avec ses
 * propres tailles (hero.illustration + hero.illus_tailles : DPE, audit).
 *
 * @package DiagImmHauts
 */

$dih_nom    = $args['nom'];
$dih_h      = $args['hero'];
$dih_illus  = ! empty( $dih_h['illustration'] ) ? $dih_h['illustration'] : dih_illus_diagnostic( dih_page_courante() );
$dih_taille = ! empty( $dih_h['illus_tailles'] ) ? $dih_h['illus_tailles'] : array( '370px', '326px', '100%' );
list( $dih_l_bureau, $dih_l_deplie, $dih_l_mobile ) = $dih_taille;
?>
<section class="l-hero l-hero--fiche">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<?php dih_ariane( array( array( 'Nos diagnostics', dih_url( 'diagnostics' ) ), array( $dih_nom ) ), 'c-ariane--fiche' ); ?>
		<div class="l-hero__grille">
			<div class="l-hero__texte">
				<div class="c-pastille c-pastille--fiche"><span aria-hidden="true"></span><?php echo esc_html( $dih_h['pastille'] ); ?></div>
				<h1 class="l-hero__titre"><?php echo esc_html( $dih_h['titre'] ); ?><br><span class="l-hero__accent"><?php echo esc_html( $dih_h['accent'] ); ?></span></h1>
				<p class="l-hero__chapeau"><?php echo esc_html( $dih_h['chapeau'] ); ?></p>
				<div class="l-hero__actions">
					<?php
					echo dih_bouton( $dih_h['cta'], dih_attr_rappel(), 'enveloppe', 'c-btn--vert c-btn--fiche' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo dih_bouton( $dih_h['cta_2'][0], 'href="' . esc_url( dih_url_cible( $dih_h['cta_2'][1] ) ) . '"', 'fleche-courte', 'c-btn--contour c-btn--fiche-2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</div>
			</div>
			<div class="l-hero__illus-fiche" style="--illus-bureau:<?php echo esc_attr( $dih_l_bureau ); ?>;--illus-deplie:<?php echo esc_attr( $dih_l_deplie ); ?>;--illus-mobile:<?php echo esc_attr( $dih_l_mobile ); ?>">
				<div class="l-hero__illus-halo<?php echo ! empty( $dih_h['halo'] ) ? ' l-hero__illus-halo--' . esc_attr( $dih_h['halo'] ) : ''; ?>" aria-hidden="true"></div>
				<img src="<?php echo esc_url( dih_img( $dih_illus ) ); ?>" alt="<?php echo esc_attr( $dih_h['illus_alt'] ); ?>" fetchpriority="high" decoding="async">
			</div>
		</div>
	</div>
</section>
