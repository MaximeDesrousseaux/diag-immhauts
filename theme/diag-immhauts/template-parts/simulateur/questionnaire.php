<?php
/**
 * Questionnaire et dossier (#simulateur, #resultats).
 *
 * Le formulaire est fait de vrais boutons radio et cases à cocher (lisibles au
 * clavier et par les lecteurs d'écran) ; les pastilles sont du CSS (:has(:checked)).
 * simulateur.js lit le formulaire, applique les règles de la maquette et
 * recompose le dossier. Sans JS : l'état initial et ses résultats.
 *
 * @package DiagImmHauts
 */

$dih_f   = $args['formulaire'];
$dih_r   = $args['resultats'];
$dih_def = $dih_f['defaut'];

// Catalogue pour simulateur.js : URL et illustration résolues côté PHP.
$dih_catalogue = array();
foreach ( $args['catalogue'] as $dih_id => $dih_d ) {
	$dih_illus = array_key_exists( 'illus', $dih_d ) ? $dih_d['illus'] : dih_illus_diagnostic( $dih_d['page'] );

	$dih_catalogue[ $dih_id ] = array(
		'url'      => dih_url( $dih_d['page'] ),
		'titre'    => $dih_d['titre'],
		'statut'   => $dih_d['statut'],
		'validite' => $dih_d['validite'],
		'texte'    => $dih_d['texte'],
		'illus'    => $dih_illus ? dih_img( $dih_illus ) : '',
	);
}

/**
 * Données d'une carte pour template-parts/simulateur/carte.php (motif : vente).
 */
$dih_carte = function ( $id, $vue ) use ( $dih_catalogue, $dih_r ) {
	$d     = $dih_catalogue[ $id ];
	$texte = is_array( $d['texte'] ) ? $d['texte']['vente'] : $d['texte'];
	$val   = is_array( $d['validite'] ) ? $d['validite']['vente'] : $d['validite'];
	return array(
		'vue'            => $vue,
		'url'            => $d['url'],
		'titre'          => $d['titre'],
		'validite'       => $val,
		'texte'          => $texte,
		'statut'         => $d['statut'],
		'statut_libelle' => $dih_r['statuts'][ $d['statut'] ],
		'illus'          => $d['illus'],
		'libelles'       => $dih_r,
	);
};

$dih_n      = count( $dih_r['defaut'] );
$dih_compte = $dih_n . ( $dih_n > 1 ? ' diagnostics' : ' diagnostic' );
$dih_obl    = count( array_filter( $dih_r['defaut'], fn( $id ) => 'obligatoire' === $dih_catalogue[ $id ]['statut'] ) );
$dih_resume = $dih_obl . ( $dih_obl > 1 ? ' obligatoires' : ' obligatoire' ) . ' · ' . mb_strtolower( $dih_def['motif'] . ' · ' . $dih_def['type'] . ' · ' . $dih_def['annee'] );

$dih_donnees = array(
	'catalogue' => $dih_catalogue,
	'statuts'   => $dih_r['statuts'],
	'popup'     => $dih_r['popup'],
);

/**
 * Groupe de boutons radio en pastilles.
 */
