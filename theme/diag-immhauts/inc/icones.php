<?php
/**
 * Pictos SVG en ligne (tracés repris des maquettes).
 *
 * @package DiagImmHauts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Retourne le SVG d'un picto.
 *
 * @param string $nom    'enveloppe' | 'fleche' | 'telephone' | 'telephone-plein' | 'fermer'.
 * @param int    $taille Largeur et hauteur en px.
 * @param array  $args   'epaisseur' (trait), 'classe'.
 * @return string
 */
function dih_icone( $nom, $taille = 16, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'epaisseur' => 2,
			'classe'    => '',
		)
	);

	$traces = array(
		'enveloppe'       => '<rect x="2.5" y="4.5" width="19" height="15" rx="2.5"/><path d="m3.5 6.5 8.5 6 8.5-6"/>',
		'fleche'          => '<path d="M4 12h15M13.5 6.2 20 12l-6.5 5.8"/>',
		'fleche-bas'      => '<path d="M12 4v15M6.2 13.5 12 20l5.8-6.5"/>',
		'telephone'       => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'telephone-plein' => '<path d="M6.9 2.5H4.6A2.1 2.1 0 0 0 2.5 4.7c0 8.9 7.2 16.1 16.1 16.1a2.1 2.1 0 0 0 2.1-2.1v-2.3a1.6 1.6 0 0 0-1.2-1.6l-3-.8a1.6 1.6 0 0 0-1.6.5l-.7.9a13.6 13.6 0 0 1-5.1-5.1l.9-.7a1.6 1.6 0 0 0 .5-1.6l-.8-3a1.6 1.6 0 0 0-1.6-1.2z"/>',
	);

	if ( ! isset( $traces[ $nom ] ) ) {
		return '';
	}

	$plein  = 'telephone-plein' === $nom;
	$classe = $args['classe'] ? ' class="' . esc_attr( $args['classe'] ) . '"' : '';

	if ( $plein ) {
		return sprintf(
			'<svg%s width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">%3$s</svg>',
			$classe,
			(int) $taille,
			$traces[ $nom ]
		);
	}

	return sprintf(
		'<svg%s width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%3$s" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%4$s</svg>',
		$classe,
		(int) $taille,
		esc_attr( $args['epaisseur'] ),
		$traces[ $nom ]
	);
}
