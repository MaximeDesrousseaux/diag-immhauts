<?php
/**
 * Page d'options « Personnalisation du site » (maquette : Admin WP - Personnalisation.dc.html).
 *
 * Menu « Diag Imm'Hauts » → Personnalisation : trois onglets (Identité du site,
 * Accueil, Pages intérieures), un sélecteur à vignettes par réglage. Chaque champ
 * porte le nom du réglage que le thème lit par dih_option( 'cle' ) : une valeur
 * pour tout le site, stockée une seule fois (options_<cle>).
 * Menu « Diag Imm'Hauts » → Formulaires : identifiants des formulaires Fluent Forms.
 * Réglage propre à une page : citation (Qui suis-je), lue par dih_option_page().
 *
 * Tout est enregistré sur dih_core_acf_init : sans ACF Pro, rien de tout cela
 * n'existe et le thème garde ses valeurs par défaut.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * URL d'une vignette de la page d'options (assets/admin).
 *
 * @param string $fichier Nom du fichier.
 * @return string
 */
function dih_core_vignette_url( $fichier ) {
	return DIH_CORE_URL . 'assets/admin/' . $fichier;
}

/**
 * Libellé HTML d'un choix à vignette : vignette, titre, description.
 * Rendu par le champ radio d'ACF, mis en forme par assets/admin/personnalisation.css.
 *
 * @param string $titre    Titre du choix.
 * @param string $desc     Description (facultative).
 * @param string $vignette HTML de la vignette (déjà échappé).
 * @param string $note     Petite ligne sous la vignette (facultative).
 * @return string
 */
function dih_core_choix( $titre, $desc = '', $vignette = '', $note = '' ) {
	$html = '<span class="dih-choix__vignette">' . $vignette . '</span>';
	if ( '' !== $note ) {
		$html .= '<span class="dih-choix__note">' . esc_html( $note ) . '</span>';
	}
	$html .= '<span class="dih-choix__titre">' . esc_html( $titre ) . '</span>';
	if ( '' !== $desc ) {
		$html .= '<span class="dih-choix__desc">' . esc_html( $desc ) . '</span>';
	}
	return $html;
}

/**
 * Vignette image, avec la pastille « Actif » des maquettes.
 *
 * @param string $fichier Fichier de assets/admin.
 * @param bool   $actif   Afficher la pastille « Actif » quand le choix est coché.
 * @return string
 */
function dih_core_vignette_img( $fichier, $actif = true ) {
	return sprintf( '<img src="%s" alt="" loading="lazy">', esc_url( dih_core_vignette_url( $fichier ) ) )
		. ( $actif ? '<span class="dih-choix__actif">Actif</span>' : '' );
}

/**
 * Champ radio à vignettes (réglage global ou de page).
 *
 * @param string $nom      Nom du réglage (clé lue par le thème).
 * @param string $label    Titre de la section.
 * @param string $consigne Description sous le titre.
 * @param array  $choix    valeur => libellé HTML (dih_core_choix) ; le premier est le défaut.
 * @param string $classes  Classes du conteneur (disposition des vignettes).
 * @return array
 */
function dih_core_champ_choix( $nom, $label, $consigne, $choix, $classes ) {
	return array(
		'key'           => 'field_dih_' . $nom,
		'name'          => $nom,
		'label'         => $label,
		'instructions'  => $consigne,
		'type'          => 'radio',
		'choices'       => $choix,
		'default_value' => array_key_first( $choix ),
		'layout'        => 'horizontal',
		'return_format' => 'value',
		'allow_null'    => 0,
		'other_choice'  => 0,
		'wrapper'       => array( 'class' => 'dih-reglage ' . $classes ),
	);
}

/**
 * Champ « message » : intro de la page, portée d'un onglet ou tête de section.
 *
 * @param string $cle     Suffixe de la clé ACF.
 * @param string $label   Titre (vide pour un simple paragraphe).
 * @param string $message Texte.
 * @param string $classes Classes du conteneur.
 * @return array
 */
