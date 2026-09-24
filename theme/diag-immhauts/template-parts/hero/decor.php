<?php
/**
 * Décor des heros intérieurs, selon le réglage global decor_hero :
 * - terrils (défaut) : hero_bg_sans_maison_large.webp + voiles ;
 * - grille : ancien décor (halo vert).
 * Cadrages par format dans scss/layout/_hero.scss.
 *
 * @package DiagImmHauts
 */

if ( 'grille' === dih_option( 'decor_hero' ) ) : ?>
	<div class="l-hero__decor l-hero__decor--grille" aria-hidden="true"></div>
<?php else : ?>
	<div class="l-hero__decor l-hero__decor--terrils" aria-hidden="true" style="--decor-img:url('<?php echo esc_url( dih_img( 'hero_bg_sans_maison_large.webp' ) ); ?>')">
		<div class="l-hero__voile"></div>
		<div class="l-hero__fondu"></div>
	</div>
	<?php
endif;
