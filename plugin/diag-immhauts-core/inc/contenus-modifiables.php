<?php
/**
 * Contenus modifiables dans l'admin (ACF Pro ou Secure Custom Fields).
 *
 * Le thème écrit ses textes par défaut dans inc/contenus/*.php et ne les lit que
 * par dih_contenu() ; ce module les remplace, section par section, par ce qui est
 * saisi dans l'admin, via le filtre dih_contenu. Un champ vide garde le texte du
 * thème : rien ne disparaît tant que l'admin n'a pas été remplie.
 *
 * - Diag Imm'Hauts → Avis clients : les avis du carrousel de l'accueil.
 * - Encart « Questions fréquentes » des 15 pages qui ont une FAQ (accueil,
 *   Nos diagnostics, Professionnels, 12 fiches) : questions, réponses, lien.
 * - Encart « Fiche diagnostic » des 12 fiches : pastille, titre, accent et chapeau
 *   du haut de page ; chiffres et légendes des quatre repères (pictos fixes).
 * - Encart « Bloc 4 étapes » des fiches et de Nos diagnostics : titres et textes des
 *   étapes (numéros fixes) ; liste « À préparer avant ma visite » des fiches.
 *
 * Pour partir des textes en place plutôt que de champs vides :
 * wp eval-file outils/importer-contenus.php (voir ce fichier).
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Pages à FAQ : fichier de contenus du thème => clé de page (dih_chemins()).
 *
 * @return array<string, string>
 */
function dih_core_pages_faq() {
	$pages = array(
		'accueil'         => 'accueil',
		'nos-diagnostics' => 'diagnostics',
		'professionnels'  => 'pros',
	);
	foreach ( array( 'dpe', 'audit', 'dtg', 'amiante', 'plomb', 'electricite', 'gaz', 'termites', 'merule', 'erp', 'mesurage', 'assainissement' ) as $cle ) {
		$pages[ 'fiche-' . $cle ] = $cle;
	}
	return $pages;
}

add_action(
	'dih_core_acf_init',
	function () {
		acf_add_options_sub_page(
			array(
				'page_title'      => 'Avis clients',
				'menu_title'      => 'Avis clients',
				'menu_slug'       => 'dih-avis',
				'parent_slug'     => 'dih-reglages',
				'capability'      => 'manage_options',
				'update_button'   => 'Enregistrer les avis',
				'updated_message' => 'Avis enregistrés.',
				'autoload'        => true,
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_dih_avis',
				'title'    => 'Avis du carrousel de l’accueil',
				'fields'   => array(
					array(
						'key'          => 'field_dih_avis_liste',
						'name'         => 'avis_liste',
						'label'        => 'Avis',
						'instructions' => 'Avis Google recopiés à l’identique, dans l’ordre d’affichage. Liste vide : le site affiche les avis par défaut du thème. La note (5,0) et le nombre d’avis affichés à côté sont des chiffres arrêtés du thème.',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => 'Ajouter un avis',
						'sub_fields'   => array(
							array(
								'key'       => 'field_dih_avis_texte',
								'name'      => 'texte',
								'label'     => 'Texte de l’avis',
								'type'      => 'textarea',
								'rows'      => 3,
								'new_lines' => '',
								'required'  => 1,
							),
							array(
								'key'      => 'field_dih_avis_nom',
								'name'     => 'nom',
								'label'    => 'Nom affiché',
								'type'     => 'text',
								'required' => 1,
								'wrapper'  => array( 'width' => '50' ),
							),
							array(
								'key'     => 'field_dih_avis_lieu',
								'name'    => 'lieu',
								'label'   => 'Commune',
								'type'    => 'text',
								'wrapper' => array( 'width' => '50' ),
							),
						),
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'dih-avis',
						),
					),
				),
			)
		);

		$gabarits = array( 'page-templates/fiche-diagnostic.php', 'page-templates/nos-diagnostics.php', 'page-templates/professionnels.php' );
		$location = array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		);
		foreach ( $gabarits as $gabarit ) {
			$location[] = array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => $gabarit,
				),
			);
		}

		acf_add_local_field_group(
			array(
				'key'      => 'group_dih_faq',
				'title'    => 'Questions fréquentes (FAQ)',
				'fields'   => array(
					array(
						'key'          => 'field_dih_faq_questions',
						'name'         => 'faq_questions',
						'label'        => 'Questions',
						'instructions' => 'La 1re question s’affiche ouverte. Les questions servent aussi aux données structurées lues par Google. Liste vide : la page garde ses questions par défaut.',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => 'Ajouter une question',
						'sub_fields'   => array(
							array(
								'key'      => 'field_dih_faq_question',
								'name'     => 'question',
								'label'    => 'Question',
								'type'     => 'text',
								'required' => 1,
							),
							array(
								'key'       => 'field_dih_faq_reponse',
								'name'      => 'reponse',
								'label'     => 'Réponse',
								'type'      => 'textarea',
								'rows'      => 4,
								'new_lines' => '',
								'required'  => 1,
							),
							array(
								'key'           => 'field_dih_faq_lien',
								'name'          => 'lien',
								'label'         => 'Lien sous la réponse (facultatif)',
								'instructions'  => 'Texte du lien et page visée ; pour un bloc de la page, une ancre comme #zones.',
								'type'          => 'link',
								'return_format' => 'array',
							),
						),
					),
				),
				'location'   => $location,
				'position'   => 'normal',
				'menu_order' => 20,
			)
		);
	}
);

