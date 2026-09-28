<?php
/**
 * Session « Le résultat » (9 fiches) : que se passe-t-il selon le constat,
 * en trois niveaux numérotés (vert clair, jaune, orange).
 *
 * Arguments : surtitre, titre, texte, disposition, cartes [ numéro, teinte, titre, texte ].
 * Dispositions : cartes (trois colonnes : amiante, plomb) | liste (une colonne) |
 * grille (colonnes de 250 px, cartes en ligne : audit, DTG).
 * preparation? : « À réunir avant ma visite » dans la même section (DTG).
 *
 * @package DiagImmHauts
 */

$dih_dispo = in_array( $args['disposition'], array( 'cartes', 'grille' ), true ) ? $args['disposition'] : 'liste';
?>
<section class="l-resultat">
	<div class="l-resultat__int">
		<div class="l-resultat__texte">
			<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<p class="l-resultat__intro"><?php echo esc_html( $args['texte'] ); ?></p>
			<ol class="l-resultat__<?php echo esc_attr( $dih_dispo ); ?>">
				<?php foreach ( $args['cartes'] as $dih_c ) : ?>
					<li class="c-card c-card--niveau">
						<span class="c-badge c-badge--carre-petit c-badge--<?php echo esc_attr( $dih_c[1] ); ?>" aria-hidden="true"><?php echo esc_html( $dih_c[0] ); ?></span>
						<span class="c-card__corps">
							<span class="c-card__titre"><?php echo esc_html( $dih_c[2] ); ?></span>
							<span class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></span>
						</span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
		<?php
		if ( ! empty( $args['preparation'] ) ) {
			get_template_part( 'template-parts/composants/preparation', null, $args['preparation'] );
		}
		?>
	</div>
</section>
