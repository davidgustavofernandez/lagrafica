<?php

# OBTENEMOS IP DE USUARIO
require_once( dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');

# WE ASK IF THE IP IS BANNED
$_ip = new Ip();
$_the_ip = $_ip->getIpRemoteAddr();
$_ip_banned = false;

$_parameter_users_ips_banneds = array(
  'controller' => 'users_ips',
  'action' => 'filter',
  'ip' => $_the_ip,
  'is_banned' => '1',
  'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
  'personal_key' => base64_encode('7usWlQCZ4v2L6Q0CrZYKzwwnh')
);
$_r->setUrl($webservices);
$_r->setMethod('GET');
$_r->setParams($_parameter_users_ips_banneds);
$_response_users_ips_banneds = $_r->getRequest();

if( !empty($_response_users_ips_banneds) )
{
  $_retorno_users_ips_banneds = json_decode($_response_users_ips_banneds);
  
  if(is_object($_retorno_users_ips_banneds) && $_retorno_users_ips_banneds->error==false)
  {
    if($_retorno_users_ips_banneds->data['0']->ip == $_the_ip)
    {
      // header('Location: '.CONFIG_HOST_NAME_FRONTEND.'?msn=40&#index');
      // exit();
      $_ip_banned = true;
    }
  }
}
