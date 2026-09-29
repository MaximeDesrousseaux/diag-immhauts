<?php
/**
 * Popup « Demande de rappel » : ouverte par tout lien [data-dih-rappel]
 * (header, hero, fiches, pied de page). Formulaire court Fluent Forms.
 * Une page peut fournir sa propre version (section « popup » de ses contenus :
 * Professionnels → « Compte partenaire », formulaire partenaire).
 *
 * @package DiagImmHauts
 */

$dih_p = array(
	'surtitre'   => 'Devis gratuit',
	'titre'      => 'Rappel sous 24 h',
	'intro'      => 'Quelques champs suffisent : je vous rappelle avec un prix ferme, tout compris.',
	'formulaire' => 'rappel',
);
if ( 'pros' === dih_page_courante() ) {
	$dih_p = dih_contenu( 'professionnels', 'popup' ) + $dih_p;
}
?>
<div class="c-popup" id="popup-rappel" role="dialog" aria-modal="true" aria-labelledby="popup-rappel-titre" hidden data-dih-popup>
	<div class="c-popup__boite" data-dih-popup-boite tabindex="-1">
		<div class="c-popup__tete">
			<div>
				<div class="c-surtitre c-surtitre--petit"><span aria-hidden="true"></span><?php echo esc_html( $dih_p['surtitre'] ); ?></div>
				<h2 class="c-popup__titre" id="popup-rappel-titre"><?php echo esc_html( $dih_p['titre'] ); ?></h2>
			</div>
			<button type="button" class="c-popup__fermer" data-dih-popup-fermer aria-label="Fermer">×</button>
		</div>
		<p class="c-popup__intro"><?php echo esc_html( $dih_p['intro'] ); ?></p>
		<div class="c-popup__form">
			<?php dih_formulaire( $dih_p['formulaire'] ); ?>
		</div>
		<div class="c-popup__rgpd">Vos coordonnées servent uniquement à répondre à votre demande — <a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">politique de confidentialité</a></div>
		<div class="c-popup__pied">
			<span>Plus rapide&nbsp;? <a class="c-popup__tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>"><?php echo esc_html( dih_info( 'telephone' ) ); ?></a></span>
			<a class="c-popup__detail" href="<?php echo esc_url( dih_url( 'contact' ) ); ?>">Formulaire détaillé <span class="c-fleche"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
		</div>
	</div>
</div>
