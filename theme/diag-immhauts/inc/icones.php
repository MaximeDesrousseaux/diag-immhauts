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
		'chevron-gauche'  => '<path d="M15 6l-6 6 6 6"/>',
		'chevron-droite'  => '<path d="M9 6l6 6-6 6"/>',
		'fleche-courte'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'descendre'       => '<path d="M12 5v14M6 13l6 6 6-6"/>',
		'bouclier'        => '<path d="M12 3 5 6v5c0 4 3 7 7 8 4-1 7-4 7-8V6z"/><path d="m9 12 2 2 4-4"/>',
		'medaille'        => '<circle cx="12" cy="9" r="5"/><path d="M9 13 8 21l4-2 4 2-1-8"/>',
		'repere'          => '<path d="M12 21s7-6.3 7-11a7 7 0 1 0-14 0c0 4.7 7 11 7 11z"/><circle cx="12" cy="10" r="2.4"/>',
		'coche'           => '<path d="M20 6 9 17l-5-5"/>',
		'bulle'           => '<path d="M4 5h16v11H8l-4 4z"/>',
		'horloge'         => '<circle cx="12" cy="12" r="8"/><path d="M12 8v4l3 2"/>',
		'calendrier'      => '<rect x="4" y="5" width="16" height="16" rx="2"/><path d="M8 3v4M16 3v4M4 11h16"/>',
		'document'        => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5"/>',
		'jauge'           => '<path d="M12 13 15 9"/><path d="M4 18a8 8 0 1 1 16 0"/><circle cx="12" cy="13" r="1.2" fill="currentColor" stroke="none"/>',
		'feuille'         => '<path d="M4 20C4 10 12 4 20 4c0 8-6 16-16 16z"/><path d="M4 20C8 16 12 12 18 8"/>',
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

/**
 * SVG à partir d'un tracé écrit dans les contenus (pictos propres à une fiche).
 * Même gabarit que dih_icone() : 24 × 24, trait en currentColor.
 *
 * @param string $traces Éléments SVG (path, rect, circle…) relevés sur la maquette.
 * @param int    $taille Largeur et hauteur en px.
 * @return string
 */
function dih_svg( $traces, $taille = 22 ) {
	$autorises = array(
		'path'     => array( 'd' => true, 'fill' => true, 'stroke' => true ),
		'rect'     => array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true ),
		'circle'   => array( 'cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true ),
		'line'     => array( 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true ),
		'polyline' => array( 'points' => true ),
		'ellipse'  => array( 'cx' => true, 'cy' => true, 'rx' => true, 'ry' => true ),
	);
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%2$s</svg>',
		(int) $taille,
		wp_kses( $traces, $autorises )
	);
}
