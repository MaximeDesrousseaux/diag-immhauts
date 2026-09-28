<?php
/**
 * Fiche « Amiante », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Amiante',
	'hero'     => array(
		'pastille'      => 'Obligatoire pour tout bien construit avant juillet 1997',
		'titre'         => 'Diagnostic amiante',
		'accent'        => 'repérer avant d\'exposer.',
		'chapeau'       => 'L\'amiante a été utilisé dans des centaines de produits du bâtiment jusqu\'à son interdiction en 1997 : dalles de sol, colles, conduits, toitures, enduits. Le repérage identifie ces matériaux, évalue leur état de conservation et détermine ce que vous devez surveiller, faire retirer ou déclarer avant travaux.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration amiante',
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', 'Avant 07/1997', 'Permis de construire concerné' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '1 à 3 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', 'Illimitée', 'Validité d’un repérage négatif' ),
		array( '<path d="M9 3h6M10 3v6l-5 9a2 2 0 0 0 1.8 3h10.4a2 2 0 0 0 1.8-3l-5-9V3"></path><path d="M7.5 15h9"></path>', '3 à 5 jours', 'Analyse en laboratoire accrédité' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du repérage',
			'titre'     => 'Trois listes, trois niveaux d\'accès',
			'texte'     => 'La réglementation classe les matériaux susceptibles de contenir de l\'amiante en trois listes. Le repérage avant-vente couvre les listes A et B ; la liste C, plus invasive, relève du repérage avant travaux ou démolition.',
			'cartes'    => array(
				array( 'A', 'vert', 'Flocages, calorifugeages, faux plafonds', 'Les matériaux les plus friables, donc les plus émissifs. Leur état de conservation est évalué selon une grille réglementaire.' ),
				array( 'B', 'jaune', 'Produits en place non friables', 'Dalles de sol, colles, conduits, toitures et bardages en fibres-ciment, enduits, joints. C’est la catégorie la plus fréquente dans l’habitat.' ),
				array( 'C', 'orange', 'Matériaux atteints par les travaux', 'Repérage avant travaux ou démolition, avec sondages destructifs : il couvre tout ce que le chantier va découper, percer ou déposer.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je recherche chez vous',
				'texte'    => 'J\'inspecte les matériaux visibles et accessibles, pièce par pièce, sans dégradation. En cas de doute, je réalise un prélèvement analysé par un laboratoire accrédité.',
				'cartes'   => array(
					array( '<rect x="3" y="4" width="18" height="16" rx="1"></rect><path d="M3 12h18M9 4v16M15 4v16"></path>', 'Sols & revêtements', 'Dalles vinyle-amiante, colles de carrelage, linoléums et sous-couches.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Toitures & bardages', 'Plaques fibres-ciment, ardoises, gouttières et descentes d’eau.' ),
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Conduits & réseaux', 'Conduits de fumée, gaines de ventilation, canalisations en amiante-ciment.' ),
					array( '<rect x="3" y="5" width="18" height="14" rx="1"></rect><path d="M3 12h18M9 5v7M15 12v7"></path>', 'Murs & plafonds', 'Enduits, projections, plaques de doublage et faux plafonds.' ),
					array( '<path d="M12 3c1 3 4 4 4 8a4 4 0 0 1-8 0c0-1.5.6-2.5 1.2-3.2C10 8 11 6 12 3z"></path>', 'Chauffage & calorifuge', 'Isolants de chaudière, joints de portes de foyer, tresses et calorifugeages.' ),
					array( '<path d="m12 3 8 4.5-8 4.5-8-4.5z"></path><path d="m4 12.5 8 4.5 8-4.5"></path><path d="m4 17 8 4.5 8-4.5"></path>', 'Points singuliers', 'Joints, mastics de vitrage, plinthes et passages de câbles.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel repérage amiante dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'Repérage amiante avant-vente', 'Listes A et B, annexé au dossier de diagnostic technique. Sans lui, vous restez exposé à la garantie des vices cachés.' ),
				array( 'Location & parties communes', 'jaune', 'DAPP et dossier technique amiante', 'Le propriétaire constitue un dossier amiante des parties privatives, tenu à disposition du locataire. En copropriété, le syndic gère le DTA des parties communes.' ),
				array( 'Travaux & démolition', 'orange', 'Repérage avant travaux (RAT)', 'Obligatoire avant toute rénovation ou démolition, liste C incluse. Il protège juridiquement le donneur d’ordre et les intervenants du chantier.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'cartes',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Amiante détecté : et ensuite ?',
			'texte'       => 'Un matériau amianté en bon état n\'impose pas de travaux. C\'est son état de conservation qui commande la suite, selon trois scores définis par la réglementation.',
			'cartes'      => array(
				array( '1', 'vert', 'Bon état de conservation', 'Évaluation périodique de l’état du matériau tous les trois ans. Aucun travaux imposé.' ),
				array( '2', 'jaune', 'État intermédiaire', 'Mesure d’empoussièrement dans l’air par un organisme accrédité, dans un délai de trois mois.' ),
				array( '3', 'orange', 'Matériau dégradé', 'Travaux de retrait ou de confinement à engager, par une entreprise certifiée, dans un délai réglementé.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Cadrage par téléphone', 'Année de construction, surface, motif : je détermine le type de repérage exact dont vous avez besoin.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, prélèvements et analyses de laboratoire compris. Aucun supplément de déplacement dans la région.' ),
			array( '3', 'Le repérage sur place', 'Inspection pièce par pièce des matériaux accessibles, photos, croquis de localisation et prélèvements si nécessaire.' ),
			array( '4', 'Rapport & explications', 'Rapport conforme avec localisation, état de conservation et préconisations, suivi d’un appel pour tout reprendre avec vous.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces éléments accélèrent le repérage et limitent le nombre de prélèvements nécessaires.',
			'liste' => array( 'Le permis de construire ou l’année exacte de construction', 'Les rapports amiante et plans existants, même anciens', 'Un accès dégagé aux combles, caves, garages et locaux techniques', 'Les factures de rénovation (sols, toiture, chauffage)', 'La liste des travaux envisagés, s’il s’agit d’un repérage avant travaux' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'L\'amiante en clair',
		'questions' => array(
			array( 'Mon bien date de 1998, suis-je concerné ?', 'Non. L’obligation vise les biens dont le permis de construire a été délivré avant le 1er juillet 1997. Au-delà, aucun repérage amiante n’est exigé pour la vente.', 'Vérifier les diagnostics de mon bien', 'simulateur' ),
			array( 'Le diagnostic amiante a-t-il une durée de validité ?', 'Un repérage négatif réalisé selon la réglementation actuelle est valable sans limite de durée. En revanche, un rapport positif impose un contrôle de l’état de conservation tous les trois ans, et les rapports antérieurs à 2013 doivent souvent être refaits.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Faut-il faire des prélèvements ?', 'Uniquement en cas de doute sur un matériau. Le prélèvement est réalisé sur place, en protégeant la zone, puis analysé par un laboratoire accrédité Cofrac. Le résultat arrive sous 3 à 5 jours ouvrés.', 'Demander un devis amiante', '#rappel' ),
			array( 'Que se passe-t-il si de l’amiante est trouvé ?', 'Rien d’automatique. S’il est en bon état et non dégradé, il suffit de le surveiller. Ce sont l’état de conservation et les travaux envisagés qui déclenchent des mesures : contrôle périodique, mesure d’empoussièrement ou retrait par une entreprise qualifiée.', 'Poser ma question sur mon rapport', 'contact' ),
			array( 'Puis-je vendre sans diagnostic amiante ?', 'Non. En son absence, vous ne pouvez pas vous exonérer de la garantie des vices cachés : l’acquéreur peut demander une réduction du prix ou l’annulation de la vente, même des années plus tard.', 'Le dossier de diagnostic technique', 'diagnostics' ),
			array( 'Amiante avant travaux, est-ce la même chose ?', 'Non, c’est un repérage distinct et plus poussé (liste C), obligatoire avant toute rénovation ou démolition. Il peut nécessiter des sondages destructifs et conditionne le mode opératoire de l’entreprise de travaux.', 'Repérages avant travaux & copropriétés', 'pros' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec l\'amiante',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'plomb', 'Plomb (CREP)', 'Risque d’exposition au plomb dans les peintures d’avant 1949.' ),
			array( 'electricite', 'Électricité', 'Sécurité de l’installation intérieure de plus de 15 ans.' ),
			array( 'termites', 'Termites', 'Recherche de termites dans les communes sous arrêté.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Besoin d\'un repérage amiante ?',
		'texte' => 'Dites-moi l\'année de construction, la surface et le motif (vente, location, travaux) : vous recevez un devis gratuit sous 24 heures, prélèvements et analyses inclus.',
	),
);
