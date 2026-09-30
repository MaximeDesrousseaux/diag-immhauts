<?php
/**
 * Données des e-mails des formulaires (maquettes 1.14, design_diagimmhauts_theme_wp/emails/).
 *
 * - Note et nombre d'avis Google : même source que le bandeau de confiance du site,
 *   dih_info( 'avis_note' | 'avis_nombre' | 'avis_google' ) du thème, que les champs de
 *   Diag Imm'Hauts → Avis clients remplacent quand ils sont remplis.
 * - Statut de zone d'une commune : même règle que « Vérifier ma commune »
 *   (donnees/communes.json : 62 en zone, 59 et 80 en limite, autre hors zone).
 * - Balises Fluent Forms {dih.avis_note}, {dih.avis_nombre}, {dih.avis_url},
 *   {dih.zone_statut}, {dih.prenom}, utilisables dans l'éditeur des notifications.
 *
 * Les gabarits eux-mêmes (présentation) sont dans le thème : inc/emails.php.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Note Google, nombre d'avis et lien, ou chaînes vides si la source est vide
 * (les e-mails affichent alors « Certifié Bureau Veritas »).
 *
 * @return array{note: string, nombre: string, url: string}
 */
function dih_core_avis_google() {
	$infos = function_exists( 'dih_info' );
	return array(
		'note'   => $infos ? (string) dih_info( 'avis_note' ) : '',
		'nombre' => $infos ? (string) dih_info( 'avis_nombre' ) : '',
		'url'    => $infos ? (string) dih_info( 'avis_google' ) : '',
	);
}

/**
 * Statut de zone d'une commune saisie (« Arras (62000) », « 62000 », « Arras »).
 *
 * @param string $commune Saisie du client.
 * @return string « en zone », « limite de zone », « hors zone », ou vide si inconnue.
 */
function dih_core_zone_statut( $commune ) {
	static $table = null;
	$commune = trim( (string) $commune );
	if ( '' === $commune ) {
		return '';
	}
	if ( null === $table ) {
		$fichier = DIH_CORE_DIR . 'donnees/communes.json';
		$table   = file_exists( $fichier ) ? json_decode( file_get_contents( $fichier ), true ) : array(); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	}

	$dep = '';
	if ( preg_match( '/\b(\d{5})\b/', $commune, $cp ) ) {
		$dep = substr( $cp[1], 0, 2 );
	} else {
		$cle = strtolower( remove_accents( $commune ) );
		$cle = preg_replace( '/[^a-z0-9]/', '', $cle );
		$dep = isset( $table['communes'][ $cle ] ) ? $table['communes'][ $cle ] : '';
	}
	if ( '' === $dep ) {
		return '';
	}

	$zone = isset( $table['zone'] ) ? $table['zone'] : array(
		'oui'    => array( '62' ),
		'limite' => array( '59', '80' ),
	);
	if ( in_array( $dep, $zone['oui'], true ) ) {
		return 'en zone';
	}
	return in_array( $dep, $zone['limite'], true ) ? 'limite de zone' : 'hors zone';
}

/**
 * Prénom d'un nom saisi (« Claire Vasseur » → « Claire »).
 *
 * @param string $nom Nom et prénom.
 * @return string
 */
function dih_core_prenom( $nom ) {
	$mots = preg_split( '/\s+/', trim( (string) $nom ) );
	return $mots ? $mots[0] : '';
}

/**
 * Balises {dih.…} des notifications Fluent Forms.
 */
add_filter(
	'fluentform/smartcode_group_dih',
	function ( $propriete, $parseur ) {
		$avis   = dih_core_avis_google();
		$inputs = is_object( $parseur ) && method_exists( $parseur, 'getInputs' ) ? (array) $parseur::getInputs() : array();
		switch ( $propriete ) {
			case 'avis_note':
				return $avis['note'];
			case 'avis_nombre':
				return $avis['nombre'];
			case 'avis_url':
				return $avis['url'];
			case 'zone_statut':
				return dih_core_zone_statut( isset( $inputs['commune'] ) ? $inputs['commune'] : '' );
			case 'prenom':
				return dih_core_prenom( isset( $inputs['nom'] ) ? $inputs['nom'] : '' );
		}
		return $propriete;
	},
	10,
	2
);

// Note et nombre d'avis modifiables : champs de la page Avis clients, prioritaires
// sur les chiffres du thème quand ils sont remplis.
add_action(
	'dih_core_acf_init',
	function () {
		acf_add_local_field_group(
			array(
				'key'        => 'group_dih_avis_google',
				'title'      => 'Note Google',
				'fields'     => array(
					array(
						'key'          => 'field_dih_avis_note',
						'name'         => 'avis_note',
						'label'        => 'Note',
						'instructions' => 'Affichée dans le bandeau de confiance du site et en pied des e-mails envoyés aux clients. Vide : note du thème (5,0).',
						'type'         => 'text',
						'placeholder'  => '5,0',
						'wrapper'      => array( 'width' => '33' ),
					),
					array(
						'key'          => 'field_dih_avis_nombre',
						'name'         => 'avis_nombre',
						'label'        => 'Nombre d’avis',
						'instructions' => 'Vide : nombre du thème (12).',
						'type'         => 'number',
						'min'          => 0,
						'wrapper'      => array( 'width' => '33' ),
					),
					array(
						'key'          => 'field_dih_avis_url',
						'name'         => 'avis_url',
						'label'        => 'Lien des avis Google',
						'instructions' => 'Vide : lien du thème.',
						'type'         => 'url',
						'wrapper'      => array( 'width' => '34' ),
					),
				),
				'location'   => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'dih-avis',
						),
					),
				),
				'menu_order' => -1,
			)
		);
	}
);

add_filter(
	'dih_info',
	function ( $valeur, $cle ) {
		$champs = array(
			'avis_note'   => 'avis_note',
			'avis_nombre' => 'avis_nombre',
			'avis_google' => 'avis_url',
		);
		if ( ! isset( $champs[ $cle ] ) || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
			return $valeur;
		}
		$saisie = get_field( $champs[ $cle ], 'option' );
		return ( null !== $saisie && '' !== trim( (string) $saisie ) ) ? (string) $saisie : $valeur;
	},
	10,
	2
);
