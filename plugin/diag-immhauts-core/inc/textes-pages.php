<?php
/**
 * Textes des pages modifiables dans l'admin (ACF Pro ou Secure Custom Fields) :
 * encart « Textes de la page » des pages uniques, un onglet par section.
 *
 * Chaque page est décrite dans dih_core_textes() : ses sections (haut de page,
 * bandeau de confiance, parcours…), et pour chacune les textes et les listes
 * modifiables, repérés par leur chemin dans les contenus du thème
 * (inc/contenus/<page>.php). Tout le reste (pictos, illustrations, liens, ordre
 * des blocs) reste celui du thème. Un champ vide garde le texte du thème.
 *
 * Noms des champs : <section>_<chemin> (« / » devient « _ »), la section seule
 * pour une liste qui est la section elle-même ; clés : field_dih_<section>_<page>
 * [_<chemin>]. Les champs du haut de page (hero_…) gardent ainsi leurs noms et
 * leurs clés d'origine.
 *
 * Pour partir des textes en place plutôt que de champs vides :
 * wp eval-file outils/importer-contenus.php (voir ce fichier).
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Textes modifiables, page par page.
 *
 * Page (fichier de contenus du thème) => [
 *   'lieu'     => [ paramètre d'emplacement ACF, valeur ],
 *   'sections' => [ identifiant => [
 *     'titre'  => onglet de l'encart,
 *     'base'   => chemin de la section dans les contenus (par défaut : l'identifiant),
 *     'aide'   => message en tête d'onglet (facultatif),
 *     'champs' => [ chemin => [ libellé, type (text, textarea), aide facultative ] ],
 *     'listes' => [ chemin => [ libellé, colonnes, max (0 : sans limite), aide facultative ] ],
 *   ] ],
 * ]
 *
 * Chemins relatifs à la section, « / » entre les niveaux ; '' : la section elle-même.
 * Colonnes d'une liste : nom du sous-champ => [ position dans l'élément du thème
 * (rang ou clé ; null : liste de textes), libellé, type (text par défaut) ]. Les
 * positions absentes (picto, lien, illustration…) restent celles du thème, par
 * rang : une liste qui en a ne dépasse pas le nombre d'éléments du thème.
 *
 * @return array
 */
