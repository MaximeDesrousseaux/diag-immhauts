<?php
/**
 * Contenus de l'accueil, relevés sur « Diag Imm'Hauts - Accueil.dc.html ».
 *
 * Valeurs par défaut : les blocs ACF de l'étape 5 les remplaceront section par
 * section via le filtre dih_contenu (voir inc/contenus.php).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero'         => array(
		'pastille'       => 'Diagnostiqueur indépendant certifié',
		'titre'          => 'Des diagnostics fiables,',
		'titre_accent'   => "partout dans l'Artois.",
		'titre_mobile'   => 'un interlocuteur unique.', // 2e ligne du titre sur téléphone
		'chapeau'        => 'Vente, location, copropriétés ou audit énergétique : Maxime Dillies réalise lui-même les douze diagnostics. Un seul interlocuteur, avec rigueur, réactivité et pédagogie.',
		'cta'            => 'Demande de rappel',
		'cta_2'          => 'Découvrir mes prestations',
		'cta_2_court'    => 'Mes prestations', // déplié (VERROUILLÉ)
		'avis_mobile'    => '5,0 · 12 avis · certifié Bureau Veritas',
		'chiffres'       => array(
			array( '8 ans', "d'expérience terrain" ),
			array( '48 h', 'délai moyen de rendez-vous' ),
			array( '100 %', 'certifié & assuré' ),
		),
		'carte_titre'    => 'Rappel gratuit',
		'carte_delai'    => 'Réponse sous 24 h',
		// Barre de rappel (variantes terrils-barre et max-bandeau)
		'barre_titre'    => 'Rappel gratuit sous 24 h',
		'barre_lien'     => 'Besoin d\'un devis détaillé ?', // max-bandeau seulement
		'photo_alt'      => 'Maxime Dillies au téléphone', // max-bandeau
		// Textes propres à une variante (réglage hero_accueil), fusionnés sur les précédents.
		'variantes'      => array(
			'max-bandeau' => array(
				'titre_accent' => 'un interlocuteur unique.',
				'chapeau'      => 'Vente, location, copropriétés ou audit énergétique : Maxime Dillies vous accompagne partout dans l\'Artois, avec rigueur, réactivité et pédagogie.',
			),
			'sansBG'      => array(
				'titre_accent' => 'un interlocuteur unique.',
				'chapeau'      => 'Vente, location, copropriétés ou audit énergétique : Maxime Dillies vous accompagne partout dans l\'Artois et les Hauts-de-France, avec rigueur, réactivité et pédagogie.',
			),
		),
	),

	'confiance'    => array(
		array( 'bouclier', 'Certifié Bureau Veritas', 'Certifications à jour · tous domaines' ),
		array( 'medaille', 'Assurance RC Pro', 'Interventions couvertes & garanties' ),
		array( 'repere', "Ancré dans l'Artois", 'Un artisan local, disponible' ),
	),

	'une'          => array(
		'surtitre'     => 'À la une',
		'illustration' => 'ill_article_coefficient_elec.webp',
		'legende'      => "Coefficient de l'électricité",
		'avant'        => '2,3',
		'apres'        => '1,9',
		'note'         => 'Dans le calcul du DPE depuis le 1<sup>er</sup> janvier 2026. Il descendra à 1,7 en 2027.',
		'etiquette'    => 'Nouveau · réforme du DPE 2026',
		'titre'        => 'Votre logement chauffé à l\'électricité a <span class="l-insecable">peut-être</span> gagné une classe.',
		'texte'        => "Environ 850 000 logements sont sortis du statut de passoire thermique sans le moindre travaux. Si votre DPE date d'avant 2026, une attestation de nouvelle étiquette est gratuite : je vous dis en cinq minutes si votre bien est concerné et ce que ça change pour votre vente ou votre location.",
		'cta'          => 'Vérifier mon étiquette',
		'lien'         => 'Comprendre la réforme',
		'lien_url'     => array( 'actualites', 'reforme-dpe-2026' ), // article du journal (étape 4)
	),

	'prestations'  => array(
		'surtitre' => 'Nos prestations',
		'titre'    => 'Un accompagnement pour chaque projet immobilier',
		'texte'    => "Quatre pôles d'expertise, une même exigence : des rapports clairs, conformes et rendus dans les délais.",
		'cards'    => array(
			array(
				'teinte' => 'foret',
				'num'    => '01',
				'tag'    => 'Particuliers',
				'titre'  => 'Vente & location',
				'texte'  => 'DPE, amiante, plomb, électricité, gaz, ERP, mesurage… Le Dossier de Diagnostic Technique complet, prêt pour votre notaire ou votre bail.',
				'lien'   => 'diagnostics',
				'image'  => 'ill_item_location-b693f583.webp',
			),
			array(
				'teinte' => 'vert',
				'num'    => '02',
				'tag'    => 'Pros',
				'titre'  => 'Copropriétés & collectivités',
				'texte'  => 'Diagnostic technique global (DTG), amiante des parties communes, accompagnement des syndics et bailleurs sociaux sur l’ensemble du parc.',
				'lien'   => 'dtg',
				'image'  => 'ill_syndic_ssfond.webp',
			),
			array(
				'teinte' => 'pale',
				'num'    => '03',
				'tag'    => 'Réglementaire',
				'titre'  => 'Audits énergétiques',
				'texte'  => 'Audit énergétique réglementaire pour les biens classés E, F ou G, avec scénarios de travaux chiffrés et priorisés.',
				'lien'   => 'audit',
				'image'  => 'diag_audit.webp',
			),
			array(
				'teinte' => 'blanc',
				'num'    => '04',
				'tag'    => 'Sur-mesure',
				'titre'  => 'Conseil & pédagogie',
				'texte'  => 'Lecture claire de vos rapports, réponses à vos questions et recommandations concrètes pour valoriser et sécuriser votre bien.',
				'lien'   => 'qui',
				'image'  => 'ill_conseil_ssfond.webp',
			),
		),
	),

	'detail'       => array(
		'surtitre' => 'Le détail',
		'titre'    => 'Tous les diagnostics obligatoires, réunis dans un seul dossier',
		'cta'      => 'Vérifier mon bien',
		// libellé, clé de page (illustration : dih_illus_diagnostic(), jeu normalisé v10)
		'tuiles'   => array(
			array( 'DPE', 'dpe' ),
			array( 'Amiante', 'amiante' ),
			array( 'Plomb (CREP)', 'plomb' ),
			array( 'Électricité', 'electricite' ),
			array( 'Gaz', 'gaz' ),
			array( 'Termites', 'termites' ),
			array( 'État des risques (ERP)', 'erp' ),
			array( 'Loi Carrez', 'mesurage' ),
			array( 'Loi Boutin', 'mesurage' ),
			array( 'Assainis&shy;sement', 'assainissement' ),
			array( 'Mérule', 'merule' ),
			array( 'Audit énergétique', 'audit' ),
		),
	),

	'expert'       => array(
		'photo'     => 'Maxime_Dillies_pp.webp',
		'photo_alt' => 'Maxime Dillies, diagnostiqueur immobilier certifié',
		'nom'       => 'Maxime Dillies',
		'role'      => 'Fondateur & diagnostiqueur certifié',
		'surtitre'  => 'Qui suis-je ?',
		'titre'     => 'Un diagnostiqueur indépendant, pas un simple prestataire',
		'texte'     => "Installé au cœur du Pas-de-Calais, j'ai fondé Diag Imm'Hauts pour offrir aux particuliers, agences et collectivités un diagnostic à la fois rigoureux et humain. Chaque intervention, je la mène moi-même : vous avez un interlocuteur unique, joignable, qui prend le temps d'expliquer.",
		'valeurs'   => array(
			array( 'bulle', 'Interlocuteur unique', 'Vous parlez directement à celui qui intervient.' ),
			array( 'horloge', 'Réactivité', 'Rendez-vous rapides, rapports dans les délais.' ),
			array( 'medaille', 'Certifié & assuré', 'Certifications Bureau Veritas à jour, RC Pro.' ),
			array( 'feuille', 'Pédagogie', 'Des rapports clairs, expliqués sans jargon.' ),
		),
		'lien'      => 'Découvrir mon parcours',
	),

	'zones'        => array(
		'surtitre'     => 'Zones desservies',
		'titre'        => "Présent dans tout l'Artois & les Hauts-de-France",
		'texte'        => "D'Arras à Lens en passant par Saint-Pol-sur-Ternoise, je me déplace dans les communes moyennes et grandes de la région. Vérifiez en un instant si votre commune est desservie.",
		'cta'          => 'Vérifier ma commune',
		'illustration' => 'ill_terrils_et_village.webp',
		'illus_alt'    => "Village de l'Artois au pied des terrils",
		'note'         => 'Déplacement inclus dans tout le Pas-de-Calais (62). Nord (59) et Somme (80) sur demande.',
		'communes_titre' => 'Communes desservies',
		'communes'     => array( 'Arras', 'Lens', 'Liévin', 'Béthune', 'Saint-Pol-sur-Ternoise', 'Aubigny-en-Artois', 'Avesnes-le-Comte', 'Tincques', 'Savy-Berlette', 'Houdain', 'Bruay-la-Buissière', 'Auchel', 'Aire-sur-la-Lys', 'Saint-Omer', 'Béthonsart', 'Izel-lès-Hameau', 'Rivière', 'Penin', 'Villers-Brûlin', 'Camblain-Châtelain', 'Écurie', 'Gauchin-Verloingt', 'Houchin', 'Huclier', 'Humbercourt', 'Ivergny', 'La Cauchie', 'Marest', 'Mingoval', 'Ramecourt', 'Rebreuve-sur-Canche', 'Rebreuviette', 'Berles-Monchel', 'Douai', 'Cambrai', 'Hénin-Beaumont', 'Carvin' ),
	),

	// Avis repris de la maquette : à remplacer par les avis Google réels avant la mise en ligne.
	'avis'         => array(
		'surtitre' => 'Avis clients',
		'titre'    => "Ils m'ont fait confiance",
		'note'     => '5,0',
		'nombre'   => '12 avis Google vérifiés',
		'liste'    => array(
			array( 'Intervention rapide et très professionnelle. Maxime a pris le temps de tout m’expliquer, rapport reçu le lendemain. Je recommande vivement.', 'Julie L.', 'Arras' ),
			array( 'Parfait pour la vente de notre maison. Ponctuel, minutieux et de très bon conseil sur le DPE. Un vrai pro, accessible et humain.', 'Thomas D.', 'Lens' ),
			array( 'Nous avons fait appel à lui pour notre copropriété. Sérieux, réactif et pédagogue avec le conseil syndical. Rien à redire.', 'Sophie M.', 'Béthune' ),
			array( 'Rendez‑vous pris le matin, visite le surlendemain. Les rapports étaient limpides, avec des explications sur chaque point relevé.', 'Karim B.', 'Liévin' ),
			array( 'J’ai fait faire le DPE et l’audit ensemble avant la mise en vente. Bon conseil sur l’ordre des travaux, prix très correct.', 'Émilie R.', 'Saint‑Pol‑sur‑Ternoise' ),
		),
	),

	'faq'          => array(
		'surtitre' => 'Infos & FAQ',
		'titre'    => 'Vos questions sur le diagnostic immobilier',
		// question, réponse, libellé du lien, cible (clé de page ou #ancre)
		'questions' => array(
			array( 'Quels diagnostics sont obligatoires pour vendre mon bien ?', 'Cela dépend de l’âge et de la localisation du logement : DPE, amiante (avant 1997), plomb (avant 1949), électricité et gaz (installations de plus de 15 ans), ERP, mesurage loi Carrez en copropriété… Je constitue pour vous le Dossier de Diagnostic Technique complet annexé à la promesse de vente.', 'Tester mon bien avec le simulateur', 'simulateur' ),
			array( 'Combien de temps un DPE reste-t-il valide ?', 'Un DPE est valable 10 ans. Attention : les DPE réalisés entre le 1er janvier 2018 et le 30 juin 2021 ne sont plus valides depuis le 1er janvier 2025. Un audit énergétique est par ailleurs requis pour les biens classés E, F ou G à la vente.', 'Tout savoir sur le DPE', 'dpe' ),
			array( 'Sous quel délai intervenez-vous ?', 'J’interviens généralement sous 48 heures, souvent plus vite en cas d’urgence. Le devis, lui, vous est communiqué gratuitement sous 24 heures après votre demande de rappel.', 'Demander un devis gratuit', 'contact' ),
			array( 'Dans quelles communes vous déplacez-vous ?', 'Je couvre l’Artois et une large partie des Hauts-de-France : Arras, Lens, Béthune, Saint-Pol-sur-Ternoise et de nombreuses communes alentour. Si votre ville n’apparaît pas, appelez-moi : j’interviens très probablement chez vous.', 'Voir la carte des zones desservies', '#zones' ),
			array( 'Vos diagnostics sont-ils certifiés et assurés ?', 'Oui. Je suis diagnostiqueur certifié (Bureau Veritas) sur l’ensemble des domaines et couvert par une assurance responsabilité civile professionnelle. Vos rapports sont opposables et reconnus par les notaires et agences.', 'Mon parcours et mes certifications', 'qui' ),
		),
	),

	'rappel'       => array(
		'titre'  => 'Un projet de vente, de location ou un audit ?',
		'texte'  => 'Parlons-en. Décrivez-moi votre bien et recevez un devis gratuit, clair et sans engagement — généralement sous 24 heures.',
		'cta_2'  => 'Demande de rappel gratuit',
		'photo'  => 'maxime_tel.webp',
		'photo_alt' => 'Maxime Dillies au téléphone',
	),
);
