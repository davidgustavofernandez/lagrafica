<?php
require_once('Class.Use.Curl.php');

$url = 'http://secure-developments.com/commonwealth/colombia/picup-img/api/webservices.php';
$useCurl = new UseCurl();
$useCurl->setUrl($url);
$useCurl->setPostString("controller=settings&action=listed&status=1&kcs=cDlsd1N1bVhNVTd4aHdARjFXT1hpRWlmOQ==&kcsp=STNkblo4bElFc0NYcjBqWWZBbXY=&");
$useCurlRetorno = $useCurl->do_request();

echo '<strong>Retorno por CURL: '.$url.'</strong>';
echo '<br>';
print_r($useCurlRetorno);
echo '<br>';

?>