<?php
/**
 * Fiche « Mérule », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Mérule',
	'hero'     => array(
		'pastille'      => 'Information obligatoire dans les zones délimitées par arrêté',
		'titre'         => 'Diagnostic mérule',
		'accent'        => 'le champignon qui dévore le bois.',
		'chapeau'       => 'La mérule se développe dans l\'obscurité, à l\'abri des regards, et peut détruire une charpente ou un plancher en quelques mois. Dans les zones délimitées par arrêté préfectoral, le vendeur doit informer l\'acquéreur ; partout ailleurs, la recherche reste le seul moyen de lever le doute avant de signer.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illustration'  => 'ill_merule_ssfond.webp',
		'illus_alt'     => 'Illustration merule',
		'illus_tailles' => array( '299px', '264px', '100%' ),
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', 'Zone arrêtée', 'Information obligatoire du vendeur' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '1 à 2 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '6 mois*', 'Usage professionnel, aucune durée réglementaire' ),
		array( '<path d="M12 3c3 4 6 6.5 6 10a6 6 0 0 1-12 0c0-3.5 3-6 6-10z"></path>', '20 %', 'Taux d’humidité du bois au-delà duquel le risque apparaît' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre de la recherche',
			'titre'     => 'Trois conditions qui la font naître',
			'texte'     => 'La mérule a besoin de trois choses réunies. Là où elles se rencontrent — cave humide, mur enterré, plancher sur vide sanitaire — la recherche est justifiée même hors zone.',
			'cartes'    => array(
				array( '1', 'vert', 'Humidité persistante', 'Fuite, infiltration, remontée capillaire ou condensation durable : sans eau, pas de mérule.' ),
				array( '2', 'jaune', 'Absence de ventilation', 'Cave fermée, vide sanitaire borgne, pièce inoccupée : l’air stagnant est sa condition idéale.' ),
				array( '3', 'orange', 'Bois & obscurité', 'Un support cellulosique dans le noir — solive, plancher, coffrage — et la colonisation démarre.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je recherche chez vous',
				'texte'    => 'J\'inspecte les zones sombres et humides, sonde les bois et relève les taux d\'humidité des parois, sans dégradation.',
				'cartes'   => array(
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Caves & vides sanitaires', 'Les foyers les plus fréquents : sol en terre, murs enterrés, aucune ventilation.' ),
					array( '<rect x="3" y="4" width="18" height="16" rx="1"></rect><path d="M3 12h18M9 4v16M15 4v16"></path>', 'Planchers bas', 'Solives d’about, lambourdes et parquets au contact des murs humides.' ),
					array( '<rect x="3" y="5" width="18" height="14" rx="1"></rect><path d="M3 12h18M9 5v7M15 12v7"></path>', 'Murs & maçonneries', 'Filaments et cordons sur les enduits, derrière les plinthes et les doublages.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Charpente & combles', 'Zones de fuite en toiture, pieds de fermes et abouts de pannes.' ),
					array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 12 15.5 9"></path><path d="M12 6v1M18 12h-1M6 12h1"></path>', 'Taux d’humidité', 'Mesures d’humidité des bois et des parois aux points sensibles.' ),
					array( '<path d="M12 3c3 4 6 6.5 6 10a6 6 0 0 1-12 0c0-3.5 3-6 6-10z"></path>', 'Origine de l’eau', 'Recherche de la cause : sans elle, aucun traitement ne tient dans le temps.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quelle obligation dans votre situation ?',
			'cartes'   => array(
				array( 'Zone délimitée', 'vert', 'Information de l’acquéreur', 'Dans un secteur visé par arrêté préfectoral, le vendeur doit informer l’acquéreur du risque de mérule.' ),
				array( 'Constat de présence', 'jaune', 'Déclaration en mairie', 'La présence de mérule constatée dans un immeuble doit être signalée à la mairie par le propriétaire ou l’occupant.' ),
				array( 'Hors zone', 'orange', 'Recherche recommandée', 'Aucune obligation, mais un bâti ancien humide justifie une recherche : la découverte après vente se règle souvent au tribunal.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Mérule détectée : et ensuite ?',
			'texte'       => 'Un foyer actif se traite en profondeur : il ne suffit pas de retirer le bois atteint, il faut supprimer la source d\'humidité.',
			'cartes'      => array(
				array( '1', 'vert', 'Aucun indice', 'Absence d’indice de mérule sur les parties accessibles, avec les réserves du rapport.' ),
				array( '2', 'jaune', 'Conditions favorables', 'Pas de champignon constaté, mais une humidité et une ventilation qui appellent des travaux préventifs.' ),
				array( '3', 'orange', 'Foyer actif', 'Traitement par une entreprise spécialisée : suppression de la source d’eau, dépose des bois atteints et traitement fongicide.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Premier échange', 'Vos observations, l’âge du bâti et la commune : je vérifie l’arrêté applicable et l’urgence réelle.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, tout compris, groupable avec l’état parasitaire termites.' ),
			array( '3', 'La recherche sur place', 'Inspection des zones à risque, sondage des bois, mesures d’humidité, photos et localisation.' ),
			array( '4', 'Rapport & explications', 'Rapport avec les indices, leur étendue et l’origine probable de l’humidité, suivi d’un appel.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces conditions sont indispensables pour examiner les zones où la mérule se développe réellement.',
			'liste' => array( 'Un accès aux caves, vides sanitaires et combles', 'La localisation des fuites et infiltrations connues', 'Les plinthes et doublages dégagés dans les zones suspectes', 'L’historique des dégâts des eaux et des sinistres', 'Les rapports et traitements antérieurs' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'La mérule en clair',
		'questions' => array(
			array( 'La recherche de mérule est-elle obligatoire ?', 'L\'obligation porte sur l\'information : dans une zone délimitée par arrêté préfectoral, le vendeur doit signaler le risque à l\'acquéreur. La recherche elle-même n\'est pas imposée, mais elle est la seule façon de savoir.', 'Vérifier mes obligations', 'simulateur' ),
			array( 'Comment reconnaître une mérule ?', 'Trois signes : une odeur de champignon persistante, des filaments blancs cotonneux sur les maçonneries, et un bois qui se déforme en cubes et s\'effrite. À un stade avancé, une plaque brun-rouille à bord blanc apparaît.', 'Décrire ce que j\'ai observé', 'contact' ),
			array( 'Quelle est la durée de validité ?', 'Six mois, comme les autres états parasitaires. Un rapport plus ancien ne dit rien de l\'état actuel : la mérule progresse vite.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Que coûte un traitement ?', 'Cela dépend de l\'étendue et de la cause. Le traitement combine toujours la suppression de la source d\'humidité, la dépose des bois atteints et un traitement fongicide des maçonneries. C\'est un chantier, pas une intervention ponctuelle.', 'Demander un devis', '#rappel' ),
			array( 'Faut-il déclarer une présence de mérule ?', 'Oui. L\'occupant ou le propriétaire qui constate la présence de mérule dans un immeuble doit en informer la mairie, laquelle tient un registre des signalements.', 'L\'état parasitaire termites', 'termites' ),
			array( 'La mérule est-elle un vice caché ?', 'Elle peut l\'être si le vendeur la connaissait et ne l\'a pas signalée. Un rapport de recherche annexé à la vente protège les deux parties : il date précisément l\'état du bien.', 'Le dossier de diagnostic technique', 'diagnostics' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec la mérule',
		'cartes' => array(
			array( 'termites', 'ill_termites_ssfond2.webp', 'scaleX(-1) scale(0.95, 0.95)', 'Termites', 'Recherche de termites dans les communes sous arrêté.' ),
			array( 'dpe', 'ill_dpe_ssfond-eb37ee46.webp', 'none', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'ill_amiante_ssfond.webp', 'scaleX(-1)', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'erp', 'ill_erp_ssfond.webp', 'scaleX(-1) scale(0.9775, 1.0925)', 'ERP', 'Risques naturels, miniers et technologiques de la commune.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Un doute sur la mérule ?',
		'texte' => 'Décrivez-moi ce que vous observez — odeur de champignon, bois qui gonfle, filaments blancs : je vous dis au téléphone s\'il faut intervenir, et un devis gratuit suit sous 24 heures.',
	),
);
