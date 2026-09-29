<?php
/**
 * Balises SEO (README § SEO, Audit SEO.dc.html, chantiers S1 à S3) :
 * titre, description, canonique, og:*, twitter:card, directive robots,
 * JSON-LD LocalBusiness sur l'accueil (textes : inc/contenus/seo.php) ;
 * JSON-LD BreadcrumbList et FAQPage tirés du fil d'Ariane et des FAQ affichés.
 *
 * Si une extension SEO est active (Yoast, Rank Math, SEOPress, AIOSEO),
 * le thème s'efface et la laisse faire.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Une extension SEO gère-t-elle déjà le <head> ?
 *
 * @return bool
 */
function dih_seo_extension_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

/**
 * Clé SEO de la page affichée : clé de dih_chemins(), ou 'article:<slug>'.
 *
 * @return string|null
 */
function dih_seo_cle() {
	$page = dih_page_courante();
	if ( 'actualite' === $page ) {
		return 'article:' . get_post_field( 'post_name', get_queried_object_id() );
	}
	return $page;
}

/**
 * Balises de la page affichée, ou tableau vide si elle n'en a pas.
 *
 * Les articles écrits plus tard, absents des maquettes, reprennent leur titre
 * et leur extrait.
 *
 * @return array{titre?:string, description?:string, og_titre?:string, og_description?:string, og_type?:string, og_image?:string, jsonld?:array}
 */
function dih_seo() {
	static $seo = null;
	if ( null !== $seo ) {
		return $seo;
	}

	$toutes = dih_contenu( 'seo' );
	$cle    = dih_seo_cle();
	$seo    = ( $cle && isset( $toutes[ $cle ] ) ) ? $toutes[ $cle ] : array();

	if ( ! $seo && is_singular( 'post' ) ) {
		$id  = get_queried_object_id();
		$seo = array(
			'titre'       => get_the_title( $id ) . " — Diag Imm'Hauts",
			'description' => wp_strip_all_tags( get_the_excerpt( $id ) ),
			'og_titre'    => get_the_title( $id ),
			'og_type'     => 'article',
		);
	}

	/**
	 * Permet d'ajuster les balises d'une page.
	 *
	 * @param array       $seo Balises.
	 * @param string|null $cle Clé SEO de la page.
	 */
	$seo = (array) apply_filters( 'dih_seo', $seo, $cle );
	return $seo;
}

/**
 * Adresse canonique de la page affichée.
 *
 * @return string
 */
function dih_seo_canonique() {
	if ( is_home() ) {
		$page = (int) get_query_var( 'paged' );
		return $page > 1 ? get_pagenum_link( $page ) : dih_url( 'actualites' );
	}
	if ( is_singular() ) {
		$url = wp_get_canonical_url();
		if ( $url ) {
			return $url;
		}
	}
	return dih_url( (string) dih_page_courante() );
}

add_action(
	'wp',
	function () {
		if ( is_admin() || dih_seo_extension_active() || ! dih_seo() ) {
			return;
		}

		// Titre complet de la maquette (pas de séparateur ni de nom de site ajouté).
		add_filter(
			'pre_get_document_title',
			function () {
				$seo = dih_seo();
				return isset( $seo['titre'] ) ? $seo['titre'] : '';
			}
		);

		// La canonique du thème remplace celle de WordPress (sur les pages seulement).
		remove_action( 'wp_head', 'rel_canonical' );
		add_action( 'wp_head', 'dih_seo_balises', 1 );

		// « index, follow » explicites, comme les maquettes — si le site est ouvert aux moteurs.
		add_filter(
			'wp_robots',
			function ( $robots ) {
				if ( get_option( 'blog_public' ) && empty( $robots['noindex'] ) ) {
					$robots = array_merge(
						array(
							'index'  => true,
							'follow' => true,
						),
						$robots
					);
				}
				return $robots;
			},
			20
		);
	}
);

/**
 * Description, canonique, og:*, twitter:card et JSON-LD de la page.
 */
