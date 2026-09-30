<?php
/**
 * Hero de l'accueil, selon le réglage hero_accueil :
 *
 * - terrils-boutons (défaut) : décor hero_bg_2000px + tuiles latérales, titre,
 *   chapeau, deux CTA, trois chiffres. Réglages du déplié VERROUILLÉS (NOTES-PROJET).
 * - terrils-barre : même décor et mêmes textes, la barre de rappel pleine largeur
 *   collée au bas du hero remplace les deux CTA.
 * - max-bandeau : halos verts, photo de Maxime à droite (bureau), barre de rappel
 *   en panneau sous le texte.
 * - sansBG : fond vert uni à halo, texte à gauche, carte « Rappel gratuit » à droite.
 *
 * Téléphone, commun aux quatre : décor portrait bg_mobile1, titre court, note
 * Google, carte « Rappel gratuit » avec le formulaire. Le header y fait office de
 * barre du hero (layout/_entete.scss, .l-entete--accueil).
 *
 * @package DiagImmHauts
 */

$dih_variante = dih_option( 'hero_accueil' );
$dih_c        = dih_contenu( 'accueil', 'hero' );
if ( isset( $dih_c['variantes'][ $dih_variante ] ) ) {
	$dih_c = array_merge( $dih_c, $dih_c['variantes'][ $dih_variante ] );
}

