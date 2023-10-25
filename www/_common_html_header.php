<?php

foreach ($static_settings_array as $setting) {
  $setting_name = !empty($setting['name']) ? $setting['name'] : '';
  $setting_detail = !empty($setting['detail']) ? $setting['detail'] : '';
  $setting_keywords = !empty($setting['keywords']) ? $setting['keywords'] : '';
  $setting_author = !empty($setting['author']) ? $setting['author'] : '';
  $setting_favicon = !empty($setting['favicon']) ? CONFIG_HOST_NAME_FRONTEND . "material/settings/media/" . $setting['favicon'] : '';
  $setting_logo = !empty($setting['logo']) ? CONFIG_HOST_NAME_FRONTEND . "material/settings/media/" . $setting['logo'] : '';
  $setting_logo_variant = !empty($setting['logo_variant']) ? CONFIG_HOST_NAME_FRONTEND . "material/settings/media/" . $setting['logo_variant'] : '';
  $setting_province = !empty($setting['province']) ? $setting['province'] : '';
  $setting_address = !empty($setting['address']) ? $setting['address'] : '';
  $setting_postal_code = !empty($setting['postal_code']) ? $setting['postal_code'] : '';
  $setting_phone = !empty($setting['phone']) ? $setting['phone'] : '';
  $setting_email = !empty($setting['email']) ? $setting['email'] : '';
  $setting_no_reply_email = !empty($setting['no_reply_email']) ? $setting['no_reply_email'] : '';
  $setting_no_reply_name = !empty($setting['no_reply_name']) ? $setting['no_reply_name'] : '';
  $setting_contact_email = !empty($setting['contact_email']) ? $setting['contact_email'] : '';
  $setting_contact_name = !empty($setting['contact_name']) ? $setting['contact_name'] : '';
  $setting_contact_phone = !empty($setting['contact_phone']) ? $setting['contact_phone'] : '';
  $setting_contact_whatsapp = !empty($setting['contact_whatsapp']) ? $setting['contact_whatsapp'] : '';

  $setting_google_analytics = !empty($setting['google_analytics']) ? $setting['google_analytics'] : '';
  $setting_google_ads = !empty($setting['google_ads']) ? $setting['google_ads'] : '';
  $setting_google_maps = !empty($setting['google_maps']) ? $setting['google_maps'] : '';
  $setting_google_app = !empty($setting['google_app']) ? true : false;
  if ($setting_google_app == true) {
    $setting_google_id_client = !empty($setting['google_id_client']) ? $setting['google_id_client'] : '';
    $setting_google_id_secret = !empty($setting['google_id_secret']) ? $setting['google_id_secret'] : '';
  }

  $setting_facebook_pixel = !empty($setting['facebook_pixel']) ? $setting['facebook_pixel'] : '';

  $setting_url_shop = !empty($setting['url_shop']) ? $setting['url_shop'] : '';
  $setting_url_pinterest = !empty($setting['url_pinterest']) ? $setting['url_pinterest'] : '';
  $setting_url_facebook = !empty($setting['url_facebook']) ? $setting['url_facebook'] : '';
  $setting_url_instagram = !empty($setting['url_instagram']) ? $setting['url_instagram'] : '';
  $setting_url_tiktok = !empty($setting['url_tiktok']) ? $setting['url_tiktok'] : '';

  $setting_share_email = !empty($setting['share_email']) ? $setting['share_email'] : '';
  $setting_share_email_subject = !empty($setting['share_email_subject']) ? $setting['share_email_subject'] : '';
  $setting_share_email_body = !empty($setting['share_email_body']) ? $setting['share_email_body'] : '';
  $setting_share_hashtags = !empty($setting['share_hashtags']) ? $setting['share_hashtags'] : '';
  $setting_share_source = !empty($setting['share_source']) ? $setting['share_source'] : '';
  $setting_share_whatsapp_phone = !empty($setting['share_whatsapp_phone']) ? $setting['share_whatsapp_phone'] : '';
  $setting_share_whatsapp_body = !empty($setting['share_whatsapp_body']) ? $setting['share_whatsapp_body'] : '';
  $setting_background_img = !empty($setting['background_img']) ? $setting['background_img'] : '';
}
/*
print_r($static_secciones_array);
exit();
*/
// foreach($static_sections_array as $section)
// {
//   if($section['id_section'] == $id_section)
//   {
//     $section_name = !empty($section['name']) ? $section['name'] : $setting_name;
//     $section_title = !empty($section['title']) ? $section['title'] : $setting_title;
//     $section_meta_description	= !empty($section['meta_description']) ? $section['meta_description'] : $setting_detail;
//     $section_meta_keywords = !empty($section['meta_keywords']) ? $section['meta_keywords'] : $setting_keywords;
//     $section_url_friendly = !empty($section['slug']) ? $section['slug'] : '';
//     $section_description = !empty($section['description']) ? $section['description'] : $setting_detail;
//     $section_file = !empty($section['file']) ? $section['file'] : '';
//   }
// }