function dih_seo_balises() {
	$seo       = dih_seo();
	$canonique = dih_seo_canonique();

	$balises = array(
		array( 'name', 'description', isset( $seo['description'] ) ? $seo['description'] : '' ),
		array( 'property', 'og:type', isset( $seo['og_type'] ) ? $seo['og_type'] : 'website' ),
		array( 'property', 'og:locale', 'fr_FR' ),
		array( 'property', 'og:site_name', 'Diag Imm’Hauts' ),
		array( 'property', 'og:title', isset( $seo['og_titre'] ) ? $seo['og_titre'] : ( isset( $seo['titre'] ) ? $seo['titre'] : '' ) ),
		array( 'property', 'og:description', isset( $seo['og_description'] ) ? $seo['og_description'] : ( isset( $seo['description'] ) ? $seo['description'] : '' ) ),
		array( 'property', 'og:url', $canonique ),
		// Image de partage unique (rapport SEO, S3) : aperçu des liens dans WhatsApp,
		// Messenger, Facebook, LinkedIn… Source : outils/image-partage.html.
		array( 'property', 'og:image', isset( $seo['og_image'] ) ? $seo['og_image'] : dih_img( 'partage.jpg' ) ),
		array( 'property', 'og:image:width', isset( $seo['og_image'] ) ? '' : '1200' ),
		array( 'property', 'og:image:height', isset( $seo['og_image'] ) ? '' : '630' ),
		array( 'property', 'og:image:alt', isset( $seo['og_image'] ) ? '' : "Diag Imm'Hauts : des diagnostics fiables, partout dans l'Artois" ),
		array( 'name', 'twitter:card', 'summary_large_image' ),
	);

	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonique ) );
	foreach ( $balises as $b ) {
		if ( '' === $b[2] ) {
			continue;
		}
		printf( '<meta %s="%s" content="%s">' . "\n", esc_attr( $b[0] ), esc_attr( $b[1] ), esc_attr( $b[2] ) );
	}

	if ( ! empty( $seo['jsonld'] ) ) {
		$donnees = $seo['jsonld'];
		// Adresses et coordonnées du site réel (préprod comprise), une seule source.
		if ( isset( $donnees['@id'] ) ) {
			$donnees['@id'] = home_url( '/#business' );
		}
		if ( isset( $donnees['url'] ) ) {
			$donnees['url'] = home_url( '/' );
		}
		if ( isset( $donnees['telephone'] ) ) {
			$donnees['telephone'] = dih_info( 'telephone_lien' );
		}
		if ( isset( $donnees['email'] ) ) {
			$donnees['email'] = dih_info( 'email' );
		}
		dih_seo_jsonld( $donnees );
	}
}

/**
 * Imprime un bloc JSON-LD.
 *
 * @param array $donnees Données schema.org.
 */
function dih_seo_jsonld( $donnees ) {
	echo '<script type="application/ld+json">' . wp_json_encode( $donnees, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG ) . '</script>' . "\n";
}

/**
 * Niveaux du fil d'Ariane affiché (transmis par dih_ariane()).
 *
 * @param array|null $niveaux [ libellé, url ] par niveau ; null pour lire.
 * @return array
 */
function dih_seo_ariane( $niveaux = null ) {
	static $memo = array();
	if ( null !== $niveaux ) {
		$memo = $niveaux;
	}
	return $memo;
}

/**
 * Questions des FAQ affichées (transmises par le partial composants/faq).
 *
 * @param array|null $questions [ question, réponse, … ] ; null pour lire.
 * @return array
 */
function dih_seo_faq( $questions = null ) {
	static $memo = array();
	if ( null !== $questions ) {
		$memo = array_merge( $memo, $questions );
	}
	return $memo;
}

/**
 * Fil d'Ariane et FAQ structurés (rapport SEO, chantier S3), en pied de page :
 * c'est là que les gabarits ont fini de les afficher.
 */
add_action(
	'wp_footer',
	function () {
		if ( dih_seo_extension_active() ) {
			return;
		}

		$niveaux = dih_seo_ariane();
		if ( count( $niveaux ) > 1 ) {
			$elements = array();
			foreach ( array_values( $niveaux ) as $i => $niveau ) {
				$elements[] = array(
					'@type'    => 'ListItem',
					'position' => $i + 1,
					'name'     => $niveau[0],
					'item'     => isset( $niveau[1] ) ? $niveau[1] : dih_seo_canonique(),
				);
			}
			dih_seo_jsonld(
				array(
					'@context'        => 'https://schema.org',
					'@type'           => 'BreadcrumbList',
					'itemListElement' => $elements,
				)
			);
		}

		$questions = dih_seo_faq();
		if ( $questions ) {
			$entites = array();
			foreach ( $questions as $q ) {
				$entites[] = array(
					'@type'          => 'Question',
					'name'           => $q[0],
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => $q[1],
					),
				);
			}
			dih_seo_jsonld(
				array(
					'@context'   => 'https://schema.org',
					'@type'      => 'FAQPage',
					'mainEntity' => $entites,
				)
			);
		}
	}
);
