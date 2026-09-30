<?php
/**
 * Accusé de réception du client — design_diagimmhauts_theme_wp/emails/email-client.html
 * (piste 1a), rempli par inc/emails.php. Tableaux et styles en ligne, 560 px, Arial.
 *
 * @package DiagImmHauts
 */

$dih_m  = $args;
$dih_t  = $dih_m['textes']['client'];
$dih_v  = $dih_m['v'];
$dih_a  = $dih_m['avis'];
$dih_nb = "\u{00A0}";

$dih_police = 'font-family:Arial,Helvetica,sans-serif;';
?>
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="x-apple-disable-message-reformatting">
<meta name="color-scheme" content="light dark">
<meta name="supported-color-schemes" content="light dark">
<title><?php echo esc_html( isset( $dih_v['objet'] ) ? $dih_v['objet'] : '' ); ?></title>
<!--[if mso]><noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript><![endif]-->
<style>
@media (max-width:620px){.w{width:100% !important}.px{padding-left:20px !important;padding-right:20px !important}.k{width:110px !important}.st td{display:block !important;width:100% !important;text-align:left !important}.st .r{padding-top:12px !important}}
</style>
</head>
<body style="margin:0;padding:0;background:#f5f8ef;">
<div style="display:none;max-height:0;overflow:hidden;mso-hide:all;font-size:1px;line-height:1px;color:#f5f8ef;"><?php echo esc_html( isset( $dih_v['pre'] ) ? $dih_v['pre'] : '' ); ?>&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f8ef;">
<tr><td align="center" style="padding:24px 12px;">

