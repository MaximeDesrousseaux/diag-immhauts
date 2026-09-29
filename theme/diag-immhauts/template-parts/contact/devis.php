<?php
/**
 * Formulaire de devis (#devis) et colonne de contact.
 *
 * Grand bureau (≥ 1151 px) : formulaire | colonne (1,5 fr | 1 fr).
 * En dessous : colonne sous le formulaire, en grille (téléphone et zone sur
 * toute la largeur, horaires | coordonnées) ; une seule colonne sur téléphone.
 *
 * @package DiagImmHauts
 */

$dih_tel = dih_info( 'telephone' );
?>
<section class="l-section l-devis" id="devis">
	<div class="l-devis__grille">
		<div class="l-devis__form">
			<h2 class="l-devis__titre"><?php echo esc_html( $args['formulaire']['titre'] ); ?></h2>
			<p class="l-devis__intro"><?php echo esc_html( $args['formulaire']['intro'] ); ?></p>
			<div class="l-devis__champs">
				<?php dih_formulaire( 'devis' ); ?>
			</div>
		</div>

		<div class="l-devis__cote">
			<div class="c-bloc-contact c-bloc-contact--tel">
				<h2 class="c-bloc-contact__titre"><?php echo esc_html( $args['telephone']['titre'] ); ?></h2>
				<p class="c-bloc-contact__texte"><?php echo esc_html( $args['telephone']['texte'] ); ?></p>
				<a class="c-bloc-contact__appel" href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>"><?php echo esc_html( $dih_tel ); ?></a>
				<a class="c-bloc-contact__mail" href="mailto:<?php echo esc_attr( dih_info( 'email' ) ); ?>"><?php echo esc_html( dih_info( 'email' ) ); ?></a>
			</div>

			<div class="c-bloc-contact c-bloc-contact--horaires">
				<h2 class="c-bloc-contact__titre"><?php echo esc_html( $args['horaires']['titre'] ); ?></h2>
				<dl class="c-bloc-contact__horaires">
					<?php foreach ( $args['horaires']['lignes'] as $dih_h ) : ?>
						<div><dt><?php echo esc_html( $dih_h[0] ); ?></dt><dd><?php echo esc_html( $dih_h[1] ); ?></dd></div>
					<?php endforeach; ?>
				</dl>
			</div>

			<div class="c-bloc-contact c-bloc-contact--zone">
				<h2 class="c-bloc-contact__titre"><?php echo esc_html( $args['zone']['titre'] ); ?></h2>
				<p class="c-bloc-contact__texte"><?php echo esc_html( $args['zone']['texte'] ); ?></p>
				<ul class="c-bloc-contact__communes">
					<?php foreach ( $args['zone']['communes'] as $dih_commune ) : ?>
						<li><?php echo esc_html( $dih_commune ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p class="c-bloc-contact__note"><?php echo esc_html( $args['zone']['note'] ); ?></p>
			</div>

			<div class="c-bloc-contact c-bloc-contact--coordonnees">
				<h2 class="c-bloc-contact__titre"><?php echo esc_html( $args['coordonnees']['titre'] ); ?></h2>
				<address class="c-bloc-contact__adresse">
					<?php echo implode( '<br>', array_map( 'esc_html', $args['coordonnees']['lignes'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</address>
			</div>
		</div>
	</div>
</section>
