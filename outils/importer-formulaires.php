<?php
/**
 * Crée dans Fluent Forms les formulaires du site (rappel, rappel du haut de
 * l'accueil, devis, compte partenaire), d'après dih_core_formulaires_definitions()
 * (plugin, inc/formulaires.php), et renseigne leurs identifiants dans
 * Diag Imm'Hauts → Formulaires.
 *
 * Usage : wp eval-file outils/importer-formulaires.php
 *         wp eval-file outils/importer-formulaires.php forcer   (réécrit les formulaires existants)
 *
 * - Sans « forcer », un formulaire déjà créé (identifiant renseigné et formulaire
 *   présent) n'est pas touché : ses réglages faits dans Fluent Forms sont gardés.
 * - Les champs sont bâtis sur les éléments par défaut de Fluent Forms (même format
 *   que l'éditeur), messages d'erreur en français.
 * - Notification par e-mail à l'adresse du site (dih_info( 'email' )) ; sur la
 *   préprod LocalWP, les e-mails sont retenus par Mailpit.
 * - Cloudflare Turnstile est ajouté quand ses clés sont enregistrées dans
 *   Fluent Forms → Global Settings (relancer alors avec « forcer »).
 *
 * @package DiagImmHauts
 */

use FluentForm\App\Models\Form;
use FluentForm\App\Models\FormMeta;

if ( ! defined( 'ABSPATH' ) || ! function_exists( 'dih_core_formulaires_definitions' ) ) {
	echo "À lancer avec wp eval-file, plugin Diag Imm'Hauts actif.\n";
	return;
}
if ( ! dih_core_fluentforms_actif() || ! function_exists( 'fluentformLoadFile' ) ) {
	echo "Fluent Forms doit être actif.\n";
	return;
}
if ( ! dih_core_acf_actif() || ! function_exists( 'update_field' ) ) {
	echo "ACF Pro ou Secure Custom Fields doit être actif (identifiants des formulaires).\n";
	return;
}

$dih_forcer = isset( $args ) && in_array( 'forcer', (array) $args, true );

// Éléments par défaut de Fluent Forms, à plat : nom d'élément => définition.
$dih_elements = array();
foreach ( (array) fluentformLoadFile( 'Services/FormBuilder/DefaultElements.php' ) as $dih_groupe ) {
	foreach ( (array) $dih_groupe as $dih_nom => $dih_element ) {
		$dih_elements[ $dih_nom ] = $dih_element;
	}
}

$dih_messages = array(
	'required' => 'Ce champ est obligatoire.',
	'email'    => 'Adresse e-mail invalide.',
	'numeric'  => 'Saisissez un nombre.',
	'min'      => 'Valeur trop petite.',
	'max'      => 'Valeur trop grande.',
);

/**
 * Champ Fluent Forms d'après une ligne de dih_core_formulaires_definitions().
 *
 * @param array  $c   Champ décrit.
 * @param string $cle Clé du formulaire.
 * @param int    $i   Rang.
 * @return array
 */
