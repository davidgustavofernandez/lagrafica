<?php

function https_amigo_json() 
{
	$url = 'http://secure-developments.com/commonwealth/colombia/picup-img/api/webservices.php?controller=settings&action=listed&status=1&kcs=cDlsd1N1bVhNVTd4aHdARjFXT1hpRWlmOQ==&kcsp=STNkblo4bElFc0NYcjBqWWZBbXY=&';
	$a = file_get_contents($url);
	return $a;
}

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json; charset=utf-8');

echo https_amigo_json();
?>