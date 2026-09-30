<?php
/**
 * Contenus de Mentions légales & confidentialité (/mentions-legales/), relevés
 * sur la maquette « Mentions legales » (textes à la lettre).
 *
 * Blocs : titre, surtitre, id (ancre), paragraphes, definitions [ terme, valeur ],
 * sous_titre (au-dessus des définitions), actions.
 * Dans les valeurs, {a completer: …} produit une mention surlignée (champ que
 * le client doit encore fournir) ; {adresse}, {telephone} et {email} reprennent
 * les coordonnées du site (dih_info : adresse, téléphone, e-mail RGPD), liens
 * compris ; les autres liens sont en HTML simple.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'  => array(
		'ariane'       => 'Mentions légales',
		'titre'        => 'Mentions légales & confidentialité',
		'chapeau'      => 'Éditeur du site, hébergement, propriété intellectuelle et traitement de vos données personnelles.',
		'note'         => 'Dernière mise à jour : septembre 2026',
		'illustration' => 'ill_mentions_legales.webp',
	),
	'blocs' => array(
		array(
			'titre'        => 'Éditeur du site',
			'raison'       => 'DIAG IMM\'HAUTS',
			'paragraphes'  => array( 'Société par actions simplifiée à associé unique (SASU) au capital de 5 000 €, spécialisée dans les diagnostics immobiliers — analyses, essais et inspections techniques.' ),
			'definitions'  => array(
				array( 'Adresse', '{adresse}' ),
				array( 'Téléphone', '{telephone}' ),
				array( 'E-mail', '{email}' ),
				array( 'SIRET', '949 529 929 00018' ),
				array( 'RCS', '949 529 929 RCS Arras — société immatriculée le 6 mars 2023' ),
				array( 'Capital social', '5 000 €' ),
				array( 'TVA intracommunautaire', 'FR14 949529929' ),
				array( 'Président & directeur de la publication', 'Maxime Dillies' ),
			),
		),
		array(
			'titre'       => 'Hébergement',
			'paragraphes' => array( 'Le site est hébergé par <strong>OVH</strong>, SAS au capital de 10 069 020 €, dont le siège social est situé 2 rue Kellermann, 59100 Roubaix, France — RCS Lille Métropole 424 761 419.' ),
		),
		array(
			'titre'       => 'Propriété intellectuelle',
			'paragraphes' => array(
				'L\'ensemble du site, sa structure, ses textes, images, graphismes, logos, icônes, sons et vidéos sont la propriété exclusive de DIAG IMM\'HAUTS, sauf mention contraire.',
				'Toute reproduction, représentation, modification, publication ou adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite sans autorisation écrite préalable.',
			),
		),
		array(
			'titre'       => 'Certification & assurance',
			'paragraphes' => array( 'Les diagnostics sont réalisés par Maxime Dillies, certifié par <strong>Bureau Veritas</strong>, organisme accrédité par le Cofrac (Comité français d\'accréditation) pour la certification des personnes réalisant des diagnostics immobiliers.' ),
			'definitions' => array(
				array( 'N° de certification', '{a completer: à compléter}' ),
				array( 'Assurance responsabilité civile professionnelle', '{a completer: assureur, n° de contrat et zone couverte à compléter}' ),
			),
		),
		array(
			'id'          => 'confidentialite',
			'surtitre'    => 'RGPD',
			'titre'       => 'Protection des données personnelles',
			'paragraphes' => array(
				'Les informations recueillies via les formulaires du site (contact, demande de devis, demande de rappel) sont strictement confidentielles et utilisées uniquement dans le cadre de nos échanges commerciaux ou d\'information. Elles ne sont ni cédées ni revendues à des tiers.',
				'Conformément au Règlement général sur la protection des données (RGPD), vous disposez d\'un droit d\'accès, de rectification, d\'opposition, de portabilité et de suppression de vos données. Vous pouvez également introduire une réclamation auprès de la CNIL (3 place de Fontenoy, 75007 Paris — cnil.fr).',
			),
			'sous_titre'  => 'Vos données en clair',
			'definitions' => array(
				array( 'Responsable du traitement', 'DIAG IMM\'HAUTS — Maxime Dillies, {adresse}' ),
				array( 'Finalité', 'Répondre à votre demande, établir un devis, organiser l\'intervention et vous transmettre le rapport.' ),
				array( 'Base légale', 'Votre consentement pour les demandes de rappel et de devis ; l\'exécution du contrat pour les prestations commandées.' ),
				array( 'Durée de conservation', '3 ans après le dernier contact pour une demande sans suite ; 10 ans pour les dossiers facturés, conformément aux obligations comptables et à la durée de validité des rapports.' ),
				array( 'Destinataires', 'Aucun tiers commercial. Vos données sont traitées par Maxime Dillies seul, sur la messagerie et l\'hébergement du site (OVH, France), et transmises à l\'agence ou au notaire uniquement sur votre demande.' ),
				array( 'Mesure d\'audience', '{a completer: outils utilisés à compléter}' ),
			),
			'actions'     => array(
				array( 'Exercer mes droits par e-mail', 'mailto:' . dih_info( 'email_rgpd' ) ),
				array( 'Nous écrire', 'contact' ),
			),
		),
		array(
			'titre'       => 'Responsabilité',
			'paragraphes' => array( 'DIAG IMM\'HAUTS s\'efforce d\'assurer au mieux l\'exactitude des informations diffusées sur son site. Toutefois, l\'éditeur ne saurait être tenu pour responsable des éventuelles erreurs, omissions ou indisponibilités du site.' ),
		),
		array(
			'titre'       => 'Médiation de la consommation',
			'paragraphes' => array( 'Conformément aux articles L. 612-1 et suivants du code de la consommation, tout client particulier a le droit de recourir gratuitement à un médiateur de la consommation en vue de la résolution amiable d\'un litige, après avoir tenté de le résoudre directement avec nous par une réclamation écrite.' ),
			'definitions' => array(
				array( 'Médiateur compétent', '{a completer: nom, adresse et site du médiateur à compléter}' ),
			),
		),
		array(
			'titre'       => 'Droit applicable',
			'paragraphes' => array( 'Le présent site est soumis au droit français. En cas de litige, les tribunaux français seront seuls compétents.' ),
		),
	),
);
