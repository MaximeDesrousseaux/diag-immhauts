<?php
/**
 * Remplit les contenus modifiables de l'admin avec les textes actuels du thème
 * (inc/contenus/*.php), pour que l'admin montre les textes en place au lieu de
 * champs vides : coordonnées du site, avis de l'accueil, FAQ des 15 pages, haut de
 * page et repères des 12 fiches, bloc « 4 étapes » des fiches, de Nos diagnostics et
 * de Qui suis-je, textes des pages décrites dans dih_core_textes() (plugin,
 * inc/textes-pages.php).
 *
 * Usage : wp eval-file outils/importer-contenus.php
 *         wp eval-file outils/importer-contenus.php forcer   (réécrit aussi les champs déjà remplis)
 *
 * - Sans « forcer », un champ déjà rempli dans l'admin n'est jamais touché ; un champ
 *   vide est rempli (fiches : champ par champ, un chapeau vidé est repris seul).
 * - Les liens internes sont enregistrés en chemins relatifs (/dpe/, /contact-devis/…) :
 *   ils restent justes après le passage de la préprod au site en ligne.
 * - Exige le thème Diag Imm'Hauts, le plugin Diag Imm'Hauts — Cœur, et ACF Pro ou
 *   Secure Custom Fields.
 *
 * @package DiagImmHauts
 */

if ( ! defined( 'ABSPATH' ) || ! function_exists( 'dih_contenu' ) || ! function_exists( 'dih_core_pages_faq' ) ) {
	echo "À lancer avec wp eval-file, thème et plugin Diag Imm'Hauts actifs.\n";
	return;
}
if ( ! dih_core_acf_actif() || ! function_exists( 'update_field' ) ) {
	echo "ACF Pro ou Secure Custom Fields doit être actif.\n";
	return;
}

$dih_forcer = isset( $args ) && in_array( 'forcer', (array) $args, true );

// Les textes par défaut du thème, sans ce que l'admin contient déjà.
remove_filter( 'dih_contenu', 'dih_core_contenus_modifiables', 10 );
remove_filter( 'dih_contenu', 'dih_core_contenus_fiches', 10 );
remove_filter( 'dih_contenu', 'dih_core_contenus_textes', 10 );

/**
 * Lien d'une question : [ libellé, cible ] du thème → champ « lien » d'ACF.
 *
 * @param string       $libelle Libellé.
 * @param string|array $cible   Clé de page, ancre ou [ clé, ancre ].
 * @return array|string
 */
$dih_lien = function ( $libelle, $cible ) {
	if ( '' === (string) $libelle ) {
		return '';
	}
	$url = dih_url_cible( $cible );
	if ( 0 !== strpos( $url, '#' ) ) {
		$url = wp_make_link_relative( $url );
	}
	return array(
		'title'  => $libelle,
		'url'    => $url,
		'target' => '',
	);
};

// Avis de l'accueil ------------------------------------------------------------------
$dih_avis = dih_contenu( 'accueil', 'avis' );
if ( ! $dih_forcer && get_field( 'avis_liste', 'option' ) ) {
	echo "Avis : déjà remplis, inchangés.\n";
} else {
	$lignes = array();
	foreach ( $dih_avis['liste'] as $a ) {
		$lignes[] = array(
			'texte' => $a[0],
			'nom'   => $a[1],
			'lieu'  => $a[2],
		);
	}
	update_field( 'field_dih_avis_liste', $lignes, 'option' );
	printf( "Avis : %d importés.\n", count( $lignes ) );
}