function dih_core_champ_message( $cle, $label, $message, $classes ) {
	return array(
		'key'       => 'field_dih_msg_' . $cle,
		'name'      => '',
		'label'     => $label,
		'type'      => 'message',
		'message'   => $message,
		'new_lines' => '',
		'esc_html'  => 0,
		'wrapper'   => array( 'class' => $classes ),
	);
}

/**
 * Onglet de la page d'options.
 *
 * @param string $cle   Suffixe de la clé ACF.
 * @param string $label Libellé.
 * @return array
 */
function dih_core_champ_onglet( $cle, $label ) {
	return array(
		'key'       => 'field_dih_onglet_' . $cle,
		'label'     => $label,
		'type'      => 'tab',
		'placement' => 'top',
		'endpoint'  => 0,
	);
}

/**
 * Champs de la page « Personnalisation du site », dans l'ordre de la maquette.
 * Les valeurs et défauts suivent dih_options_valeurs() du thème (README § Réglages
 * globaux). step_icons n'a pas de champ : la maquette d'admin a retiré ce choix.
 *
 * @return array
 */
function dih_core_champs_personnalisation() {
	$nb = "\u{00a0}"; // espace insécable, comme les maquettes

	// Identité du site ------------------------------------------------------------
	$logos = array();
	foreach ( array(
		'toitures' => array( 'Ancien logo mis à jour', 'Le logo actuel redessiné en vectoriel, aux couleurs de la charte.', 'logo-toitures.svg' ),
		'actuel'   => array( 'Ancien logo', 'Le logo du site actuellement en ligne.', 'logo-diag.png' ),
		'terrils'  => array( 'Nouveau logo', 'Les deux terrils du bassin minier sous le sillon : terril avant en vert clair.', 'logo-terrils-nav.svg' ),
	) as $valeur => $c ) {
		$logos[ $valeur ] = dih_core_choix( $c[0], $c[1], dih_core_vignette_img( $c[2] ) );
	}

	$boutons = array(
		'pilule'  => dih_core_choix( 'Pilule (arrondi complet)', '', '<span class="dih-bouton-exemple">Demande de rappel</span>' ),
		'arrondi' => dih_core_choix( 'Coins arrondis', '', '<span class="dih-bouton-exemple">Demande de rappel</span>' ),
	);

	$titres = array();
	foreach ( array(
		'manrope'       => array( 'Manrope', 'Le jeu actuel du site.' ),
		'outfit'        => array( 'Outfit', 'Plus géométrique, contours plus doux.' ),
		'space-grotesk' => array( 'Space Grotesk', 'Plus technique, un peu plus étroit.' ),
		'archivo'       => array( 'Archivo', 'Plus dense et plus affirmé.' ),
	) as $valeur => $c ) {
		$titres[ $valeur ] = dih_core_choix( $c[0], $c[1], '<span class="dih-police-exemple dih-police--' . $valeur . '">Diagnostic</span>' );
	}

	// Facteur de correction : égalise la hauteur d'x sur Inter (repris par le thème,
	// $polices-texte dans abstracts/_tokens.scss).
	$textes = array();
	foreach ( array(
		'inter'           => array( 'Inter', 'Le jeu actuel du site. Très lisible sur écran.', 100 ),
		'instrument-sans' => array( 'Instrument Sans', 'Un peu plus chaleureuse, lettres légèrement plus étroites.', 104 ),
		'source-sans-3'   => array( 'Source Sans 3', 'La plus humaine des trois, confortable en lecture longue.', 112 ),
	) as $valeur => $c ) {
		$textes[ $valeur ] = dih_core_choix(
			$c[0],
			$c[1],
			'<span class="dih-texte-exemple dih-police--' . $valeur . '">Le diagnostic de performance énergétique est obligatoire avant toute vente ou mise en location.</span>',
			100 === $c[2] ? 'Taille de référence' : 'Corrigée à ' . $c[2] . $nb . '%'
		);
	}

	// Accueil ---------------------------------------------------------------------
	$heros = array();
	foreach ( array(
		'terrils-boutons' => array( 'Décor de collines, deux boutons', 'La présentation actuelle : deux boutons côte à côte, pas de formulaire dans le visuel.', 'hero-terrils-boutons.webp' ),
		'terrils-barre'   => array( 'Décor de collines, barre de rappel', 'Même décor, mais le formulaire de rappel occupe toute la largeur en bas du visuel.', 'hero-terrils-barre.webp' ),
		'max-bandeau'     => array( 'Photo de Maxime', 'Votre photo à droite et le formulaire en bandeau. Met la personne en avant plutôt que le territoire.', 'hero-max-bandeau.webp' ),
		'sansBG'          => array( 'Sans décor, formulaire à droite', 'Fond vert uni, formulaire complet à droite. La version la plus sobre et la plus rapide à charger.', 'hero-sans-bg.webp' ),
	) as $valeur => $c ) {
		$heros[ $valeur ] = dih_core_choix( $c[0], $c[1], dih_core_vignette_img( $c[2] ) );
	}

	$details = array();
	foreach ( array(
		'ouvert' => array( 'Cards blanches, pas de background', 'Aucun panneau : les 12 cartes blanches à filet vert clair sont posées directement sur le fond de la page. Le plus léger, dans la continuité des cards de l’accueil.', 'detail-ouvert.webp' ),
		'clair'  => array( 'Panneau blanc, tuiles vert pâle', 'Un grand panneau blanc à filet fin regroupe les 12 diagnostics sur des tuiles vert très pâle. Au survol, la tuile passe en blanc avec un filet vert.', 'detail-clair.webp' ),
		'damier' => array( 'Damier blanc / vert clair', 'Petites cartes à bordure vert foncé de 2 px, en alternance blanc / vert clair, flèche à côté du nom. Le plus structuré, reprend le standard des grandes cards.', 'detail-damier.webp' ),
	) as $valeur => $c ) {
		$details[ $valeur ] = dih_core_choix( $c[0], $c[1], dih_core_vignette_img( $c[2] ) );
	}

	// Pages intérieures -----------------------------------------------------------
	$decors = array();
	foreach ( array(
		'terrils' => array( 'Terrils', 'Le paysage des terrils en grand, l’herbe sert de support à l’illustration de chaque page.', 'decor-terrils.webp' ),
		'grille'  => array( 'Lignes graphiques', 'L’ancien décor : fond vert uni, lignes isométriques et halos lumineux.', 'decor-lignes.webp' ),
	) as $valeur => $c ) {
		$decors[ $valeur ] = dih_core_choix( $c[0], $c[1], dih_core_vignette_img( $c[2] ) );
	}

	$entrees = array();
	foreach ( array(
		'sommaire'        => array( 'Sommaire', 'Trois lignes séparées par un filet, sans cadre. Titres plus grands, flèche dans un cercle. Plus léger, laisse respirer l’illustration.', 'entrees-sommaire.webp' ),
		'cartes-blanches' => array( 'Cartes blanches', 'Trois cartes blanches pleines, numéro vert et flèche dans une pastille verte. Plus visibles, invitent davantage au clic.', 'entrees-cartes-blanches.webp' ),
	) as $valeur => $c ) {
		$entrees[ $valeur ] = dih_core_choix( $c[0], $c[1], dih_core_vignette_img( $c[2] ) );
	}

	$etapes = array(
		'en-ligne'      => dih_core_choix( 'Les 4 étapes en ligne', 'Les illustrations au-dessus, les quatre cartes alignées en dessous.', dih_core_vignette_img( 'etapes-en-ligne.webp', false ) ),
		'deux-colonnes' => dih_core_choix( 'Deux colonnes', 'Une grande illustration à gauche, les quatre étapes en damier à droite. Plus haut, plus illustré.', dih_core_vignette_img( 'etapes-deux-colonnes.webp', false ) ),
	);

	return array(
		dih_core_champ_message( 'intro', '', 'Ces réglages s’appliquent à l’ensemble du site. Ils ne modifient pas le contenu des pages' . $nb . ': aucun texte ni aucune image n’est touché.', 'dih-intro' ),

		dih_core_champ_onglet( 'identite', 'Identité du site' ),
		dih_core_champ_message( 'portee_identite', '', 'S’applique à' . $nb . ': toutes les pages.', 'dih-portee' ),
		dih_core_champ_choix( 'logo_site', 'Logo du site', 'Trois logos au choix, affichés dans l’en-tête et le pied de page des 22 pages. Le réglage vaut pour tout le site.', $logos, 'dih-reglage--logo' ),
		dih_core_champ_choix( 'forme_boutons', 'Forme des boutons', 'S’applique à tous les boutons verts du site (21 pages) : demandes de rappel, liens vers les fiches, bouton du simulateur.', $boutons, 'dih-reglage--boutons' ),
		dih_core_champ_message( 'polices', 'Polices de caractères', 'Deux réglages indépendants' . $nb . ': la police des titres et celle du texte courant. Ils s’appliquent aux 22 pages. Toutes les polices proposées sont hébergées sur le site' . $nb . ': aucune donnée n’est envoyée à un service extérieur.', 'dih-reglage dih-reglage--tete' ),
		dih_core_champ_choix( 'police_titre', 'Titres', '', $titres, 'dih-reglage--suite dih-reglage--titres' ),
		dih_core_champ_choix( 'police_texte', 'Texte courant', 'Chaque police a son propre dessin' . $nb . ': à taille égale, certaines paraissent plus petites. Une correction de taille est appliquée automatiquement pour que le texte garde la même présence d’un jeu à l’autre.', $textes, 'dih-reglage--suite dih-reglage--fin dih-reglage--textes' ),

		dih_core_champ_onglet( 'accueil', 'Accueil' ),
		dih_core_champ_message( 'portee_accueil', '', 'S’applique à' . $nb . ': page d’accueil uniquement.', 'dih-portee' ),
		dih_core_champ_choix( 'hero_accueil', 'Visuel du haut de page d’accueil', 'Quatre présentations possibles du premier écran. Le texte, les chiffres et le bouton restent les mêmes' . $nb . ': seule la mise en scène change.', $heros, 'dih-reglage--hero' ),
		dih_core_champ_choix( 'detail_style', 'Bloc «' . $nb . 'Le détail' . $nb . '» de l’accueil', 'La grille des 12 diagnostics, sous «' . $nb . 'Nos prestations' . $nb . '». Les liens, les illustrations et le bouton «' . $nb . 'Vérifier mon bien' . $nb . '» restent les mêmes' . $nb . ': seule la présentation change.', $details, 'dih-reglage--detail' ),

		dih_core_champ_onglet( 'interieures', 'Pages intérieures' ),
		dih_core_champ_message( 'portee_interieures', '', 'S’applique à' . $nb . ': fiches, nos diagnostics, simulateur…', 'dih-portee' ),
		dih_core_champ_choix( 'decor_hero', 'Décor du site (hauts de page)', 'Le fond du premier écran des pages intérieures (fiches, Nos diagnostics, simulateur, professionnels, actualités, contact). L’accueil et «' . $nb . 'Qui suis-je' . $nb . '» ont leur propre décor.', $decors, 'dih-reglage--decor' ),
		dih_core_champ_choix( 'entrees_hero', 'Entrées du haut de page «' . $nb . 'Nos diagnostics' . $nb . '»', 'Les trois raccourcis du premier écran (Vente & location, Copropriétés, Audit énergétique). Les liens et les textes restent les mêmes' . $nb . ': seule la présentation change.', $entrees, 'dih-reglage--entrees' ),
		dih_core_champ_message( 'etapes', 'Bloc «' . $nb . 'De votre appel au rapport, en 4 étapes' . $nb . '»', 'Ce bloc apparaît sur les 12 fiches diagnostic, sur «' . $nb . 'Nos diagnostics' . $nb . '» et sur le simulateur. Le réglage vaut pour les 14 pages en même temps.', 'dih-reglage dih-reglage--tete' ),
		dih_core_champ_choix( 'etapes_dispo', 'Disposition sur ordinateur', 'Sur mobile et sur tablette, les deux dispositions donnent le même rendu' . $nb . ': les quatre étapes s’empilent le long d’un filet vertical.', $etapes, 'dih-reglage--suite dih-reglage--fin dih-reglage--etapes' ),
	);
}

