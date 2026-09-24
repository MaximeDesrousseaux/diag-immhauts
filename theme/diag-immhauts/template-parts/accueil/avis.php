<?php
/**
 * « Avis clients » : note Google, puis les avis en carrousel horizontal
 * (scroll-snap, CSS seul).
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'avis' );
?>
<section class="l-avis" aria-labelledby="avis-titre">
	<div class="l-avis__int">
		<div class="l-section__tete l-avis__tete">
			<div>
				<?php echo dih_surtitre( $dih_c['surtitre'], 'c-surtitre--clair' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2 class="l-section__titre l-avis__titre" id="avis-titre"><?php echo esc_html( $dih_c['titre'] ); ?></h2>
			</div>
			<div class="l-avis__note">
				<span class="l-avis__google" aria-hidden="true" style="background-image:url('<?php echo esc_url( dih_img( 'google.svg', 'logos' ) ); ?>')"></span>
				<span class="l-avis__chiffre"><?php echo esc_html( $dih_c['note'] ); ?></span>
				<span>
					<span class="c-etoiles c-etoiles--moyen" aria-label="5 étoiles sur 5">★★★★★</span>
					<span class="l-avis__nombre"><?php echo esc_html( $dih_c['nombre'] ); ?></span>
				</span>
			</div>
		</div>
		<ul class="l-avis__liste">
			<?php foreach ( $dih_c['liste'] as $dih_a ) : ?>
				<?php
				$dih_initiales = '';
				foreach ( preg_split( '/[\s.]+/u', $dih_a[1], -1, PREG_SPLIT_NO_EMPTY ) as $dih_mot ) {
					$dih_initiales .= mb_substr( $dih_mot, 0, 1 );
				}
				?>
				<li class="c-card c-card--avis">
					<div class="c-card__haut">
						<span class="c-etoiles c-etoiles--petit" aria-label="5 étoiles sur 5">★★★★★</span>
						<span class="c-card__source"><span aria-hidden="true" style="background-image:url('<?php echo esc_url( dih_img( 'google.svg', 'logos' ) ); ?>')"></span>Avis Google</span>
					</div>
					<p class="c-card__texte"><?php echo esc_html( $dih_a[0] ); ?></p>
					<div class="c-card__auteur">
						<span class="c-card__initiales" aria-hidden="true"><?php echo esc_html( $dih_initiales ); ?></span>
						<span>
							<span class="c-card__nom"><?php echo esc_html( $dih_a[1] ); ?></span>
							<span class="c-card__lieu"><?php echo esc_html( $dih_a[2] ); ?></span>
						</span>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
