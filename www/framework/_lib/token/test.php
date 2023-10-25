<?php
require_once(dirname(__FILE__) . '/Class.Token.php');

$_token = new Token();
$_token->setChars(true, true, true, false);

$_token->setLength(20, 20);
$_string = $_token->getToken();
echo 'CONFIG_SESION_FLAG <b>x20:</b><br>' . $_string . '<br>';

$_token->setLength(100, 100);
$_string1 = $_token->getToken();
echo '<br>CONFIG_SESION_KEY_BACK <b>x100:</b><br>' . $_string1 . '<br>';

$_token->setLength(100, 100);
$_string2 = $_token->getToken();
echo '<br>CONFIG_SESION_KEY_FRONT <b>x100:</b><br>' . $_string2 . '<br>';

$_token->setLength(100, 100);
$_string3 = $_token->getToken();
echo '<br>CONFIG_SESION_KEY_ADMIN <b>x100:</b><br>' . $_string3 . '<br>';

$_token->setLength(100, 100);
$_string4 = $_token->getToken();
echo '<br>CONFIG_SESION_KEY_ADMINISTRADOR <b>x100:</b><br>' . $_string4 . '<br>';

$_token->setLength(250, 250);
$_string5 = $_token->getToken();
echo '<br>CRYPT_VAR <b>x250:</b><br>' . $_string5 . '<br>';

$_token->setLength(2500, 2500);
$_string6 = $_token->getToken();
echo '<br>CRYPT_VAR_TXT <b>x2500:</b><br>' . $_string6 . '<br>';

$_token->setLength(2500, 2500);
$_string7 = $_token->getToken();
echo '<br>CRYPT_VAR_USERS <b>x2500:</b><br>' . $_string7 . '<br>';

$_token->setChars(true, true, true, true);
$_token->setLength(25, 25);
$_string8 = $_token->getToken();
echo '<br>CRYPT_VAR_WEB_SERVICE <b>x25:</b><br>' . $_string8 . '<br>';

$_token->setChars(true, true, true, false);
$_token->setLength(50, 50);
$_string9 = $_token->getToken();
echo '<br>CRYPT_VAR_WEB_SERVICE_KEY <b>x50:</b><br>' . $_string9 . '<br>';

$_token->setChars(false, false, true, false);
$_token->setLength(30, 30);
$_string10 = $_token->getToken();
echo '<br>COOKIE_ID <b>x30:</b><br>' . $_string10 . '<br>';

$_token->setChars(true, true, true, false);
$_token->setLength(2500, 2500);
$_string11 = $_token->getToken();
echo '<br>COOKIE_CRYPT_VAR <b>x2500:</b><br>' . $_string11 . '<br>';

$_token->setLength(25, 25);
$_string12 = $_token->getToken();
echo '<br>API_KEY <b>x25:</b><br>' . $_string12 . '<br>';
