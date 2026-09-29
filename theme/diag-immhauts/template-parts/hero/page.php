<?php
/**
 * Hero simple des pages de texte (gabarit de Mentions légales) :
 * fil d'Ariane, titre, chapeau facultatif, illustration facultative.
 *
 * Arguments (get_template_part, 3e paramètre) :
 * - titre         string  Titre (h1). Défaut : titre de la page.
 * - ariane        string  Dernier maillon du fil d'Ariane. Défaut : le titre.
 * - chapeau       string  Paragraphe sous le titre.
 * - note          string  Petite ligne (ex. date de mise à jour).
 * - illustration  string  Fichier de assets/img (ex. 'ill_mentions_legales.webp').
 * - variante      string  Modificateur l-hero--<variante> (actus, article).
 * - parent        array   [ libellé, URL ] : maillon intermédiaire du fil d'Ariane.
 * - pastille      string  Pastille au-dessus du titre (catégorie d'un article).
 * - date          string  Ligne à côté de la pastille (date · durée de lecture).
 *
 * @package DiagImmHauts
 */

$dih_args = wp_parse_args(
	$args,
	array(
		'titre'        => get_the_title(),
		'ariane'       => '',
		'chapeau'      => '',
		'note'         => '',
		'illustration' => '',
		'variante'     => '',
		'parent'       => array(),
		'pastille'     => '',
		'date'         => '',
	)
);
$dih_classes_hero = 'l-hero l-hero--page';
if ( $dih_args['illustration'] ) {
	$dih_classes_hero .= ' l-hero--illus';
}
if ( $dih_args['variante'] ) {
	$dih_classes_hero .= ' l-hero--' . $dih_args['variante'];
}
?>
<section class="<?php echo esc_attr( $dih_classes_hero ); ?>">
	<?php get_template_part( 'template-parts/hero/decor' ); ?>
	<div class="l-hero__int">
		<div class="l-hero__texte">
			<nav class="c-ariane c-ariane--espace" aria-label="Fil d'Ariane">
				<a href="<?php echo esc_url( dih_url( 'accueil' ) ); ?>">Accueil</a>
				<span class="c-ariane__sep" aria-hidden="true">/</span>
				<?php if ( $dih_args['parent'] ) : ?>
					<a href="<?php echo esc_url( $dih_args['parent'][1] ); ?>"><?php echo esc_html( $dih_args['parent'][0] ); ?></a>
					<span class="c-ariane__sep" aria-hidden="true">/</span>
				<?php endif; ?>
				<span aria-current="page"><?php echo esc_html( wp_strip_all_tags( $dih_args['ariane'] ? $dih_args['ariane'] : $dih_args['titre'] ) ); ?></span>
			</nav>
			<?php if ( $dih_args['pastille'] || $dih_args['date'] ) : ?>
				<div class="l-hero__meta">
					<?php if ( $dih_args['pastille'] ) : ?>
						<span class="c-pastille c-pastille--article"><?php echo esc_html( $dih_args['pastille'] ); ?></span>
					<?php endif; ?>
					<span class="l-hero__date"><?php echo esc_html( $dih_args['date'] ); ?></span>
				</div>
			<?php endif; ?>
			<h1 class="l-hero__titre"><?php echo wp_kses_post( $dih_args['titre'] ); ?></h1>
			<?php if ( $dih_args['chapeau'] ) : ?>
				<p class="l-hero__chapeau"><?php echo wp_kses_post( $dih_args['chapeau'] ); ?></p>
			<?php endif; ?>
			<?php if ( $dih_args['note'] ) : ?>
				<div class="l-hero__note"><?php echo wp_kses_post( $dih_args['note'] ); ?></div>
			<?php endif; ?>
		</div>
		<?php if ( $dih_args['illustration'] ) : ?>
			<div class="l-hero__illus" style="background-image:url('<?php echo esc_url( dih_img( $dih_args['illustration'] ) ); ?>')" role="presentation"></div>
		<?php endif; ?>
	</div>
</section>
