<?php
/**
 * Messages des formulaires modifiables dans l'admin (Diag Imm'Hauts → Formulaires,
 * encart « Messages des formulaires ») : message affiché après l'envoi de chaque
 * formulaire, mention à côté du bouton du devis, textes indicatifs du formulaire
 * court sur fond vert (haut de l'accueil).
 *
 * Ils remplacent les textes du thème (inc/contenus/formulaires.php) par le filtre
 * dih_contenu ; un champ vide garde le texte du thème. {telephone} est remplacé par
 * le numéro des coordonnées du site. Le message d'après l'envoi est produit pendant
 * l'envoi (requête AJAX de Fluent Forms) : le filtre y reste actif.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Messages modifiables : onglet => [ chemin dans les contenus « formulaires » =>
 * [ libellé, type ] ].
 *
 * @return array
 */
function dih_core_messages_formulaires() {
	return array(
		'Popup « Rappel sous 24 h »'   => array(
			'confirmations/rappel/texte'  => array( 'Message après l’envoi', 'textarea' ),
			'confirmations/rappel/bouton' => array( 'Bouton', 'text' ),
		),
		'Haut de l’accueil'            => array(
			'confirmations/accueil/titre'  => array( 'Titre après l’envoi', 'text' ),
			'confirmations/accueil/texte'  => array( 'Message après l’envoi', 'textarea' ),
			'confirmations/accueil/urgent' => array( 'Phrase « urgent »', 'textarea' ),
			'confirmations/accueil/bouton' => array( 'Bouton d’appel', 'text' ),
			'message_sombre'               => array( 'Texte indicatif du message (ordinateur)', 'text' ),
			'message_court'                => array( 'Texte indicatif du message (tablette et téléphone)', 'text' ),
			'email_sombre'                 => array( 'Texte indicatif de l’e-mail', 'text' ),
		),
		'Devis (Contact)'              => array(
			'note_devis'                  => array( 'Mention à côté du bouton d’envoi', 'text' ),
			'confirmations/devis/titre'   => array( 'Titre après l’envoi', 'text' ),
			'confirmations/devis/texte'   => array( 'Message après l’envoi', 'textarea' ),
			'confirmations/devis/bouton'  => array( 'Lien « Envoyer une autre demande »', 'text' ),
		),
		'Compte partenaire'            => array(
			'confirmations/partenaire/texte'  => array( 'Message après l’envoi', 'textarea' ),
			'confirmations/partenaire/bouton' => array( 'Bouton', 'text' ),
		),
	);
}

/**
 * Nom du champ d'un message.
 *
 * @param string $chemin Chemin dans les contenus « formulaires ».
 * @return string
 */
function dih_core_message_nom( $chemin ) {
	return 'msg_' . str_replace( array( 'confirmations/', '/' ), array( '', '_' ), $chemin );
}

add_action(
	'dih_core_acf_init',
	function () {
		$champs = array(
			array(
				'key'     => 'field_dih_msg_aide',
				'label'   => '',
				'type'    => 'message',
				'message' => 'Vide : texte actuel du thème. <code>{telephone}</code> est remplacé par le numéro de Diag Imm’Hauts → Coordonnées. Les champs des formulaires eux-mêmes se règlent dans Fluent Forms.',
			),
		);
		foreach ( dih_core_messages_formulaires() as $onglet => $messages ) {
			$champs[] = array(
				'key'       => 'field_dih_msg_onglet_' . sanitize_title( $onglet ),
				'label'     => $onglet,
				'type'      => 'tab',
				'placement' => 'top',
			);
			foreach ( $messages as $chemin => $def ) {
				$nom   = dih_core_message_nom( $chemin );
				$champ = array(
					'key'   => 'field_dih_' . $nom,
					'name'  => $nom,
					'label' => $def[0],
					'type'  => $def[1],
				);
				if ( 'textarea' === $def[1] ) {
					$champ['rows']      = 3;
					$champ['new_lines'] = '';
				}
				$champs[] = $champ;
			}
		}

		acf_add_local_field_group(
			array(
				'key'        => 'group_dih_messages_formulaires',
				'title'      => 'Messages des formulaires',
				'fields'     => $champs,
				'location'   => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'dih-formulaires',
						),
					),
				),
				'menu_order' => 10,
			)
		);
	}
);

/**
 * Messages saisis dans l'admin, à la place de ceux du thème.
 *
 * @param array  $donnees Contenus de la page.
 * @param string $page    Nom du fichier de contenus.
 * @return array
 */
function dih_core_contenus_messages( $donnees, $page ) {
	if ( 'formulaires' !== $page || ( is_admin() && ! wp_doing_ajax() ) || ! dih_core_acf_actif() || ! function_exists( 'get_field' ) ) {
		return $donnees;
	}
	$telephone = function_exists( 'dih_info' ) ? dih_info( 'telephone' ) : '';
	foreach ( dih_core_messages_formulaires() as $messages ) {
		foreach ( array_keys( $messages ) as $chemin ) {
			$valeur = get_field( dih_core_message_nom( $chemin ), 'option' );
			if ( is_string( $valeur ) && '' !== trim( $valeur ) && null !== dih_core_chemin_lire( $donnees, $chemin ) ) {
				dih_core_chemin_ecrire( $donnees, $chemin, str_replace( '{telephone}', $telephone, $valeur ) );
			}
		}
	}
	return $donnees;
}
add_filter( 'dih_contenu', 'dih_core_contenus_messages', 10, 2 );