// Coordonnées (page d'options) -------------------------------------------------------
if ( function_exists( 'dih_core_coordonnees' ) ) {
	$lignes = array();
	foreach ( array_keys( dih_core_coordonnees() ) as $cle ) {
		$actuel = get_field( 'coord_' . $cle, 'option' );
		if ( ! $dih_forcer && is_string( $actuel ) && '' !== trim( $actuel ) ) {
			continue;
		}
		update_field( 'field_dih_coord_' . $cle, dih_core_coordonnee_theme( $cle ), 'option' );
		$lignes[] = $cle;
	}
	echo $lignes ? 'Coordonnées : importées (' . implode( ', ', $lignes ) . ").\n" : "Coordonnées : déjà remplies, inchangées.\n";
}

// FAQ des pages ----------------------------------------------------------------------
$dih_chemins = dih_chemins();

/**
 * Identifiant de la page WordPress d'une clé de dih_chemins(), ou 0.
 *
 * @param string $cle Clé de page.
 * @return int
 */
$dih_page_id = function ( $cle ) use ( $dih_chemins ) {
	if ( 'accueil' === $cle ) {
		return (int) get_option( 'page_on_front' );
	}
	$page = get_page_by_path( trim( $dih_chemins[ $cle ], '/' ) );
	return $page ? (int) $page->ID : 0;
};
foreach ( dih_core_pages_faq() as $dih_fichier => $dih_cle ) {
	$page_id = $dih_page_id( $dih_cle );
	if ( ! $page_id ) {
		printf( "FAQ %s : page introuvable (%s), ignorée.\n", $dih_cle, $dih_chemins[ $dih_cle ] );
		continue;
	}
	if ( ! $dih_forcer && get_field( 'faq_questions', $page_id ) ) {
		printf( "FAQ %s : déjà remplie, inchangée.\n", $dih_cle );
		continue;
	}

	$faq    = dih_contenu( $dih_fichier, 'faq' );
	$lignes = array();
	foreach ( (array) ( isset( $faq['questions'] ) ? $faq['questions'] : array() ) as $q ) {
		$lignes[] = array(
			'question' => $q[0],
			'reponse'  => $q[1],
			'lien'     => $dih_lien( isset( $q[2] ) ? $q[2] : '', isset( $q[3] ) ? $q[3] : '' ),
		);
	}
	update_field( 'field_dih_faq_questions', $lignes, $page_id );
	printf( "FAQ %s : %d questions importées (page %d).\n", $dih_cle, count( $lignes ), $page_id );
}

// Fiches (haut de page, repères) et bloc « 4 étapes » (fiches, Nos diagnostics, Qui suis-je)
foreach ( dih_core_pages() as $dih_fichier => $dih_cle ) {
	$dih_fiche = 0 === strpos( $dih_fichier, 'fiche-' );
	if ( ! $dih_fiche && ! in_array( $dih_fichier, array( 'nos-diagnostics', 'qui' ), true ) ) {
		continue;
	}
	$page_id = $dih_page_id( $dih_cle );
	if ( ! $page_id ) {
		if ( 'qui' === $dih_cle ) {
			printf( "Étapes %s : page introuvable (%s), ignorée.\n", $dih_cle, $dih_chemins[ $dih_cle ] );
		}
		continue; // pages à FAQ : déjà signalées plus haut
	}
	// Champ par champ : sans « forcer », seul un champ vide est rempli (un chapeau vidé
	// dans l'admin est ainsi repris, sans toucher aux champs modifiés à côté).
	$c       = dih_contenu( $dih_fichier );
	$remplis = array();
	$ecrire  = function ( $cle, $nom, $valeur ) use ( $dih_forcer, $page_id, &$remplis ) {
		$actuel = get_field( $nom, $page_id );
		$plein  = is_array( $actuel ) ? count( $actuel ) > 0 : '' !== trim( (string) $actuel );
		if ( $plein && ! $dih_forcer ) {
			return;
		}
		update_field( $cle, $valeur, $page_id );
		$remplis[] = $nom;
	};

	if ( $dih_fiche ) {
		foreach ( array( 'pastille', 'titre', 'accent', 'chapeau' ) as $champ ) {
			$ecrire( 'field_dih_fiche_' . $champ, 'fiche_' . $champ, $c['hero'][ $champ ] );
		}
		$lignes = array();
		foreach ( $c['reperes'] as $r ) {
			$lignes[] = array(
				'valeur'  => $r[1],
				'legende' => $r[2],
			);
		}
		$ecrire( 'field_dih_fiche_reperes', 'fiche_reperes', $lignes );
	}

	$lignes = array();
	foreach ( $c['etapes']['liste'] as $e ) {
		$lignes[] = array(
			'titre' => $e[1],
			'texte' => $e[2],
		);
	}
	$ecrire( 'field_dih_etapes_liste', 'etapes_liste', $lignes );

	$preparation = isset( $c['etapes']['preparation']['liste'] ) ? $c['etapes']['preparation']['liste'] : array();
	if ( $preparation ) {
		$ecrire(
			'field_dih_preparation_liste',
			'preparation_liste',
			array_map(
				function ( $element ) {
					return array( 'element' => $element );
				},
				$preparation
			)
		);
	}

	if ( ! $remplis ) {
		printf( "Fiche / étapes %s : déjà remplies, inchangées.\n", $dih_cle );
		continue;
	}
	// Tout rempli : même message qu'avant ; sinon, les champs repris.
	$tout = $dih_fiche ? ( $preparation ? 7 : 6 ) : 1;
	printf( "Fiche / étapes %s : importées (page %d)%s.\n", $dih_cle, $page_id, count( $remplis ) < $tout ? ' : ' . implode( ', ', $remplis ) : '' );
}

