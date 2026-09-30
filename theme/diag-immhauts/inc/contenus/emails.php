<?php
/**
 * Textes des e-mails des formulaires, relevés sur la maquette « E-mails formulaires -
 * propositions » (renderVals) et sur les gabarits de design_diagimmhauts_theme_wp/emails/
 * (maquettes 1.14c). Piste 1a pour le client, 1c pour Max.
 *
 * Trois variantes par destinataire : rappel (formulaire court), devis (Contact),
 * simulateur (formulaire court envoyé depuis le simulateur) ; le compte partenaire
 * n'a que la notification de Max.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

$dih_nb = "\u{00A0}";

return array(
	// Accusé de réception du client (email-client.html)
	'client'     => array(
		'titre_mail' => 'Votre demande est bien arrivée',
		'salut'     => 'Bonjour %s,',
		'recap'     => 'Votre demande',
		'erreur'    => 'Une erreur' . $dih_nb . '? Répondez simplement à cet e-mail.',
		'suite'     => 'La suite',
		'au_revoir' => 'Bonne journée, et à très vite,',
		'titre'     => 'Diagnostiqueur certifié Bureau Veritas',
		'avis'      => 'sur Google',
		'avis_nb'   => '%s avis clients',
		// Repli du pied quand la note Google n'est pas renseignée
		'certifie'  => 'Certifié',
		'organisme' => 'Bureau Veritas',
		'cofrac'    => 'organisme accrédité Cofrac',
		'legal'     => 'Diag Imm\'Hauts · SASU au capital de 5' . $dih_nb . '000' . $dih_nb . '€ · ' . dih_info( 'adresse' ),
		'motif'     => 'Vous recevez ce message à la suite de votre demande sur',
	),

	// Notification de Max (email-max.html)
	'max'        => array(
		'bandeau'   => '%1$s · %2$s à %3$s',
		'message'   => 'Message',
		'appeler'   => 'Appeler · %s',
		'repondre'  => 'Répondre par e-mail',
		'origine'   => 'Page d’origine',
		'depuis'    => 'arrivé depuis %s',
		'envoye'    => 'Envoyé depuis le formulaire %s',
		'rgpd'      => 'consentement RGPD coché',
		'accuse'    => 'l’accusé de réception est parti chez le client',
		'rappel_de' => 'Rappel demandé depuis la page %s',
	),

	// Variantes : objet, préheader, intro et 3 étapes du client ; tag de Max.
	'variantes'  => array(
		'rappel'     => array(
			'objet'  => 'Je vous rappelle très vite — Diag Imm’Hauts',
			'pre'    => 'Votre demande de rappel est bien arrivée. Je vous appelle sous 24 h ouvrées.',
			'intro'  => 'Merci pour votre demande de rappel. Je vous appelle sous 24 heures ouvrées, souvent le jour même, entre deux interventions.',
			'etapes' => array(
				'Je vous appelle sous 24 h ouvrées.',
				'On fait le point ensemble sur votre bien et les diagnostics utiles.',
				'Je vous envoie un devis ferme, puis on cale un rendez-vous sous 48 h.',
			),
			'tag'    => 'Rappel demandé',
		),
		'devis'      => array(
			'objet'  => 'Votre demande de devis est bien arrivée',
			'pre'    => 'Devis détaillé sous 24 h ouvrées. Récapitulatif de votre demande à l’intérieur.',
			'intro'  => 'Merci pour votre demande de devis. Je vous envoie un prix détaillé sous 24 heures ouvrées.',
			'etapes' => array(
				'J’étudie votre demande et vérifie la liste des diagnostics obligatoires.',
				'Vous recevez un devis détaillé sous 24 h ouvrées.',
				'Une fois validé, rendez-vous sous 48 h et rapport sous 48 h.',
			),
			'tag'    => 'Demande de devis',
		),
		'simulateur' => array(
			'objet'  => 'Votre liste de diagnostics et la suite',
			'pre'    => 'La liste calculée par le simulateur, et votre devis ferme sous 24 h ouvrées.',
			'intro'  => 'Merci d’avoir utilisé le simulateur. Je vérifie la liste ci-dessous et vous envoie un devis ferme sous 24 heures ouvrées.',
			'etapes' => array(
				'Je vérifie la liste calculée par le simulateur.',
				'Vous recevez un devis ferme sous 24 h ouvrées.',
				'Une fois validé, rendez-vous sous 48 h et rapport sous 48 h.',
			),
			'tag'    => 'Simulateur',
		),
		'partenaire' => array(
			'tag' => 'Compte partenaire',
		),
	),

	// Lignes du récapitulatif client : libellé => champs (joints par « · »).
	'recap'      => array(
		'rappel'     => array(
			'Nom'       => array( 'nom' ),
			'Téléphone' => array( 'telephone' ),
			'Message'   => array( 'message' ),
		),
		'devis'      => array(
			'Bien'        => array( 'type_bien', 'surface', 'annee' ),
			'Commune'     => array( 'commune' ),
			'Motif'       => array( 'motif' ),
			'Échéance'    => array( 'echeance' ),
			'Diagnostics' => array( 'diagnostics' ),
		),
		'simulateur' => array(
			'Projet'       => array( 'sim_projet' ),
			'Bien'         => array( 'type_bien', 'sim_annee', 'commune' ),
			'Installations' => array( 'sim_precisions' ),
			'Obligatoires' => array( 'sim_obligatoires' ),
		),
	),

	// Libellés du détail de Max, quand ils diffèrent de ceux du formulaire (maquette 1c).
	'libelles'   => array(
		'surface'     => 'Surface',
		'commune'     => 'Commune',
		'echeance'    => 'Échéance',
		'diagnostics' => 'Diagnostics',
		'dossiers'    => 'Dossiers par mois',
		'sim_precisions' => 'Installations',
	),

	// Détail de Max : champs dans l'ordre (vide : ordre du formulaire).
	'detail'     => array(
		'simulateur' => array( 'telephone', 'email', 'sim_projet', 'type_bien', 'sim_annee', 'commune', 'sim_precisions', 'sim_diagnostics' ),
	),
);