/**
 * Page affichée, si elle correspond au fichier de contenus demandé.
 *
 * @param string $page Nom du fichier de contenus du thème (ex. 'fiche-dpe').
 * @return int Identifiant de la page, ou 0.
 */
function dih_core_id_si_affichee( $page ) {
	$pages = dih_core_pages_faq();
	if ( isset( $pages[ $page ] ) && function_exists( 'dih_page_courante' ) && dih_page_courante() === $pages[ $page ] ) {
		return (int) get_queried_object_id();
	}
	return 0;
}

/**
 * Emplacement ACF : pages utilisant l'un des gabarits donnés.
 *
 * @param string[] $gabarits Gabarits de page (page-templates/…).
 * @return array
 */
function dih_core_location_gabarits( $gabarits ) {
	$location = array();
	foreach ( $gabarits as $gabarit ) {
		$location[] = array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => $gabarit,
			),
		);
	}
	return $location;
}

add_action(
	'dih_core_acf_init',
	function () {
		$vide = 'Vide : texte actuel du thème.';

		acf_add_local_field_group(
			array(
				'key'        => 'group_dih_fiche',
				'title'      => 'Fiche diagnostic',
				'fields'     => array(
					array(
						'key'       => 'field_dih_fiche_onglet_haut',
						'label'     => 'Haut de page',
						'type'      => 'tab',
						'placement' => 'top',
					),
					array(
						'key'          => 'field_dih_fiche_pastille',
						'name'         => 'fiche_pastille',
						'label'        => 'Pastille',
						'instructions' => 'Au-dessus du titre (ex. « Obligatoire pour toute vente et toute location »). ' . $vide,
						'type'         => 'text',
					),
					array(
						'key'          => 'field_dih_fiche_titre',
						'name'         => 'fiche_titre',
						'label'        => 'Titre, 1re ligne',
						'instructions' => $vide,
						'type'         => 'text',
						'wrapper'      => array( 'width' => '50' ),
					),
					array(
						'key'          => 'field_dih_fiche_accent',
						'name'         => 'fiche_accent',
						'label'        => 'Titre, 2e ligne (en vert)',
						'instructions' => $vide,
						'type'         => 'text',
						'wrapper'      => array( 'width' => '50' ),
					),
					array(
						'key'          => 'field_dih_fiche_chapeau',
						'name'         => 'fiche_chapeau',
						'label'        => 'Chapeau',
						'instructions' => 'Le paragraphe sous le titre. ' . $vide,
						'type'         => 'textarea',
						'rows'         => 4,
						'new_lines'    => '',
					),
					array(
						'key'       => 'field_dih_fiche_onglet_reperes',
						'label'     => 'Repères',
						'type'      => 'tab',
						'placement' => 'top',
					),
					array(
						'key'          => 'field_dih_fiche_reperes',
						'name'         => 'fiche_reperes',
						'label'        => 'Les quatre repères sous le haut de page',
						'instructions' => 'Dans l’ordre d’affichage ; chaque picto reste celui de sa position. Liste vide : repères actuels.',
						'type'         => 'repeater',
						'layout'       => 'table',
						'max'          => 4,
						'button_label' => 'Ajouter un repère',
						'sub_fields'   => array(
							array(
								'key'      => 'field_dih_fiche_repere_valeur',
								'name'     => 'valeur',
								'label'    => 'Chiffre',
								'type'     => 'text',
								'required' => 1,
								'wrapper'  => array( 'width' => '35' ),
							),
							array(
								'key'     => 'field_dih_fiche_repere_legende',
								'name'    => 'legende',
								'label'   => 'Légende',
								'type'    => 'text',
								'wrapper' => array( 'width' => '65' ),
							),
						),
					),
				),
				'location'   => dih_core_location_gabarits( array( 'page-templates/fiche-diagnostic.php' ) ),
				'position'   => 'normal',
				'menu_order' => 0,
			)
		);

		acf_add_local_field_group(
			array(
				'key'        => 'group_dih_etapes',
				'title'      => 'Bloc « 4 étapes »',
				'fields'     => array(
					array(
						'key'          => 'field_dih_etapes_liste',
						'name'         => 'etapes_liste',
						'label'        => 'Étapes',
						'instructions' => 'Quatre étapes, numérotées automatiquement (les pictos suivent l’ordre). Liste vide : étapes actuelles.',
						'type'         => 'repeater',
						'layout'       => 'block',
						'max'          => 4,
						'button_label' => 'Ajouter une étape',
						'sub_fields'   => array(
							array(
								'key'      => 'field_dih_etape_titre',
								'name'     => 'titre',
								'label'    => 'Titre',
								'type'     => 'text',
								'required' => 1,
							),
							array(
								'key'       => 'field_dih_etape_texte',
								'name'      => 'texte',
								'label'     => 'Texte',
								'type'      => 'textarea',
								'rows'      => 2,
								'new_lines' => '',
								'required'  => 1,
							),
						),
					),
					array(
						'key'          => 'field_dih_preparation_liste',
						'name'         => 'preparation_liste',
						'label'        => 'À préparer avant ma visite',
						'instructions' => 'Les documents listés sous les étapes (champ absent des pages qui n’ont pas cette liste). Liste vide : liste actuelle.',
						'type'         => 'repeater',
						'layout'       => 'table',
						'button_label' => 'Ajouter un document',
						'sub_fields'   => array(
							array(
								'key'      => 'field_dih_preparation_element',
								'name'     => 'element',
								'label'    => 'Document',
								'type'     => 'text',
								'required' => 1,
							),
						),
					),
				),
				'location'   => dih_core_location_gabarits( array( 'page-templates/fiche-diagnostic.php', 'page-templates/nos-diagnostics.php' ) ),
				'position'   => 'normal',
				'menu_order' => 10,
			)
		);
	}
);

