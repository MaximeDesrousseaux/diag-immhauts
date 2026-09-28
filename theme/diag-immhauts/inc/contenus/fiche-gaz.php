<?php
/**
 * Fiche « Gaz », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Gaz',
	'hero'     => array(
		'pastille'      => 'Obligatoire si l\'installation a plus de 15 ans',
		'titre'         => 'État de l\'installation intérieure de gaz',
		'accent'        => 'étanchéité, combustion, ventilation.',
		'chapeau'       => 'Une installation de gaz vieillissante expose à deux risques majeurs : la fuite et l\'intoxication au monoxyde de carbone. Le diagnostic contrôle les tuyauteries fixes, les appareils raccordés, l\'évacuation des produits de combustion et la ventilation du logement, puis classe chaque anomalie selon sa gravité.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration gaz',
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', '+ de 15 ans', 'Installations concernées' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '45 min à 1 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '3 ans / 6 ans', 'Validité vente / location' ),
		array( '<circle cx="12" cy="12" r="2"></circle><path d="M12 10V4a4 4 0 0 1 0 6M14 12h6a4 4 0 0 1-6 0M12 14v6a4 4 0 0 1 0-6M10 12H4a4 4 0 0 1 6 0"></path>', '4 domaines', 'Tuyauteries, appareils, évacuation, ventilation' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du contrôle',
			'titre'     => 'Trois organes sous surveillance',
			'texte'     => 'Le contrôle ne porte pas sur le réseau du distributeur mais sur votre installation intérieure, depuis le robinet de commande jusqu\'aux appareils et à l\'air qu\'ils consomment.',
			'cartes'    => array(
				array( 'T', 'vert', 'Tuyauteries fixes', 'Organe de coupure, canalisations, raccords et tuyaux flexibles : étanchéité, état et date de péremption.' ),
				array( 'A', 'jaune', 'Appareils raccordés', 'Chaudière, chauffe-eau, cuisinière, radiateur : raccordement, stabilité de la combustion et taux de CO mesuré.' ),
				array( 'V', 'orange', 'Évacuation & ventilation', 'Conduits de fumée, tirage, amenées d’air et sorties : c’est ce qui protège du monoxyde de carbone.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je contrôle chez vous',
				'texte'    => 'Je vérifie l\'étanchéité, l\'état des raccordements et le tirage des conduits, avec des mesures de combustion et de dépression lorsque c\'est nécessaire.',
				'cartes'   => array(
					array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 12 15.5 9"></path><path d="M12 6v1M18 12h-1M6 12h1"></path>', 'Organe de coupure', 'Présence, accessibilité et manœuvrabilité du robinet de commande générale.' ),
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Tuyauteries & flexibles', 'Étanchéité des raccords, état et date de validité des tuyaux flexibles.' ),
					array( '<path d="M12 3c1 3 4 4 4 8a4 4 0 0 1-8 0c0-1.5.6-2.5 1.2-3.2C10 8 11 6 12 3z"></path>', 'Chaudière & chauffe-eau', 'Raccordement, combustion, mesure du monoxyde de carbone dans les fumées.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Évacuation des fumées', 'Conduit adapté à l’appareil, tirage effectif, absence d’obstruction.' ),
					array( '<circle cx="12" cy="12" r="2"></circle><path d="M12 10V4a4 4 0 0 1 0 6M14 12h6a4 4 0 0 1-6 0M12 14v6a4 4 0 0 1 0-6M10 12H4a4 4 0 0 1 6 0"></path>', 'Ventilation du local', 'Amenée d’air et sortie d’air suffisantes, entrées non obturées.' ),
					array( '<path d="M10 3h4v3l2 3v12H8V9l2-3z"></path><path d="M8 13h8"></path>', 'Local & stockage', 'Volume du local, présence de bouteilles, aération et conditions de stockage.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel diagnostic gaz dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'Diagnostic valable 3 ans', 'Annexé au dossier de diagnostic technique. Les anomalies sont portées à la connaissance de l’acquéreur.' ),
				array( 'Location', 'jaune', 'Diagnostic valable 6 ans', 'Remis avec le bail. Les anomalies affectant la sécurité doivent être corrigées avant l’entrée dans les lieux.' ),
				array( 'Après une coupure', 'orange', 'Remise en service encadrée', 'Après un DGI, l’installation ne peut être réalimentée qu’après réparation par un professionnel et attestation de son intervention.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Une anomalie relevée : et ensuite ?',
			'texte'       => 'Les anomalies sont codifiées. Leur code détermine le délai dans lequel il faut intervenir — et, dans le cas le plus grave, l\'arrêt immédiat de l\'installation.',
			'cartes'      => array(
				array( 'A1', 'vert', 'Anomalie mineure', 'À corriger lors d’une intervention ultérieure. L’installation peut continuer à fonctionner normalement.' ),
				array( 'A2', 'jaune', 'Anomalie à traiter', 'Réparation nécessaire dans les meilleurs délais par un professionnel. Le diagnostic précise le point concerné.' ),
				array( 'DGI', 'orange', 'Danger grave et immédiat', 'Interruption immédiate de l’alimentation, information de l’occupant et du distributeur, remise en service après réparation.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Cadrage par téléphone', 'Nombre d’appareils au gaz, type de chaudière, motif : je confirme l’obligation et le prix.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, tout compris. Tarif réduit si le diagnostic est groupé avec l’électricité ou le DPE.' ),
			array( '3', 'Le contrôle sur place', 'Essais d’étanchéité, mesures de combustion et de monoxyde, vérification des ventilations et des conduits.' ),
			array( '4', 'Rapport & explications', 'Rapport conforme avec les anomalies codifiées A1, A2 ou DGI, suivi d’un appel pour prioriser les interventions.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces conditions sont indispensables pour un contrôle complet, en particulier les mesures de combustion.',
			'liste' => array( 'Le gaz ouvert et les appareils en état de fonctionner', 'Un accès dégagé à la chaudière, au chauffe-eau et à la cuisinière', 'Les factures d’entretien de chaudière des deux dernières années', 'Un accès aux ventilations, grilles et conduits de fumée', 'Le justificatif de condamnation, si l’installation a été supprimée' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'Le gaz en clair',
		'questions' => array(
			array( 'Quand le diagnostic est-il obligatoire ?', 'Dès que le logement comporte une installation intérieure de gaz de plus de quinze ans, pour la vente comme pour la mise en location. Peu importe que les appareils soient encore utilisés ou non.', 'Vérifier mes obligations', 'simulateur' ),
			array( 'Combien de temps est-il valable ?', 'Trois ans pour une vente, six ans pour une location. Un certificat de conformité récent délivré par un professionnel qualifié peut en tenir lieu dans certains cas.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Que se passe-t-il en cas de danger grave ?', 'Le code DGI impose l\'interruption immédiate de l\'alimentation en gaz. Je ferme l\'organe de coupure, j\'informe l\'occupant et le distributeur, et l\'installation ne peut être remise en service qu\'après réparation par un professionnel.', 'Poser une question sur mon rapport', 'contact' ),
			array( 'Ma cuisinière au gaz est-elle contrôlée ?', 'Oui, comme tout appareil raccordé de manière fixe ou par tuyau flexible : cuisinière, table de cuisson, chaudière, chauffe-eau, radiateur. Son raccordement, sa combustion et sa ventilation sont vérifiés.', 'Demander un devis gaz', '#rappel' ),
			array( 'Faut-il que le gaz soit ouvert ?', 'Oui. Sans mise en service, les essais d\'étanchéité et les mesures de combustion sont impossibles. Prévoyez aussi de l\'eau chaude et un accès à la chaudière.', 'Préparer ma visite', 'contact' ),
			array( 'J\'ai supprimé le gaz, dois-je le déclarer ?', 'Si l\'installation a été condamnée dans les règles — coupure, obturation, dépose des appareils — le diagnostic n\'est plus exigé. Gardez le justificatif de l\'entreprise qui est intervenue.', 'Le diagnostic électricité', 'electricite' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec le gaz',
		'cartes' => array(
			array( 'electricite', 'Électricité', 'Sécurité de l’installation intérieure de plus de 15 ans.' ),
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'plomb', 'Plomb (CREP)', 'Risque d’exposition au plomb dans les peintures d’avant 1949.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Besoin d\'un diagnostic gaz ?',
		'texte' => 'Donnez-moi le type de bien, le nombre d\'appareils au gaz et le motif : vous recevez un devis gratuit sous 24 heures. Groupé avec l\'électricité, il est nettement moins cher.',
	),
);
