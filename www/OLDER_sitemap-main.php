<?php
require_once(dirname(__FILE__) . '/framework/_common/Class.Config.php');
$_c = new Configuration();
require_once(dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');
// require_once(dirname(__FILE__) . '/framework/_lib/propagate/Class.Propagate.php');
// require_once(dirname(__FILE__) . '/framework/_lib/curl/Class.Curl.php');
require_once(dirname(__FILE__) . '/framework/_lib/functions/Class.Functions.php');

$_e = new ErrorHandler();
// $_p = new Propagate();
// $_r = new Curl();
$_f = new Functions();

# SECTIONS {
$path_sections = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'sections.inc';
if (function_exists('file_get_contents') && file_exists($path_sections)) {
	$static_sections_array = unserialize(file_get_contents($path_sections));
} else {
	$static_sections_array = array();
}
#} SECTIONS


# SECTIONS FREQUENCIES {
$path_sections_frequencies = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'sections_frequencies.inc';
if (function_exists('file_get_contents') && file_exists($path_sections_frequencies)) {
	$static_sections_frequencies_array = unserialize(file_get_contents($path_sections_frequencies));
} else {
	$static_sections_frequencies_array = array();
}
#} SECTIONS FREQUENCIES
// print_r($static_sections_frequencies_array);
// exit();

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
/*echo '<?xml-stylesheet type="text/xsl" href="'.CONFIG_HOST_NAME_FRONTEND.'/sitemap.xsl"?>';*/
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php
	// foreach ($static_sections_array as $secciones) {
	// 	if (!empty($secciones['id_section'])) {
	// 		if ($secciones['mapsite'] == 1) {
	// 			echo '<url>';
	// 			if ($secciones['mapsite_slug'] == 1) {
	// 				if (!empty($secciones['slug'])) {
	// 					echo '    <loc>' . CONFIG_HOST_NAME_FRONTEND . $secciones['slug'] . '/</loc>';
	// 				} else {
	// 					echo '    <loc>' . CONFIG_HOST_NAME_FRONTEND . $secciones['slug'] . '</loc>';
	// 				}
	// 			} else {
	// 				echo '    <loc>' . CONFIG_HOST_NAME_FRONTEND . $secciones['url_canonical'] . '</loc>';
	// 			}
	// 			echo '    <lastmod>' . $_f->date_decode($secciones['modified'], TIME_ZONE, W3C_DATETIME_FORMAT) . TIME_ZONE_OFFSET . '</lastmod>';
	// 			echo '    <changefreq>' . $_f->getStringOffArrayByIndice($static_sections_frequencies_array, 'id_section_frequency', $secciones['id_section_frequency'], 'nombre') . '</changefreq>';
	// 			echo '</url>';
	// 		}
	// 	}
	// }
	?>
	<?php
	foreach ($static_sections_array as $sections_menu_nav) {

		if ($sections_menu_nav['mapsite'] == 1) {

			$external_url = strpos($sections_menu_nav['url_canonical'], 'http');

			// SECTIONS
			$external_urls = strpos($sections_menu_nav['url_canonical'], 'http');
			$dinamic_urls = strpos($sections_menu_nav['url_canonical'], '.php?id');

			if (empty($sections_menu_nav['url_canonical'])) {
				if ($dinamic_urls !== false) {
					$section_urls = '1' . $_f->getCustomUrl(true, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'] . $sections_menu_nav['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
				} else {
					$id_parent_secction = $_f->getStringOffArrayByIndice($static_sections_array, 'slug', $sections_menu_nav['slug'], 'parent_id_section');
					$parent_secction_slug = $_f->getStringOffArrayByIndice($static_sections_array, 'id_section', $id_parent_secction, 'slug');
					$section_urls = $_f->getCustomUrl(true, $parent_secction_slug, $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
				}
			} else {
				if ($dinamic_urls !== false) {
					$section_urls = '3' . $_f->getCustomUrl(false, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'] . $sections_menu_nav['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
				} else {
					$section_urls = '4' . $_f->getCustomUrl(false, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
				}
			}

			echo '<url>';
			echo ' <loc>' . $section_urls . '</loc>';
			echo ' <lastmod>' . $_f->date_decode($sections_menu_nav['modified'], TIME_ZONE, W3C_DATETIME_FORMAT) . TIME_ZONE_OFFSET . '</lastmod>';
			echo ' <changefreq>' . $_f->getStringOffArrayByIndice($static_sections_frequencies_array, 'id_section_frequency', $sections_menu_nav['id_section_frequency'], 'name') . '</changefreq>';
			echo '</url>';

			// foreach ($sections_menu_nav['childs'] as $sections_menu_nav_child) {
			// 	if (!empty($sections_menu_nav_child['url_canonical'])) {
			// 		if ($external_url !== false) {
			// 			$section_url = $_f->getCustomUrl(false, $sections_menu_nav_child['slug'], $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
			// 		} else {
			// 			$url_child = $_f->getCustomUrl(false, $sections_menu_nav_child['slug'], $sections_menu_nav['slug'], $sections_menu_nav_child['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
			// 		}
			// 	} else {
			// 		$url_child = $_f->getCustomUrl(true, $sections_menu_nav['slug'], $sections_menu_nav_child['slug'], $sections_menu_nav_child['url_canonical'], $sections_menu_nav_child['url_anchor'], $nav_section);
			// 	}

			// 	// SECTIONS FOR USERS NOT LOGGED
			// 	if (empty($token_session_data_user) || $token_session_data_user == 'sindatos') {
			// 		// SHOW THE SECTIONS THAT THE USER CAN SEE WITHOUT BEING LOGGED
			// 		if (empty($sections_menu_nav_child['need_logged'])) {

			// 			echo '<url>';
			// 			echo ' <loc>' . $url_child . '</loc>';
			// 			echo ' <lastmod>' . $_f->date_decode($sections_menu_nav_child['modified'], TIME_ZONE, W3C_DATETIME_FORMAT) . TIME_ZONE_OFFSET . '</lastmod>';
			// 			echo ' <changefreq>' . $_f->getStringOffArrayByIndice($static_sections_frequencies_array, 'id_section_frequency', $sections_menu_nav_child['id_section_frequency'], 'nombre') . '</changefreq>';
			// 			echo '</url>';
			// 		}
			// 	}
			// }
		}
	}
	?>
</urlset>