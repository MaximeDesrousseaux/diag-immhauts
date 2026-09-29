<?php
/**
 * Index du journal (/actualites/, page des articles) : hero, article épinglé
 * « à la une » (panneau chiffré), autres articles en lignes, articles
 * « à paraître », encart d'appel.
 *
 * Champs des articles (outils/importer-articles.php) : dih_illustration,
 * dih_lecture, dih_une_legende, dih_une_avant, dih_une_apres, dih_une_note.
 *
 * @package DiagImmHauts
 */

get_header();
$dih_c      = dih_contenu( 'actualites' );
$dih_sup    = array( 'sup' => array() );
$dih_une_id = 0;

$dih_epingles = get_option( 'sticky_posts' );
if ( $dih_epingles ) {
	$dih_une    = get_posts(
		array(
			'post__in'            => $dih_epingles,
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => true,
		)
	);
	$dih_une_id = $dih_une ? $dih_une[0]->ID : 0;
}

$dih_liste = get_posts(
	array(
		'posts_per_page'      => 20,
		'post__not_in'        => $dih_une_id ? array( $dih_une_id ) : array(),
		'ignore_sticky_posts' => true,
	)
);
?>
<main id="contenu" class="l-main l-main--actualites">
	<?php
	get_template_part(
		'template-parts/hero/page',
		null,
		array(
			'ariane'       => $dih_c['hero']['ariane'],
			'titre'        => '<span class="l-hero__accent">' . esc_html( $dih_c['hero']['accent'] ) . '</span>' . esc_html( $dih_c['hero']['titre'] ),
			'chapeau'      => $dih_c['hero']['chapeau'],
			'illustration' => $dih_c['hero']['illustration'],
			'variante'     => 'actus',
		)
	);
	?>
	<div class="l-journal">
		<?php if ( $dih_une_id ) : ?>
			<?php
			$dih_m = function ( $cle ) use ( $dih_une_id ) {
				return (string) get_post_meta( $dih_une_id, $cle, true );
			};
			?>
			<a class="c-card c-card--actu-une" href="<?php echo esc_url( get_permalink( $dih_une_id ) ); ?>">
				<span class="c-card__chiffre">
					<span class="c-card__illus" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( $dih_m( 'dih_illustration' ) ) ); ?>')"></span>
					<span class="c-card__legende"><?php echo esc_html( $dih_m( 'dih_une_legende' ) ); ?></span>
					<span class="c-card__evolution">
						<span class="c-card__avant"><?php echo esc_html( $dih_m( 'dih_une_avant' ) ); ?></span>
						<span class="c-card__vers" aria-hidden="true">→</span>
						<span class="c-card__apres"><?php echo esc_html( $dih_m( 'dih_une_apres' ) ); ?></span>
					</span>
					<span class="c-card__note"><?php echo wp_kses( $dih_m( 'dih_une_note' ), $dih_sup ); ?></span>
				</span>
				<span class="c-card__corps">
					<span class="c-card__meta">
						<span class="c-pastille c-pastille--nouveau c-pastille--petite"><?php echo esc_html( $dih_c['une']['etiquette'] ); ?></span>
						<span class="c-card__date"><?php echo esc_html( dih_date_article( $dih_une_id ) . ' · ' . sprintf( $dih_c['une']['lecture'], $dih_m( 'dih_lecture' ) ) ); ?></span>
					</span>
					<h2 class="c-card__titre"><?php echo dih_titre_insecable( get_the_title( $dih_une_id ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
					<span class="c-card__texte"><?php echo wp_kses( get_the_excerpt( $dih_une_id ), $dih_sup ); ?></span>
					<span class="c-btn c-btn--vert c-card__cta"><span class="c-btn__texte"><?php echo esc_html( $dih_c['une']['cta'] ); ?></span><span class="c-btn__icone"><?php echo dih_icone( 'fleche-courte', 17, array( 'epaisseur' => 2.2 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>
				</span>
			</a>
		<?php endif; ?>

		<?php foreach ( $dih_liste as $dih_a ) : ?>
			<?php $dih_cat = get_the_category( $dih_a->ID ); ?>
			<a class="c-card c-card--actu" href="<?php echo esc_url( get_permalink( $dih_a ) ); ?>">
				<span class="c-card__illus" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( get_post_meta( $dih_a->ID, 'dih_illustration', true ) ) ); ?>')"></span>
				<span class="c-card__corps">
					<span class="c-card__meta">
						<?php if ( $dih_cat ) : ?>
							<span class="c-pastille c-pastille--nouveau c-pastille--petite"><?php echo esc_html( $dih_cat[0]->name ); ?></span>
						<?php endif; ?>
						<span class="c-card__date"><?php echo esc_html( dih_date_article( $dih_a ) . ' · ' . sprintf( $dih_c['liste']['lecture'], get_post_meta( $dih_a->ID, 'dih_lecture', true ) ) ); ?></span>
					</span>
					<h2 class="c-card__titre"><?php echo dih_titre_insecable( get_the_title( $dih_a ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
					<span class="c-card__texte"><?php echo wp_kses( get_the_excerpt( $dih_a ), $dih_sup ); ?></span>
				</span>
				<span class="c-card__lien"><?php echo esc_html( $dih_c['liste']['cta'] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche-courte', 16, array( 'epaisseur' => 2.2 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>
			</a>
		<?php endforeach; ?>

		<div class="l-journal__tete">
			<h2 class="l-journal__titre"><?php echo esc_html( $dih_c['a_paraitre']['titre'] ); ?></h2>
			<span class="l-journal__sous-titre"><?php echo esc_html( $dih_c['a_paraitre']['texte'] ); ?></span>
		</div>
		<div class="l-journal__a-paraitre">
			<?php foreach ( $dih_c['a_paraitre']['cartes'] as $dih_p ) : ?>
				<div class="c-card c-card--a-paraitre">
					<span class="c-card__illus" role="presentation" style="background-image:url('<?php echo esc_url( dih_img( $dih_p[1] ) ); ?>')"></span>
					<span class="c-card__quand"><?php echo esc_html( $dih_p[0] ); ?></span>
					<h3 class="c-card__titre"><?php echo esc_html( $dih_p[2] ); ?></h3>
					<p class="c-card__texte"><?php echo esc_html( $dih_p[3] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="c-encart-appel c-encart-appel--journal">
			<div class="c-encart-appel__texte">
				<h2><?php echo esc_html( $dih_c['appel']['titre'] ); ?></h2>
				<p><?php echo esc_html( $dih_c['appel']['texte'] ); ?></p>
			</div>
			<?php echo dih_bouton( $dih_c['appel']['cta'], 'href="' . esc_url( dih_url( 'contact' ) ) . '"', 'fleche-courte', 'c-btn--vert c-encart-appel__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</main>
<?php
get_footer();