$dih_radios = function ( $nom, $groupe, $defaut, $classe ) {
	?>
	<fieldset class="c-simulateur__groupe">
		<legend class="c-simulateur__legende"><?php echo esc_html( $groupe[0] ); ?></legend>
		<div class="c-simulateur__choix c-simulateur__choix--<?php echo esc_attr( $classe ); ?>">
			<?php foreach ( $groupe[1] as $dih_cle => $dih_val ) : ?>
				<?php
				$dih_libelle = is_string( $dih_cle ) ? $dih_cle : $dih_val;
				$dih_image   = is_string( $dih_cle ) ? $dih_val : '';
				?>
				<label class="c-choix<?php echo $dih_image ? ' c-choix--type' : ''; ?>">
					<input class="c-choix__input" type="radio" name="<?php echo esc_attr( $nom ); ?>" value="<?php echo esc_attr( $dih_libelle ); ?>"<?php checked( $dih_libelle, $defaut ); ?>>
					<?php if ( $dih_image ) : ?>
						<span class="c-choix__illus" aria-hidden="true" style="background-image:url('<?php echo esc_url( dih_img( $dih_image ) ); ?>')"></span>
					<?php endif; ?>
					<span class="c-choix__texte"><?php echo esc_html( $dih_libelle ); ?></span>
				</label>
			<?php endforeach; ?>
		</div>
	</fieldset>
	<?php
};
?>
<section class="l-section l-simulateur" id="simulateur" data-dih-simulateur data-vue="mosaique">
	<form class="c-simulateur" action="#resultats" data-sim-form>
		<h2 class="c-simulateur__titre"><?php echo esc_html( $dih_f['titre'] ); ?></h2>

		<?php $dih_radios( 'motif', $dih_f['motif'], $dih_def['motif'], 'ligne' ); ?>

		<div class="c-simulateur__bloc c-simulateur__bloc--bien">
			<?php
			$dih_radios( 'type', $dih_f['type'], $dih_def['type'], 'types' );
			$dih_radios( 'annee', $dih_f['annee'], $dih_def['annee'], 'ligne' );
			?>
		</div>

		<fieldset class="c-simulateur__bloc c-simulateur__groupe">
			<legend class="c-simulateur__legende c-simulateur__legende--serree"><?php echo esc_html( $dih_f['precisions'] ); ?></legend>
			<p class="c-simulateur__aide"><?php echo esc_html( $dih_f['aide'] ); ?></p>
			<div class="c-simulateur__cases">
				<?php foreach ( $dih_f['cases'] as $dih_cle => $dih_libelle ) : ?>
					<label class="c-case">
						<input class="c-choix__input" type="checkbox" name="<?php echo esc_attr( $dih_cle ); ?>" value="1"<?php checked( in_array( $dih_cle, $dih_def['cases'], true ) ); ?>>
						<span class="c-case__boite" aria-hidden="true">✓</span>
						<span class="c-case__texte"><?php echo esc_html( $dih_libelle ); ?></span>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>

		<div class="c-simulateur__actions">
			<?php echo dih_bouton( $dih_f['cta'], 'href="#resultats"', 'descendre', 'c-btn--vert c-btn--ombre-douce c-simulateur__cta' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<button class="c-simulateur__reset" type="reset"><?php echo esc_html( $dih_f['reset'] ); ?></button>
		</div>
	</form>

	<div class="c-dossier" id="resultats">
		<div class="c-dossier__halo" aria-hidden="true"></div>
		<div class="c-dossier__tete">
			<div class="c-dossier__surtitre"><?php echo esc_html( $dih_r['surtitre'] ); ?></div>
			<div class="c-dossier__ligne">
				<div class="c-dossier__compte" data-sim-compte aria-live="polite"><?php echo esc_html( $dih_compte ); ?></div>
				<div class="c-dossier__resume" data-sim-resume><?php echo esc_html( $dih_resume ); ?></div>
				<div class="c-dossier__vues" role="group" aria-label="Affichage" data-sim-vues hidden>
					<button type="button" class="c-dossier__vue" data-sim-vue="liste" aria-pressed="false"><?php echo dih_icone( 'liste', 15, array( 'epaisseur' => 2.2 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $dih_r['liste'] ); ?></button>
					<button type="button" class="c-dossier__vue" data-sim-vue="mosaique" aria-pressed="true"><?php echo dih_icone( 'mosaique', 15, array( 'epaisseur' => 2.2 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $dih_r['mosaique'] ); ?></button>
				</div>
			</div>
		</div>
		<div class="c-dossier__grille" data-sim-liste>
			<?php
			foreach ( $dih_r['defaut'] as $dih_id ) {
				get_template_part( 'template-parts/simulateur/carte', null, $dih_carte( $dih_id, 'mosaique' ) );
			}
			?>
		</div>
		<div class="c-dossier__actions">
			<?php
			$dih_intro = sprintf( $dih_r['popup'], $dih_compte );
			echo dih_bouton( $dih_r['devis'], dih_attr_rappel() . ' data-dih-rappel-intro="' . esc_attr( $dih_intro ) . '" data-sim-devis', 'fleche-courte', 'c-btn--vert c-btn--fiche' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dih_bouton( $dih_r['modifier'], 'href="#simulateur"', 'monter', 'c-btn--contour c-dossier__modifier' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
		<p class="c-dossier__note"><?php echo esc_html( $dih_r['note'] ); ?></p>
	</div>

	<?php foreach ( array( 'mosaique', 'liste' ) as $dih_vue ) : ?>
		<template data-sim-modele="<?php echo esc_attr( $dih_vue ); ?>">
			<?php get_template_part( 'template-parts/simulateur/carte', null, array( 'vue' => $dih_vue, 'libelles' => $dih_r ) ); ?>
		</template>
	<?php endforeach; ?>
	<script type="application/json" data-sim-donnees><?php echo wp_json_encode( $dih_donnees, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG ); ?></script>
</section>
