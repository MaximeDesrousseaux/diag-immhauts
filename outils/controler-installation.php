<?php
/**
 * Contrôle d'une installation de Diag Imm'Hauts (lecture seule : ne modifie rien).
 * Lancé à la fin de outils/installer.sh, ou seul :
 *
 *   wp eval-file outils/controler-installation.php
 *
 * Vérifie : langue, fuseau horaire, permaliens, thème et extensions actifs, les pages
 * du site (adresse et gabarit), la page d'accueil et la page des articles, les
 * formulaires Fluent Forms, la visibilité aux moteurs de recherche, les informations
 * « à compléter » des mentions légales, l'envoi des e-mails. Chaque ligne
 * est marquée OK, À FAIRE ou ERREUR ; le bilan compte les erreurs.
 *
 * @package DiagImmHauts
 */

if ( ! defined( 'ABSPATH' ) ) {
	echo "À lancer avec wp eval-file.\n";
	return;
}

$dih_bilan = array(
	'ok'      => 0,
	'a_faire' => 0,
	'erreur'  => 0,
);

/**
 * Affiche une ligne du contrôle.
 *
 * @param string $etat    'ok' | 'a_faire' | 'erreur'.
 * @param string $libelle Ce qui est contrôlé.
 * @param string $detail  Valeur trouvée ou consigne.
 */
$dih_ligne = function ( $etat, $libelle, $detail = '' ) use ( &$dih_bilan ) {
	$marques = array(
		'ok'      => 'OK      ',
		'a_faire' => 'À FAIRE ',
		'erreur'  => 'ERREUR  ',
	);
	++$dih_bilan[ $etat ];
	echo $marques[ $etat ] . $libelle . ( '' !== $detail ? ' — ' . $detail : '' ) . "\n";
};

echo "\n== Réglages\n";

$dih_langue = get_locale();
$dih_ligne( 'fr_FR' === $dih_langue ? 'ok' : 'erreur', 'Langue du site', $dih_langue );

$dih_fuseau = (string) get_option( 'timezone_string' );
$dih_ligne( 'Europe/Paris' === $dih_fuseau ? 'ok' : 'erreur', 'Fuseau horaire', '' !== $dih_fuseau ? $dih_fuseau : 'décalage UTC ' . get_option( 'gmt_offset' ) );

$dih_permaliens = (string) get_option( 'permalink_structure' );
$dih_ligne( '/actualites/%postname%/' === $dih_permaliens ? 'ok' : 'erreur', 'Permaliens', '' !== $dih_permaliens ? $dih_permaliens : 'simples (?p=123)' );

$dih_ligne( 'diag-immhauts' === get_stylesheet() ? 'ok' : 'erreur', 'Thème actif', get_stylesheet() );

echo "\n== Extensions\n";

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$dih_acf_pro = is_plugin_active( 'advanced-custom-fields-pro/acf.php' );
$dih_extensions = array(
	'diag-immhauts-core/diag-immhauts-core.php' => 'Diag Imm’Hauts — Cœur',
	'fluentform/fluentform.php'                  => 'Fluent Forms',
	'fluent-smtp/fluent-smtp.php'                => 'FluentSMTP',
);
if ( $dih_acf_pro ) {
	$dih_ligne( 'ok', 'Champs personnalisés', 'ACF Pro' );
} else {
	$dih_extensions['secure-custom-fields/secure-custom-fields.php'] = 'Secure Custom Fields';
}
foreach ( $dih_extensions as $dih_fichier => $dih_nom ) {
	$dih_ligne( is_plugin_active( $dih_fichier ) ? 'ok' : 'erreur', $dih_nom, is_plugin_active( $dih_fichier ) ? 'active' : 'inactive ou absente' );
}

echo "\n== Pages\n";

