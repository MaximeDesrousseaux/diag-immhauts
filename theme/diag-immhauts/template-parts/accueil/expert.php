<?php
/**
 * « Qui suis-je ? » : portrait avec cartouche, présentation, quatre engagements.
 * En déplié, les quatre engagements passent en 2 × 2 sous le bloc (VERROUILLÉ).
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'expert' );

$dih_valeurs = function ( $classe ) use ( $dih_c ) {
	?>
	<ul class="<?php echo esc_attr( $classe ); ?>">
		<?php foreach ( $dih_c['valeurs'] as $dih_v ) : ?>
			<li class="l-expert__valeur">
				<span class="l-expert__picto" aria-hidden="true"><?php echo dih_icone( $dih_v[0], 20, array( 'epaisseur' => 1.7 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span>
					<span class="l-expert__valeur-titre"><?php echo esc_html( $dih_v[1] ); ?></span>
					<span class="l-expert__valeur-texte"><?php echo esc_html( $dih_v[2] ); ?></span>
				</span>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
};
?>
<section class="l-expert" id="expert">
	<div class="l-expert__int">
		<figure class="l-expert__photo">
			<div class="l-expert__cadre">
				<img src="<?php echo esc_url( dih_img( $dih_c['photo'] ) ); ?>" alt="<?php echo esc_attr( $dih_c['photo_alt'] ); ?>" loading="lazy" decoding="async" width="837" height="900">
			</div>
			<figcaption class="l-expert__cartouche">
				<span class="l-expert__nom"><?php echo esc_html( $dih_c['nom'] ); ?></span>
				<span class="l-expert__role"><span aria-hidden="true"></span><?php echo esc_html( $dih_c['role'] ); ?></span>
			</figcaption>
		</figure>
		<div class="l-expert__texte">
			<?php echo dih_surtitre( $dih_c['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-expert__titre"><?php echo esc_html( $dih_c['titre'] ); ?></h2>
			<p class="l-expert__para"><?php echo esc_html( $dih_c['texte'] ); ?></p>
			<?php $dih_valeurs( 'l-expert__valeurs l-expert__valeurs--dedans' ); ?>
			<a class="l-expert__lien" href="<?php echo esc_url( dih_url( 'qui' ) ); ?>"><?php echo esc_html( $dih_c['lien'] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche', 17, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
		</div>
	</div>
	<div class="l-expert__dessous">
		<?php $dih_valeurs( 'l-expert__valeurs l-expert__valeurs--dessous' ); ?>
	</div>
</section>
