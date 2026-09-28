<?php
/**
 * Fiche « DPE », relevée sur DPE.dc.html (page de référence du gabarit
 * « Fiche diagnostic » et du bloc 4 étapes).
 *
 * Structure commune aux 12 fiches : hero, repères, sessions (liste ordonnée de
 * blocs typés), 4 étapes + préparation, FAQ, diagnostics liés, rappel.
 * Le bloc ACF « Fiche diagnostic » (étape 5) reprendra ces champs à l'identique.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'DPE', // fil d'Ariane
	'hero'     => array(
		'pastille'     => 'Obligatoire pour toute vente et toute location',
		'titre'        => 'Diagnostic de performance énergétique',
		'accent'       => 'le DPE, de A à G.',
		'chapeau'      => "Le DPE mesure la consommation énergétique et les émissions de gaz à effet de serre de votre logement, et vous situe sur une échelle de A à G. C'est la pièce maîtresse du dossier de diagnostic technique : il conditionne votre annonce, votre prix et, selon la classe, l'obligation d'audit énergétique.",
		'cta'          => 'Demander un devis gratuit',
		'cta_2'        => array( 'Vérifier mes obligations', 'simulateur' ),
		'illustration' => 'ill_dpe_v6.webp',
		'illus_alt'    => 'Illustration dpe',
		// largeur de l'illustration : bureau, déplié, téléphone
		'illus_tailles' => array( '205px', '180px', '72%' ),
	),

	'reperes'  => array(
		array( 'calendrier', '10 ans', 'Durée de validité du rapport' ),
		array( 'horloge', '1 à 2 h', 'Durée moyenne sur place' ),
		array( 'document', '48 h', 'Délai de remise du rapport' ),
		array( 'jauge', '2 étiquettes', 'Énergie et climat, de A à G' ),
	),

	'sessions' => array(
		array(
			'type'      => 'etiquette',
			'surtitre'  => 'Le résultat',
			'titre'     => 'Votre logement classé de A à G',
			'texte'     => "Deux étiquettes sont délivrées : la performance énergétique (kWh/m²/an) et l'impact climat (kg CO₂/m²/an). Chacune classe le logement sur sept niveaux, de <strong>A</strong> pour les plus sobres à <strong>G</strong> pour les passoires thermiques — et c'est la plus défavorable des deux qui fait la classe finale affichée dans votre annonce.",
			'image'     => 'ill_jauge_texte_det.webp',
			'image_alt' => 'Étiquette énergie à sept classes, de A « très performant » à G « très énergivore »',
			'releves'   => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je relève chez vous',
				'texte'    => 'Le DPE repose sur les caractéristiques réelles du bâti, relevées et justifiées pièce par pièce — pas sur vos factures.',
				// illustration, transformation (réglée à l'œil), titre, texte
				'cartes'   => array(
					array( 'ill_mur_det.webp', 'scale(.9)', 'Murs & isolation', 'Nature des parois, épaisseur, isolation rapportée et ponts thermiques.' ),
					array( 'ill_menuiserie_det.webp', 'scaleX(-1) scale(.79)', 'Menuiseries', 'Type de vitrage, matériau des châssis, orientation et masques solaires.' ),
					array( 'ill_radiateur_det.webp', 'none', 'Chauffage', 'Générateur, émetteurs, régulation et système de distribution.' ),
					array( 'ill_eauchaude_det.webp', 'scaleX(-1) scale(.88, .792)', 'Eau chaude', 'Mode de production, stockage et déperditions du réseau.' ),
					array( 'ill_ventilation_det.webp', 'scale(1.1)', 'Ventilation', 'Type de VMC ou ventilation naturelle et état des entrées d’air.' ),
					array( 'ill_solaire_det.webp', 'scale(1.14)', 'Énergies renouvelables', 'Panneaux solaires, pompe à chaleur, poêle bois et contribution.' ),
				),
			),
		),
		array(
			'type'      => 'reforme',
			'id'        => 'reforme-2026',
			'etiquette' => 'Réforme du 1<sup>er</sup> janvier 2026',
			'source'    => 'Arrêté du 13 août 2025',
			'titre'     => "L'électricité compte différemment dans le calcul : 850 000 logements ont quitté le statut de passoire sans travaux.",
			'texte'     => "Pour obtenir la consommation en énergie primaire, le DPE multiplie les kilowattheures consommés par un coefficient de conversion. Il pénalisait le chauffage électrique : il est passé à 1,9 au 1<sup>er</sup> janvier 2026 et descendra à 1,7 au 1<sup>er</sup> janvier 2027. Conséquence directe : un logement tout électrique classé F ou G de justesse peut remonter d'une classe — et redevenir louable.",
			// valeur, légende, état : passe | actuel | futur
			'valeurs'   => array(
				array( '2,58', "jusqu'en 2022", 'passe' ),
				array( '2,3', 'de 2022 à 2025', 'passe' ),
				array( '1,9', 'depuis le 1<sup>er</sup> janvier 2026', 'actuel' ),
				array( '1,7', 'au 1<sup>er</sup> janvier 2027', 'futur' ),
			),
			'notes'     => array(
				array( 'Votre DPE reste valable.', 'Aucune étiquette ne baisse avec la réforme, et les DPE réalisés avant 2026 conservent leurs dix ans de validité.' ),
				array( "L'attestation est gratuite.", "Si le nouveau coefficient change votre classement, une attestation de nouvelle étiquette s'obtient sur le site de l'ADEME, sans nouvelle visite." ),
			),
			'cta'       => 'Faire le point sur mon étiquette',
			'lien'      => array( "Et pour l'audit énergétique", 'audit' ),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Ce que la classe de votre DPE change pour vous',
			// pastille, teinte de la pastille, titre, texte
			'cartes'   => array(
				array( 'Classes A à D', 'vert', 'Aucune contrainte particulière', 'Votre DPE est simplement annexé au dossier de vente ou au bail. La classe reste un argument commercial fort dans l’annonce.' ),
				array( 'Classe E', 'dpe-e', 'Audit énergétique à la vente', 'L’audit énergétique devient obligatoire à la vente des maisons et immeubles en monopropriété classés E, avec scénarios de travaux chiffrés.' ),
				array( 'Classes F et G', 'dpe-f', 'Passoire thermique', 'Audit énergétique obligatoire à la vente, interdiction progressive de mise en location et gel du loyer en cas de relocation.' ),
			),
		),
	),

	'etapes'   => array(
		'variante'    => 'integree', // DPE : sur fond blanc, préparation intégrée
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		// numéro, titre, texte (pictos : ill_stb_tel / cal / maison / rapport)
		'liste'       => array(
			array( '01', 'Votre appel', 'Type de bien, surface, année et commune. Je vous confirme le tarif et les diagnostics à joindre.' ),
			array( '02', 'Devis sous 24 h', 'Un devis forfaitaire et clair, sans engagement, envoyé par e-mail.' ),
			array( '03', 'La visite', '1 à 2 h sur place. J’ai besoin d’accéder aux combles, à la chaudière et à toutes les pièces.' ),
			array( '04', 'Votre rapport', 'Rapport numérique sous 48 h, avec le numéro ADEME à reporter dans votre annonce.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => "Ces documents me permettent de justifier les caractéristiques du bâti et d'éviter les valeurs par défaut, souvent pénalisantes.",
			'liste' => array(
				'Les anciens diagnostics et l’ancien DPE s’il existe',
				'Les factures de travaux d’isolation ou de chauffage',
				'Les plans du logement et la surface habitable',
				'La date de construction ou le permis de construire',
				'Les notices des équipements de chauffage et de ventilation',
			),
		),
	),

	'faq'      => array(
		'variante'  => 'transparente',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'Le DPE en clair',
		'questions' => array(
			array( 'Mon logement chauffé à l’électricité peut-il gagner une classe sans travaux ?', 'Oui, c’est l’effet de la réforme du 1ᵉʳ janvier 2026 : le coefficient de conversion de l’électricité est passé de 2,3 à 1,9, et descendra à 1,7 au 1ᵉʳ janvier 2027. Environ 850 000 logements sont sortis du statut de passoire thermique sans le moindre travaux. Aucune étiquette ne baisse, et si votre classement change, l’attestation de nouvelle étiquette est gratuite sur le site de l’ADEME, sans nouvelle visite.', 'Faire le point sur mon étiquette', '#rappel' ),
			array( 'Le DPE est-il obligatoire pour une location ?', 'Oui. Le DPE doit être annexé au bail et sa classe figurer dans l’annonce, comme pour une vente. Les logements classés G ne peuvent plus être proposés à la location depuis le 1er janvier 2025 ; l’interdiction s’étendra aux classes F au 1er janvier 2028, puis E au 1er janvier 2034. Un audit énergétique permet de chiffrer les travaux à engager.', 'Tous les diagnostics de location', 'diagnostics' ),
			array( 'Mon ancien DPE est-il encore valable ?', 'Un DPE est valable 10 ans. En revanche, les DPE réalisés entre le 1ᵉʳ janvier 2018 et le 30 juin 2021 ne sont plus valides depuis le 1ᵉʳ janvier 2025 et doivent être refaits selon la méthode actuelle.', "Vérifier ce dont j'ai besoin", 'simulateur' ),
			array( 'Pourquoi ma classe est-elle plus mauvaise qu’attendu ?', 'Le DPE est calculé sur les caractéristiques du bâti, pas sur votre consommation réelle. En l’absence de justificatif (facture de travaux, notice de chaudière), la méthode impose des valeurs par défaut pénalisantes : rassembler vos documents avant la visite change souvent la classe finale.', "Comprendre l'audit énergétique", 'audit' ),
			array( 'Puis-je contester ou faire refaire mon DPE ?', 'Oui, et c’est fréquent lorsque des travaux n’ont pas pu être justifiés. Je reprends volontiers l’analyse d’un DPE établi par un confrère et vous explique précisément ce qui pèse sur la note.', 'Demander un devis pour un nouveau DPE', '#rappel' ),
			array( 'Que contient le numéro ADEME ?', 'Chaque DPE est enregistré dans la base nationale de l’ADEME et reçoit un numéro à 13 caractères, obligatoire dans toute annonce immobilière. Il permet à l’acquéreur ou au locataire de vérifier l’authenticité du rapport.', 'Nous contacter pour retrouver mon numéro', 'contact' ),
		),
	),

	'lies'     => array(
		'variante' => 'grand',
		'titre'  => 'Souvent réalisés avec le DPE',
		// clé de page, titre, texte (illustration : dih_illus_diagnostic())
		'cartes' => array(
			array( 'audit', 'Audit énergétique', 'Obligatoire à la vente pour les classes E, F et G.' ),
			array( 'amiante', 'Amiante', 'Pour les biens dont le permis est antérieur à juillet 1997.' ),
			array( 'electricite', 'Électricité', 'Pour toute installation de plus de 15 ans.' ),
			array( 'mesurage', 'Mesurage', 'Loi Carrez à la vente, loi Boutin en location.' ),
		),
	),

	'rappel'   => array(
		'boutons' => 'obligations', // « Demander un devis gratuit » + « Vérifier mes obligations »
		'titre' => "Besoin d'un DPE pour votre bien ?",
		'texte' => 'Donnez-moi le type de bien, sa surface et sa commune : vous recevez un devis gratuit sous 24 heures et un rendez-vous sous 48 heures en moyenne.',
	),
);
