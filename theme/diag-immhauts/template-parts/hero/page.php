<?php
/**
 * Hero simple des pages de texte (gabarit de Mentions légales) :
 * fil d'Ariane, titre, chapeau facultatif, illustration facultative.
 *
 * Arguments (get_template_part, 3e paramètre) :
 * - titre         string  Titre (h1). Défaut : titre de la page.
 * - chapeau       string  Paragraphe sous le titre.
 * - note          string  Petite ligne (ex. date de mise à jour).
 * - illustration  string  Fichier de assets/img (ex. 'ill_mentions_legales.webp').
 *
 * @package DiagImmHauts
 */

$dih_args = wp_parse_args(
	$args,
	array(
		'titre'        => get_the_title(),
		'chapeau'      => '',
		'note'         => '',
		'illustration' => '',
	)
);
?>
<section class="dih-hero dih-hero--page<?php echo $dih_args['illustration'] ? ' dih-hero--illus' : ''; ?>">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="dih-hero-in">
		<div class="dih-hero-texte">
			<nav class="dih-ariane dih-ariane--espace" aria-label="Fil d'Ariane">
				<a href="<?php echo esc_url( dih_url( 'accueil' ) ); ?>">Accueil</a>
				<span class="dih-ariane-sep" aria-hidden="true">/</span>
				<span aria-current="page"><?php echo esc_html( wp_strip_all_tags( $dih_args['titre'] ) ); ?></span>
			</nav>
			<h1 class="dih-hero-titre"><?php echo wp_kses_post( $dih_args['titre'] ); ?></h1>
			<?php if ( $dih_args['chapeau'] ) : ?>
				<p class="dih-hero-chapeau"><?php echo wp_kses_post( $dih_args['chapeau'] ); ?></p>
			<?php endif; ?>
			<?php if ( $dih_args['note'] ) : ?>
				<div class="dih-hero-note"><?php echo wp_kses_post( $dih_args['note'] ); ?></div>
			<?php endif; ?>
		</div>
		<?php if ( $dih_args['illustration'] ) : ?>
			<div class="dih-hero-illus" style="background-image:url('<?php echo esc_url( dih_img( $dih_args['illustration'] ) ); ?>')" role="presentation"></div>
		<?php endif; ?>
	</div>
</section>
