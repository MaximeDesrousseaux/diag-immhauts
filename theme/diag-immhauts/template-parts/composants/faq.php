<?php
/**
 * FAQ en accordéon (<details>) : la 1re question est ouverte, un lien suit
 * chaque réponse. Ouverture animée en CSS seul (composants/_faq.scss).
 *
 * Arguments : surtitre, titre, questions [ question, réponse, lien, cible ], id.
 *
 * @package DiagImmHauts
 */

$dih_args = wp_parse_args(
	$args,
	array(
		'surtitre'  => '',
		'titre'     => '',
		'questions' => array(),
		'id'        => 'faq',
	)
);
?>
<section class="c-faq" id="<?php echo esc_attr( $dih_args['id'] ); ?>">
	<div class="c-faq__int">
		<div class="c-faq__tete">
			<?php echo dih_surtitre( $dih_args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre c-faq__titre"><?php echo esc_html( $dih_args['titre'] ); ?></h2>
		</div>
		<div class="c-faq__liste">
			<?php foreach ( $dih_args['questions'] as $dih_i => $dih_q ) : ?>
				<details class="c-faq__item"<?php echo 0 === $dih_i ? ' open' : ''; ?>>
					<summary class="c-faq__question">
						<span><?php echo esc_html( $dih_q[0] ); ?></span>
						<span class="c-faq__signe" aria-hidden="true"></span>
					</summary>
					<div class="c-faq__reponse">
						<p><?php echo esc_html( $dih_q[1] ); ?></p>
						<?php if ( ! empty( $dih_q[2] ) ) : ?>
							<a class="c-lien c-lien--vert c-faq__lien" href="<?php echo esc_url( dih_url_cible( $dih_q[3] ) ); ?>"><?php echo esc_html( $dih_q[2] ); ?><span class="c-fleche"><?php echo dih_icone( 'fleche', 16, array( 'epaisseur' => 2.6 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></a>
						<?php endif; ?>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
