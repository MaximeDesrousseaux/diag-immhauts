<?php
/**
 * Contenus de la page Professionnels (/professionnels-agences-notaires-syndics/),
 * relevés sur la maquette « Professionnels » (textes à la lettre).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'        => array(
		'ariane'    => 'Professionnels',
		'pastille'  => 'Agences · Notaires · Syndics · Bailleurs',
		'titre'     => 'Votre diagnostiqueur partenaire',
		'accent'    => 'un seul numéro, des délais tenus.',
		'chapeau'   => 'Un lot ou tout un portefeuille : créneaux réservés, rapport sous 24 h et une seule facture par mois.',
		'cta'       => 'Ouvrir un compte partenaire',
		'illus'     => 'ill_nosdiags_immeuble.webp',
		'illus_alt' => 'Immeuble en copropriété et dossier de diagnostics',
	),
	'profils'     => array(
		'surtitre' => 'Votre métier',
		'titre'    => 'Ce que j\'apporte à votre organisation',
		// [ titre, illustration, largeur de l'illustration, texte, points ]
		'cartes'   => array(
			array(
				'Agences immobilières',
				'ill_immo_d2.webp',
				108,
				'Un DDT complet avant la mise en ligne de l’annonce, pour ne jamais bloquer un compromis.',
				array( 'Prise de rendez-vous gérée avec vos vendeurs', 'Étiquette DPE transmise dès la visite pour l’annonce', 'Reprise des dossiers incomplets d’un ancien prestataire' ),
			),
			array(
				'Notaires',
				'ill_notaire_d2.webp',
				88,
				'Des rapports conformes, lisibles et envoyés directement à l’étude, avec les pièces attendues.',
				array( 'Envoi au format PDF nommé selon votre nomenclature', 'Diagnostics complémentaires en urgence avant signature', 'Interlocuteur unique pour les questions de conformité' ),
			),
			array(
				'Syndics & bailleurs',
				'ill_immeuble_ssfond.webp',
				116,
				'DTA, DTG, DPE collectif et diagnostics de parties communes, planifiés sur l’ensemble du parc.',
				array( 'Planning échelonné sur plusieurs immeubles', 'Suivi des contrôles périodiques amiante', 'Compte rendu synthétique pour l’assemblée générale' ),
			),
		),
	),
	'engagements' => array(
		'surtitre' => 'Le compte partenaire',
		'titre'    => 'Six engagements, sans contrat d\'exclusivité',
		// [ tracés SVG, titre, texte ]
		'cartes'   => array(
			array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', 'Créneaux réservés', 'Des plages bloquées chaque semaine pour les comptes partenaires, y compris en période de forte demande.' ),
			array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', 'Rapport sous 24 h', 'Le rapport conforme part dans les 24 heures suivant la visite, sans relance de votre part.' ),
			array( '<path d="M4 12 20 4l-7 16-2.5-6z"></path><path d="m10.5 14 9.5-10"></path>', 'Envoi direct', 'Notaire, vendeur, bailleur ou locataire : j’envoie le rapport à qui vous voulez, avec vous en copie.' ),
			array( '<path d="M6 3h12v18l-3-2-3 2-3-2-3 2z"></path><path d="M9 8h6M9 12h6"></path>', 'Facturation groupée', 'Une facture mensuelle unique, référencée par mandat, réglable à 30 jours.' ),
			array( '<path d="M4 20V4"></path><path d="M4 20h16"></path><path d="M8 16v-5M12.5 16V8M17 16v-7"></path>', 'Grille dégressive', 'Un tarif partenaire selon vos volumes, et un prix de pack pour les DDT complets.' ),
			array( '<path d="M12 3 5 6v5c0 4 3 7 7 8 4-1 7-4 7-8V6z"></path><path d="m9 12 2 2 4-4"></path>', 'Aucune sous-traitance', 'C’est toujours moi qui visite et qui signe. Vos clients ont un seul visage en face d’eux.' ),
		),
	),
	'packs'       => array(
		'surtitre' => 'Dossiers types',
		'titre'    => 'Les packs les plus commandés par mes partenaires',
		'lien'     => 'Composer un dossier sur mesure',
		// [ pastille, teinte (vert | jaune | orange), titre, texte, diagnostics, note ]
		'cartes'   => array(
			array( 'Vente', 'vert', 'DDT vente complet', 'Le dossier standard pour un logement ancien mis en vente, calibré selon l’année de construction.', array( 'DPE', 'ERP', 'Amiante', 'Plomb si avant 1949', 'Électricité', 'Gaz', 'Carrez' ), 'Tarif de pack partenaire, sur devis selon la surface.' ),
			array( 'Location', 'jaune', 'Mise en location', 'Le nécessaire pour signer un bail conforme et sécuriser la gestion locative.', array( 'DPE', 'ERP', 'Boutin', 'DAPP amiante', 'Électricité', 'Gaz' ), 'Idéal pour un parc géré : planning échelonné possible.' ),
			array( 'Copropriété', 'orange', 'Immeuble & parties communes', 'Les obligations collectives, du DTA au DPE collectif, avec restitution pour l’assemblée générale.', array( 'DTA', 'DPE collectif', 'DTG', 'Contrôles périodiques amiante', 'Repérage avant travaux' ), 'Devis par immeuble, après visite de cadrage gratuite.' ),
		),
	),
	'process'     => array(
		'surtitre'    => 'Comment je travaille',
		'titre'       => 'Une commande prend deux minutes',
		'texte'       => 'Pas de plateforme à apprendre, pas de formulaire à rallonge : un SMS, un mail ou un appel avec l\'adresse et le motif suffisent. Je gère la prise de rendez-vous avec le vendeur ou le locataire si vous le souhaitez.',
		'ligne_titre' => 'Ligne directe partenaires',
		'ligne_texte' => 'Du lundi au samedi, 8 h – 19 h. Vous tombez sur moi, pas sur un standard.',
		'ligne_cta'   => 'Demander un devis',
		// [ numéro, titre, texte ]
		'etapes'      => array(
			array( '1', 'Ouverture du compte', 'Dix minutes au téléphone : volumes, délais attendus, nomenclature de fichiers et grille tarifaire.' ),
			array( '2', 'Vous commandez', 'Un mail, un SMS ou un appel avec l’adresse, le motif et le contact sur place. C’est tout.' ),
			array( '3', 'J’interviens', 'Je fixe le rendez-vous, je réalise l’ensemble des diagnostics en une seule visite.' ),
			array( '4', 'Livraison & facture', 'Rapport sous 24 h aux destinataires choisis, et une facture unique en fin de mois.' ),
		),
	),
	'faq'         => array(
		'surtitre'  => 'Questions des professionnels',
		'titre'     => 'Ce qu\'on me demande le plus',
		'questions' => array(
			array( 'Quels sont vos délais réels pour un dossier urgent ?', 'Les comptes partenaires disposent de créneaux réservés en début de semaine. En pratique : visite sous 48 h dans 9 cas sur 10, rapport livré sous 24 h après la visite. Pour un compromis à signer dans les jours qui suivent, appelez-moi : je réorganise ma tournée quand c’est possible.', 'Ouvrir un compte partenaire', '#rappel' ),
			array( 'Comment fonctionne la facturation ?', 'Une facture unique en fin de mois récapitulant tous les dossiers, avec les références de vos mandats. Paiement à 30 jours. Vous pouvez aussi demander une facturation au dossier, à la charge du vendeur ou du bailleur.', 'Demander la grille partenaire', 'contact' ),
			array( 'Prenez-vous les rendez-vous avec nos clients ?', 'Oui, si vous le souhaitez. Vous m’envoyez l’adresse et le contact, je gère la prise de rendez-vous, la relance et l’accès au bien. Sinon, vous fixez le créneau et je m’y tiens.', 'Confier la prise de rendez-vous', 'contact' ),
			array( 'Envoyez-vous les rapports directement au notaire ?', 'Oui. Le rapport part par mail à qui vous indiquez — étude notariale, vendeur, bailleur ou plateforme de votre réseau — avec vous en copie systématique.', 'Voir les prestations couvertes', 'diagnostics' ),
			array( 'Y a-t-il une exclusivité ou un volume minimum ?', 'Aucun des deux. La grille partenaire s’applique dès le premier dossier et reste valable même si vous travaillez avec d’autres diagnostiqueurs.', 'Demander une convention de parc', '#rappel' ),
			array( 'Intervenez-vous sur les biens gérés en location ?', 'Oui : DPE et diagnostics de mise en location, DAPP amiante, états des installations électriques et gaz, mesurage Boutin. Je peux aussi reprendre un parc entier de manière échelonnée sur plusieurs mois.', 'Le DPE de mise en location', 'dpe' ),
		),
	),
	'rappel'      => array(
		'titre'      => 'Ouvrons votre compte partenaire',
		'texte'      => 'Un appel de dix minutes pour caler vos volumes, vos délais et votre grille tarifaire. Sans engagement, sans exclusivité : vous testez sur un premier dossier.',
		'formulaire' => array( 'Écrire un message', 'contact' ),
	),
	// Popup de rappel propre à la page (ouverte par le header, le hero et les liens #rappel).
	'popup'       => array(
		'surtitre'   => 'Compte partenaire',
		'titre'      => 'Être rappelé sous 24 h',
		'intro'      => 'Quelques informations sur votre structure et je vous rappelle avec une grille tarifaire partenaire.',
		'formulaire' => 'partenaire',
	),
);