/**
 * Remplace les textes par défaut du thème par ceux saisis dans l'admin.
 *
 * @param array  $donnees Contenus de la page (inc/contenus/<page>.php du thème).
 * @param string $page    Nom du fichier de contenus.
 * @return array
 */
function dih_core_contenus_modifiables( $donnees, $page ) {
	if ( is_admin() || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
		return $donnees;
	}

	// Avis de l'accueil (page d'options).
	if ( 'accueil' === $page && isset( $donnees['avis'] ) ) {
		$liste = array();
		foreach ( (array) get_field( 'avis_liste', 'option' ) as $ligne ) {
			if ( ! empty( $ligne['texte'] ) && ! empty( $ligne['nom'] ) ) {
				$liste[] = array( $ligne['texte'], $ligne['nom'], isset( $ligne['lieu'] ) ? (string) $ligne['lieu'] : '' );
			}
		}
		if ( $liste ) {
			$donnees['avis']['liste'] = $liste;
		}
	}

	// FAQ de la page affichée (champs de la page).
	$pages = dih_core_pages_faq();
	if ( isset( $pages[ $page ], $donnees['faq'] ) && function_exists( 'dih_page_courante' ) && dih_page_courante() === $pages[ $page ] ) {
		$questions = array();
		foreach ( (array) get_field( 'faq_questions', get_queried_object_id() ) as $ligne ) {
			if ( empty( $ligne['question'] ) || empty( $ligne['reponse'] ) ) {
				continue;
			}
			$lien        = ( isset( $ligne['lien'] ) && is_array( $ligne['lien'] ) ) ? $ligne['lien'] : array();
			$questions[] = array(
				$ligne['question'],
				$ligne['reponse'],
				isset( $lien['title'] ) ? (string) $lien['title'] : '',
				isset( $lien['url'] ) ? (string) $lien['url'] : '',
			);
		}
		if ( $questions ) {
			$donnees['faq']['questions'] = $questions;
		}
	}

	return $donnees;
}
add_filter( 'dih_contenu', 'dih_core_contenus_modifiables', 10, 2 );

/**
 * Fiches et Nos diagnostics : haut de page, repères, 4 étapes, « À préparer ».
 * Chaque champ vide garde le texte du thème.
 *
 * @param array  $donnees Contenus de la page.
 * @param string $page    Nom du fichier de contenus.
 * @return array
 */
