<?php
/**
 * Balises SEO des 22 pages (inc/seo.php), reprises à la lettre des blocs
 * <!-- seo --> des maquettes : titre, description, og:title et og:description
 * quand ils diffèrent, og:type des articles, JSON-LD LocalBusiness de l'accueil.
 * Clés : celles de dih_chemins() ; articles : 'article:<slug>'.
 * Communs à toutes les pages (inc/seo.php) : canonique, og:url, og:locale,
 * og:site_name, twitter:card, directive robots.
 * {telephone} dans une description : le numéro de dih_info() (maquettes : 06 35 88 43 00).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

return array(
	'accueil'                                      => array(
		'titre'       => 'Diagnostics immobiliers Arras, Lens, Béthune — Diag Imm\'Hauts',
		'description' => 'Diagnostiqueur certifié Bureau Veritas dans l\'Artois : DPE, amiante, plomb, électricité, gaz. Devis gratuit sous 24 h, rendez-vous sous 48 h. {telephone}.',
		'jsonld'      => array(
			'@context'                  => 'https://schema.org',
			'@type'                     => array(
				'LocalBusiness',
				'ProfessionalService',
			),
			'@id'                       => 'https://diagimmhauts.fr/#business',
			'name'                      => 'Diag Imm\'Hauts',
			'legalName'                 => 'DIAG IMM\'HAUTS',
			'description'               => 'Diagnostics immobiliers pour la vente, la location, les copropriétés et les audits énergétiques dans l\'Artois et le Pas-de-Calais.',
			'url'                       => 'https://diagimmhauts.fr/',
			'telephone'                 => '+33635884300',
			'email'                     => 'contact@diagimmhauts.fr',
			'founder'                   => array(
				'@type' => 'Person',
				'name'  => 'Maxime Dillies',
			),
			'foundingDate'              => '2023-03-06',
			'address'                   => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => '19 route nationale',
				'postalCode'      => '62690',
				'addressLocality' => 'Berles-Monchel',
				'addressRegion'   => 'Hauts-de-France',
				'addressCountry'  => 'FR',
			),
			'areaServed'                => array(
				array(
					'@type' => 'City',
					'name'  => 'Arras',
				),
				array(
					'@type' => 'City',
					'name'  => 'Lens',
				),
				array(
					'@type' => 'City',
					'name'  => 'Liévin',
				),
				array(
					'@type' => 'City',
					'name'  => 'Béthune',
				),
				array(
					'@type' => 'City',
					'name'  => 'Saint-Pol-sur-Ternoise',
				),
				array(
					'@type' => 'City',
					'name'  => 'Aubigny-en-Artois',
				),
				array(
					'@type' => 'City',
					'name'  => 'Avesnes-le-Comte',
				),
				array(
					'@type' => 'City',
					'name'  => 'Tincques',
				),
				array(
					'@type' => 'City',
					'name'  => 'Savy-Berlette',
				),
				array(
					'@type' => 'City',
					'name'  => 'Houdain',
				),
				array(
					'@type' => 'City',
					'name'  => 'Douai',
				),
				array(
					'@type' => 'City',
					'name'  => 'Cambrai',
				),
			),
			'openingHoursSpecification' => array(
				array(
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => array(
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
					),
					'opens'     => '08:00',
					'closes'    => '19:00',
				),
				array(
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => 'Saturday',
					'opens'     => '09:00',
					'closes'    => '13:00',
				),
			),
			'priceRange'                => '€€',
			'aggregateRating'           => array(
				'@type'       => 'AggregateRating',
				'ratingValue' => '5',
				'reviewCount' => '12',
			),
			'hasCredential'             => array(
				'@type'              => 'EducationalOccupationalCredential',
				'credentialCategory' => 'Certification de diagnostiqueur immobilier',
				'recognizedBy'       => array(
					'@type' => 'Organization',
					'name'  => 'Bureau Veritas',
				),
			),
		),
	),
	'diagnostics'                                  => array(
		'titre'       => 'Tous les diagnostics immobiliers obligatoires — Arras & Pas-de-Calais',
		'description' => 'Les 12 diagnostics pour vendre ou louer : lesquels sont obligatoires pour votre bien, leur durée de validité et mon tarif. Devis gratuit sous 24 h.',
	),
	'dpe'                                          => array(
		'titre'       => 'DPE à Arras et dans le Pas-de-Calais — validité, réforme 2026, tarif',
		'description' => 'Diagnostic de performance énergétique obligatoire à la vente et à la location, valable 10 ans. Ce qui change avec la réforme du 1er janvier 2026. Devis gratuit.',
	),
	'audit'                                        => array(
		'titre'       => 'Audit énergétique réglementaire à Arras — classes F, G, E, D',
		'description' => 'Obligatoire à la vente : F et G depuis avril 2023, E depuis janvier 2025, D au 1er janvier 2034. Scénarios de travaux chiffrés, base de MaPrimeRénov\'.',
	),
	'dtg'                                          => array(
		'titre'       => 'DTG et DPE collectif pour copropriétés — Arras, Lens, Béthune',
		'description' => 'Diagnostic technique global et DPE collectif : calendrier des obligations, déroulé de l\'intervention et présentation en assemblée générale.',
	),
	'amiante'                                      => array(
		'titre'       => 'Diagnostic amiante à Arras — obligatoire avant juillet 1997',
		'description' => 'Repérage amiante obligatoire pour tout bien dont le permis est antérieur au 1er juillet 1997. Validité illimitée si négatif. Prélèvements et analyses inclus.',
	),
	'plomb'                                        => array(
		'titre'       => 'Diagnostic plomb (CREP) à Arras — logements avant 1949',
		'description' => 'Constat de risque d\'exposition au plomb, obligatoire pour les logements construits avant le 1er janvier 1949. Valable 1 an à la vente, 6 ans en location.',
	),
	'electricite'                                  => array(
		'titre'       => 'Diagnostic électricité à Arras — installations de plus de 15 ans',
		'description' => 'État de l\'installation intérieure d\'électricité, obligatoire pour toute installation de plus de 15 ans. Valable 3 ans à la vente, 6 ans en location.',
	),
	'gaz'                                          => array(
		'titre'       => 'Diagnostic gaz à Arras — installations de plus de 15 ans',
		'description' => 'État de l\'installation intérieure de gaz : tuyauteries, appareils, évacuation, ventilation. Valable 3 ans à la vente, 6 ans en location. Devis gratuit sous 24 h.',
	),
	'termites'                                     => array(
		'titre'       => 'Diagnostic termites à Arras et dans le Pas-de-Calais — validité 6 mois',
		'description' => 'Recherche de termites et d\'agents de dégradation biologique du bois, obligatoire en zone d\'arrêté préfectoral. Rapport valable 6 mois.',
	),
	'merule'                                       => array(
		'titre'       => 'Diagnostic mérule dans le Pas-de-Calais — zones à risque',
		'description' => 'Recherche de mérule et information de l\'acquéreur en zone d\'arrêté. Un risque réel dans l\'habitat ancien de l\'Artois. Devis gratuit sous 24 h.',
	),
	'erp'                                          => array(
		'titre'       => 'État des risques (ERP) à Arras — document obligatoire, validité 6 mois',
		'description' => 'Risques naturels, miniers, technologiques et sismiques de la commune : document obligatoire à la vente comme à la location, valable 6 mois.',
	),
	'mesurage'                                     => array(
		'titre'       => 'Mesurage Carrez et Boutin à Arras — surface certifiée',
		'description' => 'Surface privative loi Carrez à la vente en copropriété, surface habitable loi Boutin en location. Mesurage certifié, sans durée de validité limitée.',
	),
	'assainissement'                               => array(
		'titre'       => 'Assainissement non collectif à Arras — accompagnement avant le SPANC',
		'description' => 'Bien non raccordé au tout-à-l\'égout : le contrôle est délivré par le SPANC de votre commune. Je vous accompagne et j\'intègre les autres diagnostics au devis.',
	),
	'simulateur'                                   => array(
		'titre'       => 'Quels diagnostics obligatoires pour mon bien ? Simulateur gratuit',
		'description' => 'Cinq questions et vous obtenez la liste exacte de vos diagnostics obligatoires, avec leur durée de validité. Gratuit, sans inscription.',
	),
	'pros'                                         => array(
		'titre'       => 'Diagnostiqueur partenaire — agences, notaires et syndics de l\'Artois',
		'description' => 'Créneaux réservés, rapport sous 24 h, une facture unique en fin de mois. Grille partenaire dès le premier dossier, sans exclusivité ni volume minimum.',
	),
	'actualites'                                   => array(
		'titre'          => 'Actualités des diagnostics immobiliers — Diag Imm\'Hauts',
		'description'    => 'Réforme du DPE 2026, calendrier d\'interdiction de location, prix et durées de validité : ce qui change pour votre bien, expliqué simplement par votre diagnostiqueur dans l\'Artois.',
		'og_description' => 'Réforme du DPE 2026, calendrier d\'interdiction de location, prix et durées de validité : ce qui change pour votre bien.',
	),
	'qui'                                          => array(
		'titre'       => 'Maxime Dillies, diagnostiqueur certifié Bureau Veritas — Artois',
		'description' => 'Diagnostiqueur depuis 2018, certifié Bureau Veritas. Celui qui visite votre logement est celui qui vous explique le rapport. 12 diagnostics en interne.',
	),
	'contact'                                      => array(
		'titre'       => 'Contact et devis gratuit — Diag Imm\'Hauts, Arras et Pas-de-Calais',
		'description' => 'Décrivez votre bien en quelques champs : je vous rappelle sous 24 h ouvrées avec un prix ferme, tout compris. {telephone}, du lundi au samedi.',
	),
	'mentions'                                     => array(
		'titre'       => 'Mentions légales et confidentialité — Diag Imm\'Hauts',
		'description' => 'Éditeur du site, hébergement, propriété intellectuelle et traitement de vos données personnelles.',
	),
	'article:reforme-dpe-2026-classe-sans-travaux' => array(
		'titre'          => 'Réforme du DPE 2026 : gagner une classe sans travaux — Diag Imm\'Hauts',
		'description'    => 'Le coefficient de l\'électricité est passé de 2,3 à 1,9 le 1er janvier 2026 : 850 000 logements ont quitté le statut de passoire. Comment savoir si le vôtre est concerné, et l\'attestation gratuite.',
		'og_titre'       => 'Réforme du DPE 2026 : gagner une classe sans travaux',
		'og_description' => 'Le coefficient de l\'électricité est passé de 2,3 à 1,9 : 850 000 logements ont quitté le statut de passoire. Ce que ça change pour votre vente ou votre location.',
		'og_type'        => 'article',
	),
	'article:location-dpe-dates-interdiction'      => array(
		'titre'          => 'Location et DPE : les dates d\'interdiction (2025, 2028, 2034) — Diag Imm\'Hauts',
		'description'    => 'Logements classés G interdits à la location depuis 2025, F au 1er janvier 2028, E au 1er janvier 2034. Ce que l\'interdiction vise vraiment, les exceptions, et ce qu\'un bailleur peut faire dès maintenant.',
		'og_titre'       => 'Location et DPE : les dates d\'interdiction (2025, 2028, 2034)',
		'og_description' => 'G depuis 2025, F en 2028, E en 2034 : ce que l\'interdiction vise vraiment, les exceptions, et ce qu\'un bailleur peut faire dès maintenant.',
		'og_type'        => 'article',
	),
);
