<?php
/**
 * Contenus de la page Contact & devis (/contact-devis/), relevés sur la
 * maquette « Contact » (textes à la lettre). Le formulaire lui-même est un
 * formulaire Fluent Forms (clé « devis ») : ses champs se règlent dans
 * l'administration ; ci-dessous, seulement le titre et l'introduction.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'       => array(
		'ariane'    => 'Contact & devis',
		'titre_1'   => 'Demandez',
		'titre_2'   => 'votre',
		'accent'    => 'devis gratuit',
		'chapeau'   => 'Décrivez-moi votre bien en quelques champs : je vous réponds avec un prix ferme, tout compris, sous 24 heures ouvrées. Pour une demande urgente, un appel reste le plus rapide.',
		'promesses' => array(
			'Devis ferme sous 24 h ouvrées',
			'Rendez-vous sous 48 h en moyenne',
			'Un seul interlocuteur, du devis au rapport',
		),
		'illus'     => 'ill_contact_ssfond.webp',
		'illus_alt' => 'Téléphone, devis signé et repère de localisation',
	),
	'formulaire' => array(
		'titre' => 'Votre demande de devis',
		'intro' => 'Les champs marqués d\'un astérisque sont nécessaires pour établir un prix.',
	),
	'telephone'  => array(
		'titre' => 'Plus rapide au téléphone',
		'texte' => 'Je décroche entre deux interventions, du lundi au samedi.',
	),
	'horaires'   => array(
		'titre'  => 'Horaires d\'appel',
		'lignes' => array(
			array( 'Lundi – vendredi', '8 h – 19 h' ),
			array( 'Samedi', '9 h – 13 h' ),
			array( 'Dimanche', 'Sur rendez-vous' ),
		),
	),
	'zone'       => array(
		'titre'    => 'Zone d\'intervention',
		'texte'    => 'Basé à Berles-Monchel, près d’Aubigny-en-Artois, j\'interviens sur tout le Pas-de-Calais et les Hauts-de-France : Arras, Lens, Liévin, Béthune, Saint-Pol-sur-Ternoise, Douai, Cambrai et leurs alentours.',
		'communes' => array( 'Arras', 'Lens', 'Liévin', 'Béthune', 'Saint-Pol-sur-Ternoise', 'Aubigny-en-Artois', 'Douai', 'Cambrai' ),
		'note'     => 'Votre commune n\'est pas listée ? Appelez-moi, j\'y vais probablement.',
	),
	'coordonnees' => array(
		'titre'  => 'Mes coordonnées',
		'lignes' => array(
			'Diag Imm\'Hauts — Maxime Dillies',
			dih_info( 'adresse' ),
			'Pas de réception du public : je me déplace chez vous',
			'Certifié Bureau Veritas (organisme accrédité par le Cofrac)',
			'RC professionnelle diagnostic immobilier',
		),
	),
);
