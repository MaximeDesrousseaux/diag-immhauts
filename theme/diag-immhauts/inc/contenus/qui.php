<?php
/**
 * Contenus de la page Qui suis-je (/maxime-dillies-diagnostiqueur/), relevés
 * sur la maquette « Qui suis-je » (textes à la lettre).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'         => array(
		'ariane'       => 'Qui suis-je ?',
		'pastille'     => 'Fondateur & unique intervenant',
		'titre'        => 'Maxime Dillies,',
		'accent_1'     => 'diagnostiqueur',
		'accent_2'     => 'certifié.',
		'chapeau'      => 'Diagnostiqueur depuis 2018, certifié Bureau Veritas : la personne qui visite votre logement est aussi celle qui vous explique le rapport. Un seul interlocuteur, du premier appel à la remise des documents.',
		'chapeau_court' => 'Certifié Bureau Veritas depuis 2018. Celui qui visite votre logement est celui qui vous explique le rapport.',
		'cta'          => 'Demander un devis gratuit',
		'cta_parcours' => 'Découvrir mon parcours',
		'photo'        => 'Maxime_Dillies_pp.webp',
		'photo_alt'    => 'Maxime Dillies, diagnostiqueur immobilier',
	),
	// Bandeau de confiance (composant partagé avec l'accueil) : ici deux engagements.
	'confiance'    => array(
		array( 'bouclier', 'Certifié Bureau Veritas', 'Certifications à jour' ),
		array( 'horloge', 'Rendez-vous sous 48 h', 'Rapport remis en 48 h' ),
	),
	'parcours'     => array(
		'surtitre'   => 'Mon parcours',
		'titre'      => 'Le diagnostic comme métier, pas comme formalité',
		'paragraphes' => array(
			'Avant le diagnostic, j\'ai été volleyeur professionnel : une discipline qui apprend la rigueur, la préparation et le sens du collectif. Je me suis ensuite formé au diagnostic immobilier, exerçant depuis 2018 et certifié en 2020. Chaque visite m\'apprend à lire un bâtiment autrement qu\'à travers une grille de contrôle — reconnaître une ancienne peinture au plomb sous trois couches, deviner une isolation absente au toucher d\'un mur.',
			'Ce réflexe de terrain guide ma façon de travailler. Je ne coche pas des cases : j\'explique ce que j\'observe, ce que ça implique pour votre vente ou votre location, et ce qui mérite des travaux avant le reste.',
		),
		// Réglage de la page « citation » (champ ACF de la page, voir dih_option_page()).
		'citations'  => array(
			'comprendre'    => '« Un diagnostic n’a de valeur que si son propriétaire le comprend. »',
			'mesurer'       => '« Je ne coche pas des cases : je mesure, je justifie, j’explique. »',
			'terrain'       => '« Ce qui compte n’est pas le rapport que je remets, c’est la décision qu’il vous permet de prendre. »',
			'interlocuteur' => '« Vous n’avez qu’un numéro à retenir : celui de la personne qui vient chez vous. »',
			'preparation'   => '« Un diagnostic bien préparé, c’est une vente qui ne se renégocie pas. »',
		),
		'signature'  => 'Maxime Dillies',
		// [ année, titre, texte ]
		'frise'      => array(
			array( 'Avant 2017', 'Volleyeur professionnel', 'Des années de sport de haut niveau : rigueur, préparation, sens du collectif et goût de l’effort bien fait.' ),
			array( '2018', 'Diagnostiqueur immobilier', 'Formation au diagnostic immobilier puis premières années d’exercice sur le terrain, dans l’habitat ancien de l’Artois.' ),
			array( '2020', 'Certifications Bureau Veritas', 'Certification personnelle délivrée par Bureau Veritas, organisme accrédité par le Cofrac, sur les domaines réglementés.' ),
			array( '2023', 'Création de Diag Imm’Hauts', 'Lancement de Diag Imm’Hauts à Berles-Monchel, avec une promesse : un seul interlocuteur, du premier appel au rapport commenté.' ),
		),
	),
	'engagements'  => array(
		'surtitre' => 'Mes engagements',
		'titre'    => 'Ce que vous obtenez en travaillant avec moi',
		// [ tracés SVG, titre, texte ]
		'cartes'   => array(
			array( '<circle cx="12" cy="8" r="3.4"></circle><path d="M5 20c1.2-3.6 4-5 7-5s5.8 1.4 7 5"></path>', 'Un seul interlocuteur', 'Je réponds au téléphone, je réalise la visite et je commente le rapport. Aucun sous-traitant, aucun standard.' ),
			array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', 'Des délais tenus', 'Devis sous 24 h, rendez-vous sous 48 h en moyenne, rapport livré dans les 48 h suivant la visite.' ),
			array( '<path d="M20 15a3 3 0 0 1-3 3H8l-4 3V6a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3z"></path><path d="M8 9h8M8 12.5h5"></path>', 'Un rapport expliqué', 'Je reprends chaque point sensible avec vous, par téléphone ou sur place, jusqu’à ce que tout soit clair.' ),
			array( '<path d="M12 3 5 6v5c0 4 3 7 7 8 4-1 7-4 7-8V6z"></path><path d="m9 12 2 2 4-4"></path>', 'Une neutralité totale', 'Aucun lien avec une entreprise de travaux : je constate, je ne vends rien d’autre que le diagnostic.' ),
		),
	),
	'certifications' => array(
		'surtitre'   => 'Certifications',
		'titre'      => 'Certifié, assuré, contrôlé',
		'texte'      => 'Chaque domaine de diagnostic fait l\'objet d\'une certification personnelle délivrée par un organisme accrédité par le Cofrac, renouvelée par examen et contrôlée sur site. J\'y ajoute une assurance responsabilité civile professionnelle spécifique au diagnostic immobilier.',
		'garanties'  => array(
			'Certifications personnelles renouvelées par examen, avec contrôle sur ouvrage en cours de cycle.',
			'Assurance responsabilité civile professionnelle dédiée au diagnostic immobilier.',
			'Matériel de mesure vérifié et étalonné, rapports conformes aux méthodes réglementaires en vigueur.',
		),
		// [ tracés SVG, titre, texte ]
		'domaines'   => array(
			array( '<path d="M12 13 15 9"></path><path d="M4 18a8 8 0 1 1 16 0"></path><circle cx="12" cy="13" r="1.2" fill="currentColor" stroke="none"></circle>', 'DPE', 'Avec mention audit énergétique' ),
			array( '<path d="m12 3 8 4.5-8 4.5-8-4.5z"></path><path d="m4 12.5 8 4.5 8-4.5"></path><path d="m4 17 8 4.5 8-4.5"></path>', 'Amiante', 'Avant-vente, location et travaux' ),
			array( '<path d="M12 3c3 4 6 6.5 6 10a6 6 0 0 1-12 0c0-3.5 3-6 6-10z"></path>', 'Plomb', 'CREP et diagnostic avant travaux' ),
			array( '<path d="M13 2 4 14h7l-1 8 9-12h-7z"></path>', 'Électricité', 'Installations intérieures' ),
			array( '<path d="M12 3c1 3 4 4 4 8a4 4 0 0 1-8 0c0-1.5.6-2.5 1.2-3.2C10 8 11 6 12 3z"></path>', 'Gaz', 'Installations intérieures' ),
			array( '<ellipse cx="12" cy="13" rx="4" ry="5"></ellipse><path d="M12 8V5M8.5 10 6 8M15.5 10 18 8M8 14H5M16 14h3M9 18l-2 2M15 18l2 2"></path>', 'Termites & mérule', 'États parasitaires réglementés' ),
		),
	),
	'etapes'       => array(
		'variante' => 'qui',
		'surtitre' => 'Ma méthode',
		'titre'    => 'Comment se passe une intervention',
		'lien'     => array( 'Voir tous les diagnostics', 'diagnostics' ),
		// [ numéro, titre, texte, étiquette (bureau) ]
		'liste'    => array(
			array( '1', 'Premier échange', 'Type de bien, surface, année de construction, motif : je liste les diagnostics obligatoires dans votre cas.', 'ÉTAPE 01' ),
			array( '2', 'Devis gratuit', 'Un prix ferme sous 24 h, tout compris, sans frais de déplacement caché dans la région.', 'ÉTAPE 02' ),
			array( '3', 'La visite', 'Une à trois heures selon le nombre de diagnostics. Je vous accompagne pièce par pièce si vous êtes présent.', 'ÉTAPE 03' ),
			array( '4', 'Rapport & explications', 'Rapport PDF conforme sous 48 h, suivi d’un appel pour reprendre ensemble les points importants.', 'ÉTAPE 04' ),
		),
	),
	'rappel'       => array(
		'titre'      => 'Parlons de votre bien',
		'texte'      => 'Un appel de cinq minutes suffit à cadrer les diagnostics dont vous avez réellement besoin. Devis gratuit sous 24 heures, rendez-vous sous 48 heures en moyenne.',
		'formulaire' => array( 'Demande de rappel gratuit', array( 'contact', '#devis' ) ),
	),
);
