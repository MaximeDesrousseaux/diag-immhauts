<?php
/**
 * Un diagnostic du dossier, en mosaïque (card illustrée) ou en liste (ligne).
 * Rendu par PHP pour l'état initial, et en <template> vide que simulateur.js
 * clone et remplit (repères [data-champ]).
 *
 * Arguments : vue ('mosaique' | 'liste'), et pour un diagnostic : url, titre,
 * validite, texte, statut, statut_libelle, illus (URL, ou vide), libelles.
 *
 * @package DiagImmHauts
 */

$dih_a = wp_parse_args(
	$args,
	array(
		'vue'            => 'mosaique',
		'url'            => '#',
		'titre'          => '',
		'validite'       => '',
		'texte'          => '',
		'statut'         => 'obligatoire',
		'statut_libelle' => '',
		'illus'          => '',
		'libelles'       => array(),
	)
);
$dih_illus = $dih_a['illus'] ? ' style="background-image:url(\'' . esc_url( $dih_a['illus'] ) . '\')"' : ' hidden';
$dih_lien  = '<span class="c-card__lien">' . esc_html( $dih_a['libelles']['lien'] ) . '<span class="c-fleche">' . dih_icone( 'fleche', 15, array( 'epaisseur' => 2.6 ) ) . '</span></span>';
?>
<?php if ( 'liste' === $dih_a['vue'] ) : ?>
<a class="c-card c-card--resultat c-card--resultat-ligne" href="<?php echo esc_url( $dih_a['url'] ); ?>" data-statut="<?php echo esc_attr( $dih_a['statut'] ); ?>">
	<span class="c-card__illus" data-champ="illus"<?php echo $dih_illus; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></span>
	<span class="c-card__corps">
		<span class="c-card__entete">
			<span class="c-card__titre" data-champ="titre"><?php echo esc_html( $dih_a['titre'] ); ?></span>
			<span class="c-card__statut" data-champ="statut"><?php echo esc_html( $dih_a['statut_libelle'] ); ?></span>
		</span>
		<span class="c-card__texte" data-champ="texte"><?php echo esc_html( $dih_a['texte'] ); ?></span>
	</span>
	<span class="c-card__droite">
		<span class="c-card__validite">
			<span class="c-card__validite-libelle"><?php echo esc_html( $dih_a['libelles']['validite'] ); ?></span>
			<span class="c-card__validite-valeur" data-champ="validite"><?php echo esc_html( $dih_a['validite'] ); ?></span>
		</span>
		<?php echo $dih_lien; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
</a>
<?php else : ?>
<a class="c-card c-card--resultat" href="<?php echo esc_url( $dih_a['url'] ); ?>" data-statut="<?php echo esc_attr( $dih_a['statut'] ); ?>">
	<span class="c-card__illus" data-champ="illus"<?php echo $dih_illus; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></span>
	<span class="c-card__validite" data-champ="validite"><?php echo esc_html( $dih_a['validite'] ); ?></span>
	<span class="c-card__titre" data-champ="titre"><?php echo esc_html( $dih_a['titre'] ); ?></span>
	<span class="c-card__texte" data-champ="texte"><?php echo esc_html( $dih_a['texte'] ); ?></span>
	<span class="c-card__pied">
		<?php echo $dih_lien; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<span class="c-card__statut" data-champ="statut"><?php echo esc_html( $dih_a['statut_libelle'] ); ?></span>
	</span>
</a>
<?php endif; ?>
