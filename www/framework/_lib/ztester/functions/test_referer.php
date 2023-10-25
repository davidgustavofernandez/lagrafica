<?php

define('THE_SITE_HOST',"http://".$_SERVER['HTTP_HOST']."/");
define('TENGO_REFERER', ( isset($_SERVER['HTTP_REFERER']) ? true : false) );

if(TENGO_REFERER){
	define('EN_MISMO_DOMINIO', ( substr_count($_SERVER['HTTP_REFERER'], THE_SITE_HOST) == 1 ? true : false ) );
	$PROCEDENCIA_URL = $_SERVER['HTTP_REFERER'];
}else{
	define('EN_MISMO_DOMINIO', false);
	$PROCEDENCIA_URL = '';
};


echo 'URL ACTUAL DINAMICA: ' .'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '<br>';
echo 'PROCEDENCIA: ' . $PROCEDENCIA_URL . '<br>';
echo 'IP: ' . preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] ) . '<br>';
echo 'AGENT: ' . $_SERVER['HTTP_USER_AGENT'] . '<br>';
echo 'REFERER: ' . $_SERVER['HTTP_REFERER'] . '<br>';

?>