/**
 * Libellés de la citation de Qui suis-je : textes lus dans les contenus du thème
 * (une seule source), au chargement du champ seulement (écran d'édition de la page).
 * Sans le thème, les choix gardent leur clé.
 *
 * @param array $champ Champ ACF.
 * @return array
 */
function dih_core_libelles_citation( $champ ) {
	if ( ! function_exists( 'dih_contenu' ) ) {
		return $champ;
	}
	$parcours = dih_contenu( 'qui', 'parcours' );
	foreach ( array_keys( $champ['choices'] ) as $cle ) {
		if ( isset( $parcours['citations'][ $cle ] ) ) {
			$champ['choices'][ $cle ] = $parcours['citations'][ $cle ];
		}
	}
	return $champ;
}
add_filter( 'acf/load_field/key=field_dih_citation', 'dih_core_libelles_citation' );

add_action(
	'dih_core_acf_init',
	function () {
		// Menu « Diag Imm'Hauts » : renvoie sur sa première sous-page.
		acf_add_options_page(
			array(
				'page_title' => 'Diag Imm’Hauts',
				'menu_title' => 'Diag Imm’Hauts',
				'menu_slug'  => 'dih-reglages',
				'capability' => 'manage_options',
				'icon_url'   => 'dashicons-admin-appearance',
				'position'   => 21, // juste après Pages, comme la maquette
				'redirect'   => true,
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'      => 'Personnalisation du site',
				'menu_title'      => 'Personnalisation',
				'menu_slug'       => 'dih-personnalisation',
				'parent_slug'     => 'dih-reglages',
				'capability'      => 'manage_options',
				'update_button'   => 'Enregistrer les modifications',
				'updated_message' => 'Réglages enregistrés.',
				'autoload'        => true, // lus sur chaque page du site
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'      => 'Formulaires',
				'menu_title'      => 'Formulaires',
				'menu_slug'       => 'dih-formulaires',
				'parent_slug'     => 'dih-reglages',
				'capability'      => 'manage_options',
				'update_button'   => 'Enregistrer les modifications',
				'updated_message' => 'Réglages enregistrés.',
				'autoload'        => true,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_dih_personnalisation',
				'title'                 => 'Personnalisation du site',
				'fields'                => dih_core_champs_personnalisation(),
				'location'              => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'dih-personnalisation',
						),
					),
				),
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
			)
		);

		$formulaires = array();
		foreach ( array(
			'rappel'     => array( 'Demande de rappel', 'Popup de rappel et bloc « rappel » en bas des pages.' ),
			'devis'      => array( 'Demande de devis', 'Page Contact, bloc « devis ».' ),
			'contact'    => array( 'Contact', 'Message libre (Professionnels, « Écrire un message »).' ),
			'partenaire' => array( 'Compte partenaire', 'Popup de la page Professionnels.' ),
		) as $cle => $c ) {
			$formulaires[] = array(
				'key'          => 'field_dih_formulaire_' . $cle,
				'name'         => 'formulaire_' . $cle,
				'label'        => $c[0],
				'instructions' => $c[1] . ' Identifiant Fluent Forms (colonne ID de la liste des formulaires) ; vide : emplacement balisé.',
				'type'         => 'number',
				'min'          => 1,
				'step'         => 1,
			);
		}

		acf_add_local_field_group(
			array(
				'key'      => 'group_dih_formulaires',
				'title'    => 'Formulaires Fluent Forms',
				'fields'   => $formulaires,
				'location' => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'dih-formulaires',
						),
					),
				),
			)
		);

		// Réglage propre à Qui suis-je (README § Réglages globaux).
		acf_add_local_field_group(
			array(
				'key'      => 'group_dih_qui',
				'title'    => 'Qui suis-je',
				'fields'   => array(
					array(
						'key'           => 'field_dih_citation',
						'name'          => 'citation',
						'label'         => 'Citation du parcours',
						'instructions'  => 'Phrase mise en avant sous « Mon parcours ».',
						'type'          => 'radio',
						'choices'       => array(
							'comprendre'    => 'Comprendre',
							'mesurer'       => 'Mesurer',
							'terrain'       => 'Terrain',
							'interlocuteur' => 'Interlocuteur',
							'preparation'   => 'Préparation',
						),
						'default_value' => 'comprendre',
						'layout'        => 'vertical',
						'return_format' => 'value',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-templates/qui.php',
						),
					),
				),
				'position' => 'side',
			)
		);
	}
);

