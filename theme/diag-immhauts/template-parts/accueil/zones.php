<?php
/**
 * « Zones desservies » (#zones) : texte, champ « Vérifier ma commune »
 * (assets/js/commune.js), illustration, puis les communes en pastilles.
 *
 * @package DiagImmHauts
 */

$dih_c = dih_contenu( 'accueil', 'zones' );
?>
<section class="l-section l-zones" id="zones">
	<div class="l-zones__grille">
		<div class="l-zones__texte">
			<?php echo dih_surtitre( $dih_c['surtitre'], 'l-zones__surtitre' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<h2 class="l-section__titre l-zones__titre"><?php echo esc_html( $dih_c['titre'] ); ?></h2>
			<p class="l-zones__para"><?php echo esc_html( $dih_c['texte'] ); ?></p>
			<div class="l-zones__verif c-commune" data-dih-commune data-source="<?php echo esc_url( dih_url_communes() ); ?>" data-contact="<?php echo esc_url( dih_url( 'contact' ) ); ?>">
				<?php echo dih_bouton( $dih_c['cta'], 'type="button" data-dih-commune-ouvrir', 'repere', 'c-btn--vert c-btn--ombre', 'button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<div class="c-commune__champ" hidden>
					<form class="c-commune__form" data-dih-commune-form>
						<label class="screen-reader-text" for="dih-commune-q">Code postal ou commune</label>
						<input class="c-commune__saisie" id="dih-commune-q" type="text" name="q" placeholder="Code postal ou commune" autocomplete="postal-code" aria-autocomplete="list" aria-controls="dih-commune-liste">
						<?php echo dih_bouton( 'Vérifier', 'type="submit"', 'fleche-courte', 'c-btn--vert c-btn--ombre', 'button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</form>
					<div class="c-commune__suggestions" id="dih-commune-liste" role="listbox" hidden></div>
					<p class="c-commune__note"><?php echo esc_html( $dih_c['note'] ); ?></p>
					<div class="c-commune__reponse" aria-live="polite" hidden></div>
				</div>
			</div>
		</div>
		<div class="l-zones__illus">
			<div class="l-zones__halo" aria-hidden="true"></div>
			<img src="<?php echo esc_url( dih_img( $dih_c['illustration'] ) ); ?>" alt="<?php echo esc_attr( $dih_c['illus_alt'] ); ?>" width="1000" height="750" loading="lazy" decoding="async">
		</div>
	</div>
	<div class="l-zones__communes">
		<div class="l-zones__communes-titre"><?php echo esc_html( $dih_c['communes_titre'] ); ?></div>
		<ul class="l-zones__liste">
			<?php foreach ( $dih_c['communes'] as $dih_commune ) : ?>
				<li class="c-pastille c-pastille--commune"><?php echo esc_html( $dih_commune ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
