<?php
/**
 * Contenus du simulateur (/simulateur-diagnostics-obligatoires/), relevés sur
 * « Simulateur diagnostics ». Les règles (quel diagnostic, dans quel cas) sont
 * dans assets/js/simulateur.js ; ici, seulement les textes.
 *
 * Catalogue : un texte peut dépendre du motif (clés vente / location / travaux).
 * statut : obligatoire | situation | recommande.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'        => array(
		'ariane'   => 'De quoi ai-je besoin ?',
		'titre_1'  => 'De quels ',
		'accent'   => 'diagnostics',
		'titre_2'  => ' avez-vous besoin ?',
		'chapeau'  => 'Répondez à cinq questions sur votre bien : j\'affiche la liste exacte des diagnostics obligatoires dans votre cas, avec leur durée de validité. Aucune inscription, résultat immédiat.',
		'cta'      => 'Démarrer le questionnaire',
		'illus'    => 'ill_maison_diags_sssocle.webp',
		'illus_alt' => 'Questionnaire de diagnostics, maison et outils du diagnostiqueur',
	),
	'formulaire'  => array(
		'titre'      => 'Votre bien',
		'motif'      => array( 'Votre projet', array( 'Vente', 'Location', 'Travaux / démolition' ) ),
		'type'       => array(
			'Type de bien',
			array(
				'Appartement'      => 'ill_appartement_det.webp',
				'Maison'           => 'ill_maison_detouree.webp',
				'Immeuble'         => 'ill_immeuble_detouree.webp',
				'Local commercial' => 'ill_local_det.webp',
			),
		),
		'annee'      => array( 'Année de construction', array( 'Avant 1949', '1949 – 1996', '1997 et après' ) ),
		'precisions' => 'Précisions',
		'aide'       => 'Cochez ce qui s\'applique. En cas de doute, laissez décoché : je vérifierai avec vous.',
		'cases'      => array(
			'copro'    => 'Le bien est un lot de copropriété',
			'elec'     => 'Installation électrique de plus de 15 ans',
			'gaz'      => 'Installation de gaz de plus de 15 ans',
			'termites' => 'Commune en zone termites (arrêté préfectoral)',
			'merule'   => 'Commune en zone mérule',
			'anc'      => 'Bien non raccordé au tout-à-l’égout',
		),
		// État initial (maquette) : vente d'un appartement de 1949 – 1996, lot de copropriété, électricité > 15 ans.
		'defaut'     => array(
			'motif' => 'Vente',
			'type'  => 'Appartement',
			'annee' => '1949 – 1996',
			'cases' => array( 'copro', 'elec' ),
		),
		'cta'        => 'Voir mes diagnostics',
		'reset'      => 'Réinitialiser',
	),
	'resultats'   => array(
		'surtitre' => 'Votre dossier',
		'liste'    => 'Liste',
		'mosaique' => 'Mosaïque',
		'devis'    => 'Devis pour ce dossier',
		'modifier' => 'Modifier mes informations',
		'note'     => 'Cette liste est indicative : certains cas particuliers (copropriété en cours de rénovation, bien mixte, arrêté préfectoral récent) modifient les obligations. Un appel de cinq minutes suffit à la confirmer — et le devis reste gratuit.',
		// Intro de la popup ouverte par « Devis pour ce dossier » ; %s = « 5 diagnostics ».
		'popup'    => 'Votre dossier compte %s. Laissez-moi vos coordonnées : je vous rappelle avec un prix global, tout compris.',
		'lien'     => 'En savoir plus',
		'validite' => 'Validité',
		'statuts'  => array(
			'obligatoire' => 'Obligatoire',
			'situation'   => 'Selon situation',
			'recommande'  => 'Recommandé',
		),
		// Résultats affichés sans JavaScript : ceux de l'état initial.
		'defaut'   => array( 'dpe', 'erp', 'amiante', 'electricite', 'carrez' ),
	),
	'catalogue'   => array(
		'dpe'              => array(
			'page'     => 'dpe',
			'statut'   => 'obligatoire',
			'titre'    => 'DPE',
			'validite' => '10 ans',
			'texte'    => array(
				'vente'    => 'Les étiquettes énergie et climat doivent figurer dès l’annonce.',
				'location' => 'Obligatoire pour toute mise en location, et à annexer au bail.',
			),
		),
		'erp'              => array(
			'page'     => 'erp',
			'statut'   => 'obligatoire',
			'titre'    => 'État des risques (ERP)',
			'validite' => '6 mois',
			'texte'    => 'Toujours exigé : risques naturels, miniers, technologiques et sismiques de la commune.',
		),
		'amiante'          => array(
			'page'     => 'amiante',
			'statut'   => 'obligatoire',
			'titre'    => 'Amiante',
			'validite' => 'Illimitée si négatif',
			'texte'    => array(
				'vente'    => 'Permis de construire antérieur au 1er juillet 1997 : repérage des listes A et B obligatoire.',
				'location' => 'Dossier amiante des parties privatives à tenir à disposition du locataire.',
			),
		),
		'amiante-travaux'  => array(
			'page'     => 'amiante',
			'statut'   => 'obligatoire',
			'titre'    => 'Amiante avant travaux (RAT)',
			'validite' => 'Le temps du chantier',
			'texte'    => 'Repérage avant travaux obligatoire, liste C incluse, pour tout bâti dont le permis est antérieur à juillet 1997.',
		),
		'plomb'            => array(
			'page'     => 'plomb',
			'statut'   => 'obligatoire',
			'titre'    => 'Plomb — CREP',
			'validite' => array(
				'vente'    => '1 an',
				'location' => '6 ans',
			),
			'texte'    => 'Logement construit avant 1949 : constat de risque d’exposition au plomb des peintures anciennes.',
		),
		'plomb-travaux'    => array(
			'page'     => 'plomb',
			'statut'   => 'obligatoire',
			'titre'    => 'Plomb avant travaux',
			'validite' => 'Le temps du chantier',
			'texte'    => 'Diagnostic plomb avant travaux exigé pour protéger les intervenants sur un bâti d’avant 1949.',
		),
		'electricite'      => array(
			'page'     => 'electricite',
			'statut'   => 'obligatoire',
			'titre'    => 'Électricité',
			'validite' => array(
				'vente'    => '3 ans',
				'location' => '6 ans',
			),
			'texte'    => 'Installation intérieure de plus de 15 ans : état de l’installation électrique obligatoire.',
		),
		'gaz'              => array(
			'page'     => 'gaz',
			'statut'   => 'obligatoire',
			'titre'    => 'Gaz',
			'validite' => array(
				'vente'    => '3 ans',
				'location' => '6 ans',
			),
			'texte'    => 'Présence d’une installation intérieure de gaz de plus de 15 ans : état de l’installation obligatoire.',
		),
		'carrez'           => array(
			'page'     => 'mesurage',
			'statut'   => 'obligatoire',
			'titre'    => 'Mesurage — loi Carrez',
			'validite' => 'Illimitée si aucun travaux',
			'texte'    => 'Lot de copropriété vendu : la surface privative Carrez doit figurer dans l’acte.',
		),
		'boutin'           => array(
			'page'     => 'mesurage',
			'statut'   => 'obligatoire',
			'titre'    => 'Mesurage — loi Boutin',
			'validite' => 'Illimitée si aucun travaux',
			'texte'    => 'Location vide à usage de résidence principale : la surface habitable Boutin doit figurer au bail.',
		),
		'boutin-maison'    => array(
			'page'     => 'mesurage',
			'statut'   => 'recommande',
			'titre'    => 'Mesurage — loi Boutin',
			'validite' => 'Illimitée si aucun travaux',
			'texte'    => 'La surface habitable doit figurer au bail : un mesurage évite toute contestation du locataire.',
		),
		'termites'         => array(
			'page'     => 'termites',
			'statut'   => 'obligatoire',
			'titre'    => 'Termites',
			'validite' => '6 mois',
			'texte'    => 'Commune couverte par un arrêté préfectoral : état relatif à la présence de termites obligatoire à la vente.',
		),
		'merule'           => array(
			'page'     => 'merule',
			'statut'   => 'situation',
			'titre'    => 'Mérule',
			'validite' => '6 mois',
			'texte'    => 'Zone à risque délimitée par arrêté : information obligatoire de l’acquéreur, recherche vivement conseillée.',
		),
		'assainissement'   => array(
			'page'     => 'assainissement',
			'statut'   => 'obligatoire',
			'titre'    => 'Assainissement non collectif',
			'validite' => '3 ans · à demander au SPANC',
			'texte'    => 'Bien non raccordé au tout-à-l’égout : contrôle exigé à la vente. Il est réalisé par le SPANC de votre commune — je vous indique la marche à suivre.',
		),
		'audit'            => array(
			'page'     => 'audit',
			'statut'   => 'situation',
			'titre'    => 'Audit énergétique',
			'validite' => '5 ans',
			'texte'    => 'Maison ou immeuble en monopropriété : audit obligatoire si le DPE ressort en E, F ou G. On le saura à la remise du DPE.',
		),
		'dtg'              => array(
			'page'     => 'dtg',
			'statut'   => 'recommande',
			'titre'    => 'DTG — diagnostic technique global',
			'validite' => '—',
			'texte'    => 'Immeuble en monopropriété ou mise en copropriété : le DTG anticipe les travaux et sécurise l’opération.',
			'illus'    => 'ill_syndic_ssfond.webp', // maquette : pas diag_dtg (voir Arbitrages)
		),
		'tertiaire'        => array(
			'page'     => 'contact',
			'statut'   => 'recommande',
			'titre'    => 'Diagnostic technique adapté au tertiaire',
			'validite' => '—',
			'texte'    => 'Les obligations d’un local professionnel dépendent de son usage et de son ERP éventuel : appelez-moi, je cadre le dossier avec vous.',
			'illus'    => '', // pas d'illustration (maquette)
		),
	),
	'rappel'      => array(
		'titre' => 'Un devis groupé pour tout le dossier',
		'texte' => 'Réaliser plusieurs diagnostics en une seule visite coûte moins cher que de les commander séparément. Donnez-moi votre liste : vous recevez un prix global sous 24 heures.',
	),
);
