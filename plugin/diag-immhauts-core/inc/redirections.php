<?php
/**
 * Plan de migration (README § SEO, Audit SEO.dc.html, chantier P2) : les
 * anciennes adresses du site renvoient en 301 vers les nouvelles, ce qui
 * transfère l'ancienneté acquise. « / » et « /mentions-legales/ » ne changent
 * pas ; l'ancien journal est repris comme journal (/actualites/).
 *
 * Une redirection ne s'applique qu'à une adresse sans contenu (404) : elle ne
 * masque jamais une page existante. Elle passe avant les suppositions de
 * WordPress (redirect_canonical), qui pourraient viser une autre page.
 *
 * @package DiagImmHautsCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Ancien chemin => nouveau chemin.
 *
 * @return array<string, string>
 */
function dih_core_redirections() {
	return apply_filters(
		'dih_redirections',
		array(
			'/diagnostics-immobiliers-vente-location/'             => '/diagnostics-immobiliers/',
			'/wp/diagnostics-immobiliers-vente-location/'          => '/diagnostics-immobiliers/',
			'/diagnostics-immobiliers-coproprietes-collectivites/' => '/dtg-dpe-collectif/',
			'/audits-energetiques/'                                => '/audit-energetique/',
			'/max-dillies-diag-imm-hauts/'                         => '/maxime-dillies-diagnostiqueur/',
			'/demandez-un-rappel/'                                 => '/contact-devis/',
			'/wp/demandez-un-rappel/'                              => '/contact-devis/',
			'/actualites-diagnostics-immobiliers/'                 => '/actualites/',
		)
	);
}

add_action(
	'template_redirect',
	function () {
		if ( ! is_404() ) {
			return;
		}

		$requete = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$chemin  = (string) wp_parse_url( $requete, PHP_URL_PATH );
		$base    = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ); // site installé dans un sous-dossier
		if ( '' !== $base && '/' !== $base && 0 === strpos( $chemin, $base ) ) {
			$chemin = substr( $chemin, strlen( $base ) - 1 );
		}
		$chemin = strtolower( trailingslashit( '/' . ltrim( $chemin, '/' ) ) );

		$redirections = dih_core_redirections();
		if ( isset( $redirections[ $chemin ] ) ) {
			wp_safe_redirect( home_url( $redirections[ $chemin ] ), 301, "Diag Imm'Hauts" );
			exit;
		}
	},
	1
);
