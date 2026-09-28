<?php
/**
 * Fiche « Plomb (CREP) », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Plomb (CREP)',
	'hero'     => array(
		'pastille'      => 'Obligatoire pour tout logement construit avant 1949',
		'titre'         => 'Constat de risque d\'exposition au plomb',
		'accent'        => 'le CREP, unité par unité.',
		'chapeau'       => 'Les peintures au plomb, interdites en 1949, restent présentes dans une grande partie du bâti ancien de l\'Artois. Le CREP mesure leur présence sur chaque unité de diagnostic, évalue leur état de dégradation et détermine ce que vous devez surveiller, entretenir ou faire traiter avant une vente ou une mise en location.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration d\'un constat de risque d\'exposition au plomb',
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', 'Avant 1949', 'Logements concernés' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '1 à 2 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '1 an / 6 ans', 'Validité vente / location' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 12 15.5 9"></path><path d="M12 6v1M18 12h-1M6 12h1"></path>', 'Mesure XRF', 'Analyse sur place, sans dégradation' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Trois usages du diagnostic',
			'titre'     => 'Un diagnostic, trois contextes',
			'texte'     => 'Le plomb ne se diagnostique pas de la même façon selon votre projet. Vente, location et travaux relèvent de trois missions distinctes, avec des durées de validité différentes.',
			'cartes'    => array(
				array( 'V', 'vert', 'CREP vente', 'Annexé au dossier de diagnostic technique, valable un an. Il informe l’acquéreur du risque d’exposition au plomb.' ),
				array( 'L', 'jaune', 'CREP location', 'Valable six ans, remis au locataire avec le bail. Les unités en classe 3 doivent être traitées avant la mise en location.' ),
				array( 'T', 'orange', 'Plomb avant travaux', 'Diagnostic distinct, exigé avant une rénovation ou une démolition, pour protéger les intervenants du chantier.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je mesure chez vous',
				'texte'    => 'Je contrôle chaque unité de diagnostic à l\'analyseur à fluorescence X, sans dégradation ni prélèvement, et je note l\'état de conservation du revêtement.',
				'cartes'   => array(
					array( '<rect x="4" y="4" width="12" height="6" rx="1"></rect><path d="M16 7h3v5h-7v9"></path>', 'Murs & plafonds', 'Peintures anciennes, sous-couches et recouvrements successifs.' ),
					array( '<rect x="4" y="4" width="16" height="16" rx="1"></rect><path d="M12 4v16M4 12h16"></path>', 'Menuiseries', 'Fenêtres, portes, appuis et embrasures — les zones de frottement les plus exposées.' ),
					array( '<rect x="3" y="8" width="18" height="8" rx="1"></rect><path d="M7 8v3M11 8v4M15 8v3M19 8v4"></path>', 'Plinthes & boiseries', 'Plinthes, cimaises, escaliers et garde-corps intérieurs.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Extérieurs accessibles', 'Volets, portails, balcons et rambardes lorsque l’occupant y a accès.' ),
					array( '<path d="m12 3 8 4.5-8 4.5-8-4.5z"></path><path d="m4 12.5 8 4.5 8-4.5"></path><path d="m4 17 8 4.5 8-4.5"></path>', 'État de dégradation', 'Écailles, farinage, fissures et humidité : c’est ce qui détermine la classe.' ),
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Signalements annexes', 'Canalisations en plomb visibles et situations d’insalubrité, signalées dans le rapport.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel diagnostic plomb dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'CREP obligatoire, valable 1 an', 'Annexé au dossier de diagnostic technique. Sans lui, vous ne pouvez pas vous exonérer de la garantie des vices cachés.', 'ill_pl_vente.webp' ),
				array( 'Location', 'jaune', 'CREP valable 6 ans', 'Remis au locataire avec le bail. Les revêtements dégradés doivent être traités avant l’entrée dans les lieux.', 'ill_pl_location.webp' ),
				array( 'Parties communes', 'orange', 'CREP immeuble', 'Pour tout immeuble d’habitation d’avant 1949, à la charge du syndicat des copropriétaires, indépendamment des lots privatifs.', 'ill_pl_travaux.webp' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'cartes',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Plomb détecté : et ensuite ?',
			'texte'       => 'Ce n\'est pas la présence de plomb qui déclenche une obligation, mais l\'état du revêtement. Chaque unité mesurée reçoit une classe de 0 à 3.',
			'cartes'      => array(
				array( '1', 'vert', 'Revêtement non dégradé', 'Aucun travaux. Une surveillance de l’état du revêtement suffit, avec information des occupants.' ),
				array( '2', 'jaune', 'État d’usage', 'Entretien recommandé pour éviter que la dégradation ne progresse, notamment en présence d’enfants.' ),
				array( '3', 'orange', 'Revêtement dégradé', 'Travaux de suppression du risque à la charge du propriétaire, information des occupants et transmission à l’ARS le cas échéant.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Cadrage par téléphone', 'Année de construction, nombre de pièces, motif : je détermine la mission exacte et son prix.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, tout compris, sans frais de déplacement caché dans la région.' ),
			array( '3', 'Le constat sur place', 'Mesure de chaque unité de diagnostic à l’analyseur XRF, relevé de l’état de dégradation et photos.' ),
			array( '4', 'Rapport & explications', 'Rapport conforme avec le classement unité par unité, suivi d’un appel pour reprendre les points sensibles.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces éléments accélèrent le constat et évitent les mesures inutiles.',
			'liste' => array( 'L’année de construction ou l’acte de propriété', 'Les constats plomb antérieurs, même anciens', 'Un accès à toutes les pièces, y compris caves et annexes', 'Les factures de rénovation des peintures et menuiseries', 'La présence éventuelle d’enfants de moins de six ans dans le logement' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'Le plomb en clair',
		'questions' => array(
			array( 'Mon logement date de 1955, suis-je concerné ?', 'Non. Le CREP ne concerne que les logements dont la construction est antérieure au 1er janvier 1949, date d\'interdiction des peintures au plomb en France.', 'Vérifier mes obligations', 'simulateur' ),
			array( 'Quelle est la durée de validité ?', 'Un an pour une vente, six ans pour une location. Si le constat ne révèle aucune unité en classe 1, 2 ou 3, il est en revanche valable sans limitation de durée pour les deux usages.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Y a-t-il des prélèvements ?', 'Non, dans la très grande majorité des cas. La mesure se fait sur place à l\'analyseur à fluorescence X, sans abîmer les peintures. Un prélèvement n\'est envisagé qu\'en cas de mesure impossible.', 'Préparer ma visite', 'contact' ),
			array( 'Que se passe-t-il si du plomb est détecté ?', 'Tout dépend de l\'état du revêtement. Une peinture au plomb non dégradée (classe 1) n\'impose aucun travaux, seulement une surveillance. Une peinture dégradée (classe 3) impose au propriétaire des travaux de suppression du risque et une information des occupants.', 'Poser une question sur mon rapport', 'contact' ),
			array( 'Le CREP couvre-t-il les canalisations en plomb ?', 'Non. Le CREP porte sur les revêtements. Les canalisations en plomb relèvent d\'un diagnostic distinct de l\'eau potable, mais je vous les signale systématiquement quand je les repère.', 'Voir toutes les prestations', 'diagnostics' ),
			array( 'Et pour un immeuble en copropriété ?', 'Les parties communes d\'un immeuble d\'avant 1949 doivent faire l\'objet d\'un CREP à la charge du syndicat. Il est indépendant du constat réalisé dans votre lot privatif.', 'Parties communes & copropriétés', 'dtg' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec le CREP',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'electricite', 'Électricité', 'Sécurité de l’installation intérieure de plus de 15 ans.' ),
			array( 'erp', 'ERP', 'Risques naturels, miniers et technologiques de la commune.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Besoin d\'un CREP ?',
		'texte' => 'Donnez-moi l\'année de construction, le nombre de pièces et le motif (vente, location, travaux) : vous recevez un devis gratuit sous 24 heures, mesures et rapport inclus.',
	),
);