function dih_core_textes() {
	return array(
		'accueil'         => array(
			'lieu'     => array( 'page_type', 'front_page' ),
			'sections' => array(
				'hero' => array(
					'titre'  => 'Haut de page',
					'champs' => array(
						'pastille'     => array( 'Pastille', 'text' ),
						'titre'        => array( 'Titre, 1re ligne', 'text' ),
						'titre_accent' => array( 'Titre, 2e ligne en vert (ordinateur et tablette)', 'text' ),
						'titre_mobile' => array( 'Titre, 2e ligne en vert (téléphone)', 'text' ),
						'chapeau'      => array( 'Chapeau', 'textarea' ),
						'cta'          => array( 'Bouton « Demande de rappel »', 'text' ),
						'cta_2'        => array( 'Bouton « Découvrir mes prestations »', 'text' ),
						'avis_mobile'  => array( 'Ligne sous le titre (téléphone)', 'text' ),
					),
					'listes' => array(
						'chiffres' => array(
							'Chiffres sous les boutons',
							array(
								'valeur'  => array( 0, 'Chiffre' ),
								'legende' => array( 1, 'Légende' ),
							),
							3,
						),
					),
				),
			),
		),
		'nos-diagnostics' => array(
			'lieu'     => array( 'page_template', 'page-templates/nos-diagnostics.php' ),
			'sections' => array(
				'hero' => array(
					'titre'  => 'Haut de page',
					'champs' => array(
						'titre_1'  => array( 'Titre, 1er morceau', 'text' ),
						'titre_2'  => array( 'Titre, 2e morceau', 'text' ),
						'accent_1' => array( 'Titre en vert, 1er morceau', 'text' ),
						'accent_2' => array( 'Titre en vert, 2e morceau', 'text' ),
						'chapeau'  => array( 'Chapeau', 'textarea' ),
					),
					'listes' => array(
						'entrees' => array(
							'Les trois entrées (numéro et bloc visé fixes)',
							array(
								'titre' => array( 1, 'Titre' ),
								'sous'  => array( 2, 'Sous-titre' ),
							),
							3,
						),
					),
				),
			),
		),
		'professionnels'  => array(
			'lieu'     => array( 'page_template', 'page-templates/professionnels.php' ),
			'sections' => array(
				'hero' => array(
					'titre'  => 'Haut de page',
					'champs' => array(
						'pastille' => array( 'Pastille', 'text' ),
						'titre'    => array( 'Titre, 1re ligne', 'text' ),
						'accent'   => array( 'Titre, 2e ligne (en vert)', 'text' ),
						'chapeau'  => array( 'Chapeau', 'textarea' ),
						'cta'      => array( 'Bouton principal', 'text' ),
					),
				),
			),
		),
		'qui'             => array(
			'lieu'     => array( 'page_template', 'page-templates/qui.php' ),
			'sections' => array(
				'hero' => array(
					'titre'  => 'Haut de page',
					'champs' => array(
						'pastille'      => array( 'Pastille', 'text' ),
						'titre'         => array( 'Titre, 1re ligne', 'text' ),
						'accent_1'      => array( 'Titre en vert, 1er morceau', 'text' ),
						'accent_2'      => array( 'Titre en vert, 2e morceau', 'text' ),
						'chapeau'       => array( 'Chapeau (ordinateur et tablette)', 'textarea' ),
						'chapeau_court' => array( 'Chapeau court (téléphone)', 'textarea' ),
						'cta'           => array( 'Bouton principal', 'text' ),
						'cta_parcours'  => array( 'Bouton « Découvrir mon parcours »', 'text' ),
					),
				),
			),
		),
		'contact'         => array(
			'lieu'     => array( 'page_template', 'page-templates/contact.php' ),
			'sections' => array(
				'hero' => array(
					'titre'  => 'Haut de page',
					'champs' => array(
						'titre_1' => array( 'Titre, 1er morceau', 'text' ),
						'titre_2' => array( 'Titre, 2e morceau', 'text' ),
						'accent'  => array( 'Titre en vert', 'text' ),
						'chapeau' => array( 'Chapeau', 'textarea' ),
					),
					'listes' => array(
						'promesses' => array(
							'Promesses cochées',
							array( 'texte' => array( null, 'Promesse' ) ),
							3,
						),
					),
				),
			),
		),
		'simulateur'      => array(
			'lieu'     => array( 'page_template', 'page-templates/simulateur.php' ),
			'sections' => array(
				'hero' => array(
					'titre'  => 'Haut de page',
					'champs' => array(
						'titre_1' => array( 'Titre, avant le mot en vert', 'text' ),
						'accent'  => array( 'Titre, mot en vert', 'text' ),
						'titre_2' => array( 'Titre, après le mot en vert', 'text' ),
						'chapeau' => array( 'Chapeau', 'textarea' ),
						'cta'     => array( 'Bouton principal', 'text' ),
					),
				),
			),
		),
	);
}

/**
 * Élément d'un tableau par son chemin (« a/0/b »), ou null.
 *
 * @param array  $donnees Tableau.
 * @param string $chemin  Chemin ; '' : le tableau lui-même.
 * @return mixed
 */
function dih_core_chemin_lire( $donnees, $chemin ) {
	if ( '' === $chemin ) {
		return $donnees;
	}
	foreach ( explode( '/', $chemin ) as $cle ) {
		if ( ! is_array( $donnees ) || ! array_key_exists( $cle, $donnees ) ) {
			return null;
		}
		$donnees = $donnees[ $cle ];
	}
	return $donnees;
}

/**
 * Remplace l'élément d'un tableau désigné par son chemin (existant).
 *
 * @param array  $donnees Tableau, modifié.
 * @param string $chemin  Chemin ; '' : le tableau lui-même.
 * @param mixed  $valeur  Nouvelle valeur.
 */
function dih_core_chemin_ecrire( &$donnees, $chemin, $valeur ) {
	if ( '' === $chemin ) {
		$donnees = $valeur;
		return;
	}
	$ici = &$donnees;
	foreach ( explode( '/', $chemin ) as $cle ) {
		if ( ! is_array( $ici ) || ! array_key_exists( $cle, $ici ) ) {
			return;
		}
		$ici = &$ici[ $cle ];
	}
	$ici = $valeur;
}

/**
 * Nom et clé ACF d'un champ de section.
 *
 * @param string $page    Fichier de contenus du thème.
 * @param string $section Identifiant de la section.
 * @param string $chemin  Chemin dans la section.
 * @return string[] [ nom, clé ]
 */
