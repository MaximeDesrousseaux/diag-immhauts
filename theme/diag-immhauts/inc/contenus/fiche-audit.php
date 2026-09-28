<?php
/**
 * Fiche « Audit énergétique », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Audit énergétique',
	'hero'     => array(
		'pastille'      => 'Obligatoire à la vente des maisons et immeubles classés E, F ou G',
		'titre'         => 'Audit énergétique réglementaire',
		'accent'        => 'le chemin vers un logement décent.',
		'chapeau'       => 'Là où le DPE constate, l\'audit propose : deux scénarios de travaux chiffrés, hiérarchisés par étapes, avec le gain de classe attendu et les aides mobilisables. Il est remis à l\'acquéreur dès la visite du bien.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illustration'  => 'ill_audit_hero.webp',
		'illus_alt'     => 'Illustration audit energetique',
		'illus_tailles' => array( '254px', '224px', '100%' ),
	),
	'reperes'  => array(
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '5 ans', 'Durée de validité de l’audit' ),
		array( '<path d="M4 20h4v-4h4v-4h4V8h4"></path><path d="M4 20V4"></path>', '2 scénarios', 'Parcours de travaux chiffrés et hiérarchisés' ),
		array( '<path d="M12 13 15 9"></path><path d="M4 18a8 8 0 1 1 16 0"></path><circle cx="12" cy="13" r="1.2" fill="currentColor" stroke="none"></circle>', 'E, F, G', 'Classes qui déclenchent l’obligation à la vente' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M15 9a4 4 0 1 0 0 6M8 11h5M8 13h5"></path>', 'Accès aux aides', 'Condition des dispositifs de rénovation d’ampleur' ),
	),
	'sessions' => array(
		array(
			'type'        => 'cadre',
			'disposition' => 'cote',
			'intro'       => 'grande',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Deux scénarios, plusieurs étapes',
			'texte'       => 'L\'audit ne se contente pas d\'une liste de travaux : il trace deux parcours possibles, l\'un progressif, l\'autre en une fois, en indiquant à chaque étape la classe atteinte, le gain d\'énergie et le coût estimé.',
			'badge'       => 'chiffre',
			'cartes'      => array(
				array( '1', 'vert', 'Rénovation par étapes', 'Un parcours en plusieurs lots de travaux, étalé dans le temps, avec la classe atteinte et le coût estimé à chaque palier. La première étape doit permettre d’atteindre au moins la classe E.' ),
				array( '2', 'jaune', 'Rénovation performante en une fois', 'Un scénario global visant directement un haut niveau de performance, généralement la classe B ou A, avec le traitement simultané des six postes de travaux.' ),
				array( '€', 'orange', 'Chiffrage et aides', 'Chaque étape est estimée en coût de travaux, en gain d’énergie et en économies annuelles, avec le renvoi vers les dispositifs de financement adaptés.' ),
			),
			'sur_place'   => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je relève chez vous',
				'texte'    => 'L\'audit est plus poussé qu\'un DPE : chaque paroi, chaque équipement est relevé et justifié, car les préconisations engagent votre budget travaux.',
				'cartes'   => array(
					array( '<rect x="3" y="5" width="18" height="14" rx="1"></rect><path d="M3 12h18M9 5v7M15 12v7"></path>', 'Murs & isolation', 'Nature des parois, épaisseur, isolation existante et ponts thermiques relevés.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Toiture & combles', 'Type de couverture, isolation des rampants ou du plancher haut, ventilation du comble.' ),
					array( '<rect x="4" y="4" width="16" height="16" rx="1"></rect><path d="M12 4v16M4 12h16"></path>', 'Menuiseries', 'Vitrages, châssis, étanchéité à l’air, orientation et masques solaires.' ),
					array( '<path d="M12 3c1 3 4 4 4 8a4 4 0 0 1-8 0c0-1.5.6-2.5 1.2-3.2C10 8 11 6 12 3z"></path>', 'Chauffage & ECS', 'Générateur, émetteurs, régulation, distribution et production d’eau chaude.' ),
					array( '<circle cx="12" cy="12" r="2"></circle><path d="M12 10V4a4 4 0 0 1 0 6M14 12h6a4 4 0 0 1-6 0M12 14v6a4 4 0 0 1 0-6M10 12H4a4 4 0 0 1 6 0"></path>', 'Ventilation', 'Type de VMC, entrées d’air, débit et cohérence avec l’isolation projetée.' ),
					array( '<circle cx="12" cy="12" r="4"></circle><path d="M12 3v2M12 19v2M3 12h2M19 12h2M6 6l1.4 1.4M16.6 16.6 18 18M18 6l-1.4 1.4M7.4 16.6 6 18"></path>', 'Énergies renouvelables', 'Solaire, pompe à chaleur, poêle bois et part réellement couverte.' ),
				),
				'grille'   => 'auto',
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quand l\'audit devient obligatoire',
			'texte'    => 'Il concerne la vente des maisons individuelles et des immeubles détenus en monopropriété, selon la classe du DPE. Le calendrier s\'est resserré au fil des années.',
			'cartes'   => array(
				array( 'Classes F et G', 'vert', 'Depuis le 1er avril 2023', 'Les maisons individuelles et immeubles en monopropriété les plus énergivores ont ouvert le calendrier.' ),
				array( 'Classe E', 'jaune', 'Depuis le 1er janvier 2025', 'L’obligation s’est étendue aux biens classés E, dans les mêmes conditions de vente.' ),
				array( 'Classe D', 'orange', 'Au 1er janvier 2034', 'Prochaine échéance du calendrier, et le plus gros du parc. Anticiper l’audit permet d’étaler les travaux au lieu de les subir.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'grille',
			'surtitre'    => 'Le financement',
			'titre'       => 'L\'audit ouvre la porte aux aides',
			'texte'       => 'Réalisé par un professionnel qualifié, il conditionne l\'accès aux principaux dispositifs de financement des rénovations d\'ampleur.',
			'cartes'      => array(
				array( '1', 'vert', 'MaPrimeRénov’ parcours accompagné', 'L’audit conditionne l’accès au parcours de rénovation d’ampleur et au montant d’aide majoré.' ),
				array( '2', 'jaune', 'Éco-prêt à taux zéro', 'Le scénario retenu sert de base au dossier de financement, jusqu’au plafond travaux lourds.' ),
				array( '3', 'orange', 'Aides locales & CEE', 'Région, département et fournisseurs d’énergie s’appuient sur les préconisations de l’audit.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Votre appel', 'Type de bien, surface, année, classe DPE si vous la connaissez : je confirme si l’audit est obligatoire.' ),
			array( '2', 'Devis sous 24 h', 'Prix forfaitaire, avec l’option DPE + audit groupés dans une seule visite.' ),
			array( '3', 'La visite', '2 à 3 h sur place. J’ai besoin d’accéder aux combles, à la chaufferie et à toutes les pièces.' ),
			array( '4', 'Votre rapport', 'Audit remis sous 5 à 8 jours, scénarios chiffrés inclus, prêt à être annexé à l’annonce.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Plus le bâti est documenté, plus les scénarios de travaux sont justes — et moins les valeurs par défaut pénalisent votre classe.',
			'liste' => array( 'Les anciens diagnostics et le DPE en cours de validité', 'Les factures et devis de travaux d’isolation ou de chauffage', 'Les plans du logement et la surface habitable', 'La date de construction ou le permis de construire', 'Les notices des équipements de chauffage et de ventilation', 'Vos factures d’énergie des trois dernières années' ),
			'style' => 'large',
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'L\'audit énergétique en clair',
		'questions' => array(
			array( 'Quelle différence avec le DPE ?', 'Le DPE établit un constat et une classe. L\'audit part de ce constat pour construire un parcours de travaux : deux scénarios chiffrés, hiérarchisés en étapes, avec la classe visée à chaque palier et les aides mobilisables. Il est nettement plus long à réaliser.', 'Tout savoir sur le DPE', 'dpe' ),
			array( 'Mon bien est classé D : suis-je concerné ?', 'Non pour l\'obligation légale à la vente, qui vise les classes E, F et G des maisons individuelles et immeubles en monopropriété. Un audit volontaire reste utile si vous préparez une rénovation d\'ampleur ou visez une aide.', 'Vérifier mes obligations', 'simulateur' ),
			array( 'L\'audit est-il obligatoire pour un appartement ?', 'Non : un lot en copropriété n\'est pas soumis à l\'audit réglementaire de vente. C\'est la copropriété qui relève du DPE collectif, du DTG et du plan pluriannuel de travaux.', 'DPE collectif & DTG', 'dtg' ),
			array( 'Quelle est sa durée de validité ?', 'Cinq ans. Il doit être remis à l\'acquéreur potentiel dès la première visite du bien, au même titre que le DPE.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Suis-je obligé de faire les travaux préconisés ?', 'Non. L\'audit est un document d\'information : il éclaire l\'acquéreur sur l\'ampleur et le coût des travaux à prévoir. Aucune obligation de réalisation ne pèse sur le vendeur.', 'Faire le point sur mes travaux', 'contact' ),
			array( 'Peut-on le grouper avec le DPE ?', 'Oui, et c\'est le plus économique : le relevé sur place est largement commun. Comptez une visite un peu plus longue, et les deux rapports livrés ensemble.', 'Demander un devis groupé', '#rappel' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec l\'audit',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'dtg', 'DTG & DPE collectif', 'État global du bâti et plan de travaux de la copropriété.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'electricite', 'Électricité', 'Sécurité de l’installation intérieure de plus de 15 ans.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'DPE et audit dans la même visite',
		'texte' => 'Si votre bien risque de sortir en E, F ou G, autant grouper : le relevé est commun, le prix global est plus bas et vous avez les deux rapports en même temps pour votre annonce.',
	),
);