$dih_champ = function ( $c, $cle, $i ) use ( $dih_elements, $dih_messages ) {
	$types   = array(
		'texte'  => 'input_text',
		'tel'    => 'input_text',
		'email'  => 'input_email',
		'nombre' => 'input_number',
		'liste'  => 'select',
		'cases'  => 'input_checkbox',
		'zone'   => 'textarea',
		'rgpd'   => 'gdpr_agreement',
	);

	// Séparateur : filet pleine largeur entre deux groupes de champs.
	if ( 'separateur' === $c['type'] ) {
		$f                                = $dih_elements['custom_html'];
		$f['index']                       = $i;
		$f['uniqElKey']                   = 'el_dih_' . $cle . '_separateur_' . $c['nom'];
		$f['settings']['html_codes']      = '<div class="dih-separateur" aria-hidden="true"></div>';
		$f['settings']['container_class'] = 'dih-champ dih-champ--separateur';
		return $f;
	}

	$element = $types[ $c['type'] ];
	$f       = $dih_elements[ $element ];

	$f['index']                        = $i;
	$f['uniqElKey']                    = 'el_dih_' . $cle . '_' . $c['nom'];
	$f['attributes']['name']           = $c['nom'];
	$f['settings']['container_class']  = 'dih-champ dih-champ--' . $c['nom'];
	$f['settings']['admin_field_label'] = wp_strip_all_tags( str_replace( ' *', '', $c['label'] ) );
	$f['settings']['help_message']     = isset( $c['aide'] ) ? $c['aide'] : '';

	if ( 'rgpd' === $c['type'] ) {
		$f['settings']['label']    = '';
		$f['settings']['tnc_html'] = $c['label'];
		$c['requis']               = true;
	} else {
		$f['settings']['label'] = $c['label'];
	}

	if ( isset( $c['placeholder'] ) ) {
		$f['attributes']['placeholder'] = $c['placeholder'];
	}
	if ( 'tel' === $c['type'] ) {
		$f['attributes']['type'] = 'tel';
	}
	if ( 'zone' === $c['type'] ) {
		$f['attributes']['rows'] = isset( $c['lignes'] ) ? $c['lignes'] : 3;
	}
	if ( isset( $c['options'] ) ) {
		$f['settings']['advanced_options'] = array_map(
			function ( $o ) {
				return array(
					'label'      => $o,
					'value'      => $o,
					'calc_value' => '',
					'image'      => '',
				);
			},
			$c['options']
		);
	}
	if ( 'liste' === $c['type'] ) {
		// Sans option vide, la liste s'ouvre sur son premier choix, comme la maquette.
		$f['settings']['placeholder'] = isset( $c['vide'] ) ? $c['vide'] : '';
	}

	// Règles : obligatoire ou non, messages en français (plus les messages globaux anglais).
	foreach ( $f['settings']['validation_rules'] as $regle => $r ) {
		if ( isset( $dih_messages[ $regle ] ) ) {
			$f['settings']['validation_rules'][ $regle ]['message'] = $dih_messages[ $regle ];
			$f['settings']['validation_rules'][ $regle ]['global']  = false;
		}
	}
	$f['settings']['validation_rules']['required']['value'] = ! empty( $c['requis'] );
	if ( 'rgpd' === $c['type'] ) {
		$f['settings']['validation_rules']['required']['message'] = 'Merci d’accepter pour envoyer votre demande.';
	}

	return $f;
};

$dih_email = function_exists( 'dih_info' ) ? dih_info( 'email' ) : get_option( 'admin_email' );
$dih_ids   = dih_core_formulaires_ids();