<table role="presentation" class="w" width="560" cellpadding="0" cellspacing="0" border="0" style="width:560px;background:#fefffc;border:1px solid #e6ebdd;border-radius:16px;">
	<tr><td class="px" style="padding:32px 32px 8px;<?php echo $dih_police; // phpcs:ignore ?>">
		<div style="font-size:26px;line-height:32px;mso-line-height-rule:exactly;font-weight:bold;color:#123f24;"><?php echo esc_html( sprintf( $dih_t['salut'], $dih_m['prenom'] ) ); ?></div>
		<div style="margin-top:12px;font-size:15.5px;line-height:24px;mso-line-height-rule:exactly;color:#17331f;"><?php echo esc_html( isset( $dih_v['intro'] ) ? $dih_v['intro'] : '' ); ?></div>
	</td></tr>

	<?php if ( $dih_m['recap'] ) : ?>
	<tr><td class="px" style="padding:16px 32px;">
		<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f8ef;border-radius:10px;">
			<tr><td colspan="2" style="padding:16px 16px 8px;<?php echo $dih_police; // phpcs:ignore ?>font-size:12.5px;font-weight:bold;letter-spacing:.06em;text-transform:uppercase;color:#1e5b34;"><?php echo esc_html( $dih_t['recap'] ); ?></td></tr>
			<?php foreach ( $dih_m['recap'] as $dih_l ) : ?>
			<tr><td class="k" width="150" valign="top" style="padding:6px 16px;<?php echo $dih_police; // phpcs:ignore ?>font-size:14px;line-height:20px;color:#5e6d55;"><?php echo esc_html( $dih_l[0] ); ?></td><td style="padding:6px 16px 6px 0;<?php echo $dih_police; // phpcs:ignore ?>font-size:14px;line-height:20px;font-weight:bold;color:#17331f;"><?php echo esc_html( $dih_l[1] ); ?></td></tr>
			<?php endforeach; ?>
			<tr><td colspan="2" style="padding:8px 16px 16px;<?php echo $dih_police; // phpcs:ignore ?>font-size:12.5px;line-height:18px;color:#5e6d55;"><?php echo esc_html( $dih_t['erreur'] ); ?></td></tr>
		</table>
	</td></tr>
	<?php endif; ?>

	<tr><td class="px" style="padding:16px 32px 8px;<?php echo $dih_police; // phpcs:ignore ?>">
		<div style="font-size:12.5px;font-weight:bold;letter-spacing:.06em;text-transform:uppercase;color:#1e5b34;"><?php echo esc_html( $dih_t['suite'] ); ?></div>
		<?php foreach ( isset( $dih_v['etapes'] ) ? $dih_v['etapes'] : array() as $dih_i => $dih_e ) : ?>
		<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:12px;"><tr><td width="36" valign="top"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr><td width="26" height="26" align="center" style="background:#7bc62f;border-radius:13px;<?php echo $dih_police; // phpcs:ignore ?>font-size:14px;font-weight:bold;color:#123f24;"><?php echo (int) $dih_i + 1; ?></td></tr></table></td><td style="padding-top:3px;<?php echo $dih_police; // phpcs:ignore ?>font-size:14px;line-height:22px;color:#17331f;"><?php echo esc_html( $dih_e ); ?></td></tr></table>
		<?php endforeach; ?>
	</td></tr>

	<tr><td class="px" style="padding:24px 32px 8px;<?php echo $dih_police; // phpcs:ignore ?>font-size:15.5px;line-height:24px;color:#17331f;"><?php echo esc_html( $dih_t['au_revoir'] ); ?></td></tr>
	<tr><td class="px" style="padding:8px 32px 32px;">
		<table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr>
			<td width="72" valign="middle"><img src="<?php echo esc_url( dih_email_image( 'signature-maxime.png' ) ); ?>" width="60" height="60" alt="<?php echo esc_attr( dih_info( 'dirigeant' ) ); ?>" style="display:block;width:60px;height:60px;border:0;"></td>
			<td valign="middle" style="<?php echo $dih_police; // phpcs:ignore ?>font-size:14px;line-height:21px;color:#17331f;"><b style="font-size:15.5px;"><?php echo esc_html( dih_info( 'dirigeant' ) ); ?></b><br><span style="color:#5e6d55;"><?php echo esc_html( $dih_t['titre'] ); ?></span><br><a href="tel:<?php echo esc_attr( dih_info( 'telephone_lien' ) ); ?>" style="color:#1e5b34;font-weight:bold;text-decoration:none;"><?php echo esc_html( dih_info( 'telephone' ) ); ?></a></td>
		</tr></table>
	</td></tr>

	<tr><td class="px" style="padding:24px 32px;background:#1e5b34;border-radius:0 0 15px 15px;">
		<table role="presentation" class="st" width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
			<td valign="middle">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="text-decoration:none;"><table role="presentation" cellpadding="0" cellspacing="0" border="0"><tr>
					<td valign="middle" style="padding-right:8px;"><img src="<?php echo esc_url( dih_email_image( 'logo-email-blanc.png' ) ); ?>" width="56" height="16" alt="" style="display:block;width:56px;height:16px;border:0;"></td>
					<td valign="middle" style="<?php echo $dih_police; // phpcs:ignore ?>"><div style="font-size:15.5px;line-height:17px;font-weight:bold;color:#ffffff;"><?php echo esc_html( dih_info( 'nom' ) ); ?></div><div style="margin-top:3px;font-size:11px;line-height:13px;letter-spacing:.09em;text-transform:uppercase;color:#d6e6cf;"><?php echo esc_html( dih_info( 'baseline' ) ); ?></div></td>
				</tr></table></a>
			</td>
			<td class="r" valign="middle" align="right" style="<?php echo $dih_police; // phpcs:ignore ?>font-size:12.5px;line-height:19px;color:#d6e6cf;">
				<?php if ( '' !== $dih_a['note'] && '' !== $dih_a['nombre'] ) : ?>
				<a href="<?php echo esc_url( $dih_a['url'] ); ?>" style="color:#eaf3e6;text-decoration:none;"><span style="color:#a3e04a;font-weight:bold;">&#9733; <?php echo esc_html( $dih_a['note'] ); ?></span> <?php echo esc_html( $dih_t['avis'] ); ?><br><?php echo esc_html( sprintf( $dih_t['avis_nb'], $dih_a['nombre'] ) ); ?></a>
				<?php else : ?>
				<span style="color:#eaf3e6;"><?php echo esc_html( $dih_t['certifie'] ); ?> <b style="color:#a3e04a;"><?php echo esc_html( $dih_t['organisme'] ); ?></b></span><br><?php echo esc_html( $dih_t['cofrac'] ); ?>
				<?php endif; ?>
			</td>
		</tr></table>
	</td></tr>
</table>

<table role="presentation" class="w" width="520" cellpadding="0" cellspacing="0" border="0" style="width:520px;">
	<tr><td align="center" style="padding:16px 0 0;<?php echo $dih_police; // phpcs:ignore ?>font-size:11px;line-height:18px;color:#5e6d55;"><?php echo esc_html( $dih_t['legal'] ); ?><br><?php echo esc_html( $dih_t['motif'] ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#1e5b34;"><?php echo esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ); ?></a>.</td></tr>
</table>

</td></tr>
</table>
</body>
</html>
