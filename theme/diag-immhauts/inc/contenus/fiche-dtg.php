<?php
/**
 * Fiche « DTG & DPE collectif », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'DTG & DPE collectif',
	'hero'     => array(
		'pastille'      => 'Copropriétés au permis déposé avant 2013',
		'titre'         => 'DTG & DPE collectif',
		'accent'        => 'l\'immeuble vu comme un tout.',
		'chapeau'       => 'Le DPE collectif classe l\'immeuble entier de A à G. Le diagnostic technique global va plus loin : état du bâti, travaux à prévoir et budget projeté sur dix ans. Deux outils qui transforment une assemblée générale en décision étayée.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illustration'  => 'ill_nosdiags_immeuble.webp',
		'illus_alt'     => 'Immeuble en copropriété et dossier de diagnostics',
		'illus_tailles' => array( '440px', '92%', '150%' ),
		'halo'          => 'lumineux',
	),
	'reperes'  => array(
		array( '<rect x="4" y="3" width="16" height="18" rx="1"></rect><path d="M8 7h2M14 7h2M8 11h2M14 11h2M8 15h2M14 15h2M10 21v-3h4v3"></path>', 'Toutes les copros', 'D’habitation concernées par le DPE collectif' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '10 ans', 'Validité du DPE collectif' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M15 9a4 4 0 1 0 0 6M8 11h5M8 13h5"></path>', 'Budget projeté', 'Chiffrage des travaux sur 10 ans au DTG' ),
		array( '<circle cx="9" cy="8" r="3"></circle><path d="M3 20a6 6 0 0 1 12 0"></path><path d="M16 6a3 3 0 0 1 0 6M17 20a6 6 0 0 0-2-4.3"></path>', 'Lisible en AG', 'Rapport pensé pour le conseil syndical' ),
	),
	'sessions' => array(
		array(
			'type'        => 'cadre',
			'disposition' => 'colonnes',
			'intro'       => 'grande',
			'surtitre'    => 'Le cadre',
			'titre'       => 'Trois missions à ne pas confondre',
			'texte'       => 'DPE collectif, DTG et projet de plan pluriannuel de travaux répondent à des obligations différentes — mais s\'articulent : le premier mesure, le deuxième diagnostique, le troisième planifie et chiffre.',
			'badge'       => 'sigle',
			'cartes'      => array(
				array( 'DPE', 'vert', 'DPE collectif', 'Une étiquette énergie et une étiquette climat pour l’immeuble entier, assorties de recommandations de travaux. Obligatoire pour toutes les copropriétés d’habitation.' ),
				array( 'DTG', 'jaune', 'Diagnostic technique global', 'État apparent des parties communes et des équipements, situation au regard des obligations légales, et estimation des travaux nécessaires sur dix ans.' ),
				array( 'PPT', 'orange', 'Projet de plan pluriannuel de travaux', 'Hiérarchisation et chiffrage des travaux sur dix ans, obligatoire pour les copropriétés de plus de quinze ans. Il alimente le fonds de travaux.' ),
			),
			'sur_place'   => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que j\'examine dans l\'immeuble',
				'texte'    => 'La visite couvre les parties communes, l\'enveloppe et les équipements collectifs, avec un échantillon de logements représentatif du bâti.',
				'cartes'   => array(
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Enveloppe & toiture', 'Façades, couverture, étanchéité, isolation rapportée et ponts thermiques.' ),
					array( '<rect x="4" y="4" width="16" height="16" rx="1"></rect><path d="M12 4v16M4 12h16"></path>', 'Menuiseries communes', 'Vitrages, châssis, portes palières et fermetures des parties communes.' ),
					array( '<path d="M12 3c1 3 4 4 4 8a4 4 0 0 1-8 0c0-1.5.6-2.5 1.2-3.2C10 8 11 6 12 3z"></path>', 'Chauffage collectif', 'Chaufferie, réseau de distribution, régulation, comptage et production d’eau chaude.' ),
					array( '<circle cx="12" cy="12" r="2"></circle><path d="M12 10V4a4 4 0 0 1 0 6M14 12h6a4 4 0 0 1-6 0M12 14v6a4 4 0 0 1 0-6M10 12H4a4 4 0 0 1 6 0"></path>', 'Ventilation', 'VMC collective, gaines, entrées d’air et état d’entretien du réseau.' ),
					array( '<path d="M4 20h4v-4h4v-4h4V8h4"></path><path d="M4 20V4"></path>', 'Parties communes', 'Cages d’escalier, caves, parkings, ascenseur et sécurité incendie.' ),
					array( '<rect x="4" y="3" width="16" height="18" rx="1"></rect><path d="M8 7h2M14 7h2M8 11h2M14 11h2M8 15h2M14 15h2M10 21v-3h4v3"></path>', 'Échantillon de logements', 'Quelques lots représentatifs, choisis avec le conseil syndical, pour caler le modèle.' ),
				),
				'grille'   => 'auto',
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Le calendrier, selon la taille de votre copropriété',
			'texte'    => 'Le DPE collectif s\'est déployé par vagues depuis 2024. Depuis le 1er janvier 2026, plus aucune copropriété d\'habitation n\'y échappe.',
			'cartes'   => array(
				array( 'Plus de 200 lots', 'vert', 'Depuis le 1er janvier 2024', 'Les grandes copropriétés d’habitation devaient disposer d’un DPE collectif à cette date, renouvelé tous les dix ans.' ),
				array( '51 à 200 lots', 'jaune', 'Depuis le 1er janvier 2025', 'Deuxième vague du calendrier. Le DPE collectif doit être présenté à l’assemblée générale suivant sa réalisation.' ),
				array( '50 lots et moins', 'orange', 'Depuis le 1er janvier 2026', 'Dernière échéance : les petites copropriétés d’habitation dont le permis de construire a été déposé avant le 1er janvier 2013 sont soumises à l’obligation.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'grille',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Ce que le conseil syndical reçoit',
			'texte'       => 'Un rapport lisible en assemblée générale, pas un document d\'expert réservé aux experts.',
			'cartes'      => array(
				array( '1', 'vert', 'Les deux étiquettes', 'Classes énergie et climat de l’immeuble, avec le détail des consommations par poste.' ),
				array( '2', 'jaune', 'L’état du bâti', 'Constat par lot technique, désordres relevés, photos et niveau d’urgence associé.' ),
				array( '3', 'orange', 'Le chiffrage', 'Scénarios de travaux hiérarchisés et estimation budgétaire projetée sur dix ans.' ),
			),
			'preparation' => array(
				'titre' => 'À réunir avant ma visite',
				'texte' => 'Ces pièces, généralement détenues par le syndic, évitent les valeurs par défaut et accélèrent le rapport.',
				'liste' => array( 'Le règlement de copropriété et l’état descriptif de division', 'Les plans de l’immeuble et les permis de construire', 'Les carnets d’entretien et contrats de maintenance', 'Les factures d’énergie des trois dernières années', 'Les derniers diagnostics : DTA, amiante, ascenseur, gaz', 'Les procès-verbaux d’AG mentionnant des travaux' ),
				'style' => 'large',
			),
		),
	),
	'etapes'   => array(
		'variante' => 'standard',
		'surtitre' => 'Comment ça se passe',
		'titre'    => 'Du vote en AG au rapport, en 4 étapes',
		'liste'    => array(
			array( '1', 'Devis présenté en AG', 'Je fournis un devis détaillé et une note explicative que le syndic joint à la convocation.' ),
			array( '2', 'Collecte des pièces', 'Le syndic me transmet les documents de l’immeuble ; je prépare la visite avec le conseil syndical.' ),
			array( '3', 'La visite technique', 'Une demi-journée à deux jours sur place selon la taille, parties communes et lots témoins.' ),
			array( '4', 'Rapport et restitution', 'Rapport remis sous une à trois semaines, avec une synthèse présentable en assemblée générale.' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'La copropriété en clair',
		'questions' => array(
			array( 'Le DPE collectif dispense-t-il du DPE individuel ?', 'Non pour une vente ou une location : chaque lot garde besoin de son propre DPE. En revanche, un DPE collectif récent et détaillé peut servir de base à des DPE individuels dits « à l\'immeuble », moins coûteux, sous conditions.', 'Le DPE individuel', 'dpe' ),
			array( 'Qui vote et qui paie ?', 'La réalisation est votée en assemblée générale à la majorité simple et financée par le budget de la copropriété, réparti selon les tantièmes. Le devis est présenté en résolution avec les autres devis mis en concurrence.', 'Demander un devis pour l\'AG', 'contact' ),
			array( 'Le DTG est-il obligatoire pour toutes les copropriétés ?', 'Non. Il l\'est pour tout immeuble de plus de dix ans mis en copropriété, et lorsque l\'administration l\'exige dans le cadre d\'une procédure d\'insalubrité. Ailleurs, il reste facultatif — mais la question de sa réalisation doit être inscrite à l\'ordre du jour d\'une AG.', 'Vérifier les obligations de la copropriété', 'simulateur' ),
			array( 'Quelle différence entre DTG et plan pluriannuel de travaux ?', 'Le DTG dresse l\'état du bâti et propose une liste de travaux avec une estimation sur dix ans. Le PPT, lui, est l\'outil de programmation obligatoire des copropriétés de plus de quinze ans : il hiérarchise les travaux et alimente le fonds de travaux. Un DTG de moins de dix ans peut en tenir lieu s\'il contient le plan.', 'Accompagnement des syndics', 'pros' ),
			array( 'Combien de temps dure l\'intervention ?', 'Comptez une demi-journée pour un petit immeuble, une à deux journées au-delà de cinquante lots, avec un échantillon de logements visités. Le rapport suit sous une à trois semaines selon la mission.', 'Planifier l\'intervention', '#rappel' ),
			array( 'Faut-il refaire le DPE collectif tous les dix ans ?', 'Oui, sa durée de validité est de dix ans, comme celle d\'un DPE individuel. Une exception : un DPE collectif postérieur au 1er juillet 2021 qui classe l\'immeuble en A, B ou C n\'a pas à être renouvelé. Dans tous les cas, il doit être mis à jour avant terme si des travaux modifient significativement la performance de l\'immeuble.', 'Toutes les durées de validité', 'diagnostics' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés en copropriété',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'electricite', 'Électricité', 'Sécurité de l’installation intérieure de plus de 15 ans.' ),
			array( 'plomb', 'Plomb (CREP)', 'Risque d’exposition au plomb dans les peintures d’avant 1949.' ),
		),
	),
	'rappel'   => array(
		'formulaire' => array( 'Offre syndics & bailleurs', 'pros' ),
		'titre' => 'Un devis pour votre copropriété',
		'texte' => 'Donnez-moi l\'adresse, le nombre de lots et l\'année de construction : vous recevez sous 24 heures un devis prêt à être présenté en assemblée générale, avec le détail des missions.',
	),
);
