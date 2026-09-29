<?php
/**
 * Contenus de « Nos diagnostics » (/diagnostics-immobiliers/), relevés sur
 * « Nos diagnostics.dc.html » (maquettes v10). Page VERROUILLÉE en bureau et en déplié.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'    => array(
		'titre_1'  => 'Chaque',
		'titre_2'  => 'diagnostic,',
		'accent_1' => 'son obligation',
		'accent_2' => 'et sa durée.',
		'chapeau'  => "Vente, location, copropriété ou audit énergétique : l'ensemble des prestations, leurs obligations et leur durée de validité.",
		// numéro, titre, sous-titre, ancre (réglage entrees_hero : sommaire ou cartes-blanches)
		'entrees'  => array(
			array( '01', 'Vente & location', 'Les diagnostics du dossier technique', 'vente' ),
			array( '02', 'Copropriétés', 'DPE collectif, DTG et plan de travaux', 'copro' ),
			array( '03', 'Audit énergétique', 'Scénarios de travaux chiffrés', 'audit' ),
		),
		// Réglage de la page « hero_illustration » : fichier, texte alternatif
		'illustrations' => array(
			'livrets'      => array( 'ill_diags-3d205249.webp', 'Rapports de diagnostic et étiquette DPE' ),
			'maison-verte' => array( 'ill_nosdiags_maison.webp', 'Maison individuelle diagnostiquée' ),
		),
	),

	'vente'   => array(
		'surtitre' => 'Particuliers · Agences',
		'titre'    => 'Diagnostics pour la vente & la location',
		'texte'    => "Le Dossier de Diagnostic Technique réunit les diagnostics obligatoires à annexer à votre acte de vente ou à votre bail. La liste exacte dépend du bien : je la détermine avec vous avant l'intervention.",
		// clé de page, validité, titre, texte, condition, illustration propre (facultative)
		'cartes'   => array(
			array( 'dpe', '10 ans', 'DPE', 'Classe énergétique et climatique du logement, de A à G, avec recommandations de travaux.', 'Obligatoire pour toute vente ou location' ),
			array( 'amiante', 'Illimitée*', 'Amiante', 'Repérage des matériaux et produits contenant de l’amiante dans le bâti.', 'Permis de construire avant le 1er juillet 1997' ),
			array( 'plomb', '1 an / 6 ans', 'Plomb (CREP)', 'Constat de risque d’exposition au plomb dans les peintures anciennes.', 'Logement construit avant le 1er janvier 1949' ),
			array( 'electricite', '3 ans / 6 ans', 'Électricité', 'État de l’installation intérieure d’électricité et des risques associés.', 'Installation de plus de 15 ans' ),
			array( 'gaz', '3 ans / 6 ans', 'Gaz', 'État de l’installation intérieure de gaz : appareils, tuyauteries, ventilation.', 'Installation de plus de 15 ans' ),
			array( 'termites', '6 mois', 'Termites', 'Recherche de termites et d’agents de dégradation biologique du bois.', 'Zone déclarée par arrêté préfectoral' ),
			array( 'erp', '6 mois', 'État des risques (ERP)', 'Risques naturels, miniers, technologiques et sismiques de la commune.', 'Obligatoire dans les zones concernées' ),
			array( 'mesurage', 'Illimitée*', 'Mesurage Carrez / Boutin', 'Surface privative en copropriété (Carrez) ou surface habitable en location (Boutin).', 'Vente en copropriété · bail d’habitation' ),
			array( 'assainissement', 'Contrôle SPANC', 'Assainissement', 'Contrôle de l’installation non collective : il est réalisé par le SPANC de votre commune, je vous oriente et j’intègre les autres diagnostics au même devis.', 'Bien non raccordé au tout-à-l’égout' ),
			array( 'merule', '6 mois', 'Mérule', 'Recherche de mérule et de champignons lignivores dans les bois du bâti.', 'Zone à risque délimitée par arrêté' ),
			array( 'dtg', '10 ans', 'DTG & DPE collectif', 'Étiquette énergétique de l’immeuble entier et état technique global de la copropriété.', 'Copropriétés d’habitation' ),
			array( 'audit', '5 ans', 'Audit énergétique', 'Deux scénarios de travaux chiffrés pour sortir le logement des classes énergivores.', 'Vente d’une maison classée E, F ou G' ),
		),
		'cta'      => 'De quels diagnostics ai-je besoin ?',
	),

	'etapes'  => array(
		'variante' => 'standard',
		'surtitre' => 'Comment ça se passe',
		'titre'    => 'Quatre étapes, aucune mauvaise surprise',
		'liste'    => array(
			array( '01', 'Votre appel', 'Vous décrivez le bien : type, surface, année, projet. Je détermine la liste exacte des diagnostics.' ),
			array( '02', 'Devis sous 24 h', 'Un devis clair, forfaitaire et sans engagement, envoyé par e-mail.' ),
			array( '03', 'L’intervention', 'Sur place sous 48 h en moyenne. Comptez 1 à 3 h selon la surface et le nombre de diagnostics.' ),
			array( '04', 'Vos rapports', 'Rapports numériques transmis sous 48 h, prêts pour le notaire ou l’agence.' ),
		),
	),

	'copro'   => array(
		'surtitre'  => 'Syndics · Bailleurs · Collectivités',
		'titre'     => 'Copropriétés & collectivités',
		'texte'     => "J'accompagne les syndics, bailleurs sociaux et collectivités sur l'ensemble de leur parc : repérages réglementaires des parties communes, diagnostic technique global, DPE collectif et suivi pluriannuel. Un référent unique, des plannings tenus et des rapports harmonisés d'un immeuble à l'autre.",
		'cta'       => 'Demander une convention de parc',
		'image'     => 'ill_nosdiags_immeubles2.webp',
		'image_alt' => 'Immeubles en copropriété, DPE collectif et contrôle',
		// illustration, titre, texte
		'cartes'    => array(
			array( 'diag_dtg.webp', 'Diagnostic technique global (DTG)', 'État du bâti, analyse des améliorations possibles et projection budgétaire sur 10 ans.' ),
			array( 'diag_dpe_v2.webp', 'DPE collectif', 'Étiquette énergétique de l’immeuble entier, obligatoire pour tous les immeubles d’habitation.' ),
			array( 'diag_amiante.webp', 'Amiante des parties communes (DTA)', 'Dossier technique amiante et mise à jour du repérage avant travaux.' ),
			array( 'ill_syndic_ssfond.webp', 'Accompagnement de parc', 'Planning annuel, référent unique et rapports harmonisés pour bailleurs et collectivités.' ),
		),
	),

	'audit'   => array(
		'surtitre'  => 'Réglementaire',
		'titre'     => 'Audits énergétiques',
		'texte'     => "L'audit énergétique est obligatoire à la vente pour les maisons et immeubles en monopropriété : classes F et G depuis le 1<sup>er</sup> avril 2023, classe E depuis le 1<sup>er</sup> janvier 2025, classe D au 1<sup>er</sup> janvier 2034. Il propose des scénarios de travaux chiffrés et hiérarchisés pour faire remonter votre bien dans le classement.",
		'cta'       => 'Estimer mon audit énergétique',
		'image'     => 'ill_jauge_texte_det.webp',
		'image_alt' => 'Étiquette énergie à sept classes, de A « très performant » à G « très énergivore »',
		'legende'   => 'Les classes E, F et G déclenchent des obligations à la vente et à la location.',
	),

	'faq'     => array(
		'surtitre'  => 'FAQ',
		'titre'     => 'Questions fréquentes',
		'questions' => array(
			array( 'Comment savoir quels diagnostics sont obligatoires pour mon bien ?', 'La liste dépend de quatre critères : l’année de construction, l’âge des installations électriques et gaz, la localisation (zones termites, risques, assainissement) et la nature du projet — vente ou location. Un appel de deux minutes suffit pour établir la liste exacte, sans engagement.', 'Faire le point en une minute', 'simulateur' ),
			array( 'Combien de temps dure une intervention ?', 'Entre 1 h pour un studio avec DPE seul et 3 h pour une maison avec un dossier complet. Je vous donne un créneau précis lors de la prise de rendez-vous afin que vous n’attendiez pas.', 'Réserver un créneau', '#rappel' ),
			array( 'Que dois-je préparer avant votre visite ?', 'Idéalement : les anciens diagnostics, les plans, les factures d’énergie récentes, la description des travaux d’isolation ou de chauffage réalisés, et l’accès à toutes les pièces, aux combles et au tableau électrique.', 'Nous transmettre les infos du bien', 'contact' ),
			array( 'Quand recevrai-je mes rapports ?', 'Sous 48 heures après l’intervention, au format numérique, directement exploitables par votre notaire ou votre agence. En cas d’urgence de signature, je peux prioriser votre dossier.', 'Demander une intervention rapide', '#rappel' ),
		),
	),

	'rappel'  => array(
		'titre'      => 'Un doute sur les diagnostics dont vous avez besoin ?',
		'texte'      => 'Décrivez-moi votre bien en deux minutes au téléphone : je vous dis exactement quels diagnostics sont obligatoires et je vous envoie un devis gratuit sous 24 heures.',
		'formulaire' => array( 'Demande de rappel gratuit', array( 'contact', '#devis' ) ),
	),
);
