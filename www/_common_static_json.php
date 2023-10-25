<?php

# SETTINGS
$path_settings = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings.inc';
if (function_exists('file_get_contents') && file_exists($path_settings)) {
	$static_settings_array = unserialize(file_get_contents($path_settings));
} else {
	$static_settings_array = array();
}
# SETTINGS COPYS
$path_settings_copys = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings_copys.inc';
if (function_exists('file_get_contents') && file_exists($path_settings_copys)) {
	$static_settings_copys_array = unserialize(file_get_contents($path_settings_copys));
} else {
	$static_settings_copys_array = array();
}
# SETTINGS TARGETS
$path_settings_targets = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings_targets.inc';
if (function_exists('file_get_contents') && file_exists($path_settings_targets)) {
	$static_settings_targets_array = unserialize(file_get_contents($path_settings_targets));
} else {
	$static_settings_targets_array = array();
}

# SECTIONS
$path_sections = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'sections.inc';
if (function_exists('file_get_contents') && file_exists($path_sections)) {
	$static_sections_array = unserialize(file_get_contents($path_sections));
} else {
	$static_sections_array = array();
}
# SECTIONS Full
# This is one exception (MVC) and is created into the Framework [Framework/_model/modelSections.php: line: 665]
$path_sections_full = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'sections__custom_full.inc';
if (function_exists('file_get_contents') && file_exists($path_sections_full)) {
	$static_sections_full_array = unserialize(file_get_contents($path_sections_full));
} else {
	$static_sections_full_array = array();
}
# SECTIONS Navs
# This is one exception (MVC) and is created into the Framework [Framework/_model/modelSections.php: line: 665]
$path_sections_navs = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'sections__custom_nav.inc';
if (function_exists('file_get_contents') && file_exists($path_sections_navs)) {
	$static_sections_navs_array = unserialize(file_get_contents($path_sections_navs));
} else {
	$static_sections_navs_array = array();
}
# SECTIONS HEROS
$path_sections_heros = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'sections_heros.inc';
if (function_exists('file_get_contents') && file_exists($path_sections_heros)) {
	$static_sections_heros_array = unserialize(file_get_contents($path_sections_heros));
} else {
	$static_sections_heros_array = array();
}

# Forms Types
$path_forms_types = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'forms_types.inc';
if (function_exists('file_get_contents') && file_exists($path_forms_types)) {
	$static_forms_types_array = unserialize(file_get_contents($path_forms_types));
} else {
	$static_forms_types_array = array();
}
