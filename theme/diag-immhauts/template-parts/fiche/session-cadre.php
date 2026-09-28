<?php
/**
 * Session « Le cadre du contrôle » (9 fiches) : trois catégories à lettre
 * colorée, puis « Sur place » : ce qui est recherché, en cartes à picto.
 *
 * Arguments : surtitre, titre, texte, cartes [ lettre, teinte, titre, texte ],
 * sur_place { surtitre, titre, texte, cartes [ svg, titre, texte ] }.
 * Les pictos (tracés SVG des maquettes) sont propres à chaque fiche.
 *
 * @package DiagImmHauts
 */

$dih_sp = $args['sur_place'];
?>
<section class="l-session l-session--cadre">
	<div>
		<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
		<p class="l-session__intro"><?php echo esc_html( $args['texte'] ); ?></p>
		<ul class="l-session__grille-tiers">
			<?php foreach ( $args['cartes'] as $dih_c ) : ?>
				<li class="c-card c-card--categorie">
					<span class="c-badge c-badge--carre c-badge--<?php echo esc_attr( $dih_c[1] ); ?>" aria-hidden="true"><?php echo esc_html( $dih_c[0] ); ?></span>
					<span>
						<span class="c-card__titre"><?php echo esc_html( $dih_c[2] ); ?></span>
						<span class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></span>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div>
		<?php echo dih_surtitre( $dih_sp['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $dih_sp['titre'] ); ?></h2>
		<p class="l-session__intro"><?php echo esc_html( $dih_sp['texte'] ); ?></p>
		<ul class="l-session__grille-tiers">
			<?php foreach ( $dih_sp['cartes'] as $dih_c ) : ?>
				<li class="c-card c-card--point">
					<span class="c-card__picto" aria-hidden="true"><?php echo dih_svg( $dih_c[0], 22 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span class="c-card__titre"><?php echo esc_html( $dih_c[1] ); ?></span>
					<span class="c-card__texte"><?php echo esc_html( $dih_c[2] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
