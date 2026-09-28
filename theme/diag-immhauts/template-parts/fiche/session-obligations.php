<?php
/**
 * Session « Vos obligations » : panneau vert foncé, trois cartes à pastille
 * colorée (vert clair, jaune, orange — ou classes E / F de l'étiquette DPE).
 *
 * Arguments : surtitre, titre, texte? (paragraphe d'ouverture : audit, DTG),
 * cartes [ pastille, teinte, titre, texte, illustration? ].
 * L'illustration facultative (plomb) flotte à droite de la pastille.
 * Teintes : vert | jaune | orange | dpe-e | dpe-f.
 *
 * @package DiagImmHauts
 */

?>
<section class="l-session l-session--obligations">
	<div class="c-panneau">
		<div class="c-panneau__halo" aria-hidden="true"></div>
		<div class="c-panneau__int">
			<?php echo dih_surtitre( $args['surtitre'], 'c-surtitre--clair c-surtitre--serre' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre c-panneau__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<?php if ( ! empty( $args['texte'] ) ) : ?>
				<p class="c-panneau__texte"><?php echo esc_html( $args['texte'] ); ?></p>
			<?php endif; ?>
			<ul class="c-panneau__grille">
				<?php foreach ( $args['cartes'] as $dih_c ) : ?>
					<li class="c-card c-card--obligation">
						<?php if ( ! empty( $dih_c[4] ) ) : ?>
							<span class="c-card__illus" aria-hidden="true" style="background-image:url('<?php echo esc_url( dih_img( $dih_c[4] ) ); ?>')"></span>
						<?php endif; ?>
						<span class="c-badge c-badge--<?php echo esc_attr( $dih_c[1] ); ?>"><?php echo esc_html( $dih_c[0] ); ?></span>
						<span class="c-card__titre"><?php echo esc_html( $dih_c[2] ); ?></span>
						<p class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