if ($data_section['id_section'] == $id_section) {
  $section_name = !empty($data_section['name']) ? $data_section['name'] : $setting_name;
  $section_title = !empty($data_section['title']) ? $data_section['title'] : $setting_title;
  $section_meta_description  = !empty($data_section['meta_description']) ? $data_section['meta_description'] : $setting_detail;
  $section_meta_keywords = !empty($data_section['meta_keywords']) ? $data_section['meta_keywords'] : $setting_keywords;
  $section_url_friendly = !empty($data_section['slug']) ? $data_section['slug'] : '';
  $section_description = !empty($data_section['description']) ? $data_section['description'] : $setting_detail;
  $section_file = !empty($data_section['file']) ? $data_section['file'] : '';
}
/*
print_r($static_settings_array);
print_r($static_secciones_array);
exit();
*/

$url_compartir = $_p->getInjection($_SERVER['QUERY_STRING']) ? CONFIG_REAL_URL . '?' . $_p->getInjection($_SERVER['QUERY_STRING']) : CONFIG_REAL_URL;

// echo $data_notes['name'];
// exit();
$the_section_title = !empty($section_title) ? $_f->clean_string($section_title) : $setting_title;
$the_section_subtitle = '';
$the_section_copete = '';

if (!empty($data_notes['name'])) {
  $the_section_subtitle = $_f->strireplace($_f->clean_string($data_notes['name']));
} else {
  $the_section_subtitle = '';
}

if (!empty($id_section) && $id_section == '37' && !empty($data_notes['name']) && !empty($data_notes['copete'])) {
  $the_section_subtitle = $_f->strireplace($_f->clean_string($data_notes['name']), ' ');
  $the_section_copete = $_f->strireplace($_f->clean_string($data_notes['copete']), ' ');
}

if (!empty($id_section) && $id_section == '27' && !empty($data_notes['name']) && !empty($data_notes['copete'])) {
  $the_section_subtitle = $_f->strireplace($_f->clean_string($data_notes['name']), ' ');
  $the_section_copete = $_f->strireplace($_f->clean_string($data_notes['copete']), ' ');
}

if (!empty($id_section) && $id_section == '24' && !empty($data_notes['name'])) {
  $the_section_subtitle = $_f->strireplace($_f->clean_string($data_notes['name']), ' ');
  $the_section_copete = $_f->strireplace($_f->clean_string($data_notes['copete']), ' ');
}

$share_url = $url_compartir;
$share_url_encode  = urlencode($url_compartir);
$share_name = $the_section_title;
$share_summary = $the_section_subtitle;
$share_image = CONFIG_HOST_NAME_FRONTEND . 'assets/img/share.jpg';
$share_hashtags = $setting_share_hashtags;
$share_email = $setting_share_email;
$share_email_subject = $setting_share_email_subject;
$share_email_body = $setting_share_email_body;
$share_source = $setting_share_source;

$share_whatsapp_phone = $setting_share_whatsapp_phone;
$share_whatsapp_body = $setting_share_whatsapp_body;

$share_copete = $the_section_copete;
$share_description = $section_meta_description;
$share_description_utf8 = utf8_decode($share_description);

if (empty($section_title)) {
  $page_title = $setting_title;
} else {
  $page_title = $section_title;
}

$page_description  = empty($section_meta_description) ? $setting_detail : $section_meta_description;
$page_keywords = empty($section_meta_keywords) ? $setting_keywords : $section_meta_keywords;

?>
<!DOCTYPE html>
<html lang="es">

<head>



  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title><?php echo CONFIG_NAME_SITE . ' - ' . $page_title; ?></title>
  <meta name="description" content="<?php echo $share_description; ?>" />
  <meta name="keywords" content="<?php echo $page_keywords; ?>" />
  <meta name="author" content="<?php echo $setting_author; ?>" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta name="language" content="Spanish" />
  <meta http-equiv="content-language" content="es" />
  <meta http-equiv="expires" content="1" />
  <meta content="index,follow" name="robots" />

  <!-- Twitter Card data -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="<?php echo $url_compartir;  ?>" />
  <meta name="twitter:title" content="<?php echo $share_name; ?>" />
  <meta name="twitter:description" content="<?php echo $share_description; ?>" />
  <meta name="twitter:creator" content="<?php echo $setting_author; ?>" />
  <meta name="twitter:image" content="<?php echo $share_image; ?>">

  <!-- Open Graph data -->
  <meta property="og:title" content="<?php echo $share_name; ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo $share_url; ?>" />
  <meta property="og:image" content="<?php echo $share_image; ?>" />
  <meta property="og:description" content="<?php echo $share_description; ?>" />
  <meta property="og:site_name" content="<?php echo CONFIG_REAL_URL;  ?>" />

  <!-- Google verification-->
  <meta name="google-site-verification" content="" />

  <!-- Apple -->
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-touch-fullscreen" content="yes" />


  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/icon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/bootstrap-5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/SlickNav-1.0.10/dist/slicknav.min.css">
  <link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/css/hamburgers.min.css">
  <link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/fontawesome-free-5.15.4-web/css/all.min.css">
  <link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/slick-1.8.1/slick/slick.css">
  <link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/css/style.css?a=2">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>