<?php
/**
 * Fiche « ERP », extraite de la maquette (textes à la lettre).
 * Structure : voir fiche-dpe.php.
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'nom'      => 'ERP',
	'hero'     => array(
		'pastille'      => 'Exigé pour toute vente et toute location, partout en France',
		'titre'         => 'État des risques et pollutions',
		'accent'        => 'ce que le sol et l\'histoire imposent.',
		'chapeau'       => 'L\'ERP informe l\'acquéreur ou le locataire des risques auxquels le bien est exposé : inondation, aléa minier, risque technologique, sismicité, radon, pollution des sols. Dans le Pas-de-Calais, l\'aléa minier et le retrait-gonflement des argiles concernent une grande partie des communes.',
		'cta'           => 'Demander un devis gratuit',
		'cta_2'         => array( 'Vérifier mes obligations', 'simulateur' ),
		'illus_alt'     => 'Illustration erp',
	),
	'reperes'  => array(
		array( '<rect x="4" y="5" width="16" height="16" rx="2"></rect><path d="M8 3v4M16 3v4M4 11h16"></path>', 'Toute la France', 'Vente et location, sans exception' ),
		array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path>', 'Sous 24 h', 'Délai de production du document' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', '6 mois', 'Durée de validité' ),
		array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path><path d="M9 13h6M9 17h4"></path>', 'Dès l’annonce', 'Obligatoire depuis la loi Climat' ),
	),
	'sessions' => array(
		array(
			'type'      => 'cadre',
			'surtitre'  => 'Le cadre du document',
			'titre'     => 'Trois familles de risques à déclarer',
			'texte'     => 'L\'ERP compile les zonages officiels applicables à la parcelle, les arrêtés de catastrophe naturelle et les sinistres indemnisés déclarés par le vendeur.',
			'cartes'    => array(
				array( 'N', 'vert', 'Risques naturels', 'Inondation, retrait-gonflement des argiles, mouvements de terrain, sismicité et arrêtés de catastrophe naturelle.' ),
				array( 'M', 'jaune', 'Risques miniers & technologiques', 'Aléa minier hérité de l’exploitation charbonnière, plans de prévention des risques technologiques et sites industriels.' ),
				array( 'P', 'orange', 'Pollutions & radon', 'Secteurs d’information sur les sols, anciens sites industriels répertoriés et potentiel radon de la commune.' ),
			),
			'sur_place' => array(
				'surtitre' => 'Sur place',
				'titre'    => 'Ce que je vérifie pour votre parcelle',
				'texte'    => 'Je consulte les zonages en vigueur à la date de l\'établissement du document, parcelle par parcelle, et je joins les extraits cartographiques correspondants.',
				'cartes'   => array(
					array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path><path d="M9 13h6M9 17h4"></path>', 'Plans de prévention', 'PPRN, PPRM et PPRT applicables à la parcelle, avec extraits de zonage.' ),
					array( '<path d="M4 8h8a4 4 0 0 1 4 4v8"></path><path d="M2 6h4v4H2zM14 20h4v-4h-4"></path>', 'Aléa minier', 'Zonages d’affaissement, d’effondrement et de remontée de nappe du bassin minier.' ),
					array( '<circle cx="12" cy="12" r="8"></circle><path d="M12 12 15.5 9"></path><path d="M12 6v1M18 12h-1M6 12h1"></path>', 'Sismicité & radon', 'Zone de sismicité de la commune et potentiel radon sur une échelle de 1 à 3.' ),
					array( '<path d="m12 3 8 4.5-8 4.5-8-4.5z"></path><path d="m4 12.5 8 4.5 8-4.5"></path><path d="m4 17 8 4.5 8-4.5"></path>', 'Argiles', 'Exposition au retrait-gonflement des sols argileux, très présente dans l’Artois.' ),
					array( '<path d="M9 3h6M10 3v6l-5 9a2 2 0 0 0 1.8 3h10.4a2 2 0 0 0 1.8-3l-5-9V3"></path><path d="M7.5 15h9"></path>', 'Pollution des sols', 'Secteurs d’information sur les sols et anciens sites industriels à proximité.' ),
					array( '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"></path><path d="M14 3v5h5"></path>', 'Sinistres indemnisés', 'Partie déclarative : sinistres passés indemnisés au titre d’une catastrophe reconnue.' ),
				),
			),
		),
		array(
			'type'     => 'obligations',
			'surtitre' => 'Vos obligations',
			'titre'    => 'Quel ERP dans votre situation ?',
			'cartes'   => array(
				array( 'Vente', 'vert', 'ERP annexé et remis tôt', 'Annexé à la promesse et à l’acte, et remis dès la première visite. L’information doit aussi figurer dans l’annonce.' ),
				array( 'Location', 'jaune', 'ERP annexé au bail', 'Le locataire reçoit le document avec son bail, y compris pour un renouvellement dans certains cas.' ),
				array( 'Zone de plan de prévention', 'orange', 'Travaux parfois prescrits', 'Certains PPR imposent des travaux de réduction de vulnérabilité au propriétaire, dans un délai et un plafond de coût définis.' ),
			),
		),
		array(
			'type'        => 'resultat',
			'disposition' => 'liste',
			'surtitre'    => 'Le résultat',
			'titre'       => 'Un risque identifié : et ensuite ?',
			'texte'       => 'Être en zone de risque n\'empêche pas de vendre ou de louer. Ce sont l\'information et, parfois, des travaux prescrits par un plan de prévention qui s\'imposent.',
			'cartes'      => array(
				array( '1', 'vert', 'Information seule', 'Le bien est exposé mais aucun travaux n’est prescrit. Le document informe simplement l’acquéreur ou le locataire.' ),
				array( '2', 'jaune', 'Mention obligatoire à l’annonce', 'L’exposition doit figurer dans l’annonce et l’ERP être remis dès la première visite, sous peine de nullité invocable.' ),
				array( '3', 'orange', 'Travaux prescrits par un PPR', 'Le plan de prévention impose des mesures de réduction de vulnérabilité, à réaliser dans le délai qu’il fixe.' ),
			),
		),
	),
	'etapes'   => array(
		'variante'    => 'standard',
		'surtitre'    => 'Comment ça se passe',
		'titre'       => 'De votre appel au rapport, en 4 étapes',
		'liste'       => array(
			array( '1', 'Adresse & cadastre', 'Je récupère la parcelle exacte : les zonages s’arrêtent parfois au milieu d’une rue.' ),
			array( '2', 'Consultation des zonages', 'Plans de prévention, aléa minier, sismicité, radon, sols pollués et arrêtés de catastrophe.' ),
			array( '3', 'Partie déclarative', 'Nous complétons ensemble les sinistres indemnisés et les travaux prescrits déjà réalisés.' ),
			array( '4', 'Document remis sous 24 h', 'ERP daté et signé, avec extraits cartographiques, prêt pour l’annonce, la promesse ou le bail.' ),
		),
		'preparation' => array(
			'titre' => 'À préparer avant ma visite',
			'texte' => 'Ces éléments me permettent d\'établir un document exact et de renseigner la partie déclarative.',
			'liste' => array( 'L’adresse exacte et la référence cadastrale du bien', 'Les indemnisations perçues au titre d’une catastrophe naturelle', 'Les ERP et documents d’urbanisme antérieurs', 'Le titre de propriété, s’il mentionne des servitudes', 'Les travaux déjà réalisés au titre d’un plan de prévention' ),
		),
	),
	'faq'      => array(
		'variante'  => 'blanche',
		'surtitre'  => 'Questions fréquentes',
		'titre'     => 'L\'ERP en clair',
		'questions' => array(
			array( 'L\'ERP est-il obligatoire partout ?', 'Oui, pour toute vente et toute location de bien immobilier en France, quelle que soit la commune. Son contenu, lui, varie selon les zonages applicables à la parcelle.', 'Le dossier de diagnostic technique', 'diagnostics' ),
			array( 'Quelle est sa durée de validité ?', 'Six mois. Comme les zonages et les arrêtés évoluent, un ERP trop ancien doit être refait avant la signature.', 'Toutes les durées de validité', 'diagnostics' ),
			array( 'Que change la loi Climat pour l\'annonce ?', 'L\'information sur l\'exposition aux risques doit désormais figurer dès l\'annonce immobilière, et l\'ERP être remis dès la première visite. Ce n\'est plus un document que l\'on produit à la dernière minute.', 'Vérifier mes obligations d\'annonce', 'simulateur' ),
			array( 'Qu\'est-ce que l\'aléa minier ?', 'L\'héritage de l\'exploitation charbonnière : affaissements, effondrements localisés, remontées de nappe. Une grande partie du bassin minier du Pas-de-Calais est concernée, avec des zonages précis par secteur.', 'Poser une question sur ma commune', 'contact' ),
			array( 'Le radon fait-il partie de l\'ERP ?', 'Oui, le potentiel radon de la commune y figure, sur une échelle de 1 à 3. En zone 3, une mesure dans le logement est recommandée, sans être obligatoire pour la vente.', 'Demander une mesure radon', 'contact' ),
			array( 'Dois-je déclarer les sinistres passés ?', 'Oui. Les sinistres ayant donné lieu à une indemnisation au titre d\'une catastrophe naturelle ou technologique doivent être déclarés par le vendeur ou le bailleur, et sont annexés à l\'ERP.', 'Faire établir mon ERP', '#rappel' ),
		),
	),
	'lies'     => array(
		'titre'  => 'Souvent réalisés avec l\'ERP',
		'cartes' => array(
			array( 'dpe', 'DPE', 'Classe énergie et climat du logement, de A à G.' ),
			array( 'amiante', 'Amiante', 'Recherche des matériaux amiantés dans le bâti d’avant 1997.' ),
			array( 'termites', 'Termites', 'Recherche de termites dans les communes sous arrêté.' ),
			array( 'assainissement', 'Assainissement', 'Conformité de l’assainissement non collectif.' ),
		),
	),
	'rappel'   => array(
		'titre' => 'Besoin d\'un ERP ?',
		'texte' => 'Donnez-moi l\'adresse exacte et la référence cadastrale : l\'ERP est le document le plus rapide à produire, et il est inclus sans supplément dans la plupart de mes dossiers de vente.',
	),
);
