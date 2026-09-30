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
 *   'fichiers' => fichiers de contenus qui partagent la description (gabarit commun,
 *                 ex. les 12 fiches : entrée « fiche ») ; facultatif,
 *   'ordre'    => position de l'encart parmi ceux de la page (défaut : -10, en tête),
 *   'sections' => [ identifiant => [
 *     'titre'  => onglet de l'encart,
 *     'base'   => chemin de la section dans les contenus (par défaut : l'identifiant),
 *     'aide'   => message en tête d'onglet (facultatif),
 *     'champs' => [ chemin => [ libellé, type (text, textarea), aide facultative ] ],
 *     'listes' => [ chemin => [ libellé, colonnes, max (0 : sans limite), aide facultative ] ],
 *     (une liste peut aussi prendre place parmi les champs, sous le titre de sa carte :
 *     [ libellé, 'liste', colonnes, max, aide ] dans 'champs')
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
				'hero'        => array(
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
				'confiance'   => array(
					'titre'  => 'Bandeau de confiance',
					'aide'   => 'La note Google et le nombre d’avis se règlent dans Diag Imm’Hauts → Avis clients.',
					'listes' => array(
						'' => array(
							'Les trois engagements (picto fixe, par position)',
							array(
								'titre'   => array( 1, 'Titre' ),
								'legende' => array( 2, 'Légende' ),
							),
							3,
						),
					),
				),
				'une'         => array(
					'titre'  => 'À la une',
					'champs' => array(
						'surtitre'  => array( 'Surtitre', 'text' ),
						'etiquette' => array( 'Pastille', 'text' ),
						'titre'     => array( 'Titre', 'textarea' ),
						'texte'     => array( 'Texte', 'textarea' ),
						'cta'       => array( 'Bouton', 'text' ),
						'lien'      => array( 'Lien vers l’article', 'text' ),
						'legende'   => array( 'Panneau chiffré : légende', 'text' ),
						'avant'     => array( 'Panneau chiffré : valeur barrée', 'text' ),
						'apres'     => array( 'Panneau chiffré : nouvelle valeur', 'text' ),
						'note'      => array( 'Panneau chiffré : note', 'textarea', 'Exposant en HTML : 1<code>&lt;sup&gt;er&lt;/sup&gt;</code>.' ),
					),
				),
				'prestations' => array(
					'titre'  => 'Prestations',
					'champs' => array(
						'surtitre' => array( 'Surtitre', 'text' ),
						'titre'    => array( 'Titre', 'text' ),
						'texte'    => array( 'Texte à droite du titre', 'textarea' ),
					),
					'listes' => array(
						'cards' => array(
							'Les quatre cartes (numéro, teinte, illustration et page liée fixes)',
							array(
								'tag'   => array( 'tag', 'Étiquette' ),
								'titre' => array( 'titre', 'Titre' ),
								'texte' => array( 'texte', 'Texte', 'textarea' ),
							),
							4,
						),
					),
				),
				'detail'      => array(
					'titre'  => 'Le détail',
					'aide'   => 'Les douze tuiles des diagnostics suivent les pages du site.',
					'champs' => array(
						'surtitre' => array( 'Surtitre', 'text' ),
						'titre'    => array( 'Titre', 'text' ),
						'cta'      => array( 'Bouton vers le simulateur', 'text' ),
					),
				),
				'expert'      => array(
					'titre'  => 'Qui suis-je ?',
					'champs' => array(
						'surtitre' => array( 'Surtitre', 'text' ),
						'titre'    => array( 'Titre', 'text' ),
						'texte'    => array( 'Texte', 'textarea' ),
						'nom'      => array( 'Nom sous la photo', 'text' ),
						'role'     => array( 'Rôle sous la photo', 'text' ),
						'lien'     => array( 'Lien vers Qui suis-je', 'text' ),
					),
					'listes' => array(
						'valeurs' => array(
							'Les quatre valeurs (picto fixe, par position)',
							array(
								'titre' => array( 1, 'Titre' ),
								'texte' => array( 2, 'Texte' ),
							),
							4,
						),
					),
				),
				'zones'       => array(
					'titre'  => 'Zones desservies',
					'aide'   => '« Vérifier ma commune » s’appuie sur la liste des codes postaux du plugin, pas sur les pastilles ci-dessous.',
					'champs' => array(
						'surtitre'       => array( 'Surtitre', 'text' ),
						'titre'          => array( 'Titre', 'text' ),
						'texte'          => array( 'Texte', 'textarea' ),
						'cta'            => array( 'Bouton « Vérifier ma commune »', 'text' ),
						'note'           => array( 'Note sous le champ de recherche', 'textarea' ),
						'communes_titre' => array( 'Titre des pastilles', 'text' ),
					),
					'listes' => array(
						'communes' => array(
							'Communes en pastilles',
							array( 'commune' => array( null, 'Commune' ) ),
							0,
						),
					),
				),
				'rappel'      => array(
					'titre'  => 'Bloc final',
					'champs' => array(
						'titre' => array( 'Titre', 'text' ),
						'texte' => array( 'Texte', 'textarea' ),
						'cta_2' => array( 'Bouton « Demande de rappel gratuit »', 'text' ),
					),
				),
			),
		),
		'nos-diagnostics' => array(
			'lieu'     => array( 'page_template', 'page-templates/nos-diagnostics.php' ),
			'sections' => array(
				'hero'   => array(
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
				'vente'  => array(
					'titre'  => 'Vente & location',
					'champs' => array(
						'surtitre' => array( 'Surtitre', 'text' ),
						'titre'    => array( 'Titre', 'text' ),
						'texte'    => array( 'Texte', 'textarea' ),
						'cta'      => array( 'Bouton vers le simulateur', 'text' ),
					),
					'listes' => array(
						'cartes' => array(
							'Les douze cartes (page liée et illustration fixes, par position)',
							array(
								'validite'  => array( 1, 'Validité' ),
								'titre'     => array( 2, 'Titre' ),
								'texte'     => array( 3, 'Texte', 'textarea' ),
								'condition' => array( 4, 'Condition', 'textarea' ),
							),
							12,
						),
					),
				),
				'copro'  => array(
					'titre'  => 'Copropriétés',
					'champs' => array(
						'surtitre'  => array( 'Surtitre', 'text' ),
						'titre'     => array( 'Titre', 'text' ),
						'texte'     => array( 'Texte', 'textarea' ),
						'cta'       => array( 'Bouton', 'text' ),
						'image_alt' => array( 'Description de l’illustration (lecteurs d’écran)', 'text' ),
					),
					'listes' => array(
						'cartes' => array(
							'Les quatre cartes (illustration fixe, par position)',
							array(
								'titre' => array( 1, 'Titre' ),
								'texte' => array( 2, 'Texte', 'textarea' ),
							),
							4,
						),
					),
				),
				'audit'  => array(
					'titre'  => 'Audits énergétiques',
					'champs' => array(
						'surtitre'  => array( 'Surtitre', 'text' ),
						'titre'     => array( 'Titre', 'text' ),
						'texte'     => array( 'Texte', 'textarea', 'Exposant en HTML : 1<code>&lt;sup&gt;er&lt;/sup&gt;</code>.' ),
						'cta'       => array( 'Bouton', 'text' ),
						'legende'   => array( 'Légende de l’étiquette', 'textarea' ),
						'image_alt' => array( 'Description de l’étiquette (lecteurs d’écran)', 'text' ),
					),
				),
				'rappel' => array(
					'titre'  => 'Bloc final',
					'champs' => array(
						'titre'        => array( 'Titre', 'text' ),
						'texte'        => array( 'Texte', 'textarea' ),
						'formulaire/0' => array( 'Bouton du formulaire', 'text' ),
					),
				),
			),
		),
		'professionnels'  => array(
			'lieu'     => array( 'page_template', 'page-templates/professionnels.php' ),
			'sections' => dih_core_textes_professionnels(),
		),
		'qui'             => array(
			'lieu'     => array( 'page_template', 'page-templates/qui.php' ),
			'sections' => array(
				'hero'           => array(
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
				'confiance'      => array(
					'titre'  => 'Bandeau de confiance',
					'aide'   => 'La note Google et le nombre d’avis se règlent dans Diag Imm’Hauts → Avis clients.',
					'listes' => array(
						'' => array(
							'Les deux engagements (picto fixe, par position)',
							array(
								'titre'   => array( 1, 'Titre' ),
								'legende' => array( 2, 'Légende' ),
							),
							2,
						),
					),
				),
				'parcours'       => array(
					'titre'  => 'Mon parcours',
					'aide'   => 'La citation affichée se choisit dans l’encart « Qui suis-je » de la page ; ses cinq textes se modifient ici.',
					'champs' => array(
						'surtitre'                => array( 'Surtitre', 'text' ),
						'titre'                   => array( 'Titre', 'text' ),
						'citations/comprendre'    => array( 'Citation « Comprendre »', 'textarea' ),
						'citations/mesurer'       => array( 'Citation « Mesurer »', 'textarea' ),
						'citations/terrain'       => array( 'Citation « Terrain »', 'textarea' ),
						'citations/interlocuteur' => array( 'Citation « Interlocuteur »', 'textarea' ),
						'citations/preparation'   => array( 'Citation « Préparation »', 'textarea' ),
						'signature'               => array( 'Signature de la citation', 'text' ),
					),
					'listes' => array(
						'paragraphes' => array(
							'Paragraphes',
							array( 'texte' => array( null, 'Paragraphe', 'textarea' ) ),
							0,
						),
						'frise'       => array(
							'Frise des années',
							array(
								'annee' => array( 0, 'Année' ),
								'titre' => array( 1, 'Titre' ),
								'texte' => array( 2, 'Texte', 'textarea' ),
							),
							0,
						),
					),
				),
				'engagements'    => array(
					'titre'  => 'Mes engagements',
					'champs' => array(
						'surtitre' => array( 'Surtitre', 'text' ),
						'titre'    => array( 'Titre', 'text' ),
					),
					'listes' => array(
						'cartes' => array(
							'Les quatre cartes (picto fixe, par position)',
							array(
								'titre' => array( 1, 'Titre' ),
								'texte' => array( 2, 'Texte', 'textarea' ),
							),
							4,
						),
					),
				),
				'certifications' => array(
					'titre'  => 'Certifications',
					'champs' => array(
						'surtitre' => array( 'Surtitre', 'text' ),
						'titre'    => array( 'Titre', 'text' ),
						'texte'    => array( 'Texte', 'textarea' ),
					),
					'listes' => array(
						'garanties' => array(
							'Garanties cochées',
							array( 'texte' => array( null, 'Garantie', 'textarea' ) ),
							0,
						),
						'domaines'  => array(
							'Les six domaines (picto fixe, par position)',
							array(
								'titre' => array( 1, 'Domaine' ),
								'texte' => array( 2, 'Précision' ),
							),
							6,
						),
					),
				),
				'rappel'         => array(
					'titre'  => 'Bloc final',
					'champs' => array(
						'titre'        => array( 'Titre', 'text' ),
						'texte'        => array( 'Texte', 'textarea' ),
						'formulaire/0' => array( 'Bouton du formulaire', 'text' ),
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
		'mentions'        => array(
			'lieu'     => array( 'page_template', 'page-templates/mentions.php' ),
			'sections' => dih_core_textes_mentions(),
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
 * Professionnels : haut de page, profils, engagements, packs, déroulé, bloc final et
 * popup « Compte partenaire ». Chaque profil et chaque pack a ses champs, sa liste
 * (points, diagnostics) juste dessous ; illustrations, pictos et teintes restent fixes.
 *
 * @return array
 */
function dih_core_textes_professionnels() {
	$sections = array(
		'hero'        => array(
			'titre'  => 'Haut de page',
			'champs' => array(
				'pastille' => array( 'Pastille', 'text' ),
				'titre'    => array( 'Titre, 1re ligne', 'text' ),
				'accent'   => array( 'Titre, 2e ligne (en vert)', 'text' ),
				'chapeau'  => array( 'Chapeau', 'textarea' ),
				'cta'      => array( 'Bouton principal', 'text' ),
			),
		),
		'profils'     => array(
			'titre'  => 'Votre métier',
			'champs' => array(
				'surtitre' => array( 'Surtitre', 'text' ),
				'titre'    => array( 'Titre', 'text' ),
			),
		),
		'engagements' => array(
			'titre'  => 'Engagements',
			'champs' => array(
				'surtitre' => array( 'Surtitre', 'text' ),
				'titre'    => array( 'Titre', 'text' ),
			),
			'listes' => array(
				'cartes' => array(
					'Les six engagements (picto fixe, par position)',
					array(
						'titre' => array( 1, 'Titre' ),
						'texte' => array( 2, 'Texte', 'textarea' ),
					),
					6,
				),
			),
		),
		'packs'       => array(
			'titre'  => 'Packs',
			'champs' => array(
				'surtitre' => array( 'Surtitre', 'text' ),
				'titre'    => array( 'Titre', 'text' ),
				'lien'     => array( 'Lien vers le simulateur', 'text' ),
			),
		),
		'process'     => array(
			'titre'  => 'Déroulé',
			'champs' => array(
				'surtitre'    => array( 'Surtitre', 'text' ),
				'titre'       => array( 'Titre', 'text' ),
				'texte'       => array( 'Texte', 'textarea' ),
				'ligne_titre' => array( 'Encadré : titre', 'text' ),
				'ligne_texte' => array( 'Encadré : texte', 'textarea' ),
				'ligne_cta'   => array( 'Encadré : bouton', 'text' ),
			),
			'listes' => array(
				'etapes' => array(
					'Les quatre étapes (numéro fixe)',
					array(
						'titre' => array( 1, 'Titre' ),
						'texte' => array( 2, 'Texte', 'textarea' ),
					),
					4,
				),
			),
		),
		'rappel'      => array(
			'titre'  => 'Bloc final',
			'champs' => array(
				'titre'        => array( 'Titre', 'text' ),
				'texte'        => array( 'Texte', 'textarea' ),
				'formulaire/0' => array( 'Bouton « Écrire un message »', 'text' ),
			),
		),
		'popup'       => array(
			'titre'  => 'Popup partenaire',
			'aide'   => 'La fenêtre « Compte partenaire » ouverte par les boutons de rappel de la page ; les champs du formulaire se règlent dans Fluent Forms.',
			'champs' => array(
				'surtitre' => array( 'Surtitre', 'text' ),
				'titre'    => array( 'Titre', 'text' ),
				'intro'    => array( 'Introduction', 'textarea' ),
			),
		),
	);

	$rangs = array( '1re', '2e', '3e' );
	foreach ( $rangs as $i => $rang ) {
		$sections['profils']['champs'][ "cartes/$i/0" ] = array( "$rang carte : titre", 'text' );
		$sections['profils']['champs'][ "cartes/$i/3" ] = array( "$rang carte : texte", 'textarea' );
		$sections['profils']['champs'][ "cartes/$i/4" ] = array( "$rang carte : points cochés", 'liste', array( 'texte' => array( null, 'Point' ) ), 0 );
	}
	foreach ( $rangs as $i => $rang ) {
		$sections['packs']['champs'][ "cartes/$i/0" ] = array( "$rang pack : pastille", 'text' );
		$sections['packs']['champs'][ "cartes/$i/2" ] = array( "$rang pack : titre", 'text' );
		$sections['packs']['champs'][ "cartes/$i/3" ] = array( "$rang pack : texte", 'textarea' );
		$sections['packs']['champs'][ "cartes/$i/4" ] = array( "$rang pack : diagnostics compris", 'liste', array( 'diagnostic' => array( null, 'Diagnostic' ) ), 0 );
		$sections['packs']['champs'][ "cartes/$i/5" ] = array( "$rang pack : note", 'textarea' );
	}
	return $sections;
}

/**
 * Mentions légales : haut de page, puis un onglet par rubrique (titre, paragraphes,
 * définitions). L'ancre, le surtitre et les boutons des rubriques restent ceux du thème.
 *
 * @return array
 */
function dih_core_textes_mentions() {
	$aide = 'Liens et gras en HTML simple : <code>&lt;a href="…"&gt;</code>, <code>&lt;strong&gt;</code>. '
		. '<code>{a completer: …}</code> s’affiche surligné : remplacez-le par l’information. '
		. '<code>{adresse}</code>, <code>{telephone}</code> et <code>{email}</code> reprennent les coordonnées '
		. '(Diag Imm’Hauts → Coordonnées).';

	$sections = array(
		'hero' => array(
			'titre'  => 'Haut de page',
			'champs' => array(
				'chapeau' => array( 'Chapeau', 'textarea' ),
				'note'    => array( 'Date de mise à jour', 'text', 'Ex. « Dernière mise à jour : septembre 2026 ».' ),
			),
		),
	);
	$rubriques = array(
		'editeur'        => 'Éditeur',
		'hebergement'    => 'Hébergement',
		'propriete'      => 'Propriété',
		'certification'  => 'Certification',
		'donnees'        => 'Données personnelles',
		'responsabilite' => 'Responsabilité',
		'mediation'      => 'Médiation',
		'droit'          => 'Droit applicable',
	);
	$rang = 0;
	foreach ( $rubriques as $id => $onglet ) {
		$sections[ $id ] = array(
			'titre'  => $onglet,
			'base'   => 'blocs/' . $rang++,
			'aide'   => $aide,
			'champs' => array(
				'titre' => array( 'Titre de la rubrique', 'text' ),
			),
			'listes' => array(
				'paragraphes' => array(
					'Paragraphes',
					array( 'texte' => array( null, 'Paragraphe', 'textarea' ) ),
					0,
				),
				'definitions' => array(
					'Informations en liste (rubrique : contenu)',
					array(
						'terme'  => array( 0, 'Rubrique' ),
						'valeur' => array( 1, 'Contenu', 'textarea' ),
					),
					0,
				),
			),
		);
	}
	foreach ( array( 'hebergement', 'propriete', 'responsabilite', 'droit' ) as $id ) {
		unset( $sections[ $id ]['listes']['definitions'] ); // rubriques sans informations en liste
	}
	$sections['editeur']['champs']['raison'] = array( 'Raison sociale', 'text' );
	$sections['donnees']['champs']['sous_titre'] = array( 'Titre de l’encart des informations', 'text' );
	return $sections;
}

/**
 * Description qui s'applique à un fichier de contenus : la sienne, ou celle d'un
 * gabarit commun (entrée dont « fichiers » le contient).
 *
 * @param string $fichier Fichier de contenus du thème.
 * @return array|null [ nom de l'entrée (préfixe des clés), description ]
 */
function dih_core_texte_entree( $fichier ) {
	$textes = dih_core_textes();
	if ( isset( $textes[ $fichier ] ) && empty( $textes[ $fichier ]['fichiers'] ) ) {
		return array( $fichier, $textes[ $fichier ] );
	}
	foreach ( $textes as $nom => $def ) {
		if ( ! empty( $def['fichiers'] ) && in_array( $fichier, $def['fichiers'], true ) ) {
			return array( $nom, $def );
		}
	}
	return null;
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
 * Éléments d'une section dans l'ordre d'affichage de l'admin : ses champs, puis ses
 * listes. Un champ de type « liste » ( [ libellé, 'liste', colonnes, max, aide ] )
 * prend sa place parmi les champs (liste propre à une carte, sous son titre).
 *
 * @param array $section Description de la section.
 * @return array[] [ chemin, 'champ' | 'liste', [ libellé, type | colonnes, max, aide ] ]
 */
function dih_core_texte_elements( $section ) {
	$elements = array();
	foreach ( isset( $section['champs'] ) ? $section['champs'] : array() as $chemin => $def ) {
		if ( 'liste' === $def[1] ) {
			$elements[] = array( (string) $chemin, 'liste', array( $def[0], $def[2], $def[3], isset( $def[4] ) ? $def[4] : null ) );
		} else {
			$elements[] = array( (string) $chemin, 'champ', $def );
		}
	}
	foreach ( isset( $section['listes'] ) ? $section['listes'] : array() as $chemin => $def ) {
		$elements[] = array( (string) $chemin, 'liste', $def );
	}
	return $elements;
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

				foreach ( dih_core_texte_elements( $section ) as $element ) {
					list( $chemin, $genre, $el ) = $element;
					list( $nom, $cle )           = dih_core_texte_champ( $page, $id, $chemin );

					if ( 'champ' === $genre ) {
						$acf = array(
							'key'          => $cle,
							'name'         => $nom,
							'label'        => $el[0],
							'instructions' => ( isset( $el[2] ) ? $el[2] . ' ' : '' ) . 'Vide : texte actuel du thème.',
							'type'         => $el[1],
						);
						if ( 'textarea' === $el[1] ) {
							$acf['rows']      = 3;
							$acf['new_lines'] = '';
						}
						$champs[] = $acf;
						continue;
					}

					$sous     = array();
					$largeurs = array();
					foreach ( $el[1] as $col => $colonne ) {
						$largeurs[ $col ] = ( isset( $colonne[2] ) && 'textarea' === $colonne[2] ) ? 2 : 1;
					}
					foreach ( $el[1] as $col => $colonne ) {
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
						'label'        => $el[0],
						'instructions' => ( isset( $el[3] ) ? $el[3] . ' ' : '' ) . 'Dans l’ordre d’affichage. Liste vide : liste actuelle du thème.',
						'type'         => 'repeater',
						'layout'       => 'table',
						'max'          => $el[2],
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
					'menu_order' => isset( $def['ordre'] ) ? $def['ordre'] : -10,
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
	$entree = dih_core_texte_entree( $page );
	if ( ! $entree || is_admin() || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
		return $donnees;
	}
	$id = dih_core_id_si_affichee( $page );
	if ( ! $id ) {
		return $donnees;
	}
	list( $prefixe, $def_page ) = $entree;

	foreach ( $def_page['sections'] as $sid => $section ) {
		$base = dih_core_texte_base( $sid, $section );
		$bloc = dih_core_chemin_lire( $donnees, $base );
		if ( null === $bloc ) {
			continue;
		}

		foreach ( dih_core_texte_elements( $section ) as $element ) {
			list( $chemin, $genre, $def ) = $element;
			list( $nom )                  = dih_core_texte_champ( $prefixe, $sid, $chemin );

			if ( 'champ' === $genre ) {
				$valeur = get_field( $nom, $id );
				$defaut = dih_core_chemin_lire( $bloc, $chemin );
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
				continue;
			}

			$defauts  = array_values( (array) dih_core_chemin_lire( $bloc, $chemin ) );
			$premier  = array_key_first( $def[1] );
			$fixes    = null !== $def[1][ $premier ][0];
			$elements = array();
			foreach ( (array) get_field( $nom, $id ) as $ligne ) {
				if ( ! is_array( $ligne ) || ! isset( $ligne[ $premier ] ) || '' === trim( (string) $ligne[ $premier ] ) ) {
					continue;
				}
				if ( ! $fixes ) {
					$elements[] = (string) $ligne[ $premier ]; // liste de textes
					continue;
				}
				$rang   = count( $elements );
				$ligne2 = ( isset( $defauts[ $rang ] ) && is_array( $defauts[ $rang ] ) ) ? $defauts[ $rang ] : array();
				foreach ( $def[1] as $col => $colonne ) {
					$ligne2[ $colonne[0] ] = isset( $ligne[ $col ] ) ? (string) $ligne[ $col ] : '';
				}
				if ( ! array_filter( array_keys( $ligne2 ), 'is_string' ) ) {
					ksort( $ligne2 ); // rangs : dans l'ordre ; clés nommées : ordre du thème
				}
				$elements[] = $ligne2;
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
