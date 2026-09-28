<?php
/**
 * Bloc « Un projet… ? » (#rappel) en bas de page : titre, texte, appel direct,
 * demande de rappel, photo de Max au téléphone (bureau et déplié).
 *
 * Arguments : titre, texte (défauts : ceux de l'accueil), variante :
 * - '' (accueil) : « Appeler le 06… » + « Demande de rappel gratuit » ;
 * - 'fiche' : « Demander un devis gratuit » (popup) + « Vérifier mes obligations » (simulateur).
 * options (fiches) : 'haut' (rembourrage vertical jusqu'à 40 px, mesurage),
 * 'photo-large' (photo sur toute la colonne, assainissement).
 *
 * @package DiagImmHauts
 */

$dih_c    = dih_contenu( 'accueil', 'rappel' );
$dih_args = wp_parse_args(
	$args,
	array(
		'titre'    => $dih_c['titre'],
		'texte'    => $dih_c['texte'],
		'variante' => '',
		'options'  => array(),
	)
);
$dih_fiche = 'fiche' === $dih_args['variante'];
$dih_tel  = '<span class="c-rappel__appel">Appeler le</span> <span class="l-insecable">' . esc_html( dih_info( 'telephone' ) ) . '</span>';
?>
<?php
$dih_classes = array( 'c-rappel' );
if ( $dih_fiche ) {
	$dih_classes[] = 'c-rappel--fiche';
}
foreach ( (array) $dih_args['options'] as $dih_option_rappel ) {
	$dih_classes[] = 'c-rappel--' . sanitize_html_class( $dih_option_rappel );
}
?>
<section class="<?php echo esc_attr( implode( ' ', $dih_classes ) ); ?>" id="rappel">
	<div class="c-rappel__bloc">
		<div class="c-rappel__halo" aria-hidden="true"></div>
		<img class="c-rappel__fond" src="<?php echo esc_url( dih_img( $dih_c['photo'] ) ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async" width="720" height="900">
		<div class="c-rappel__grille">
			<div class="c-rappel__texte">
				<h2 class="c-rappel__titre"><?php echo esc_html( $dih_args['titre'] ); ?></h2>
				<p class="c-rappel__para"><?php echo esc_html( $dih_args['texte'] ); ?></p>
				<div class="c-rappel__actions">
					<?php
					if ( $dih_fiche ) {
						echo dih_bouton( 'Demander un devis gratuit', dih_attr_rappel(), 'enveloppe', 'c-btn--vert c-btn--grand' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo dih_bouton( 'Vérifier mes obligations', 'href="' . esc_url( dih_url( 'simulateur' ) ) . '"', 'fleche-courte', 'c-btn--contour c-btn--grand c-btn--serre' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					} else {
						echo dih_bouton( $dih_tel, 'href="tel:' . esc_attr( dih_info( 'telephone_lien' ) ) . '"', 'telephone', 'c-btn--vert c-btn--grand' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo dih_bouton( $dih_c['cta_2'], dih_attr_rappel(), 'enveloppe', 'c-btn--contour c-btn--grand' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			</div>
			<div class="c-rappel__photo">
				<div class="c-rappel__photo-halo" aria-hidden="true"></div>
				<img src="<?php echo esc_url( dih_img( $dih_c['photo'] ) ); ?>" alt="<?php echo esc_attr( $dih_c['photo_alt'] ); ?>" loading="lazy" decoding="async" width="720" height="900">
			</div>
		</div>
	</div>
</section>