function dih_core_contenus_fiches( $donnees, $page ) {
	if ( is_admin() || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
		return $donnees;
	}
	$id = dih_core_id_si_affichee( $page );
	if ( ! $id ) {
		return $donnees;
	}

	if ( 0 === strpos( $page, 'fiche-' ) ) {
		foreach ( array( 'pastille', 'titre', 'accent', 'chapeau' ) as $cle ) {
			$valeur = get_field( 'fiche_' . $cle, $id );
			if ( isset( $donnees['hero'] ) && is_string( $valeur ) && '' !== trim( $valeur ) ) {
				$donnees['hero'][ $cle ] = $valeur;
			}
		}

		// Repères : le picto reste celui de la position (tracés propres à chaque fiche).
		$reperes = array();
		foreach ( array_values( (array) get_field( 'fiche_reperes', $id ) ) as $i => $ligne ) {
			if ( empty( $ligne['valeur'] ) || ! isset( $donnees['reperes'][ $i ] ) ) {
				continue;
			}
			$reperes[] = array( $donnees['reperes'][ $i ][0], $ligne['valeur'], isset( $ligne['legende'] ) ? (string) $ligne['legende'] : '' );
		}
		if ( $reperes ) {
			$donnees['reperes'] = $reperes;
		}
	}

	if ( isset( $donnees['etapes']['liste'] ) ) {
		$etapes = array();
		foreach ( (array) get_field( 'etapes_liste', $id ) as $ligne ) {
			if ( empty( $ligne['titre'] ) || empty( $ligne['texte'] ) ) {
				continue;
			}
			$n        = count( $etapes );
			$num      = isset( $donnees['etapes']['liste'][ $n ][0] ) ? $donnees['etapes']['liste'][ $n ][0] : sprintf( '%02d', $n + 1 );
			$etapes[] = array( $num, $ligne['titre'], $ligne['texte'] );
		}
		if ( $etapes ) {
			$donnees['etapes']['liste'] = $etapes;
		}

		if ( ! empty( $donnees['etapes']['preparation']['liste'] ) ) {
			$preparation = array();
			foreach ( (array) get_field( 'preparation_liste', $id ) as $ligne ) {
				if ( ! empty( $ligne['element'] ) ) {
					$preparation[] = (string) $ligne['element'];
				}
			}
			if ( $preparation ) {
				$donnees['etapes']['preparation']['liste'] = $preparation;
			}
		}
	}

	return $donnees;
}
add_filter( 'dih_contenu', 'dih_core_contenus_fiches', 10, 2 );

/**
 * Fichier de contenus du thème d'une page à contenus modifiables (ex. 'fiche-dpe'),
 * ou '' si la page n'en a pas.
 *
 * @param int $post_id Identifiant de la page.
 * @return string
 */
function dih_core_fichier_de_page( $post_id ) {
	if ( ! $post_id || ! function_exists( 'dih_chemins' ) ) {
		return '';
	}
	$chemins = dih_chemins();
	foreach ( dih_core_pages_faq() as $fichier => $cle ) {
		if ( 'accueil' === $cle ) {
			$id = (int) get_option( 'page_on_front' );
		} else {
			$page = isset( $chemins[ $cle ] ) ? get_page_by_path( trim( $chemins[ $cle ], '/' ) ) : null;
			$id   = $page ? (int) $page->ID : 0;
		}
		if ( $id === (int) $post_id ) {
			return $fichier;
		}
	}
	return '';
}

/**
 * « À préparer avant ma visite » : champ masqué dans l'admin des pages dont la
 * maquette n'a pas cette liste (Nos diagnostics, DTG & DPE collectif). Règle tirée
 * des contenus du thème : une page qui gagnerait la liste retrouverait le champ.
 * Un champ masqué n'est pas enregistré : sa valeur éventuelle reste en l'état.
 */
add_filter(
	'acf/prepare_field/key=field_dih_preparation_liste',
	function ( $field ) {
		$post_id = function_exists( 'acf_get_form_data' ) ? (int) acf_get_form_data( 'post_id' ) : 0;
		if ( ! $post_id ) {
			$post_id = (int) get_the_ID();
		}
		$fichier = dih_core_fichier_de_page( $post_id );
		if ( '' === $fichier || ! function_exists( 'dih_contenu' ) ) {
			return $field;
		}
		$contenus = dih_contenu( $fichier );
		return empty( $contenus['etapes']['preparation']['liste'] ) ? false : $field;
	}
);