function dih_core_texte_champ( $page, $section, $chemin ) {
	$suffixe = '' === $chemin ? '' : '_' . str_replace( '/', '_', $chemin );
	return array( $section . $suffixe, 'field_dih_' . $section . '_' . $page . $suffixe );
}

/**
 * Chemin de la section dans les contenus de la page.
 *
 * @param string $id      Identifiant de la section.
 * @param array  $section Description de la section.
 * @return string
 */
function dih_core_texte_base( $id, $section ) {
	return isset( $section['base'] ) ? $section['base'] : $id;
}

/**
 * Lignes d'une liste telles que l'admin les enregistre, depuis les éléments du thème
 * (import des textes en place).
 *
 * @param array $elements Éléments du thème.
 * @param array $colonnes Colonnes de la liste.
 * @return array
 */
function dih_core_texte_lignes( $elements, $colonnes ) {
	$lignes = array();
	foreach ( (array) $elements as $element ) {
		$ligne = array();
		foreach ( $colonnes as $nom => $colonne ) {
			$ligne[ $nom ] = null === $colonne[0] ? $element : ( isset( $element[ $colonne[0] ] ) ? $element[ $colonne[0] ] : '' );
		}
		$lignes[] = $ligne;
	}
	return $lignes;
}

add_action(
	'dih_core_acf_init',
	function () {
		foreach ( dih_core_textes() as $page => $def ) {
			$champs  = array();
			$onglets = count( $def['sections'] ) > 1;
			foreach ( $def['sections'] as $id => $section ) {
				if ( $onglets ) {
					$champs[] = array(
						'key'       => 'field_dih_onglet_' . $id . '_' . $page,
						'label'     => $section['titre'],
						'type'      => 'tab',
						'placement' => 'top',
					);
				}
				if ( ! empty( $section['aide'] ) ) {
					$champs[] = array(
						'key'     => 'field_dih_aide_' . $id . '_' . $page,
						'label'   => '',
						'type'    => 'message',
						'message' => $section['aide'],
					);
				}

				foreach ( isset( $section['champs'] ) ? $section['champs'] : array() as $chemin => $champ ) {
					list( $nom, $cle ) = dih_core_texte_champ( $page, $id, $chemin );
					$acf               = array(
						'key'          => $cle,
						'name'         => $nom,
						'label'        => $champ[0],
						'instructions' => ( isset( $champ[2] ) ? $champ[2] . ' ' : '' ) . 'Vide : texte actuel du thème.',
						'type'         => $champ[1],
					);
					if ( 'textarea' === $champ[1] ) {
						$acf['rows']      = 3;
						$acf['new_lines'] = '';
					}
					$champs[] = $acf;
				}

				foreach ( isset( $section['listes'] ) ? $section['listes'] : array() as $chemin => $liste ) {
					list( $nom, $cle ) = dih_core_texte_champ( $page, $id, $chemin );
					$sous              = array();
					$largeurs          = array();
					foreach ( $liste[1] as $col => $colonne ) {
						$largeurs[ $col ] = ( isset( $colonne[2] ) && 'textarea' === $colonne[2] ) ? 2 : 1;
					}
					foreach ( $liste[1] as $col => $colonne ) {
						$type   = isset( $colonne[2] ) ? $colonne[2] : 'text';
						$sous[] = array_merge(
							array(
								'key'      => $cle . '_' . $col,
								'name'     => $col,
								'label'    => $colonne[1],
								'type'     => $type,
								'required' => 1,
								'wrapper'  => array( 'width' => (string) floor( 100 * $largeurs[ $col ] / array_sum( $largeurs ) ) ),
							),
							'textarea' === $type ? array(
								'rows'      => 2,
								'new_lines' => '',
							) : array()
						);
					}
					$champs[] = array(
						'key'          => $cle,
						'name'         => $nom,
						'label'        => $liste[0],
						'instructions' => ( isset( $liste[3] ) ? $liste[3] . ' ' : '' ) . 'Dans l’ordre d’affichage. Liste vide : liste actuelle du thème.',
						'type'         => 'repeater',
						'layout'       => 'table',
						'max'          => $liste[2],
						'button_label' => 'Ajouter une ligne',
						'sub_fields'   => $sous,
					);
				}
			}

			acf_add_local_field_group(
				array(
					'key'        => 'group_dih_textes_' . $page,
					'title'      => $onglets ? 'Textes de la page' : $def['sections'][ array_key_first( $def['sections'] ) ]['titre'],
					'fields'     => $champs,
					'location'   => array(
						array(
							array(
								'param'    => $def['lieu'][0],
								'operator' => '==',
								'value'    => $def['lieu'][1],
							),
						),
					),
					'position'   => 'normal',
					'menu_order' => -10,
				)
			);
		}
	}
);

