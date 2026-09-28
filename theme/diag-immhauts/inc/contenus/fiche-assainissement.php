<?php
/**
 * Fiche « Assainissement », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Assainissement',
	'hero'     => array(
		'pastille'      => 'Obligatoire à la vente d\'un bien non raccordé au tout-à-l\'égout',
		'titre'         => 'Contrôle d\'assainissement non collectif',
		'accent'        => 'de la fosse à l\'épandage.',
		'chapeau'       => 'Un bien non raccordé au réseau collectif dispose de sa propre filière de traitement des eaux usées. Le contrôle en vérifie l\'existence, l\'état et le bon fonctionnement : c\'est le SPANC qui le réalise, et son rapport, valable trois ans, doit être annexé à la vente.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration assainissement',
	),
	'reperes'  => array(
		array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Non raccordé', 'Biens concernés par le contrôle' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '1 h environ', 'Durée de ma visite de cadrage' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '3 ans', 'Validité du rapport du SPANC' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path><path d="M9 13h6M9 17h4"></path>', '1 an', 'Délai de travaux après la vente' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du contrôle',
			'titre'     => 'Trois éléments d\'une filière complète',
			'texte'     => 'Une installation individuelle conforme se compose toujours d\'un prétraitement, d\'un traitement et d\'une évacuation. C\'est la chaîne complète qui est évaluée, pas la seule fosse.',
			'cartes'    => array(
				array( '1', 'vert', 'Prétraitement', 'Fosse toutes eaux ou fosse septique, bac dégraisseur et ventilation : c’est là que les matières décantent.' ),
				array( '2', 'jaune', 'Traitement', 'Épandage souterrain, filtre à sable, tertre ou micro-station : le sol ou le média finit l’épuration.' ),
				array( '3', 'orange', 'Évacuation', 'Infiltration dans le sol ou rejet autorisé. Un rejet direct au fossé ou au ruisseau est une non-conformité majeure.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je vérifie avant le passage du SPANC',
				'texte'    => 'Je localise les ouvrages, contrôle leur accessibilité et leur état, et vérifie l\'absence de rejet direct au milieu naturel.',
				'cartes'   => array(
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Fosse & regards', 'Volume, état des parois, niveau de boues et accessibilité des tampons.' ),
					array( '<circle cx="12" cy="12" r="2"></circle><path d="M12 10V4a4 4 0 0 1 0 6M14 12h6a4 4 0 0 1-6 0M12 14v6a4 4 0 0 1 0-6M10 12H4a4 4 0 0 1 6 0"></path>', 'Ventilation', 'Présence et hauteur des extracteurs, absence de nuisances olfactives.' ),
					array( '<rect x="3" y="4" width="18" height="16" rx="1"></rect><path d="M3 12h18M9 4v16M15 4v16"></path>', 'Dispositif de traitement', 'Épandage, filtre à sable ou micro-station : dimensionnement et état.' ),
					array( '<path d="M12 3c3 4 6 6.5 6 10a6 6 0 0 1-12 0c0-3.5 3-6 6-10z"></path>', 'Évacuation des eaux', 'Absence de rejet direct au milieu naturel, exutoire autorisé.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Eaux pluviales', 'Séparation des réseaux : les eaux de pluie ne doivent pas surcharger la filière.' ),
					array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', 'Entretien', 'Bordereaux de vidange, contrat d’entretien et historique des interventions.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel contrôle dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'Rapport de moins de 3 ans', 'Le contrôle du SPANC est annexé au dossier de diagnostic technique pour tout bien non raccordé.' ),
				array( 'Zone raccordable', 'jaune', 'Raccordement sous 2 ans', 'Si le réseau collectif dessert la rue, la commune peut imposer le raccordement dans un délai de deux ans.' ),
				array( 'Non-conformité', 'orange', 'Travaux sous 1 an', 'À la vente, l’acquéreur dispose d’un an pour réaliser les travaux de mise en conformité, sauf accord entre les parties.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Une non-conformité relevée : et ensuite ?',
			'texte'       => 'La gravité de la non-conformité détermine le délai de mise aux normes — et, à la vente, la charge des travaux.',
			'cartes'      => array(
				array( '1', 'vert', 'Installation conforme', 'Aucun travaux. Un entretien régulier et une vidange périodique suffisent.' ),
				array( '2', 'jaune', 'Défauts d’entretien ou d’usure', 'Travaux d’amélioration recommandés, sans urgence sanitaire. Le rapport les liste précisément.' ),
				array( '3', 'orange', 'Danger sanitaire ou rejet direct', 'Mise en conformité impérative : absence d’installation, rejet au milieu naturel ou risque sanitaire caractérisé.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Cadrage par téléphone', 'Commune, type de filière, ancienneté : je vérifie le SPANC compétent et la marche à suivre.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme pour l’ensemble du dossier de vente, assainissement inclus.' ),
			array( '3', 'Le contrôle sur place', 'Localisation des ouvrages, vérification de la filière complète, photos et croquis d’implantation.' ),
			array( '4', 'Rapport & explications', 'Rapport avec conclusions et travaux éventuels, suivi d’un appel pour anticiper la négociation.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces éléments évitent d\'avoir à sonder le terrain et accélèrent le contrôle.',
			'liste' => array( 'Le plan de l’installation ou l’étude de sol, s’ils existent', 'Le dernier bordereau de vidange et le contrat d’entretien', 'Les tampons et regards dégagés et accessibles', 'Le rapport de contrôle précédent du SPANC', 'Les factures des travaux d’assainissement réalisés' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'L\'assainissement en clair',
		'questions' => array(
			array( 'Qui réalise le contrôle ?', 'Le contrôle réglementaire relève du SPANC, le service public d\'assainissement non collectif de votre intercommunalité. J\'intègre la démarche dans votre dossier et je coordonne le calendrier avec vos autres diagnostics.', 'Nous écrire pour être orienté', 'contact' ),
			array( 'Quelle est la durée de validité ?', 'Trois ans à la date du contrôle. Au-delà, un nouveau contrôle est nécessaire pour vendre.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Qui paie les travaux en cas de non-conformité ?', 'L\'acquéreur dispose d\'un an après l\'acte pour réaliser les travaux, sauf accord contraire. En pratique, la non-conformité se négocie sur le prix de vente.', 'Demander un devis gratuit', '#rappel' ),
			array( 'Mon bien est raccordé, suis-je concerné ?', 'Non, le contrôle ne vise que les installations individuelles. En zone raccordable, la commune peut en revanche vous imposer le raccordement au réseau dans un délai de deux ans.', 'Vérifier les diagnostics de mon bien', 'simulateur' ),
			array( 'Et pour une location ?', 'Le contrôle n\'est pas obligatoire pour louer, mais le bailleur doit fournir un logement salubre : une installation défaillante peut être qualifiée de non-décence.', 'Les diagnostics de mise en location', 'diagnostics' ),
			array( 'Faut-il vider la fosse avant ?', 'Non, mais gardez le dernier bordereau de vidange : il fait partie des justificatifs attendus, avec le contrat d\'entretien s\'il en existe un.', 'Préparer ma visite', 'contact' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec l\'assainissement',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'erp', 'ERP', 'Risques naturels, miniers et technologiques de la commune.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'mesurage', 'Mesurage', 'Surface privative Carrez ou surface habitable Boutin.' ),
		),
	),
	'rappel'   => array(
		'options' => array( 'photo-large' ),
		'titre' => 'Besoin d\'un diagnostic assainissement ?',
		'texte' => 'Donnez-moi la commune et le type d\'installation : je vous indique la marche à suivre avec le SPANC compétent et j\'intègre les autres diagnostics dans le même devis.',
	),
);
