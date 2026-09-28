<?php
/**
 * Fiche « Électricité », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Électricité',
	'hero'     => array(
		'pastille'      => 'Obligatoire si l\'installation a plus de 15 ans',
		'titre'         => 'État de l\'installation intérieure d\'électricité',
		'accent'        => 'la sécurité, point par point.',
		'chapeau'       => 'L\'installation électrique est l\'une des premières causes d\'incendie domestique. Le diagnostic électricité contrôle l\'ensemble de votre installation intérieure au regard de la sécurité des personnes : protection différentielle, mise à la terre, protection contre les surintensités, matériels vétustes et volumes de sécurité des pièces d\'eau.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration electricite',
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', '+ de 15 ans', 'Installations concernées' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '45 min à 1 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '3 ans / 6 ans', 'Validité vente / location' ),
		array( '<rect x="3" y="4" width="18" height="16" rx="2"></rect><path d="M7 9v6M11 9v6M15 9v6M19 9v6"></path>', '8 domaines', 'Points de contrôle de la norme FD C 16-600' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du contrôle',
			'titre'     => 'Trois familles d\'anomalies',
			'texte'     => 'Le diagnostic ne juge pas la conformité à la norme du neuf, mais la sécurité de l\'existant. Les anomalies relevées se rattachent à trois grandes familles, de la plus structurante à la plus ponctuelle.',
			'cartes'    => array(
				array( '1', 'vert', 'Protection des personnes', 'Dispositif différentiel à l’origine de l’installation, prise de terre et liaisons équipotentielles des pièces d’eau.' ),
				array( '2', 'jaune', 'Protection des circuits', 'Disjoncteurs et fusibles adaptés à la section des conducteurs, absence de surintensité possible.' ),
				array( '3', 'orange', 'Matériels & installations vétustes', 'Anciens matériels, conducteurs non protégés mécaniquement, matériels inadaptés à l’usage ou aux volumes de la salle d’eau.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je contrôle chez vous',
				'texte'    => 'Je vérifie l\'installation depuis le compteur jusqu\'aux points d\'utilisation, sans démontage, avec mesures de continuité et de protection.',
				'cartes'   => array(
					array( '<path d="M9 3v6M15 3v6"></path><path d="M6 9h12v3a6 6 0 0 1-12 0z"></path><path d="M12 18v3"></path>', 'Appareil de commande', 'Disjoncteur de branchement accessible, coupure d’urgence effective.' ),
					array( '<path d="M12 3v9"></path><path d="M6 12h12M8 15h8M10 18h4"></path>', 'Différentiel & terre', 'Dispositif différentiel adapté, prise de terre et continuité des masses.' ),
					array( '<rect x="3" y="4" width="18" height="16" rx="2"></rect><path d="M7 9v6M11 9v6M15 9v6M19 9v6"></path>', 'Tableau & protections', 'Calibres des disjoncteurs, repérage des circuits, état du tableau.' ),
					array( '<path d="M4 4h8a4 4 0 0 1 4 4v2"></path><path d="M12 14v.01M15 17v.01M18 14v.01M9 17v.01"></path><rect x="12" y="9" width="8" height="3" rx="1.5"></rect>', 'Pièces d’eau', 'Respect des volumes de sécurité, liaison équipotentielle de la salle de bains.' ),
					array( '<path d="M13 2 4 14h7l-1 8 9-12h-7z"></path>', 'Matériels vétustes', 'Anciennes prises, interrupteurs cassés, conducteurs sous moulure abîmée.' ),
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Points particuliers', 'Circuits extérieurs, piscine, cave, dépendances et locaux techniques.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel diagnostic électricité dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'Diagnostic valable 3 ans', 'Annexé au dossier de diagnostic technique. Aucun travaux imposé, mais l’acquéreur doit être informé de chaque anomalie.' ),
				array( 'Location', 'jaune', 'Diagnostic valable 6 ans', 'Remis avec le bail. Le logement devant être sûr et décent, les anomalies dangereuses sont à traiter avant l’entrée du locataire.' ),
				array( 'Danger immédiat', 'orange', 'Mise en sécurité sans délai', 'En cas de danger grave et immédiat, je signale le point précis et recommande la mise hors tension du circuit jusqu’à réparation par un électricien.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Des anomalies relevées : et ensuite ?',
			'texte'       => 'Le rapport n\'oblige pas à faire des travaux lors d\'une vente, mais il engage votre information de l\'acquéreur. Trois niveaux de conclusion sont possibles.',
			'cartes'      => array(
				array( '1', 'vert', 'Aucune anomalie', 'L’installation ne présente pas d’anomalie au regard de la sécurité. Le rapport le mentionne explicitement.' ),
				array( '2', 'jaune', 'Anomalies à corriger', 'Anomalies listées et localisées, à faire traiter par un électricien. Leur correction reste libre en cas de vente.' ),
				array( '3', 'orange', 'Danger grave et immédiat', 'Signalement explicite du point dangereux et recommandation de mise hors tension du circuit jusqu’à réparation.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Cadrage par téléphone', 'Type de bien, surface, âge de l’installation : je confirme l’obligation et le prix.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, tout compris. Tarif réduit si le diagnostic est groupé avec le gaz ou le DPE.' ),
			array( '3', 'Le contrôle sur place', 'Vérification des huit domaines réglementaires, mesures de terre et de protection différentielle, photos des anomalies.' ),
			array( '4', 'Rapport & explications', 'Rapport conforme avec anomalies localisées et hiérarchisées, suivi d’un appel pour prioriser les corrections.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces conditions sont indispensables pour que le contrôle soit complet et le rapport exploitable.',
			'liste' => array( 'Une installation sous tension, compteur en service', 'Un accès dégagé au tableau électrique et au disjoncteur de branchement', 'L’attestation de conformité Consuel si l’installation a été refaite', 'Un accès aux caves, garages, dépendances et locaux techniques', 'Le rapport électricité précédent, s’il existe' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'L\'électricité en clair',
		'questions' => array(
			array( 'Quand le diagnostic est-il obligatoire ?', 'Dès que l\'installation intérieure a plus de quinze ans, pour la vente comme pour la mise en location d\'un logement. En l\'absence de justificatif, c\'est l\'âge du bâtiment ou du dernier tableau qui fait foi.', 'Vérifier mes obligations', 'simulateur' ),
			array( 'Combien de temps est-il valable ?', 'Trois ans pour une vente, six ans pour une location. Une installation refaite entre-temps peut être justifiée par une attestation de conformité visée par un organisme agréé.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Suis-je obligé de faire les travaux ?', 'Pas pour vendre : l\'acquéreur achète en connaissance de cause. Pour une location, en revanche, le logement doit être décent et sûr, ce qui impose de traiter les anomalies présentant un danger.', 'Demander un devis', '#rappel' ),
			array( 'Que signifie un danger grave et immédiat ?', 'C\'est le signalement le plus sérieux : conducteur nu accessible, absence de protection sur un circuit, matériel sous tension à découvert. Je vous l\'explique sur place et je recommande une mise hors tension du circuit concerné jusqu\'à réparation.', 'Poser une question sur mon rapport', 'contact' ),
			array( 'Faut-il que l\'électricité soit en service ?', 'Oui, c\'est indispensable. Sans alimentation, les mesures de protection différentielle et de continuité de terre sont impossibles et le rapport reste incomplet.', 'Préparer ma visite', 'contact' ),
			array( 'Contrôlez-vous les appareils et les rallonges ?', 'Non. Le diagnostic porte sur l\'installation fixe, du disjoncteur de branchement aux socles de prises et points lumineux. Les appareils mobiles ne sont pas dans le champ, mais je vous signale ce qui me paraît dangereux.', 'Voir toutes les prestations', 'diagnostics' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec l\'électricité',
		'cartes' => array(
			array( 'gaz', 'Gaz', 'Sécurité de l’installation intérieure de gaz et de la ventilation.' ),
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'plomb', 'Plomb (CREP)', 'Risque d’exposition au plomb dans les peintures d’avant 1949.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Besoin d\'un diagnostic électricité ?',
		'texte' => 'Donnez-moi la surface, le type de bien et le motif : vous recevez un devis gratuit sous 24 heures. Réalisé en même temps que le gaz ou le DPE, il coûte nettement moins cher.',
	),
);
