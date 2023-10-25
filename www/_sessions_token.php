<?php
// $explode_url = explode("/", $_SERVER["REQUEST_URI"]);
// $is_api = in_array('api',$explode_url) ? true : false;

// if($is_api==true){
// }else{
// }
require_once(dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');
# SESSION {
# Generate token
$_t->setChars(true, true, true, false);
$_t->setLength(20, 20);

# Init SESSION to save the token
$_s->setDebug(true);
$_s->setKey(CONFIG_SESION_KEY_FRONT);
$_s->setFlagValors('flag', CONFIG_SESION_NAME_FRONT);
$_s->setName(CONFIG_SESION_NAME_FRONT);
$_s->setExpireTime(180 * 60);
$_s->propagate();

# Validate SESSION
$flagDeSession = $_s->confirmFlag() === false ? 'sessionOff' : 'SessionOn';

# Create session if it is not created
if (!empty($flagDeSession) && $flagDeSession == 'sessionOff') {
  $_s->setFlag();
  $token_to_session = $_t->getToken();
  $flagDeSession = $_s->confirmFlag() === false ? 'sessionOff' : 'SessionOn';

  # Save token in session
  $_s->setVariable('token', $token_to_session);
  $token_session = $token_to_session;
} else {
  # Retrieve token of session
  $token_session = $_s->getVariable('token', false) === false ? $_m->getMessage('session', '400') : $_s->getVariable('token', false);
  # Retrieve token of session the User
  $token_session_user = $_s->getVariable('token_user', false) === false ? 'nologado' : $_s->getVariable('token_user', false);
  # Retrieve token of session the User Data
  $token_session_data_user = $_s->getVariable('user_data', true) === false ? 'sindatos' : $_s->getVariable('user_data', true);
  # Retrieve data in user session for transaction
  $token_session_data_user_transac = $_s->getVariable('user_data_transac', true) === false ? 'sindatos' : $_s->getVariable('user_data_transac', true);
  # Retrieve user permissions
  $token_session_data_user_permissions = $_s->getVariable('user_permissions_data', true) === false ? 'sindatos' : $_s->getVariable('user_permissions_data', true);
}

# Validate SESSION
if ($_s->getVariable('token_form', false) === false) {
  $token_session_form = $_t->getToken();
  $_s->setVariable('token_form', $token_session_form);
} else {
  $token_session_form = $_s->getVariable('token_form', false);
}

# TOKEN USER RETURN {
if ($_s->getVariable('token_return', true) === false) {
  # Get IP from USER
  $the_ip = new Ip();
  $user_ip = $the_ip->getIpRemoteAddr();

  require_once(dirname(__FILE__) . '/framework/_lib/cookie/Class.Abstract.Cookie.php');
  require_once(dirname(__FILE__) . '/framework/_lib/cookie/Class.Cookie.php');

  $_cookie = new Cookie();
  $_cookie->setKey(COOKIE_CRYPT_VAR);
  $_cookie->setId(COOKIE_ID);
  $_cookie->setExpire(COOKIE_EXPIRE);
  $_cookie->setPath(COOKIE_PATH);
  $_cookie->setDomain(CONFIG_HOST);
  $_cookie->setSecure(COOKIE_SECURE);
  $_cookie->setName(COOKIE_NAME);

  if ($_cookie->ifExist() === true) {
    $token_user_return = array();
    // echo 'EXISTE!!!';
    $colexion = $_cookie->getCookie(COOKIE_NAME);
    // print_r($colexion);
    $cookie_token = !empty($colexion[0]['cookie_token']) ? $colexion[0]['cookie_token'] : '';
    // $cookie_id_user = !empty($colexion[0]['id_user']) ? $colexion[0]['id_user'] : '';

    # We ask if there is a user with this IP {
    $parameters_ip = array(
      'controller' => 'users_ips',
      'action' => 'filter',
      'ip' => $user_ip,
      'token' => $cookie_token,
      'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
      'personal_key' => base64_encode('7usWlQCZ4v2L6Q0CrZYKzwwnh'),
    );
    $_r->setUrl($webservices);
    $_r->setMethod('GET');
    $_r->setParams($parameters_ip);
    $response_ip = $_r->getRequest();

    if (!empty($response_ip)) {
      $retorno_ip = json_decode($response_ip, true);

      if (is_array($retorno_ip) && $retorno_ip['error'] == false) {
        if ($retorno_ip['data']['0']['ip'] == $user_ip) {
          $token_user_return = $retorno_ip['data']['0'];
        } else {
          $token_user_return = array();
        }
      } else {
        $token_user_return = array();
      }
    } else {
      $token_user_return = array();
    }
    # } We ask if there is a USER with this IP
    # We put the USER data in SESSION
    $_s->setVariable('token_return', $token_user_return);
  } else {
    // echo 'NO EXISTE!!!';
    $token_user_return = array();
  }
} else {
  $token_user_return = $_s->getVariable('token_return', true);
}
# } TOKEN USER RETURN

# TRATAMOS WHISH LIST SESSION + COOKIE { 
/*
      Primero preguntamos si exite una Cookie con productos whish.
      Si existe la Cookie y tiene contenido lo incorporamos a la session.
      Si no solo instanciamos cookies.
    */
// if($_s->getVariable('wish_temp',true)===false)
// {
//   require_once( dirname(__FILE__) . '/framework/_lib/cookie/Class.Abstract.Cookie.php');
//   require_once( dirname(__FILE__) . '/framework/_lib/cookie/Class.Cookie.php');
//   $_cookie = new Cookie();

//   $_cookie->setKey(COOKIE_CRYPT_VAR);
//   $_cookie->setId(COOKIE_ID);
//   $_cookie->setExpire(false);
//   $_cookie->setPath('/');
//   $_cookie->setDomain('localhost');
//   $_cookie->setSecure(false);

//   $_cookie->setName('USUARIO');
//   $_cookie->setIni();

//   $session_wish_data = $_cookie->getCookie();

//   if(is_array($session_wish_data) && !empty($session_wish_data[0]['id_producto']))
//   {
//     if($_s->getVariable('wish_temp',true)===false)
//     {
//       $_s->setVariableUnset('wish_temp');
//       $_s->setVariable('wish_temp',$session_wish_data);
//     }
//     else
//     {
//       $session_wish_data = $_s->getVariable('wish_temp',true);
//     }
//   }
//   else
//   {
//     //echo 'bad';
//   }
// }
// else
// {
//   $session_wish_data = $_s->getVariable('wish_temp',true);
// }
# } TRATAMOS WHISH LIST SESSION + COOKIE

# CONFIG BILLING DATA {
// if ($_s->getVariable('session_country', true) === false) {
# Countries {
$path_countries = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'countries.inc';

if (function_exists('file_get_contents') && file_exists($path_countries)) {
  $static_countries_array = unserialize(file_get_contents($path_countries));
} else {
  $static_countries_array = array(
    '0' => array(
      'id_country' => '0',
      'id_country_language' => '',
      'isonum' => '',
      'iso2' => '',
      'iso3' => '',
      'name' => '',
      'date' => '',
      'modified' => '',
      'status' => ''
    )
  );
}
# } Countries

# Countries Currencies {
$path_currencies = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'countries_currencies.inc';

if (function_exists('file_get_contents') && file_exists($path_currencies)) {
  $static_currencies_array = unserialize(file_get_contents($path_currencies));
} else {
  $static_currencies_array = array(
    '0' => array(
      'id_country_currency' => '0',
      'language' => '',
      'currency_iso' => '',
      'name' => '',
      'currency' => '',
      'simbol' => '',
      'date' => '',
      'modified' => '',
      'status' => ''
    )
  );
}
# } Countries Currencies

# Settings Currencies {
$path_settings_currencies = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings_currencies.inc';

if (function_exists('file_get_contents') && file_exists($path_settings_currencies)) {
  $static_settings_currencies_array = unserialize(file_get_contents($path_settings_currencies));
} else {
  $static_settings_currencies_array = array(
    '0' => array(
      'id_setting_currency' => '0',
      'id_country' => '',
      'id_country_currency' => '',
      'name' => '',
      'date' => '',
      'modified' => '',
      'status' => ''
    )
  );
}
# } Settings Currencies

# Settings Languages {
$path_settings_languages = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings_languages.inc';
if (function_exists('file_get_contents') && file_exists($path_settings_languages)) {
  $static_settings_languages_array = unserialize(file_get_contents($path_settings_languages));
} else {
  $static_settings_languages_array = array(
    '0' => array(
      'id_setting_language' => '0',
      'name' => '',
      'abbreviation' => '',
      'date' => '',
      'modified' => '',
      'status' => ''
    )
  );
}
# } Settings Languages

// echo 'country false';
// print_r($static_countries_array);
// print_r($static_currencies_array);
// print_r($static_settings_currencies_array);
// print_r($static_settings_languages_array);
// exit();

# ASIGNAMOS PAIS MONEDA POR GEO IP
$session_global_data = array();
$session_global_data['enabled'] = false;
$session_global_data['code'] = '';
$session_global_data['code3'] = '';
$session_global_data['id_country'] = '';
$session_global_data['id_country_language'] = '';
$session_global_data['id_country_currency'] = '';
$session_global_data['setting_language'] = '';
$session_global_data['setting_iso'] = '';
$session_global_data['setting_name'] = '';
$session_global_data['setting_currency'] = '';
$session_global_data['setting_simbol'] = '';
$session_global_data['setting_abbreviation'] = '';

# OBTENEMOS IP PARA GEO LOACLIZAR {
$_ip = new Ip();
// $the_ip = $_ip->getIpRemoteAddr();
// $the_ip = '69.10.54.169'; // USA
$the_ip = '200.5.253.18'; // ARGENTINA

# HARCODEAMOS SEGUN PAIS
// if(!empty($token_session_data_user['id_country']))
// {
//   if($token_session_data_user['id_country']=='222')
//   {
//     $the_ip = '69.10.54.169'; // USA
//   }
//   else if($token_session_data_user['id_country']=='10')
//   {
//     $the_ip = '200.5.253.18'; // ARGENTINA
//   }
//   else
//   {
//     //echo 'NO puede comprar';
//     $the_ip = $_ip->getIpRemoteAddr();
//   }
// }
// else
// {
//   // echo 'NO puede comprar!';
//   $the_ip = $_ip->getIpRemoteAddr();
// }
# } OBTENEMOS IP PARA GEO LOACLIZAR

# OBTENEMOS x IP su GEO LOCALIZACIÓN {
if (!empty($the_ip) && $the_ip != '127.0.0.1' && $the_ip != '::1') {
  
  require_once(dirname(__FILE__) . '/framework/_lib/geo_ip/geoip-api-php/src/geoip.inc');
  $gi = geoip_open(dirname(__FILE__) . '/framework/_lib/geo_ip/GeoIP/GeoIP.dat', GEOIP_STANDARD);
  $retornoGeoIpCode = geoip_country_code_by_addr($gi, $the_ip);
  $retornoGeoIpCode3 = geoip_country_code3_by_addr($gi, $the_ip);
  geoip_close($gi);

  foreach ($static_countries_array as $data_countries) {
    if ($data_countries['iso3'] == $retornoGeoIpCode3) {
      # MATCH !!!!!!!!!!!!!!!!!!!
      $session_global_data['code'] = $retornoGeoIpCode;
      $session_global_data['code3'] = $retornoGeoIpCode3;

      $session_global_data['id_country'] = $data_countries['id_country'];
      $session_global_data['id_country_language'] = $data_countries['id_setting_language'];

      foreach ($static_settings_languages_array as $data_seting_language) {
        if ($data_countries['id_setting_language'] == $data_seting_language['id_setting_language']) {
          $session_global_data['setting_country_language_name'] = $data_seting_language['name'];
          $session_global_data['setting_abbreviation'] = $data_seting_language['abbreviation'];
        }
      }
    }
  }

  # SET IDIOMA
  if ($_s->getVariable('language', false) === false) {
    if (!empty($session_global_data['id_country_language'])) {
      $_s->setVariable('language', $session_global_data['id_country_language']);
    } else {
      // HARCODEO
      $_s->setVariable('language', '2');
    }
  } else {
    $session_language = $_s->getVariable('language', false);
  }

  # SET COUNTRY
  if ($_s->getVariable('country', false) === false) {
    if (!empty($session_global_data['id_country'])) {
      $_s->setVariable('country', $session_global_data['id_country']);
    } else {
      // HARCODEO
      $_s->setVariable('country', '10');
    }
  } else {
    $session_country = $_s->getVariable('country', false);
  }

  foreach ($static_settings_currencies_array as $data_countries_currencies) {
    if ($data_countries_currencies['id_country'] == $session_global_data['id_country']) {
      # MATCH PAIS HABILITADO PARA COMPRA!!!!!!!!!!!!!!!!!!!
      $session_global_data['enabled'] = true;
      $session_global_data['id_country_currency'] = $data_countries_currencies['id_country_currency'];

      foreach ($static_currencies_array as $data_currency) {
        if ($data_currency['id_country_currency'] == $data_countries_currencies['id_country_currency']) {
          $session_global_data['setting_language'] = $data_currency['language'];
          $session_global_data['setting_iso'] = $data_currency['currency_iso'];
          $session_global_data['setting_name'] = $data_currency['name'];
          $session_global_data['setting_currency'] = $data_currency['currency'];
          $session_global_data['setting_simbol'] = $data_currency['simbol'];
        }
      }
    }
  }
  // print_r($session_global_data);
  // exit();
}
# } OBTENEMOS x IP su GEO LOCALIZACIÓN

# GUARDAMOS DATOS EN UN ARRAY COMO VARIABLE DE SESSION
$_s->setVariable('session_country', $session_global_data);
// } else {
//   $session_global_data = $_s->getVariable('session_country', true);
// }
# } CONFIG BILLING DATA

// print_r($_s->getVariable('country',true));
// print_r($session_global_data);
// echo $session_global_data['id_country_language'];
// exit();
$session_language = $session_global_data['id_country_language'];
$session_country = $session_global_data['id_country'];

$navigation_state = !empty($_s->getVariable('navigator', false)) ? $_s->getVariable('navigator', false) : 'disabled';
$nav_state = '';

# } SESSION
