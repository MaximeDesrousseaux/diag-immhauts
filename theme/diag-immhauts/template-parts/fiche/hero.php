<?php
/**
 * Hero d'une fiche diagnostic : fil d'Ariane, pastille, titre (h1), chapeau,
 * deux CTA, illustration (_ssfond, orientation d'origine).
 *
 * Téléphone : deux colonnes en tête (titre à gauche, illustration à droite),
 * puis chapeau et CTA pleine largeur ; la colonne texte passe en display:contents.
 *
 * Arguments : le tableau de la fiche (clés « nom » et « hero »).
 *
 * @package DiagImmHauts
 */

$dih_nom = $args['nom'];
$dih_h   = $args['hero'];
list( $dih_l_bureau, $dih_l_deplie, $dih_l_mobile ) = $dih_h['illus_tailles'];
?>
<section class="l-hero l-hero--fiche">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<nav class="c-ariane c-ariane--fiche" aria-label="Fil d'Ariane">
			<a href="<?php echo esc_url( dih_url( 'accueil' ) ); ?>">Accueil</a>
			<span class="c-ariane__sep" aria-hidden="true">/</span>
			<a href="<?php echo esc_url( dih_url( 'diagnostics' ) ); ?>">Nos diagnostics</a>
			<span class="c-ariane__sep" aria-hidden="true">/</span>
			<span aria-current="page"><?php echo esc_html( $dih_nom ); ?></span>
		</nav>
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
				<div class="l-hero__illus-halo" aria-hidden="true"></div>
				<img src="<?php echo esc_url( dih_img( $dih_h['illustration'] ) ); ?>" alt="<?php echo esc_attr( $dih_h['illus_alt'] ); ?>" fetchpriority="high" decoding="async">
			</div>
		</div>
	</div>
</section>