/**
 * Feuille de style et polices de la page « Personnalisation » : vignettes en
 * cartes, onglets façon WordPress, bouton d'enregistrement sous les réglages.
 * Les polices d'aperçu sont celles du thème (assets/fonts), jamais un service extérieur.
 *
 * @param string $hook Page d'administration affichée.
 */
function dih_core_personnalisation_assets( $hook ) {
	if ( false === strpos( (string) $hook, 'dih-personnalisation' ) ) {
		return;
	}

	$fichier = 'assets/admin/personnalisation.css';
	wp_enqueue_style( 'dih-personnalisation', DIH_CORE_URL . $fichier, array(), (string) filemtime( DIH_CORE_DIR . $fichier ) );

	$polices = array(
		'Manrope'         => array( 'manrope', array( 600, 700, 800 ) ),
		'Outfit'          => array( 'outfit', array( 800 ) ),
		'Space Grotesk'   => array( 'space-grotesk', array( 700 ) ),
		'Archivo'         => array( 'archivo', array( 800 ) ),
		'Inter'           => array( 'inter', array( 400 ) ),
		'Instrument Sans' => array( 'instrument-sans', array( 400 ) ),
		'Source Sans 3'   => array( 'source-sans-3', array( 400 ) ),
	);
	$css = '';
	foreach ( $polices as $famille => $police ) {
		foreach ( $police[1] as $graisse ) {
			$relatif = 'assets/fonts/' . $police[0] . '-latin-' . $graisse . '-normal.woff2';
			if ( ! file_exists( get_template_directory() . '/' . $relatif ) ) {
				continue;
			}
			$css .= sprintf(
				'@font-face{font-family:"%s";font-weight:%d;font-display:swap;src:url("%s") format("woff2")}',
				$famille,
				$graisse,
				esc_url( get_template_directory_uri() . '/' . $relatif )
			);
		}
	}
	wp_add_inline_style( 'dih-personnalisation', $css );
}
add_action( 'admin_enqueue_scripts', 'dih_core_personnalisation_assets' );

/**
 * Lien « Voir le résultat sur le site » à côté du bouton d'enregistrement.
 *
 * @param array $page Page d'options ACF affichée.
 */
function dih_core_personnalisation_lien_site( $page ) {
	if ( empty( $page['menu_slug'] ) || 'dih-personnalisation' !== $page['menu_slug'] ) {
		return;
	}
	printf(
		'<a class="dih-voir-site" href="%s" target="_blank" rel="noopener">Voir le résultat sur le site ↗</a>',
		esc_url( home_url( '/' ) )
	);
}
add_action( 'acf/options_page/submitbox_major_actions', 'dih_core_personnalisation_lien_site' );
