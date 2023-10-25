<?php
$directory    = dirname(__FILE__) . '/log';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
// print_r($scanned_directory);

foreach($scanned_directory as $files){
	echo $files.' <a href="log/'.$files.'" target="_blank"><strong>Ver</strong></a><br>';
}
?>
