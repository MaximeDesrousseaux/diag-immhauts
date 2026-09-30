<?php
/**
 * Coordonnées du site modifiables dans l'admin (Diag Imm'Hauts → Coordonnées) :
 * téléphone, adresse, e-mail de contact, e-mail des mentions légales et du RGPD.
 *
 * Le thème les lit toutes par dih_info() (en-tête, pied de page, boutons d'appel,
 * Contact, mentions légales, messages des formulaires, e-mails, données lues par
 * Google) ; ce module les remplace par le filtre dih_info. Un champ vide garde la
 * valeur du thème. Le lien d'appel (tel:+33…) est déduit du téléphone saisi.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Coordonnées modifiables : clé de dih_info() => [ libellé, type ACF, aide ].
 *
 * @return array
 */
function dih_core_coordonnees() {
	return array(
		'telephone'  => array( 'Téléphone', 'text', 'Tel qu’il s’affiche, ex. 06 35 88 43 00 ; le lien d’appel en est déduit.' ),
		'adresse'    => array( 'Adresse', 'text', 'Sur une ligne : rue, code postal et commune, ex. « 19 route nationale, 62690 Berles-Monchel » (reprise telle quelle dans les données lues par Google).' ),
		'email'      => array( 'E-mail de contact', 'email', 'Affiché sur la page Contact et dans les données lues par Google. L’adresse qui reçoit les formulaires se règle dans les notifications de Fluent Forms.' ),
		'email_rgpd' => array( 'E-mail des mentions légales et du RGPD', 'email', 'Mentions légales, bouton « Exercer mes droits par e-mail ».' ),
	);
}

add_action(
	'dih_core_acf_init',
	function () {
		acf_add_options_sub_page(
			array(
				'page_title'      => 'Coordonnées',
				'menu_title'      => 'Coordonnées',
				'menu_slug'       => 'dih-coordonnees',
				'parent_slug'     => 'dih-reglages',
				'capability'      => 'manage_options',
				'update_button'   => 'Enregistrer les coordonnées',
				'updated_message' => 'Coordonnées enregistrées.',
				'autoload'        => true,
			)
		);

		$champs = array();
		foreach ( dih_core_coordonnees() as $cle => $def ) {
			$champs[] = array(
				'key'          => 'field_dih_coord_' . $cle,
				'name'         => 'coord_' . $cle,
				'label'        => $def[0],
				'instructions' => $def[2] . ' Vide : valeur actuelle du thème.',
				'type'         => $def[1],
				'placeholder'  => function_exists( 'dih_info' ) ? dih_core_coordonnee_theme( $cle ) : '',
			);
		}

		acf_add_local_field_group(
			array(
				'key'      => 'group_dih_coordonnees',
				'title'    => 'Coordonnées du site',
				'fields'   => $champs,
				'location' => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'dih-coordonnees',
						),
					),
				),
			)
		);
	}
);

/**
 * Valeur du thème d'une coordonnée, sans ce que l'admin contient.
 *
 * @param string $cle Clé de dih_info().
 * @return string
 */
function dih_core_coordonnee_theme( $cle ) {
	remove_filter( 'dih_info', 'dih_core_coordonnees_info', 10 );
	$valeur = dih_info( $cle );
	add_filter( 'dih_info', 'dih_core_coordonnees_info', 10, 2 );
	return (string) $valeur;
}

/**
 * Lien d'appel d'un numéro affiché : 06 35 88 43 00 → +33635884300.
 *
 * @param string $telephone Numéro tel qu'affiché.
 * @return string
 */
function dih_core_telephone_lien( $telephone ) {
	$chiffres = preg_replace( '/\D+/', '', $telephone );
	if ( 0 === strpos( ltrim( $telephone ), '+' ) ) {
		return '+' . $chiffres;
	}
	if ( 10 === strlen( $chiffres ) && '0' === $chiffres[0] ) {
		return '+33' . substr( $chiffres, 1 );
	}
	return $chiffres;
}

/**
 * Coordonnées saisies dans l'admin, à la place de celles du thème.
 *
 * @param string $valeur Valeur du thème.
 * @param string $cle    Clé de dih_info().
 * @return string
 */
function dih_core_coordonnees_info( $valeur, $cle ) {
	$champ = 'telephone_lien' === $cle ? 'telephone' : $cle;
	if ( ! array_key_exists( $champ, dih_core_coordonnees() ) || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
		return $valeur;
	}
	$saisie = get_field( 'coord_' . $champ, 'option' );
	if ( ! is_string( $saisie ) || '' === trim( $saisie ) ) {
		return $valeur;
	}
	$saisie = trim( $saisie );
	return 'telephone_lien' === $cle ? dih_core_telephone_lien( $saisie ) : $saisie;
}
add_filter( 'dih_info', 'dih_core_coordonnees_info', 10, 2 );
