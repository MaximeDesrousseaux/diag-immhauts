<?php
/**
 * Popup « Demande de rappel » : ouverte par tout lien [data-dih-rappel]
 * (header, hero, fiches, pied de page). Formulaire court Fluent Forms.
 *
 * @package DiagImmHauts
 */

?>
<div class="dih-popup" id="dih-rappel" role="dialog" aria-modal="true" aria-labelledby="dih-rappel-titre" hidden data-dih-popup>
	<div class="dih-popup-boite" data-dih-popup-boite tabindex="-1">
		<div class="dih-popup-tete">
			<div>
				<div class="dih-surtitre"><span aria-hidden="true"></span>Devis gratuit</div>
				<h2 class="dih-popup-titre" id="dih-rappel-titre">Rappel sous 24 h</h2>
			</div>
			<button type="button" class="dih-popup-fermer" data-dih-popup-fermer aria-label="Fermer">×</button>
		</div>
		<p class="dih-popup-intro">Quelques champs suffisent&nbsp;: je vous rappelle avec un prix ferme, tout compris.</p>
		<div class="dih-popup-form">
			<?php dih_formulaire( 'rappel' ); ?>
		</div>
		<div class="dih-popup-rgpd">Vos coordonnées servent uniquement à répondre à votre demande — <a href="<?php echo esc_url( dih_url( 'mentions', 'confidentialite' ) ); ?>">politique de confidentialité</a></div>
		<div class="dih-popup-pied">
			<span>Plus rapide&nbsp;? <a class="dih-popup-tel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>"><?php echo esc_html( dih_info( 'telephone' ) ); ?></a></span>
			<a class="dih-popup-detail" href="<?php echo esc_url( dih_url( 'contact' ) ); ?>">Formulaire détaillé <span class="dih-arrow"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
		</div>
	</div>
</div>
