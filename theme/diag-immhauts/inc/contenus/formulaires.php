<?php
/**
 * Textes autour des formulaires Fluent Forms, relevés sur les maquettes (textes à
 * la lettre) : message affiché après l'envoi, par formulaire, et mention à côté du
 * bouton du devis. Les champs eux-mêmes sont décrits dans le plugin
 * (dih_core_formulaires_definitions()).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	// Après l'envoi : titre (facultatif), texte, bouton.
	'confirmations' => array(
		// Popup « Rappel sous 24 h » (maquettes, popup de l'accueil)
		'rappel'     => array(
			'titre'  => '',
			'texte'  => 'Demande bien reçue : je vous rappelle sous 24 heures ouvrées au numéro indiqué. À très vite.',
			'bouton' => 'Fermer',
		),
		// Haut de l'accueil : la barre ne garde que la première phrase.
		'hero'       => array(
			'titre'  => 'Demande envoyée',
			'texte'  => 'Je vous rappelle sous 24 heures ouvrées.',
			'urgent' => 'Si c\'est urgent, appelez directement le 06 35 88 43 00.',
			'bouton' => 'Appeler maintenant',
		),
		// Page Contact
		'devis'      => array(
			'titre'  => 'Demande envoyée, merci !',
			'texte'  => 'Je reviens vers vous sous 24 heures ouvrées avec un devis détaillé. Si votre projet est urgent, appelez-moi directement au 06 35 88 43 00.',
			'bouton' => 'Envoyer une autre demande',
		),
		// Popup « Compte partenaire » de Professionnels
		'partenaire' => array(
			'titre'  => '',
			'texte'  => 'Demande bien reçue : je vous rappelle sous 24 heures ouvrées pour caler la grille et vos créneaux. À très vite.',
			'bouton' => 'Fermer',
		),
	),

	// À côté du bouton « Envoyer ma demande » (page Contact)
	'note_devis'    => 'Réponse sous 24 h ouvrées · sans engagement',

	// Message du haut de l'accueil, sur téléphone et en déplié (maquette : heroMsgPlaceholder)
	'message_court' => 'Votre message (facultatif)',
);
