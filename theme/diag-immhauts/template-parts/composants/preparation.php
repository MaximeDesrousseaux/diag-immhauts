<?php
/**
 * « À préparer avant ma visite » : titre, texte, liste cochée.
 * Sous le bloc 4 étapes (fiches) ou dans la session « résultat » (DTG).
 *
 * Arguments : titre, texte, liste, style ('' : carte blanche, liste en deux
 * colonnes ; 'large' : fond de page, rembourrage jusqu'à 40 px, colonnes de 250 px).
 *
 * @package DiagImmHauts
 */

$dih_args = wp_parse_args(
	$args,
	array(
		'titre' => '',
		'texte' => '',
		'liste' => array(),
		'style' => '',
	)
);
?>
<div class="c-prep<?php echo 'large' === $dih_args['style'] ? ' c-prep--large' : ''; ?>">
	<h3 class="c-prep__titre"><?php echo esc_html( $dih_args['titre'] ); ?></h3>
	<p class="c-prep__texte"><?php echo esc_html( $dih_args['texte'] ); ?></p>
	<ul class="c-prep__liste">
		<?php foreach ( $dih_args['liste'] as $dih_p ) : ?>
			<li><span class="c-prep__coche" aria-hidden="true">✓</span><?php echo esc_html( $dih_p ); ?></li>
		<?php endforeach; ?>
	</ul>
</div>
