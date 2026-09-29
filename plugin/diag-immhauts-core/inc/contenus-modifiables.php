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
				'location' => $location,
				'position' => 'normal',
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
