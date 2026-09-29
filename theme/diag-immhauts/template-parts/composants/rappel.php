<?php
/**
 * Bloc « Un projet… ? » (#rappel) en bas de page : titre, texte, deux boutons,
 * photo de Max au téléphone (bureau et déplié).
 *
 * Boutons (README § Bloc « rappel ») : le formulaire et l'appel. Bureau et
 * tablette : formulaire en premier, bouton principal ; appel en secondaire.
 * Téléphone : l'appel passe en premier, en principal (composants/_formulaire.scss).
 *
 * Arguments : titre, texte (défauts : ceux de l'accueil), variante :
 * - '' (accueil) : formulaire = « Demande de rappel gratuit » (popup) ;
 * - 'fiche' : formulaire = « Formulaire de devis » (page Contact) ;
 * - 'page' : pages intérieures hors fiches (Nos diagnostics…), bloc plus aéré.
 * formulaire (fiches) : [ libellé, cible ] du bouton formulaire (défaut : « Formulaire
 * de devis » vers Contact ; DTG : « Offre syndics & bailleurs » vers Professionnels).
 * boutons : 'obligations' (fiche DPE) remplace l'appel par « Vérifier mes
 * obligations » (simulateur), sans inversion sur téléphone.
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
		'boutons'    => '',
		'formulaire' => array( 'Formulaire de devis', array( 'contact', '#devis' ) ),
	)
);
$dih_fiche = 'fiche' === $dih_args['variante'];
$dih_tel  = 'Appeler le <span class="l-insecable">' . esc_html( dih_info( 'telephone' ) ) . '</span>';
?>
<?php
$dih_classes = array( 'c-rappel' );
if ( $dih_fiche ) {
	$dih_classes[] = 'c-rappel--fiche';
} elseif ( 'page' === $dih_args['variante'] ) {
	$dih_classes[] = 'c-rappel--page';
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
					if ( 'obligations' === $dih_args['boutons'] ) {
						echo dih_bouton( 'Demander un devis gratuit', dih_attr_rappel(), 'enveloppe', 'c-btn--vert c-btn--grand' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo dih_bouton( 'Vérifier mes obligations', 'href="' . esc_url( dih_url( 'simulateur' ) ) . '"', 'fleche-courte', 'c-btn--contour c-btn--grand' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					} else {
						if ( $dih_fiche || 'page' === $dih_args['variante'] ) {
							$dih_f = $dih_args['formulaire'];
							$dih_u = is_array( $dih_f[1] ) ? dih_url( $dih_f[1][0], ltrim( $dih_f[1][1], '#' ) ) : dih_url_cible( $dih_f[1] );
							echo dih_bouton( $dih_f[0], 'href="' . esc_url( $dih_u ) . '"', 'enveloppe', 'c-btn--grand c-rappel__cta c-rappel__cta--form' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							echo dih_bouton( $dih_c['cta_2'], dih_attr_rappel(), 'enveloppe', 'c-btn--grand c-rappel__cta c-rappel__cta--form' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						echo dih_bouton( $dih_tel, 'href="tel:' . esc_attr( dih_info( 'telephone_lien' ) ) . '"', 'telephone', 'c-btn--grand c-rappel__cta c-rappel__cta--appel' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