$dih_terrils = in_array( $dih_variante, array( 'terrils-boutons', 'terrils-barre' ), true );
$dih_barre   = in_array( $dih_variante, array( 'terrils-barre', 'max-bandeau' ), true );
$dih_modif   = array(
	'terrils-boutons' => '',
	'terrils-barre'   => ' l-hero--barre',
	'max-bandeau'     => ' l-hero--max',
	'sansBG'          => ' l-hero--sobre',
);
?>
<section class="l-hero l-hero--accueil<?php echo esc_attr( $dih_modif[ $dih_variante ] ); ?>">
	<?php if ( $dih_terrils ) : ?>
		<div class="l-hero__decor l-hero__decor--accueil" aria-hidden="true" style="--decor-gauche:url('<?php echo esc_url( dih_img( 'hero_bg_2000px_edge_left.webp' ) ); ?>');--decor-droite:url('<?php echo esc_url( dih_img( 'hero_bg_2000px_edge_right.webp' ) ); ?>')">
			<picture>
				<source media="(max-width: 640px)" srcset="<?php echo esc_url( dih_img( 'bg_mobile1.webp' ) ); ?>">
				<img class="l-hero__decor-img" src="<?php echo esc_url( dih_img( 'hero_bg_2000px.webp' ) ); ?>" alt="" fetchpriority="high" decoding="async">
			</picture>
			<div class="l-hero__voile-haut"></div>
			<div class="l-hero__voile-bas"></div>
		</div>
	<?php else : ?>
		<?php // Décor du téléphone seulement : au-delà, une image vide (rien n'est téléchargé). ?>
		<div class="l-hero__decor l-hero__decor--accueil" aria-hidden="true">
			<picture>
				<source media="(min-width: 641px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
				<img class="l-hero__decor-img" src="<?php echo esc_url( dih_img( 'bg_mobile1.webp' ) ); ?>" alt="" decoding="async">
			</picture>
			<div class="l-hero__voile-haut"></div>
			<div class="l-hero__voile-bas"></div>
		</div>
		<div class="l-hero__fond" aria-hidden="true">
			<?php if ( 'sansBG' === $dih_variante ) : ?>
				<svg class="l-hero__ondes" width="100%" height="100%" viewBox="0 0 1200 640" preserveAspectRatio="xMidYMid slice" fill="none" focusable="false">
					<defs>
						<radialGradient id="hero-ondes">
							<stop offset="0%" stop-color="currentColor" stop-opacity=".5"/>
							<stop offset="100%" stop-color="currentColor" stop-opacity="0"/>
						</radialGradient>
					</defs>
					<ellipse cx="960" cy="140" rx="460" ry="380" fill="url(#hero-ondes)"/>
				</svg>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="l-hero__int">
		<div class="l-hero__texte">
			<?php if ( $dih_terrils ) : ?>
				<div class="l-hero__halo" aria-hidden="true"></div>
			<?php endif; ?>
			<div class="c-pastille c-pastille--hero"><span aria-hidden="true"></span><?php echo esc_html( $dih_c['pastille'] ); ?></div>
			<h1 class="l-hero__titre">
				<?php echo esc_html( $dih_c['titre'] ); ?><br>
				<span class="l-hero__accent l-hero__accent--large"><?php echo esc_html( $dih_c['titre_accent'] ); ?></span>
				<span class="l-hero__accent l-hero__accent--mobile"><?php echo esc_html( $dih_c['titre_mobile'] ); ?></span>
			</h1>
			<div class="l-hero__avis"><span aria-hidden="true">★★★★★</span><?php echo esc_html( $dih_c['avis_mobile'] ); ?></div>
			<p class="l-hero__chapeau"><?php echo esc_html( $dih_c['chapeau'] ); ?></p>
			<?php if ( 'terrils-boutons' === $dih_variante ) : ?>
				<div class="l-hero__actions">
					<?php
					echo dih_bouton( $dih_c['cta'], dih_attr_rappel(), 'enveloppe', 'c-btn--vert c-btn--hero' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo dih_bouton( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span class="l-hero__cta-long">' . esc_html( $dih_c['cta_2'] ) . '</span><span class="l-hero__cta-court">' . esc_html( $dih_c['cta_2_court'] ) . '</span>',
						'href="#diagnostics"',
						'descendre',
						'c-btn--verre'
					);
					?>
				</div>
			<?php endif; ?>
			<ul class="c-chiffres">
				<?php foreach ( $dih_c['chiffres'] as $dih_chiffre ) : ?>
					<li class="c-chiffres__item">
						<span class="c-chiffres__valeur"><?php echo esc_html( $dih_chiffre[0] ); ?></span>
						<span class="c-chiffres__legende"><?php echo esc_html( $dih_chiffre[1] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php if ( 'max-bandeau' === $dih_variante ) : ?>
			<div class="l-hero__photo" aria-hidden="true">
				<div class="l-hero__photo-halo"></div>
				<div class="l-hero__photo-rayon"></div>
			</div>
			<?php // Bureau seulement : en déplié et sur téléphone, une image vide. ?>
			<picture>
				<source media="(max-width: 900px)" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
				<img class="l-hero__photo-img" src="<?php echo esc_url( dih_img( 'maxime_tel.webp' ) ); ?>" alt="<?php echo esc_attr( $dih_c['photo_alt'] ); ?>" width="720" height="900" decoding="async">
			</picture>
		<?php endif; ?>

		<?php if ( $dih_barre ) : ?>
			<div class="l-hero__barre">
				<div class="l-hero__barre-tete">
					<span class="l-hero__barre-titre"><?php echo esc_html( $dih_c['barre_titre'] ); ?></span>
					<?php if ( 'max-bandeau' === $dih_variante ) : ?>
						<a class="l-hero__barre-lien" href="<?php echo esc_url( dih_url( 'contact', 'devis' ) ); ?>"><?php echo esc_html( $dih_c['barre_lien'] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
					<?php endif; ?>
				</div>
				<div class="l-hero__barre-form" data-dih-form-place="rappel">
					<?php dih_formulaire( 'rappel', 'sombre' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="l-hero__carte">
			<div class="l-hero__carte-tete">
				<span class="l-hero__carte-titre"><?php echo esc_html( $dih_c['carte_titre'] ); ?></span>
				<span class="l-hero__carte-delai"><?php echo esc_html( $dih_c['carte_delai'] ); ?></span>
			</div>
			<div class="l-hero__carte-form" data-dih-form-place="rappel">
				<?php
				// Un seul formulaire par page : avec la barre, il y est rendu, et
				// assets/js/formulaires.js le déplace ici quand la carte s'affiche.
				if ( ! $dih_barre ) {
					dih_formulaire( 'rappel', 'sombre' );
				}
				?>
			</div>
			<p class="l-hero__carte-rgpd">Sans engagement · Vos coordonnées servent uniquement à répondre à votre demande — <a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">confidentialité</a></p>
		</div>
	</div>
</section>