// Textes des pages uniques (inc/textes-pages.php du plugin), section par section --------
foreach ( dih_core_textes() as $dih_entree => $dih_def ) {
	// Gabarit commun (fiches) : la même description pour chacun de ses fichiers.
	foreach ( ! empty( $dih_def['fichiers'] ) ? $dih_def['fichiers'] : array( $dih_entree ) as $dih_fichier ) {
		$dih_pages = dih_core_pages();
		$page_id   = isset( $dih_pages[ $dih_fichier ] ) ? $dih_page_id( $dih_pages[ $dih_fichier ] ) : 0;
		if ( ! $page_id ) {
			printf( "Textes %s : page introuvable, ignorée.\n", $dih_fichier );
			continue;
		}

		$c       = dih_contenu( $dih_fichier );
		$remplis = array();
		$tout    = 0;
		$ecrire  = function ( $cle, $nom, $valeur ) use ( $dih_forcer, $page_id, &$remplis ) {
			$actuel = get_field( $nom, $page_id );
			$plein  = is_array( $actuel ) ? count( $actuel ) > 0 : '' !== trim( (string) $actuel );
			if ( $plein && ! $dih_forcer ) {
				return;
			}
			update_field( $cle, $valeur, $page_id );
			$remplis[] = $nom;
		};

		foreach ( $dih_def['sections'] as $dih_sid => $dih_section ) {
			$bloc = dih_core_chemin_lire( $c, dih_core_texte_base( $dih_sid, $dih_section ) );
			foreach ( dih_core_texte_elements( $dih_section ) as $dih_element ) {
				list( $chemin, $genre, $def ) = $dih_element;
				list( $nom, $cle )            = dih_core_texte_champ( $dih_entree, $dih_sid, $chemin );
				$defaut                       = dih_core_chemin_lire( $bloc, $chemin );
				$ecrire( $cle, $nom, 'champ' === $genre ? (string) $defaut : dih_core_texte_lignes( $defaut, $def[1] ) );
				++$tout;
			}
		}

		if ( ! $remplis ) {
			printf( "Textes %s : déjà remplis, inchangés.\n", $dih_fichier );
		} else {
			printf( "Textes %s : importés (page %d)%s.\n", $dih_fichier, $page_id, count( $remplis ) < $tout ? ' : ' . implode( ', ', $remplis ) : '' );
		}
	}
}
