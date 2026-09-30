<?php
/**
 * Formulaires Fluent Forms : rappel (formulaire court de la popup et du haut de
 * l'accueil), devis (page Contact), compte partenaire (popup de Professionnels).
 *
 * - dih_core_formulaires_definitions() décrit chaque formulaire d'après les
 *   maquettes (champs, libellés, textes d'aide, bouton) ;
 *   outils/importer-formulaires.php les crée dans Fluent Forms et renseigne leurs
 *   identifiants dans Diag Imm'Hauts → Formulaires.
 * - Le thème appelle dih_core_formulaire( $cle ) ; une chaîne vide lui signale
 *   d'afficher son emplacement balisé (Fluent Forms absent ou formulaire non créé).
 *   La mise en forme (classes, bouton, message de confirmation) est celle du thème.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Formulaires du site : clé => [ nom, emplacement ] (page Diag Imm'Hauts → Formulaires).
 *
 * @return array<string, array{0: string, 1: string}>
 */
function dih_core_formulaires_liste() {
	return array(
		'rappel'     => array( 'Demande de rappel', 'Formulaire court : popup « Rappel sous 24 h » et haut de la page d’accueil (barre ou carte « Rappel gratuit »).' ),
		'devis'      => array( 'Demande de devis', 'Page Contact, bloc « devis ».' ),
		'partenaire' => array( 'Compte partenaire', 'Popup de la page Professionnels.' ),
	);
}

/**
 * Identifiants Fluent Forms de chaque formulaire du site, saisis dans
 * Diag Imm'Hauts → Formulaires (page d'options ACF, inc/personnalisation.php).
 *
 * @return array<string, int>
 */
function dih_core_formulaires_ids() {
	$ids = array_fill_keys( array_keys( dih_core_formulaires_liste() ), 0 );
	if ( dih_core_acf_actif() ) {
		foreach ( array_keys( $ids ) as $cle ) {
			$ids[ $cle ] = absint( get_field( 'formulaire_' . $cle, 'option' ) );
		}
	}
	return apply_filters( 'dih_formulaires_ids', $ids );
}

/**
 * Clé du site d'un formulaire Fluent Forms, ou chaîne vide s'il n'est pas l'un des nôtres.
 *
 * @param int $id Identifiant Fluent Forms.
 * @return string
 */
function dih_core_formulaire_cle( $id ) {
	$cle = array_search( (int) $id, dih_core_formulaires_ids(), true );
	return false === $cle ? '' : $cle;
}

/**
 * HTML du formulaire demandé, ou chaîne vide s'il n'est pas disponible.
 *
 * @param string $cle Clé de dih_core_formulaires_liste().
 * @return string
 */
function dih_core_formulaire( $cle ) {
	$ids = dih_core_formulaires_ids();
	$id  = isset( $ids[ $cle ] ) ? absint( $ids[ $cle ] ) : 0;

	if ( ! $id || ! dih_core_fluentforms_actif() || ! shortcode_exists( 'fluentform' ) ) {
		return '';
	}

	return do_shortcode( sprintf( '[fluentform id="%d"]', $id ) );
}

/**
 * Description des formulaires, d'après les maquettes (textes à la lettre).
 *
 * Champ : type (texte, tel, email, nombre, liste, cases, zone, rgpd, separateur), nom,
 * label (HTML simple permis), placeholder, requis, options (liste, cases),
 * vide (option vide en tête de liste : son libellé), lignes (zone), aide.
 * Un séparateur (filet pleine largeur) ouvre un nouveau groupe de champs.
 *
 * @return array
 */
