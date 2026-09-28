<?php
/**
 * Fiche « Mesurage », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'Mesurage',
	'hero'     => array(
		'pastille'      => 'Carrez pour la vente en copropriété, Boutin pour la location',
		'titre'         => 'Mesurage Carrez & Boutin',
		'accent'        => 'la surface qui engage votre prix.',
		'chapeau'       => 'Une erreur de surface se paie cher : au-delà de 5 % d\'écart, l\'acquéreur d\'un lot de copropriété peut demander une réduction du prix proportionnelle, pendant un an après l\'acte. Le mesurage établit une surface opposable, relevé au télémètre laser et détaillé pièce par pièce.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration mesurage',
	),
	'reperes'  => array(
		array( '<rect x="3" y="8" width="18" height="8" rx="1"></rect><path d="M7 8v3M11 8v4M15 8v3M19 8v4"></path>', 'Laser', 'Relevé au télémètre, pièce par pièce' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', '30 min à 1 h', 'Durée moyenne sur place' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', 'Illimitée', 'Validité si aucun travaux' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path><path d="M9 13h6M9 17h4"></path>', '5 %', 'Seuil au-delà duquel le prix peut être réduit' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du mesurage',
			'titre'     => 'Deux surfaces, deux définitions',
			'texte'     => 'Carrez et Boutin ne mesurent pas la même chose. La première sert la vente en copropriété, la seconde la location vide à usage de résidence principale — et leurs règles d\'exclusion diffèrent.',
			'cartes'    => array(
				array( 'C', 'vert', 'Loi Carrez — vente', 'Surface privative d’un lot de copropriété : planchers clos et couverts de plus de 1,80 m, hors murs, cloisons, gaines et embrasures.' ),
				array( 'B', 'jaune', 'Loi Boutin — location', 'Surface habitable d’un logement loué vide en résidence principale : exclut en plus combles non aménagés, caves, garages et vérandas.' ),
				array( '≠', 'orange', 'Ce qui ne compte jamais', 'Terrasses, balcons, loggias ouvertes, cours, remises isolées et toute hauteur inférieure à 1,80 m.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je relève chez vous',
				'texte'    => 'Je mesure chaque pièce au télémètre laser, je déduis les surfaces non comptabilisées et je vous remets un détail par pièce, vérifiable.',
				'cartes'   => array(
					array( '<rect x="3" y="8" width="18" height="8" rx="1"></rect><path d="M7 8v3M11 8v4M15 8v3M19 8v4"></path>', 'Hauteur sous plafond', 'Repérage de la limite des 1,80 m sous rampants et sous poutres.' ),
					array( '<rect x="3" y="5" width="18" height="14" rx="1"></rect><path d="M3 12h18M9 5v7M15 12v7"></path>', 'Cloisons & embrasures', 'Déduction des murs, cloisons, marches, gaines et embrasures de portes.' ),
					array( '<path d="M3 11 12 4l9 7"></path><path d="M5 11v9h14v-9"></path><path d="M9 20v-5h6v5"></path>', 'Combles aménagés', 'Distinction entre comble habitable et volume non aménagé.' ),
					array( '<rect x="4" y="4" width="16" height="16" rx="1"></rect><path d="M12 4v16M4 12h16"></path>', 'Vérandas & loggias', 'Traitement selon la fermeture, le chauffage et la nature du plancher.' ),
					array( '<rect x="3" y="4" width="18" height="16" rx="1"></rect><path d="M3 12h18M9 4v16M15 4v16"></path>', 'Annexes exclues', 'Caves, garages, terrasses et remises, identifiés et sortis du calcul.' ),
					array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path><path d="M9 13h6M9 17h4"></path>', 'Détail par pièce', 'Un tableau pièce par pièce, vérifiable, annexé au rapport.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel mesurage dans votre situation ?',
			'cartes'   => array(
				array( 'Vente en copropriété', 'vert', 'Surface Carrez dans l’acte', 'La superficie privative doit figurer dans la promesse et dans l’acte de vente de tout lot de copropriété.' ),
				array( 'Location vide', 'jaune', 'Surface habitable au bail', 'La surface habitable Boutin doit être mentionnée dans le bail d’un logement vide loué en résidence principale.' ),
				array( 'Après travaux', 'orange', 'Nouveau mesurage', 'Toute modification des surfaces — cloison, véranda, combles — rend le mesurage précédent inexact et engage votre responsabilité.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Un écart de surface : et ensuite ?',
			'texte'       => 'Les conséquences d\'un écart ne sont pas symétriques : la loi protège l\'acquéreur, pas le vendeur.',
			'cartes'      => array(
				array( '1', 'vert', 'Écart inférieur à 5 %', 'Aucune conséquence : la tolérance légale absorbe les écarts mineurs de mesure.' ),
				array( '2', 'jaune', 'Écart supérieur à 5 %', 'L’acquéreur peut demander une réduction du prix proportionnelle à l’écart, pendant un an à compter de l’acte.' ),
				array( '3', 'orange', 'Surface réelle supérieure', 'Aucun supplément de prix ne peut être réclamé au bénéfice du vendeur. L’erreur ne joue jamais en sa faveur.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Cadrage par téléphone', 'Type de bien, nombre de pièces, motif : je détermine la mission Carrez ou Boutin et son prix.' ),
			array( '2', 'Devis gratuit sous 24 h', 'Prix ferme, tout compris. Souvent offert dans un dossier de vente complet.' ),
			array( '3', 'Le relevé sur place', 'Mesure au télémètre laser pièce par pièce, avec relevé des hauteurs et des déductions.' ),
			array( '4', 'Attestation remise', 'Attestation de surface avec détail par pièce, opposable et engageant ma responsabilité professionnelle.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces éléments me permettent d\'établir un mesurage exact et de justifier chaque déduction.',
			'liste' => array( 'Le règlement de copropriété et l’état descriptif de division', 'Les plans du logement, même anciens', 'Un accès à toutes les pièces, y compris annexes et combles', 'Les autorisations et factures des travaux ayant modifié les surfaces', 'Le dernier mesurage réalisé, s’il existe' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'Le mesurage en clair',
		'questions' => array(
			array( 'Le mesurage est-il obligatoire pour une maison ?', 'La loi Carrez ne s\'applique qu\'aux lots de copropriété. Pour une maison individuelle en pleine propriété, le mesurage n\'est pas obligatoire à la vente — mais il reste vivement conseillé pour sécuriser l\'annonce et le prix.', 'Vérifier mes obligations', 'simulateur' ),
			array( 'Quelle différence entre Carrez et Boutin ?', 'La surface Carrez compte les surfaces de plancher closes et couvertes de plus de 1,80 m de hauteur, hors murs et cloisons. La surface habitable Boutin exclut en plus les combles non aménagés, caves, garages, terrasses et vérandas non chauffées.', 'Vente ou location : les deux dossiers', 'diagnostics' ),
			array( 'Quelle est la durée de validité ?', 'Illimitée, tant qu\'aucun travaux ne modifie les surfaces. Une cloison abattue, une véranda fermée ou des combles aménagés imposent un nouveau mesurage.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Que se passe-t-il en cas d\'erreur ?', 'Si la surface réelle est inférieure de plus de 5 % à celle annoncée, l\'acquéreur peut demander une diminution du prix proportionnelle à l\'écart, pendant un an à compter de l\'acte. Si elle est supérieure, le vendeur ne peut réclamer aucun supplément.', 'Faire vérifier une surface', 'contact' ),
			array( 'Les combles aménagés comptent-ils ?', 'En Carrez, oui, pour les parties dont la hauteur dépasse 1,80 m, à condition que le plancher soit clos et couvert. En Boutin, seuls les combles aménagés en pièces habitables sont comptés.', 'Demander un devis mesurage', '#rappel' ),
			array( 'Puis-je faire le mesurage moi-même ?', 'Rien ne l\'interdit pour la vente, mais vous en assumez seul la responsabilité. Un mesurage réalisé par un professionnel assuré transfère cette responsabilité et rassure l\'acquéreur comme le notaire.', 'Mes certifications', 'qui' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec le mesurage',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'electricite', 'Électricité', 'Sécurité de l’installation intérieure de plus de 15 ans.' ),
			array( 'erp', 'ERP', 'Risques naturels, miniers et technologiques de la commune.' ),
		),
	),
	'rappel'   => array(
		'options' => array( 'haut' ),
		'titre' => 'Besoin d\'un mesurage ?',
		'texte' => 'Donnez-moi le type de bien, le nombre de pièces et le motif : vous recevez un devis gratuit sous 24 heures, avec un détail de surface par pièce dans le rapport.',
	),
);