if ( ! function_exists( 'dih_chemins' ) ) {
	$dih_ligne( 'erreur', 'Pages', 'thème Diag Imm’Hauts inactif : contrôle impossible' );
} else {
	// Gabarit attendu par clé de page ; les fiches partagent « Fiche diagnostic ».
	$dih_gabarits = array(
		'diagnostics' => 'page-templates/nos-diagnostics.php',
		'simulateur'  => 'page-templates/simulateur.php',
		'pros'        => 'page-templates/professionnels.php',
		'qui'         => 'page-templates/qui.php',
		'contact'     => 'page-templates/contact.php',
		'mentions'    => 'page-templates/mentions.php',
	);
	$dih_fiches   = array( 'dpe', 'audit', 'dtg', 'amiante', 'plomb', 'electricite', 'gaz', 'termites', 'merule', 'erp', 'mesurage', 'assainissement' );
	foreach ( $dih_fiches as $dih_cle ) {
		$dih_gabarits[ $dih_cle ] = 'page-templates/fiche-diagnostic.php';
	}

	$dih_accueil  = (int) get_option( 'page_on_front' );
	$dih_articles = (int) get_option( 'page_for_posts' );
	if ( 'page' !== get_option( 'show_on_front' ) || ! $dih_accueil || 'publish' !== get_post_status( $dih_accueil ) ) {
		$dih_ligne( 'erreur', 'Page d’accueil', 'Réglages → Lecture : « Une page statique », page d’accueil à choisir' );
	} else {
		$dih_ligne( 'ok', 'Page d’accueil', get_post_field( 'post_title', $dih_accueil ) . ' (page ' . $dih_accueil . ')' );
	}

	foreach ( dih_chemins() as $dih_cle => $dih_chemin ) {
		if ( 'accueil' === $dih_cle ) {
			continue;
		}
		$dih_page = get_page_by_path( trim( $dih_chemin, '/' ) );
		if ( ! $dih_page || 'publish' !== $dih_page->post_status ) {
			$dih_ligne( 'erreur', $dih_chemin, $dih_page ? 'page non publiée' : 'page introuvable' );
			continue;
		}
		if ( 'actualites' === $dih_cle ) {
			$dih_ligne( $dih_articles === (int) $dih_page->ID ? 'ok' : 'erreur', $dih_chemin, $dih_articles === (int) $dih_page->ID ? 'page des articles' : 'à choisir comme « Page des articles » (Réglages → Lecture)' );
			continue;
		}
		$dih_gabarit = (string) get_page_template_slug( $dih_page->ID );
		$dih_attendu = $dih_gabarits[ $dih_cle ];
		$dih_ligne( $dih_gabarit === $dih_attendu ? 'ok' : 'erreur', $dih_chemin, $dih_gabarit === $dih_attendu ? $dih_page->post_title : 'gabarit « ' . ( '' !== $dih_gabarit ? $dih_gabarit : 'par défaut' ) . ' », attendu « ' . $dih_attendu . ' »' );
	}
}

echo "\n== Formulaires\n";

if ( ! function_exists( 'dih_core_formulaires_liste' ) || ! function_exists( 'dih_core_formulaires_ids' ) ) {
	$dih_ligne( 'erreur', 'Formulaires', 'plugin Diag Imm’Hauts — Cœur inactif : contrôle impossible' );
} else {
	global $wpdb;
	$dih_table = $wpdb->prefix . 'fluentform_forms';
	$dih_ids   = dih_core_formulaires_ids();
	foreach ( dih_core_formulaires_liste() as $dih_cle => $dih_def ) {
		$dih_id = isset( $dih_ids[ $dih_cle ] ) ? (int) $dih_ids[ $dih_cle ] : 0;
		$dih_ok = $dih_id && (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$dih_table} WHERE id = %d", $dih_id ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$dih_ligne( $dih_ok ? 'ok' : 'erreur', $dih_def[0], $dih_ok ? 'Fluent Forms n° ' . $dih_id : 'non créé : wp eval-file outils/importer-formulaires.php' );
	}
	// Même indicateur que outils/importer-formulaires.php.
	$dih_turnstile = (bool) get_option( '_fluentform_turnstile_keys_status', false );
	$dih_ligne( $dih_turnstile ? 'ok' : 'a_faire', 'Cloudflare Turnstile', $dih_turnstile ? 'clés enregistrées (relancer l’import des formulaires avec « forcer » s’il date d’avant)' : 'clés à saisir dans Fluent Forms → Global Settings, puis import avec « forcer »' );
}

echo "\n== Mise en ligne\n";

$dih_public = (int) get_option( 'blog_public' );
$dih_ligne( $dih_public ? 'ok' : 'a_faire', 'Visibilité aux moteurs de recherche', $dih_public ? 'visible' : 'masquée (Réglages → Lecture) : à ouvrir le jour de la mise en ligne' );

// Mentions légales : informations encore marquées {a completer: …} (surlignées sur le site).
if ( function_exists( 'dih_chemins' ) && function_exists( 'dih_contenu' ) ) {
	global $wpdb;
	$dih_mentions = get_page_by_path( trim( dih_chemins()['mentions'], '/' ) );
	$dih_trous    = 0;
	if ( $dih_mentions ) {
		// Textes importés dans l'admin (encart « Textes de la page »), sinon ceux du thème.
		$dih_importes = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key = 'editeur_titre' AND meta_value <> ''", $dih_mentions->ID ) );
		$dih_trous    = $dih_importes
			? (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key NOT LIKE '\\_%%' AND meta_value LIKE %s", $dih_mentions->ID, '%{a completer%' ) )
			: substr_count( wp_json_encode( dih_contenu( 'mentions' ) ), '{a completer' );
	}
	$dih_ligne( $dih_trous ? 'a_faire' : 'ok', 'Mentions légales', $dih_trous ? $dih_trous . ' information(s) « à compléter » (n° de certification, assurance, médiateur…) : Pages → Mentions légales' : 'complètes' );
}

$dih_smtp = get_option( 'fluentmail-settings' ); // réglages de FluentSMTP
$dih_ligne( ! empty( $dih_smtp['connections'] ) ? 'ok' : 'a_faire', 'Envoi des e-mails (FluentSMTP)', ! empty( $dih_smtp['connections'] ) ? 'connexion configurée' : 'connexion Brevo à configurer (README § Mise en ligne)' );

printf( "\nBilan : %d OK, %d à faire, %d erreur(s).\n", $dih_bilan['ok'], $dih_bilan['a_faire'], $dih_bilan['erreur'] );
if ( $dih_bilan['erreur'] && class_exists( 'WP_CLI' ) ) {
	WP_CLI::halt( 1 );
}
