<?php
/**
 * Session « Le résultat » du DPE : texte + étiquette A→G illustrée, puis
 * « Sur place » : ce qui est relevé chez le client, en cartes illustrées.
 *
 * Arguments : surtitre, titre, texte (HTML : <strong>), image, image_alt, releves.
 *
 * @package DiagImmHauts
 */

$dih_r = $args['releves'];
?>
<section class="l-session l-session--etiquette">
	<div class="l-session__etiquette">
		<div class="l-session__etiquette-texte">
			<?php echo dih_surtitre( $args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $args['titre'] ); ?></h2>
			<p class="l-session__etiquette-para"><?php echo wp_kses( $args['texte'], array( 'strong' => array() ) ); ?></p>
		</div>
		<div class="l-session__etiquette-image">
			<img src="<?php echo esc_url( dih_img( $args['image'] ) ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>" loading="lazy" decoding="async">
		</div>
	</div>

	<div class="l-session__releves">
		<div>
			<?php echo dih_surtitre( $dih_r['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-session__titre"><?php echo esc_html( $dih_r['titre'] ); ?></h2>
			<p class="l-session__intro"><?php echo esc_html( $dih_r['texte'] ); ?></p>
		</div>
		<ul class="l-session__grille-3">
			<?php foreach ( $dih_r['cartes'] as $dih_c ) : ?>
				<li class="c-card c-card--releve">
					<span class="c-card__cadre" aria-hidden="true">
						<span class="c-card__illus" style="background-image:url('<?php echo esc_url( dih_img( $dih_c[0] ) ); ?>');transform:<?php echo esc_attr( $dih_c[1] ); ?>"></span>
					</span>
					<span>
						<span class="c-card__titre"><?php echo esc_html( $dih_c[2] ); ?></span>
						<span class="c-card__texte"><?php echo esc_html( $dih_c[3] ); ?></span>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
