<?php
/**
 * Session « Le cadre du contrôle » (9 fiches) : trois catégories à lettre
 * colorée, puis « Sur place » : ce qui est recherché, en cartes à picto.
 *
 * Arguments : surtitre, titre, texte, cartes [ lettre, teinte, titre, texte ],
 * sur_place { surtitre, titre, texte, cartes [ svg, titre, texte ] }.
 * Les pictos (tracés SVG des maquettes) sont propres à chaque fiche.
 *
 * Options :
 * - disposition : tiers (défaut, 3 cartes par ligne sous le texte) | cote (texte à
 *   gauche, cartes empilées à droite : audit) | colonnes (3 cartes en colonne : DTG) ;
 * - intro : grande (titre et paragraphe d'ouverture plus grands : audit, DTG) ;
 * - badge : chiffre (15,5 px) | sigle (14 px) ; lettre de 19 px par défaut ;
 * - sur_place.grille : auto (colonnes de 250 px au lieu de 3 par ligne).
 *
 * @package DiagImmHauts
 */

$dih_sp     = $args['sur_place'];
$dih_dispo  = isset( $args['disposition'] ) ? $args['disposition'] : 'tiers';
$dih_badge  = isset( $args['badge'] ) ? ' c-badge--' . $args['badge'] : '';
$dih_grande = isset( $args['intro'] ) && 'grande' === $args['intro'];
$dih_grille = isset( $dih_sp['grille'] ) && 'auto' === $dih_sp['grille'] ? 'l-session__grille-auto' : 'l-session__grille-tiers';
?>
<section class="l-session l-session--cadre l-session--cadre-<?php echo esc_attr( $dih_dispo ); ?>">
	<div class="l-session__cadre">
		<div class="l-session__cadre-texte<?php echo $dih_grande ? ' l-session__cadre-texte--grand' : ''; ?>">
			<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<p class="l-session__intro"><?php echo esc_html( $args['texte'] ); ?></p>
		</div>
		<ul class="l-session__categories">
			<?php foreach ( $args['cartes'] as $dih_c ) : ?>
				<li class="c-card c-card--categorie">
					<span class="c-badge c-badge--carre c-badge--<?php echo esc_attr( $dih_c[1] . $dih_badge ); ?>" aria-hidden="true"><?php echo esc_html( $dih_c[0] ); ?></span>
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
		<ul class="<?php echo esc_attr( $dih_grille ); ?>">
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