/**
 * Textes et listes des pages uniques saisis dans l'admin. Chaque champ vide garde
 * le texte du thème.
 *
 * @param array  $donnees Contenus de la page.
 * @param string $page    Nom du fichier de contenus.
 * @return array
 */
function dih_core_contenus_textes( $donnees, $page ) {
	$textes = dih_core_textes();
	if ( ! isset( $textes[ $page ] ) || is_admin() || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
		return $donnees;
	}
	$id = dih_core_id_si_affichee( $page );
	if ( ! $id ) {
		return $donnees;
	}

	foreach ( $textes[ $page ]['sections'] as $sid => $section ) {
		$base = dih_core_texte_base( $sid, $section );
		$bloc = dih_core_chemin_lire( $donnees, $base );
		if ( null === $bloc ) {
			continue;
		}

		foreach ( isset( $section['champs'] ) ? $section['champs'] : array() as $chemin => $champ ) {
			list( $nom ) = dih_core_texte_champ( $page, $sid, $chemin );
			$valeur      = get_field( $nom, $id );
			$defaut      = dih_core_chemin_lire( $bloc, $chemin );
			// Vide, ou resté le texte du thème (import) : chaque variante garde le sien.
			if ( ! is_string( $valeur ) || '' === trim( $valeur ) || $valeur === $defaut ) {
				continue;
			}
			dih_core_chemin_ecrire( $bloc, $chemin, $valeur );
			// Accueil : un texte modifié du haut de page vaut pour toutes les variantes.
			if ( 'hero' === $base && isset( $bloc['variantes'] ) && false === strpos( $chemin, '/' ) ) {
				foreach ( array_keys( $bloc['variantes'] ) as $variante ) {
					unset( $bloc['variantes'][ $variante ][ $chemin ] );
				}
			}
		}

		foreach ( isset( $section['listes'] ) ? $section['listes'] : array() as $chemin => $liste ) {
			list( $nom ) = dih_core_texte_champ( $page, $sid, $chemin );
			$defauts     = array_values( (array) dih_core_chemin_lire( $bloc, $chemin ) );
			$premier     = array_key_first( $liste[1] );
			$fixes       = null !== $liste[1][ $premier ][0];
			$elements    = array();
			foreach ( (array) get_field( $nom, $id ) as $ligne ) {
				if ( ! is_array( $ligne ) || ! isset( $ligne[ $premier ] ) || '' === trim( (string) $ligne[ $premier ] ) ) {
					continue;
				}
				if ( ! $fixes ) {
					$elements[] = (string) $ligne[ $premier ]; // liste de textes
					continue;
				}
				$rang    = count( $elements );
				$element = ( isset( $defauts[ $rang ] ) && is_array( $defauts[ $rang ] ) ) ? $defauts[ $rang ] : array();
				foreach ( $liste[1] as $col => $colonne ) {
					$element[ $colonne[0] ] = isset( $ligne[ $col ] ) ? (string) $ligne[ $col ] : '';
				}
				ksort( $element );
				$elements[] = $element;
			}
			if ( $elements ) {
				dih_core_chemin_ecrire( $bloc, $chemin, $elements );
			}
		}

		dih_core_chemin_ecrire( $donnees, $base, $bloc );
	}

	// Simulateur : le mot en vert est collé aux deux morceaux, espaces compris.
	if ( 'simulateur' === $page && isset( $donnees['hero']['titre_1'], $donnees['hero']['titre_2'] ) ) {
		$donnees['hero']['titre_1'] = rtrim( $donnees['hero']['titre_1'] ) . ' ';
		$donnees['hero']['titre_2'] = ' ' . ltrim( $donnees['hero']['titre_2'] );
	}

	return $donnees;
}
add_filter( 'dih_contenu', 'dih_core_contenus_textes', 10, 2 );
