<?php
/**
 * Fiche « Termites », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Termites',
	'hero'     => array(
		'pastille'      => 'Obligatoire dans les communes visées par un arrêté préfectoral',
		'titre'         => 'État relatif à la présence de termites',
		'accent'        => 'le bois, examiné mètre par mètre.',
		'chapeau'       => 'Les termites souterrains progressent sans signe visible, à l\'abri de la lumière, et peuvent compromettre une charpente en quelques années. Dans les communes couvertes par un arrêté préfectoral, l\'état parasitaire est obligatoire à la vente : j\'examine et sonde l\'ensemble des bois accessibles du bâti et de ses abords.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illustration'  => 'ill_termites_ssfond2.webp',
		'illus_alt'     => 'Illustration termites',
		'illus_tailles' => array( '299px', '264px', '100%' ),
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', 'Zone arrêtée', 'Communes visées par arrêté préfectoral' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '1 à 2 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '6 mois', 'Durée de validité du rapport' ),
		array( '<ellipse cx="12" cy="13" rx="4" ry="5"></ellipse><path d="M12 8V5M8.5 10 6 8M15.5 10 18 8M8 14H5M16 14h3M9 18l-2 2M15 18l2 2"></path>', '10 m', 'Abords inspectés autour du bâti' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du contrôle',
			'titre'     => 'Trois indices qui trahissent une colonie',
			'texte'     => 'Les termites ne se voient presque jamais. Le diagnostic repose sur la recherche d\'indices indirects, à l\'œil et au son, sur chaque élément en bois accessible.',
			'cartes'    => array(
				array( '1', 'vert', 'Cordonnets & galeries-tunnels', 'Des conduits de terre agglomérée le long des murs, des plinthes ou des poutres : la signature la plus fréquente d’un passage de termites.' ),
				array( '2', 'jaune', 'Bois creusé au sondage', 'Un bois qui sonne creux ou cède au poinçon révèle des galeries internes, souvent invisibles en surface.' ),
				array( '3', 'orange', 'Essaimage', 'Ailes abandonnées près des ouvertures, au printemps : signe d’une colonie mature à proximité immédiate.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que j\'examine chez vous',
				'texte'    => 'Je sonde les bois au poinçon et au maillet, sans dégradation, et j\'inspecte les abords immédiats du bâtiment sur une bande de dix mètres.',
				'cartes'   => array(
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Charpente & planchers', 'Pannes, chevrons, solives et lambourdes, sondés un à un.' ),
					array( '<rect x="4" y="4" width="16" height="16" rx="1"></rect><path d="M12 4v16M4 12h16"></path>', 'Plinthes & huisseries', 'Bas de murs, encadrements de portes, seuils et bâtis dormants.' ),
					array( '<rect x="3" y="4" width="18" height="16" rx="1"></rect><path d="M3 12h18M9 4v16M15 4v16"></path>', 'Sols & lambris', 'Parquets, sous-couches, lambris et coffrages en bois.' ),
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Caves & vides sanitaires', 'Zones humides et non ventilées, terrain d’élection des colonies.' ),
					array( '<path d="M20 4C10 4 4 9 4 16c0 2 .6 3.4.6 3.4C8 12 13 9 20 8.5z"></path><path d="M4.6 19.4C8 16 12 14 17 13"></path>', 'Abords du bâtiment', 'Souches, clôtures, tas de bois et arbres dans un rayon de dix mètres.' ),
					array( '<path d="M12 3c3 4 6 6.5 6 10a6 6 0 0 1-12 0c0-3.5 3-6 6-10z"></path>', 'Points d’humidité', 'Fuites, remontées capillaires et infiltrations qui favorisent l’infestation.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel état parasitaire dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'État parasitaire valable 6 mois', 'Obligatoire dans les communes couvertes par un arrêté préfectoral, annexé au dossier de diagnostic technique.' ),
				array( 'Découverte', 'jaune', 'Déclaration en mairie', 'Toute présence de termites constatée dans un immeuble doit être déclarée en mairie par le propriétaire ou l’occupant.' ),
				array( 'Travaux & démolition', 'orange', 'Bois contaminés encadrés', 'Les bois infestés déposés doivent être incinérés sur place ou traités avant transport, avec déclaration de l’opération.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Des indices relevés : et ensuite ?',
			'texte'       => 'Le rapport conclut sur la présence ou l\'absence d\'indices, et distingue une infestation ancienne d\'une colonie encore active.',
			'cartes'      => array(
				array( '1', 'vert', 'Aucun indice relevé', 'Le rapport conclut à l’absence d’indices d’infestation sur les éléments accessibles, avec les réserves éventuelles.' ),
				array( '2', 'jaune', 'Indices d’infestation ancienne', 'Traces de passage sans colonie active constatée. Une surveillance et un traitement préventif sont recommandés.' ),
				array( '3', 'orange', 'Infestation active', 'Déclaration en mairie et traitement par une entreprise spécialisée. Le rapport localise précisément les zones atteintes.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Vérification de la zone', 'Je contrôle l’arrêté préfectoral applicable à votre commune et confirme l’obligation.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, tout compris. Tarif réduit si l’état parasitaire est groupé avec les autres diagnostics de vente.' ),
			array( '3', 'L’examen sur place', 'Sondage des bois accessibles, inspection des abords sur dix mètres, photos et croquis de localisation.' ),
			array( '4', 'Rapport & explications', 'Rapport conforme avec les indices relevés, leurs zones et les réserves, suivi d’un appel pour la suite à donner.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces conditions permettent d\'examiner tous les bois du bâti sans revenir une seconde fois.',
			'liste' => array( 'Un accès dégagé aux combles, caves et vides sanitaires', 'Les murs et plinthes libérés des meubles lourds si possible', 'Les rapports de traitement antérieurs et leurs garanties', 'Un accès au terrain et aux dépendances autour du bâti', 'La localisation des points d’humidité connus' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'Les termites en clair',
		'questions' => array(
			array( 'Ma commune est-elle concernée ?', 'L\'obligation dépend d\'un arrêté préfectoral qui délimite les zones contaminées ou susceptibles de l\'être. Donnez-moi votre commune au téléphone : je vérifie l\'arrêté en vigueur avant de vous établir un devis.', 'Vérifier ma commune', 'contact' ),
			array( 'Quelle est la durée de validité ?', 'Six mois. C\'est le diagnostic le plus court du dossier, avec l\'état des risques : il faut donc le positionner au bon moment dans le calendrier de la vente.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Que faire si des termites sont trouvés ?', 'Deux obligations : déclarer la présence en mairie, et faire traiter par une entreprise spécialisée. La vente reste possible, mais l\'acquéreur doit être informé et négociera généralement sur le coût du traitement.', 'Être conseillé sur le traitement', 'contact' ),
			array( 'Le diagnostic couvre-t-il les autres insectes ?', 'L\'état parasitaire réglementaire porte sur les termites. Je signale néanmoins dans le rapport les indices de capricornes, vrillettes ou lyctus que je rencontre : ce sont des informations utiles pour l\'acquéreur.', 'La recherche de mérule', 'merule' ),
			array( 'Faut-il vider les placards et les combles ?', 'Idéalement, oui. Je ne peux examiner que ce qui est accessible : un mur masqué par des meubles lourds ou des combles encombrés font l\'objet d\'une réserve explicite dans le rapport.', 'Préparer ma visite', 'contact' ),
			array( 'Et après une démolition ?', 'Les bois contaminés déposés lors de travaux doivent être incinérés sur place ou traités avant transport, et l\'opération déclarée en mairie. Je vous indique la procédure applicable dans votre commune.', 'Repérages avant travaux', 'pros' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec l\'état parasitaire',
		'cartes' => array(
			array( 'merule', 'ill_merule_ssfond.webp', 'scaleX(-1) scale(0.95, 0.95)', 'Mérule', 'Recherche de ce champignon lignivore en zone déclarée.' ),
			array( 'dpe', 'ill_dpe_ssfond-eb37ee46.webp', 'none', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'ill_amiante_ssfond.webp', 'scaleX(-1)', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'erp', 'ill_erp_ssfond.webp', 'scaleX(-1) scale(0.9775, 1.0925)', 'ERP', 'Risques naturels, miniers et technologiques de la commune.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Besoin d\'un état parasitaire ?',
		'texte' => 'Donnez-moi la commune, le type de bien et sa surface : je vérifie l\'arrêté préfectoral applicable et vous envoie un devis gratuit sous 24 heures.',
	),
);