function dih_core_formulaires_definitions() {
	$nb = "\u{00A0}";

	// Libellés, liste « Type de bien » et champ commune communs au formulaire court
	// et au devis (formulaire détaillé).
	$types_bien = array( 'Appartement', 'Maison individuelle', 'Immeuble en monopropriété', 'Local commercial', 'Terrain / autre' );
	$message    = array(
		'type'        => 'zone',
		'nom'         => 'message',
		'label'       => 'Votre message <span class="dih-facultatif">(facultatif)</span>',
		'placeholder' => 'Type de projet, délai souhaité, précisions sur le bien…',
		'lignes'      => 3,
	);

	return array(
		// Formulaire court : popup et haut de l'accueil (étiquettes masquées sur fond vert).
		'rappel'     => array(
			'titre'  => 'Demande de rappel',
			'objet'  => 'Demande de rappel — {inputs.nom}',
			'bouton' => 'Être rappelé gratuitement',
			'champs' => array(
				array( 'type' => 'texte', 'nom' => 'nom', 'label' => 'Nom et prénom', 'placeholder' => 'Votre nom', 'requis' => true ),
				array( 'type' => 'tel', 'nom' => 'telephone', 'label' => 'Téléphone', 'placeholder' => '06 12 34 56 78', 'requis' => true ),
				array( 'type' => 'texte', 'nom' => 'commune', 'label' => 'Commune ou code postal', 'placeholder' => 'Arras ou 62000' ),
				array( 'type' => 'liste', 'nom' => 'type_bien', 'label' => 'Type de bien', 'vide' => 'Type de bien', 'options' => $types_bien ),
				$message,
			),
		),
		'devis'      => array(
			'titre'  => 'Demande de devis',
			'objet'  => 'Demande de devis — {inputs.nom}',
			'bouton' => 'Envoyer ma demande',
			'champs' => array(
				array( 'type' => 'texte', 'nom' => 'nom', 'label' => 'Nom et prénom *', 'placeholder' => 'Maxime Dillies', 'requis' => true ),
				array( 'type' => 'tel', 'nom' => 'telephone', 'label' => 'Téléphone *', 'placeholder' => '06 12 34 56 78', 'requis' => true ),
				array( 'type' => 'email', 'nom' => 'email', 'label' => 'E-mail *', 'placeholder' => 'vous@exemple.fr', 'requis' => true ),
				array( 'type' => 'liste', 'nom' => 'qualite', 'label' => 'Vous êtes', 'options' => array( 'Particulier propriétaire', 'Locataire', 'Agence immobilière', 'Notaire', 'Syndic / copropriété', 'Collectivité ou bailleur' ) ),
				array( 'type' => 'separateur', 'nom' => 'bien' ),
				array( 'type' => 'liste', 'nom' => 'type_bien', 'label' => 'Type de bien *', 'requis' => true, 'options' => $types_bien ),
				array( 'type' => 'nombre', 'nom' => 'surface', 'label' => 'Surface (m²) *', 'placeholder' => '95', 'requis' => true ),
				array( 'type' => 'nombre', 'nom' => 'annee', 'label' => 'Année de construction', 'placeholder' => '1968' ),
				array( 'type' => 'texte', 'nom' => 'commune', 'label' => 'Commune ou code postal *', 'placeholder' => 'Arras ou 62000', 'requis' => true, 'aide' => 'Les suggestions sont mes secteurs habituels.' ),
				array( 'type' => 'liste', 'nom' => 'motif', 'label' => 'Motif', 'options' => array( 'Vente', 'Location', 'Copropriété / parties communes', 'Avant travaux ou démolition', 'Autre' ) ),
				array( 'type' => 'liste', 'nom' => 'echeance', 'label' => 'Échéance souhaitée', 'options' => array( 'Dès que possible', 'Sous une semaine', 'Sous un mois', 'Je me renseigne' ) ),
				array( 'type' => 'separateur', 'nom' => 'diagnostics' ),
				array(
					'type'    => 'cases',
					'nom'     => 'diagnostics',
					'label'   => 'Diagnostics souhaités',
					'aide'    => 'Vous ne savez pas lesquels sont obligatoires' . $nb . '? Laissez vide, je vous le dirai.',
					'options' => array( 'DPE', 'Amiante', 'Plomb (CREP)', 'Électricité', 'Gaz', 'Termites', 'ERP', 'Mesurage Carrez / Boutin', 'Assainissement', 'Mérule', 'DTG', 'Audit énergétique' ),
				),
				array( 'type' => 'zone', 'nom' => 'precisions', 'label' => 'Précisions', 'placeholder' => 'Étage, présence d\'un locataire, accès aux combles, date de signature prévue…', 'lignes' => 4 ),
				array( 'type' => 'rgpd', 'nom' => 'rgpd', 'label' => 'J\'accepte que ces informations soient utilisées pour me recontacter au sujet de ma demande. Elles ne sont ni revendues ni utilisées à d\'autres fins.' ),
			),
		),
		'partenaire' => array(
			'titre'  => 'Compte partenaire',
			'objet'  => 'Compte partenaire — {inputs.structure}',
			'bouton' => 'Demander la grille partenaire',
			'champs' => array(
				array( 'type' => 'texte', 'nom' => 'structure', 'label' => 'Structure', 'placeholder' => 'Nom de l\'agence, étude…', 'requis' => true ),
				array( 'type' => 'texte', 'nom' => 'nom', 'label' => 'Interlocuteur', 'placeholder' => 'Votre nom', 'requis' => true ),
				array( 'type' => 'tel', 'nom' => 'telephone', 'label' => 'Téléphone', 'placeholder' => '03 21 00 00 00', 'requis' => true ),
				array( 'type' => 'liste', 'nom' => 'dossiers', 'label' => 'Dossiers par mois', 'options' => array( '1 à 3', '4 à 10', 'Plus de 10', 'Ponctuel' ) ),
				$message,
			),
		),
	);
}

/**
 * Pied des e-mails de notification de nos formulaires : le nom du site, sans la
 * mention « Powered by FluentForm ».
 */
add_filter(
	'fluentform/email_template_footer_text',
	function ( $texte, $form ) {
		return is_object( $form ) && dih_core_formulaire_cle( $form->id ) ? 'Formulaire du site Diag Imm’Hauts — ' . wp_parse_url( home_url(), PHP_URL_HOST ) : $texte;
	},
	10,
	2
);
add_filter(
	'fluentform/email_template_footer_credit',
	function ( $mention, $form ) {
		return is_object( $form ) && dih_core_formulaire_cle( $form->id ) ? '' : $mention;
	},
	10,
	2
);
