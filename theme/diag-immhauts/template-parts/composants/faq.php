<?php
/**
 * FAQ en accordéon (<details>) : la 1re question est ouverte, un lien suit
 * chaque réponse. Une seule question ouverte à la fois, comme la maquette : les
 * <details> d'une FAQ partagent un attribut name (accordéon exclusif natif).
 * Ouverture animée en CSS seul (composants/_faq.scss).
 *
 * Arguments : surtitre, titre, questions [ question, réponse, lien, cible ], id,
 * variante ('' : accueil ; 'transparente' : fiche DPE ; 'blanche' : autres fiches ;
 * 'filet' : comme l'accueil, avec un filet en haut — Nos diagnostics ;
 * 'pros' : comme une fiche, sur le fond de page — Professionnels).
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
		'variante'  => '',
	)
);

// Questions transmises au JSON-LD FAQPage (inc/seo.php).
if ( function_exists( 'dih_seo_faq' ) ) {
	dih_seo_faq( $dih_args['questions'] );
}
?>
<?php
$dih_classes_faq = 'c-faq';
if ( in_array( $dih_args['variante'], array( 'transparente', 'blanche', 'pros' ), true ) ) {
	$dih_classes_faq .= ' c-faq--fiche';
}
if ( $dih_args['variante'] ) {
	$dih_classes_faq .= ' c-faq--' . $dih_args['variante'];
}
?>
<section class="<?php echo esc_attr( $dih_classes_faq ); ?>" id="<?php echo esc_attr( $dih_args['id'] ); ?>">
	<div class="c-faq__int">
		<div class="c-faq__tete">
			<?php echo dih_surtitre( $dih_args['surtitre'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre c-faq__titre"><?php echo esc_html( $dih_args['titre'] ); ?></h2>
		</div>
		<div class="c-faq__liste">
			<?php foreach ( $dih_args['questions'] as $dih_i => $dih_q ) : ?>
				<details class="c-faq__item" name="<?php echo esc_attr( $dih_args['id'] ); ?>-questions"<?php echo 0 === $dih_i ? ' open' : ''; ?>>
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
