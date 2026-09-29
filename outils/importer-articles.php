<?php
/**
 * Importe (ou met à jour) les deux articles du journal depuis
 * outils/contenus/articles/<slug>.html.
 *
 * Usage : wp eval-file outils/importer-articles.php
 *
 * - Permaliens des articles : /actualites/<slug>/ (README § Pages).
 * - Catégories « DPE » et « Location » ; l'article épinglé est « à la une ».
 * - Dans le HTML, {url:cle}, {url:cle:ancre} et {url:article:slug} deviennent
 *   les adresses du site (dih_url / permalien de l'article).
 * - L'article d'exemple de WordPress (« Hello world! ») passe en brouillon.
 *
 * @package DiagImmHauts
 */

if ( ! defined( 'ABSPATH' ) || ! function_exists( 'dih_url' ) ) {
	echo "À lancer avec wp eval-file, thème Diag Imm'Hauts actif.\n";
	return;
}

$dih_nbsp = "\u{a0}";

// Sans utilisateur connecté, WordPress filtrerait le HTML (pictos SVG des boutons).
kses_remove_filters();

// Permaliens : /actualites/<slug>/ pour les articles (les règles de réécriture
// sont régénérées plus bas, une fois les articles créés).
global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/actualites/%postname%/' );

$dih_articles = array(
	array(
		'slug'      => 'reforme-dpe-2026-classe-sans-travaux',
		'titre'     => 'Votre logement électrique a peut-être gagné une classe sans travaux',
		'date'      => '2026-09-16 09:00:00',
		'categorie' => 'DPE',
		'epingle'   => true,
		'extrait'   => "Environ 850 000 logements sont sortis du statut de passoire thermique le 1<sup>er</sup> janvier 2026, sans qu'un seul radiateur ait été changé. Voici pourquoi, comment savoir si le vôtre en fait partie, et ce que ça change si vous vendez ou louez.",
		'meta'      => array(
			'dih_ariane'       => 'Réforme du DPE 2026',
			'dih_chapeau'      => "Le 1<sup>er</sup> janvier 2026, environ 850 000 logements sont sortis du statut de passoire thermique. Aucun radiateur n'a été changé{$dih_nbsp}: c'est la règle de calcul qui a bougé. Voici pourquoi, et comment savoir si votre bien en fait partie.",
			'dih_lecture'      => '4',
			'dih_illustration' => 'ill_article_coefficient_elec.webp',
			'dih_une_legende'  => "Coefficient de l'électricité",
			'dih_une_avant'    => '2,3',
			'dih_une_apres'    => '1,9',
			'dih_une_note'     => 'Depuis le 1<sup>er</sup> janvier 2026. Prochaine baisse à 1,7 en 2027.',
		),
	),
	array(
		'slug'      => 'location-dpe-dates-interdiction',
		'titre'     => "Louer un logement mal classé{$dih_nbsp}: les dates à ne pas manquer",
		'date'      => '2026-09-17 09:00:00',
		'categorie' => 'Location',
		'epingle'   => false,
		'extrait'   => "G interdits depuis janvier 2025, F au 1<sup>er</sup> janvier 2028, E au 1<sup>er</sup> janvier 2034. Ce que l'interdiction vise vraiment, les exceptions qui existent, et quoi faire dès maintenant.",
		'meta'      => array(
			'dih_ariane'       => "Location{$dih_nbsp}: les dates",
			'dih_chapeau'      => "Les classes G sont sorties du marché locatif en 2025, les F suivront en 2028, les E en 2034. Derrière ces trois dates, beaucoup d'idées fausses{$dih_nbsp}: ce qui est vraiment interdit, ce qui ne l'est pas, et ce qu'un propriétaire de l'Artois peut faire dès maintenant.",
			'dih_lecture'      => '5',
			'dih_illustration' => 'ill_actu_calendrier_dpe.webp',
		),
	),
);

// 1er passage : catégories et articles (contenu provisoire).
$dih_ids = array();
foreach ( $dih_articles as $dih_a ) {
	$dih_cat = term_exists( $dih_a['categorie'], 'category' );
	if ( ! $dih_cat ) {
		$dih_cat = wp_insert_term( $dih_a['categorie'], 'category' );
	}
	$dih_existant = get_page_by_path( $dih_a['slug'], OBJECT, 'post' );
	$dih_id       = wp_insert_post(
		array(
			'ID'            => $dih_existant ? $dih_existant->ID : 0,
			'post_type'     => 'post',
			'post_status'   => 'publish',
			'post_name'     => $dih_a['slug'],
			'post_title'    => $dih_a['titre'],
			'post_date'     => $dih_a['date'],
			'post_excerpt'  => $dih_a['extrait'],
			'post_content'  => '',
			'post_category' => array( (int) $dih_cat['term_id'] ),
		),
		true
	);
	if ( is_wp_error( $dih_id ) ) {
		echo 'Erreur : ' . $dih_id->get_error_message() . "\n";
		continue;
	}
	foreach ( $dih_a['meta'] as $dih_cle => $dih_val ) {
		update_post_meta( $dih_id, $dih_cle, $dih_val );
	}
	if ( $dih_a['epingle'] ) {
		stick_post( $dih_id );
	} else {
		unstick_post( $dih_id );
	}
	$dih_ids[ $dih_a['slug'] ] = $dih_id;
}

flush_rewrite_rules( false );

// 2e passage : contenu, liens résolus (les permaliens existent maintenant).
$dih_dossier = dirname( __FILE__ ) . '/contenus/articles/';
foreach ( $dih_ids as $dih_slug => $dih_id ) {
	$dih_html = file_get_contents( $dih_dossier . $dih_slug . '.html' );
	$dih_html = preg_replace_callback(
		'/\{url:([a-z0-9-]+)(?::([a-z0-9-]+))?\}/',
		function ( $m ) use ( $dih_ids ) {
			if ( 'article' === $m[1] ) {
				return isset( $dih_ids[ $m[2] ] ) ? get_permalink( $dih_ids[ $m[2] ] ) : '#';
			}
			return dih_url( $m[1], isset( $m[2] ) ? $m[2] : '' );
		},
		$dih_html
	);
	// Bloc « HTML personnalisé » : l'éditeur le garde tel quel, sans wpautop.
	wp_update_post(
		array(
			'ID'           => $dih_id,
			'post_content' => "<!-- wp:html -->
" . trim( $dih_html ) . "
<!-- /wp:html -->",
		)
	);
	echo 'Article : ' . get_permalink( $dih_id ) . "\n";
}

// Article d'exemple de WordPress : en brouillon (réversible), plus dans le journal.
$dih_exemple = get_page_by_path( 'hello-world', OBJECT, 'post' );
if ( $dih_exemple && 'publish' === $dih_exemple->post_status ) {
	wp_update_post(
		array(
			'ID'          => $dih_exemple->ID,
			'post_status' => 'draft',
		)
	);
	echo "« Hello world! » passé en brouillon.\n";
}