foreach ( dih_core_formulaires_definitions() as $dih_cle => $dih_def ) {
	$form_id = isset( $dih_ids[ $dih_cle ] ) ? (int) $dih_ids[ $dih_cle ] : 0;
	$existe  = $form_id && Form::find( $form_id );
	if ( $existe && ! $dih_forcer ) {
		printf( "Formulaire %s : déjà créé (n° %d), inchangé.\n", $dih_cle, $form_id );
		continue;
	}

	$champs = array();
	foreach ( $dih_def['champs'] as $i => $c ) {
		$champs[] = $dih_champ( $c, $dih_cle, $i );
	}
	if ( get_option( '_fluentform_turnstile_keys_status', false ) ) {
		$t              = $dih_elements['turnstile'];
		$t['index']     = count( $champs );
		$t['uniqElKey'] = 'el_dih_' . $dih_cle . '_turnstile';
		$champs[]       = $t;
	}

	$envoi = array(
		'uniqElKey'      => 'el_dih_' . $dih_cle . '_envoi',
		'element'        => 'button',
		'attributes'     => array(
			'type'  => 'submit',
			'class' => '',
		),
		'settings'       => array(
			'align'            => 'left',
			'button_style'     => 'no_style',
			'container_class'  => 'dih-envoi',
			'help_message'     => '',
			'background_color' => '',
			'button_size'      => 'md',
			'color'            => '',
			'button_ui'        => array(
				'type'    => 'default',
				'text'    => $dih_def['bouton'],
				'img_url' => '',
			),
		),
		'editor_options' => array( 'title' => 'Submit Button' ),
	);

	$donnees = array(
		'title'       => $dih_def['titre'],
		'form_fields' => wp_json_encode(
			array(
				'fields'       => $champs,
				'submitButton' => $envoi,
			)
		),
		'status'      => 'published',
		'type'        => 'form',
		'has_payment' => 0,
	);

	if ( $existe ) {
		Form::where( 'id', $form_id )->update( $donnees + array( 'updated_at' => current_time( 'mysql' ) ) );
	} else {
		$form_id = (int) Form::insertGetId(
			$donnees + array(
				'created_by' => (int) get_current_user_id(),
				'created_at' => current_time( 'mysql' ),
				'updated_at' => current_time( 'mysql' ),
			)
		);
	}

	// Réglages : message de confirmation sur place (texte simple ; le thème le met
	// en forme), étiquettes au-dessus des champs, sans astérisque automatique
	// (les maquettes l'écrivent dans le libellé quand il le faut).
	FormMeta::persist(
		$form_id,
		'formSettings',
		array(
			'confirmation'               => array(
				'redirectTo'           => 'samePage',
				'messageToShow'        => 'Demande bien reçue : je vous rappelle sous 24 heures ouvrées.',
				'customPage'           => null,
				'samePageFormBehavior' => 'hide_form',
				'customUrl'            => null,
			),
			'restrictions'               => array(
				'limitNumberOfEntries' => array(
					'enabled'         => false,
					'numberOfEntries' => null,
					'period'          => 'total',
					'limitReachedMsg' => '',
				),
				'scheduleForm'         => array(
					'enabled'      => false,
					'start'        => null,
					'end'          => null,
					'selectedDays' => array(),
					'pendingMsg'   => '',
					'expiredMsg'   => '',
				),
				'requireLogin'         => array(
					'enabled'         => false,
					'requireLoginMsg' => '',
				),
				'denyEmptySubmission'  => array(
					'enabled' => true,
					'message' => 'Merci de remplir le formulaire avant de l’envoyer.',
				),
			),
			'layout'                     => array(
				'labelPlacement'        => 'top',
				'helpMessagePlacement'  => 'under_input',
				'errorMessagePlacement' => 'inline',
				'cssClassName'          => 'dih-form dih-form--' . $dih_cle,
				'asteriskPlacement'     => 'none',
			),
			'delete_entry_on_submission' => 'no',
		)
	);

	FormMeta::persist(
		$form_id,
		'notifications',
		array(
			'name'          => 'Notification Diag Imm’Hauts',
			'sendTo'        => array(
				'type'    => 'email',
				'email'   => $dih_email,
				'field'   => '',
				'routing' => array(),
			),
			'fromName'      => 'Site Diag Imm’Hauts',
			'fromEmail'     => '',
			'replyTo'       => in_array( 'email', wp_list_pluck( $dih_def['champs'], 'nom' ), true ) ? '{inputs.email}' : '',
			'bcc'           => '',
			'subject'       => $dih_def['objet'],
			'message'       => '<p>{all_data}</p><p>Envoyé depuis : {embed_post.permalink}</p>',
			'conditionals'  => array(
				'status'     => false,
				'type'       => 'all',
				'conditions' => array(),
			),
			'enabled'       => true,
			'email_template' => '',
		)
	);
	FormMeta::persist( $form_id, 'template_name', 'dih_' . $dih_cle );

	update_field( 'field_dih_formulaire_' . $dih_cle, $form_id, 'option' );
	printf( "Formulaire %s : %s (n° %d), %d champs.\n", $dih_cle, $existe ? 'réécrit' : 'créé', $form_id, count( $champs ) );
}
