<?php
/**
 * Notification interne de Max — design_diagimmhauts_theme_wp/emails/email-max.html
 * (piste 1c, 1.14c), remplie par inc/emails.php : une ligne par champ du formulaire,
 * page d'origine, message, boutons Appeler / Répondre sous les infos (côte à côte
 * au-dessus de 460 px).
 *
 * @package DiagImmHauts
 */

$dih_m = $args;
$dih_t = $dih_m['textes']['max'];

$dih_police = 'font-family:Arial,Helvetica,sans-serif;';
$dih_cle    = 'padding:8px 0;border-top:1px solid #e6ebdd;' . $dih_police . 'font-size:14px;line-height:20px;color:#5e6d55;';
$dih_val    = 'padding:8px 0;border-top:1px solid #e6ebdd;' . $dih_police . 'font-size:14px;line-height:20px;font-weight:bold;color:#17331f;';

// Pied : formulaire, consentement (devis), accusé de réception (e-mail rempli).
$dih_pied = array( sprintf( $dih_t['envoye'], $dih_m['formulaire'] ) );
if ( $dih_m['rgpd'] ) {
	$dih_pied[] = $dih_t['rgpd'];
}
if ( $dih_m['email'] ) {
	$dih_pied[] = $dih_t['accuse'];
}
?>
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="x-apple-disable-message-reformatting">
<meta name="color-scheme" content="light dark">
<meta name="supported-color-schemes" content="light dark">
<title><?php echo esc_html( $dih_m['v']['tag'] ); ?></title>
<style>
@media (max-width:620px){.w{width:100% !important}}
@media (max-width:460px){.px{padding-left:16px !important;padding-right:16px !important}.k{width:120px !important}.bt td{display:block !important;width:100% !important}.bt .sp{height:12px !important}}
</style>
</head>
<body style="margin:0;padding:0;background:#f5f8ef;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f8ef;">
<tr><td align="center" style="padding:24px 12px;">
<table role="presentation" class="w" width="560" cellpadding="0" cellspacing="0" border="0" style="width:560px;background:#fefffc;border:1px solid #e6ebdd;border-radius:16px;">

	<tr><td class="px" style="padding:16px 24px;background:#1e5b34;border-radius:15px 15px 0 0;<?php echo $dih_police; // phpcs:ignore ?>font-size:12.5px;font-weight:bold;letter-spacing:.06em;text-transform:uppercase;color:#a3e04a;"><?php echo esc_html( sprintf( $dih_t['bandeau'], $dih_m['v']['tag'], $dih_m['date'], $dih_m['heure'] ) ); ?></td></tr>

	<tr><td class="px" style="padding:24px 24px 16px;<?php echo $dih_police; // phpcs:ignore ?>">
		<div style="font-size:26px;line-height:32px;mso-line-height-rule:exactly;font-weight:bold;color:#123f24;"><?php echo esc_html( $dih_m['nom'] ); ?></div>
		<?php if ( $dih_m['synthese'] ) : ?>
		<div style="margin-top:4px;font-size:15.5px;line-height:22px;color:#5e6d55;"><?php echo esc_html( $dih_m['synthese'] ); ?></div>
		<?php endif; ?>
	</td></tr>

	<tr><td class="px" style="padding:8px 24px 16px;">
		<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
			<?php foreach ( $dih_m['detail'] as $dih_l ) : ?>
			<tr><td class="k" width="190" valign="top" style="<?php echo $dih_cle; // phpcs:ignore ?>"><?php echo esc_html( $dih_l[0] ); ?></td><td style="<?php echo $dih_val; // phpcs:ignore ?>"><?php echo esc_html( $dih_l[1] ); ?></td></tr>
			<?php endforeach; ?>
			<tr><td class="k" width="190" valign="top" style="<?php echo $dih_cle; // phpcs:ignore ?>"><?php echo esc_html( $dih_t['origine'] ); ?></td><td style="<?php echo $dih_val; // phpcs:ignore ?>"><a href="<?php echo esc_url( $dih_m['page']['url'] ); ?>" style="color:#1e5b34;text-decoration:none;"><?php echo esc_html( $dih_m['page']['titre'] ? $dih_m['page']['titre'] : $dih_m['page']['url'] ); ?></a><?php echo $dih_m['provenance'] ? ' · ' . esc_html( sprintf( $dih_t['depuis'], $dih_m['provenance'] ) ) : ''; ?></td></tr>
		</table>
	</td></tr>

	<?php if ( $dih_m['message'] ) : ?>
	<tr><td class="px" style="padding:0 24px 24px;<?php echo $dih_police; // phpcs:ignore ?>">
		<div style="font-size:12.5px;font-weight:bold;letter-spacing:.06em;text-transform:uppercase;color:#1e5b34;"><?php echo esc_html( $dih_t['message'] ); ?></div>
		<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:8px;"><tr><td style="padding:12px 16px;background:#f5f8ef;border-radius:10px;<?php echo $dih_police; // phpcs:ignore ?>font-size:14px;line-height:22px;color:#17331f;"><?php echo nl2br( esc_html( $dih_m['message'] ) ); ?></td></tr></table>
	</td></tr>
	<?php endif; ?>

	<?php if ( $dih_m['tel_lien'] || $dih_m['email'] ) : ?>
	<tr><td class="px" style="padding:8px 24px 24px;">
		<table role="presentation" class="bt" cellpadding="0" cellspacing="0" border="0"><tr>
			<?php if ( $dih_m['tel_lien'] ) : ?>
			<td align="center" style="background:#7bc62f;border-radius:999px;"><a href="tel:<?php echo esc_attr( $dih_m['tel_lien'] ); ?>" style="display:block;padding:12px 24px;<?php echo $dih_police; // phpcs:ignore ?>font-size:15.5px;font-weight:bold;color:#123f24;text-decoration:none;"><?php echo esc_html( sprintf( $dih_t['appeler'], $dih_m['telephone'] ) ); ?></a></td>
			<?php endif; ?>
			<?php if ( $dih_m['tel_lien'] && $dih_m['email'] ) : ?>
			<td class="sp" width="12" style="width:12px;font-size:0;line-height:0;">&nbsp;</td>
			<?php endif; ?>
			<?php if ( $dih_m['email'] ) : ?>
			<td align="center" style="background:#1e5b34;border-radius:999px;"><a href="mailto:<?php echo esc_attr( $dih_m['email'] ); ?>" style="display:block;padding:12px 24px;<?php echo $dih_police; // phpcs:ignore ?>font-size:15.5px;font-weight:bold;color:#ffffff;text-decoration:none;"><?php echo esc_html( $dih_t['repondre'] ); ?></a></td>
			<?php endif; ?>
		</tr></table>
	</td></tr>
	<?php endif; ?>

	<tr><td class="px" style="padding:16px 24px;border-top:1px solid #e6ebdd;<?php echo $dih_police; // phpcs:ignore ?>font-size:12.5px;line-height:19px;color:#5e6d55;"><?php echo esc_html( implode( ' · ', $dih_pied ) ); ?>.</td></tr>
</table>
</td></tr>
</table>
</body>
</html>
