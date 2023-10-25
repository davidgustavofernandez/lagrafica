<?php
/**
 * CONFIG_MEMO_INI constant , Memory already consumed starting point of the framework (Performance)
 */
define("CONFIG_MEMO_INI", memory_get_peak_usage());
/**
 * CONFIG_TIME_INI constant , Initial seconds (Performance)
 */
define("CONFIG_TIME_INI", microtime());
		
require_once('_controller/APP.Controller.php');

$start = new AppController();
$start->appStart();
?>