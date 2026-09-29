<?php
/**
 * Contenus fixes de l'index du journal (/actualites/) : hero, articles « à
 * paraître », encart d'appel. Les articles publiés viennent de WordPress
 * (article épinglé = « à la une ») ; leurs champs dih_* alimentent les cards.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'      => array(
		'ariane'       => 'Actualités',
		'accent'       => 'Actualités',
		'titre'        => ' du diagnostic immobilier',
		'chapeau'      => 'Les règles du diagnostic bougent vite, et rarement dans les journaux. J\'écris ici ce que j\'explique au téléphone plusieurs fois par semaine — sans jargon, avec les dates qui comptent.',
		'illustration' => 'ill_actus.webp',
	),
	'une'       => array(
		'etiquette' => 'À la une',
		'lecture'   => '%s min de lecture',
		'cta'       => 'Lire l\'article',
	),
	'liste'     => array(
		'lecture' => '%s min',
		'cta'     => 'Lire l\'article',
	),
	'a_paraitre' => array(
		'titre'   => 'À paraître ce trimestre',
		'texte'   => 'Les deux questions qui reviennent le plus souvent',
		// [ quand, illustration, titre, texte ]
		'cartes'  => array(
			array( 'Novembre 2026', 'ill_article_prix.webp', 'Combien coûte vraiment un pack de diagnostics', 'Pourquoi deux devis peuvent varier du simple au double, ce qui fait monter la facture, et comment lire un devis de diagnostiqueur sans se faire surprendre.' ),
			array( 'Décembre 2026', 'ill_article_duree_validite_flip.webp', 'Quel diagnostic est encore valable chez vous ?', 'Un tableau simple, document par document, pour savoir ce qu\'il faut refaire avant de vendre — et ce qu\'on vous ferait refaire pour rien.' ),
		),
	),
	'appel'     => array(
		'titre' => 'Une question sur votre situation ?',
		'texte' => 'Un texte réglementaire ne dit jamais ce qu\'il faut faire dans votre cas précis. Décrivez-moi votre bien : je vous réponds sans vous vendre un diagnostic dont vous n\'avez pas besoin.',
		'cta'   => 'Poser ma question',
	),
);
