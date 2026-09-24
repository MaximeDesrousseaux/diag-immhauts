<?php
/**
 * Hero de l'accueil, variante « terrils-boutons » (réglage hero_accueil, défaut).
 *
 * Bureau et déplié : décor hero_bg_2000px + tuiles latérales, titre, chapeau,
 * deux CTA, trois chiffres. Réglages du déplié VERROUILLÉS (NOTES-PROJET).
 * Téléphone : décor portrait bg_mobile1, titre court, note Google, carte
 * « Rappel gratuit » avec le formulaire. Le header y fait office de barre
 * du hero (layout/_entete.scss, .l-entete--accueil).
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'hero' );
?>
<section class="l-hero l-hero--accueil">
	<div class="l-hero__decor l-hero__decor--accueil" aria-hidden="true" style="--decor-gauche:url('<?php echo esc_url( dih_img( 'hero_bg_2000px_edge_left.webp' ) ); ?>');--decor-droite:url('<?php echo esc_url( dih_img( 'hero_bg_2000px_edge_right.webp' ) ); ?>')">
		<picture>
			<source media="(max-width: 640px)" srcset="<?php echo esc_url( dih_img( 'bg_mobile1.webp' ) ); ?>">
			<img class="l-hero__decor-img" src="<?php echo esc_url( dih_img( 'hero_bg_2000px.webp' ) ); ?>" alt="" fetchpriority="high" decoding="async">
		</picture>
		<div class="l-hero__voile-haut"></div>
		<div class="l-hero__voile-bas"></div>
	</div>

	<div class="l-hero__int">
		<div class="l-hero__texte">
			<div class="l-hero__halo" aria-hidden="true"></div>
			<div class="c-pastille c-pastille--hero"><span aria-hidden="true"></span><?php echo esc_html( $dih_c['pastille'] ); ?></div>
			<h1 class="l-hero__titre">
				<?php echo esc_html( $dih_c['titre'] ); ?><br>
				<span class="l-hero__accent l-hero__accent--large"><?php echo esc_html( $dih_c['titre_accent'] ); ?></span>
				<span class="l-hero__accent l-hero__accent--mobile"><?php echo esc_html( $dih_c['titre_mobile'] ); ?></span>
			</h1>
			<div class="l-hero__avis"><span aria-hidden="true">★★★★★</span><?php echo esc_html( $dih_c['avis_mobile'] ); ?></div>
			<p class="l-hero__chapeau"><?php echo esc_html( $dih_c['chapeau'] ); ?></p>
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
			<ul class="c-chiffres">
				<?php foreach ( $dih_c['chiffres'] as $dih_chiffre ) : ?>
					<li class="c-chiffres__item">
						<span class="c-chiffres__valeur"><?php echo esc_html( $dih_chiffre[0] ); ?></span>
						<span class="c-chiffres__legende"><?php echo esc_html( $dih_chiffre[1] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="l-hero__carte">
			<div class="l-hero__carte-tete">
				<span class="l-hero__carte-titre"><?php echo esc_html( $dih_c['carte_titre'] ); ?></span>
				<span class="l-hero__carte-delai"><?php echo esc_html( $dih_c['carte_delai'] ); ?></span>
			</div>
			<?php dih_formulaire( 'rappel', 'sombre' ); ?>
			<p class="l-hero__carte-rgpd">Sans engagement · Vos coordonnées servent uniquement à répondre à votre demande — <a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">confidentialité</a></p>
		</div>
	</div>
</section>
