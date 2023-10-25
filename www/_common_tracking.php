<?php

# OBTENEMOS IP DE USUARIO
require_once( dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');
$track_the_ip = new Ip();
$tracking_ip = $track_the_ip->getIpRemoteAddr();

if(!empty($token_user_return['id_user'])){
  $tracking_id_user = $token_user_return['id_user'];
}elseif(!empty($token_session_data_user['id_user'])){
  $tracking_id_user = $token_session_data_user['id_user'];
}else{
  $tracking_id_user = '';
}

# TOKEN COOKIE
$_t->setChars(true,true,true,false);
$_t->setLength(30,30);
$cookie_token 	= $_t->getToken();

$cookie_data[] = array(
  'cookie_token'=>$cookie_token,
  'ip'=>$tracking_ip,
  'id_user'=>$tracking_id_user
);

/* WE TREAT ACTIVITY + COOKIE { 
  a) First we ask if there is a Cookie.
  If the cookie exists and it has content, we take the user's data.
  If we do not create cookies.
*/
require_once( dirname(__FILE__) . '/framework/_lib/cookie/Class.Abstract.Cookie.php');
require_once( dirname(__FILE__) . '/framework/_lib/cookie/Class.Cookie.php');

$__cookie = new Cookie(); 
$__cookie->setKey(COOKIE_CRYPT_VAR);
$__cookie->setId(COOKIE_ID);
$__cookie->setExpire(COOKIE_EXPIRE);
$__cookie->setPath(COOKIE_PATH);
$__cookie->setDomain(CONFIG_HOST);
$__cookie->setSecure(COOKIE_SECURE);
$__cookie->setName(COOKIE_NAME);

if($__cookie->ifExist() === true)
{
  $colection = $__cookie->getCookie(COOKIE_NAME);
  $cookie_token = $colection[0]['cookie_token'];
  
  // We ask if the id_user was saved in the Cookie, if so, we use it only to insert it in the records
  $cookie_id_user = !empty($colection[0]['id_user']) ? $colection[0]['id_user'] : '';
  
  if(empty($token_user_return['id_user']))
  {
    if(!empty($cookie_id_user))
    {
      $tracking_id_user = $cookie_id_user;
    }
  }
}
else
{
  $__cookie->setValue($cookie_data);
  $__cookie->setIni();
}

# Values for the track
$tracking_session_language = !empty($session_language) ? $session_language : 1;
$tracking_id_section = !empty($tracking_id_section) ? $tracking_id_section : '';
$tracking_accion = !empty($tracking_accion) ? $tracking_accion : '';
$tracking_variable = !empty($tracking_variable) ? $tracking_variable : '';
$tracking_valor = !empty($tracking_valor) ? $tracking_valor : '';
$tracking_name = !empty($tracking_name) ? $tracking_name : '';
$tracking_ip = !empty($tracking_ip) ? $tracking_ip : '';

if($tracking_name!='count_carrito' && $tracking_name!='count_wish' && $tracking_name!='see_temp_wish'){
  // We insert trackeo
  $tracking_parameters = array(
    'controller' => 'users_trackings',
    'action' => 'talos01',
    'id_setting_language' => $tracking_session_language,
    'id_section' => $tracking_id_section,
    'id_user' => $tracking_id_user,
    'name' => $tracking_name,
    'accion' => $tracking_accion,
    'variable' => $tracking_variable,
    'valor' => $tracking_valor,
    'ip' => $tracking_ip,
    'token' => $cookie_token,
    'date' => $_f->date_decode(date('Y-m-d h:i:s'), TIME_ZONE, DATETIME_FORMAT),
    'modified' => $_f->date_decode(date('Y-m-d h:i:s'), TIME_ZONE, DATETIME_FORMAT),
    'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
    'personal_key' => base64_encode('7usWlQCZ4v2L6Q0CrZYKzwwnh'),
    'status' => '1'
  );
  $_r->setUrl($webservices);
  $_r->setParams($tracking_parameters);
  $tracking_response = $_r->getRequest();

  // print_r($tracking_parameters);
  // print_r($tracking_response);

  // $url_final = '';
  // foreach($tracking_parameters as $key=> $value){
  //   $url_final .= $key.'='.$value.'&';
  // }
  // echo '<br><br>';
  // echo $webservices['URL'].'?'.$url_final;
  // exit();
}
