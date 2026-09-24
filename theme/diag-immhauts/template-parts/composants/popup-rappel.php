<?php
/**
 * Popup « Demande de rappel » : ouverte par tout lien [data-dih-rappel]
 * (header, hero, fiches, pied de page). Formulaire court Fluent Forms.
 *
 * @package DiagImmHauts
 */

?>
<div class="c-popup" id="popup-rappel" role="dialog" aria-modal="true" aria-labelledby="popup-rappel-titre" hidden data-dih-popup>
	<div class="c-popup__boite" data-dih-popup-boite tabindex="-1">
		<div class="c-popup__tete">
			<div>
				<div class="c-surtitre c-surtitre--petit"><span aria-hidden="true"></span>Devis gratuit</div>
				<h2 class="c-popup__titre" id="popup-rappel-titre">Rappel sous 24 h</h2>
			</div>
			<button type="button" class="c-popup__fermer" data-dih-popup-fermer aria-label="Fermer">×</button>
		</div>
		<p class="c-popup__intro">Quelques champs suffisent&nbsp;: je vous rappelle avec un prix ferme, tout compris.</p>
		<div class="c-popup__form">
			<?php dih_formulaire( 'rappel' ); ?>
		</div>
		<div class="c-popup__rgpd">Vos coordonnées servent uniquement à répondre à votre demande — <a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">politique de confidentialité</a></div>
		<div class="c-popup__pied">
			<span>Plus rapide&nbsp;? <a class="c-popup__tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>"><?php echo esc_html( dih_info( 'telephone' ) ); ?></a></span>
			<a class="c-popup__detail" href="<?php echo esc_url( dih_url( 'contact' ) ); ?>">Formulaire détaillé <span class="c-fleche"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
		</div>
	</div>
</div>
