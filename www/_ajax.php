<?php
require_once(dirname(__FILE__) . '/framework/_common/Class.Config.php');
$_c = new Configuration();
require_once(dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');
require_once(dirname(__FILE__) . '/framework/_lib/propagate/Class.Propagate.php');
require_once(dirname(__FILE__) . '/framework/_lib/messages/Class.Messages.php');
require_once(dirname(__FILE__) . '/framework/_lib/curl/Class.Curl.php');
require_once(dirname(__FILE__) . '/framework/_lib/session/Class.Session.php');
require_once(dirname(__FILE__) . '/framework/_lib/functions/Class.Functions.php');
require_once(dirname(__FILE__) . '/framework/_lib/validate/Class.Validate.php');
// require_once( dirname(__FILE__) . '/framework/_lib/mails/Class.Sender.Smtp.php');
require_once(dirname(__FILE__) . '/framework/_lib/crypt/Class.Crypt.php');
require_once(dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');
require_once(dirname(__FILE__) . '/framework/_lib/token/Class.Token.php');
require_once(dirname(__FILE__) . '/framework/_lib/cookie/Class.Abstract.Cookie.php');
require_once(dirname(__FILE__) . '/framework/_lib/cookie/Class.Cookie.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(dirname(__FILE__) . '/framework/_lib/PHPMailer-master/src/Exception.php');
require_once(dirname(__FILE__) . '/framework/_lib/PHPMailer-master/src/PHPMailer.php');
require_once(dirname(__FILE__) . '/framework/_lib/PHPMailer-master/src/SMTP.php');

$_e = new ErrorHandler();
$_p = new Propagate();
$_m = new Messages();
$_r = new Curl();
$_s = new Session();
$_f = new Functions();
$_t = new Token();
$_y = new Crypt();

# Recuperamos valores por querystring
$_p->setFilter(true);

## Generamos Token
$_t->setChars(true, true, true, false);
$_t->setLength(20, 20);

$error = false;
$errors = array();
$_debug = false;

# URL webservices
$webservices = array('URL' => CONFIG_URL_WEBSERVICES);

# SESSION / TOKEN
require_once(dirname(__FILE__) . '/_sessions_token.php');

# RECORDS en archivos fisicos formato JSON
require_once(dirname(__FILE__) . '/_common_static_json.php');

//if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {

# Recuperamos valores 
$_p->setFilter(true);     // Aplicamos filtro de injection
$_metodo            = 'request';

$action             = $_p->spread($_metodo, "action", '');
$token_querystring  = $_p->spread($_metodo, "token", '');

// Contact
$name                 = $_p->spread($_metodo, "name", '');
$email                = $_p->spread($_metodo, "email", '');
$cell_phone           = $_p->spread($_metodo, "cell_phone", '');
$id_form_type         = $_p->spread($_metodo, "id_form_type", 0);
$newsletter           = $_p->spread($_metodo, "newsletter", 0);
$terms_and_conditions = $_p->spread($_metodo, "terms_and_conditions", 0);
$message              = $_p->spread($_metodo, "message", '');

$id_lang              = $_p->spread($_metodo, "id_lang", 0);

if ($session_language == '1') {
  $id_section = 13;
} elseif ($session_language == '3') {
  $id_section = 13;
} else {
  $id_section = 13;
};

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json; charset=utf-8');

# Validamos que coincidan los token (token de session y queristring)
$error = $token_session_form !== $token_querystring ? 'Error, necesita tener una sessión válida (803)' : '';
$error .= empty($action) ? 'Error, falta acción (804)' : '';
//$error = $token_session['dato']['0']!==$token_querystring ? '803' : '';
if (!empty($error)) {
  echo json_encode(array('error' => array($error)));
  exit();
}

# Data section
$data_section = $_f->getArrayOnArrayByIndice($static_sections_array, 'id_section', $id_section);

# Tracking Variables
$tracking_id_section = $data_section['id_section'];
$tracking_name = $data_section['name'];
$tracking_accion = $action;


// Services
if ($action == 'contact') {

  $email_to_user = false;
  $email_to_admins = true;
  # Tracking
  $tracking_accion = 'Contacto - Nuevo';
  require_once(dirname(__FILE__) . '/_common_tracking.php');

  if (!preg_match("/^(?:(?:00)?(549|595)?)?0?(?:(11|9)|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/", $cell_phone)) {
    $data = array(
      'error' => true,
      'code' => '01',
      'data' => '',
      'message' => array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_validation_cell_phone_regexp', $session_language, true))
    );
    echo json_encode($data);
    exit();
  }

  if (!empty($terms_and_conditions)) {
    # VALIDACIONES de datos
    # formamos el array de datos para registrar al usuario
    if ($session_language == 3) {
      $data = array(
        'por_name' => $name,
        'por_email' => $email,
        'por_id_form_type' => $id_form_type,
        'por_message' => $message,
      );
      $post = Validate::factory($data)
        ->rules('por_name',         array('not_empty' => NULL, 'min_length' => array(2), 'max_length' => array(50)))
        ->rules('por_email',        array('not_empty' => NULL, 'min_length' => array(6), 'email' => NULL))
        ->rules('por_id_form_type', array('not_empty' => NULL, 'min_length' => array(1), 'max_length' => array(3), 'numeric' => NULL))
        ->rules('por_message',      array('not_empty' => NULL, 'min_length' => array(2), 'max_length' => array(700)));
    } else if ($session_language == 2) {
      $data = array(
        'esp_name' => $name,
        'esp_email' => $email,
        'esp_id_form_type' => $id_form_type,
        'esp_message' => $message,
      );
      $post = Validate::factory($data)
        ->rules('esp_name',         array('not_empty' => NULL, 'min_length' => array(2), 'max_length' => array(50)))
        ->rules('esp_email',        array('not_empty' => NULL, 'min_length' => array(6), 'email' => NULL))
        ->rules('esp_id_form_type', array('not_empty' => NULL, 'min_length' => array(1), 'max_length' => array(3), 'numeric' => NULL))
        ->rules('esp_message',      array('not_empty' => NULL, 'min_length' => array(2), 'max_length' => array(700)));
    } else {
      $data = array(
        'eng_name' => $name,
        'eng_email' => $email,
        'eng_id_form_type' => $id_form_type,
        'eng_message' => $message,
      );
      $post = Validate::factory($data)
        ->rules('eng_name',         array('not_empty' => NULL, 'min_length' => array(2), 'max_length' => array(50)))
        ->rules('eng_email',        array('not_empty' => NULL, 'min_length' => array(6), 'email' => NULL))
        ->rules('eng_id_form_type', array('not_empty' => NULL, 'min_length' => array(1), 'max_length' => array(3), 'numeric' => NULL))
        ->rules('eng_message',      array('not_empty' => NULL, 'min_length' => array(2), 'max_length' => array(700)));
    }

    # Data VALIDATIONS
    if ($post->check()) {

      # WE GET IP TO GEO LOACLIZE
      require_once(dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');
      $theIp = new Ip();
      $finalIP = $theIp->getIpRemoteAddr();

      # WE SAVE DATA {
      $param = array(
        'controller' => 'forms',
        'action' => 'talos01',

        'name' => $name,
        'email' => $email,
        'phone' => $cell_phone,
        'id_form_type' => $id_form_type,
        'message' => $message,
        'newsletter' => $newsletter,
        'terms_and_conditions' => $terms_and_conditions,

        'date' => $_f->date_decode(date('Y-m-d h:i:s'), TIME_ZONE, DATETIME_FORMAT),
        'modified' => $_f->date_decode(date('Y-m-d h:i:s'), TIME_ZONE, DATETIME_FORMAT),
        'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
        'personal_key' => base64_encode('7usWlQCZ4v2L6Q0CrZYKzwwnh')
      );

      $_r->setUrl($webservices);
      $_r->setMethod('GET');
      $_r->setParams($param);
      $ret = $_r->getRequest();

      // print_r($param);
      // print_r($ret);

      // $url_final = '';
      // foreach($param as $key=> $value){
      //   $url_final .= $key.'='.$value.'&';
      // }
      // echo '<br><br>';
      // echo $webservices['URL'].'?'.$url_final;
      // exit();

      if (!empty($ret)) {

        $data = json_decode($ret);

        # If it returns an integer that is the id_users
        if (is_int($data->data) && $data->error != 'true') {

          if ($email_to_user === true || $email_to_admins === true) {
            $path_settings_emails = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings_emails.inc';
            if (function_exists('file_get_contents') && file_exists($path_settings_emails)) {
              $static_settings_emails_array = unserialize(file_get_contents($path_settings_emails));
            } else {
              $static_settings_emails_array = array();
            }
          }
          // NOTIFICATIONS {
          // EMAIL TO USER {
          if ($email_to_user === true) {

            $email_email = $email;
            $email_name = $name;
            $email_title = $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'email_send_contact_title', $session_language, true);
            $email_subject = $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'email_send_contact_subject', $session_language, true);
            $email_body = $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'email_send_contact_user', $session_language);

            $email_url_to_site = CONFIG_HOST_NAME_FRONTEND;
            $newsletter = $newsletter == 1 ? 'Si' : 'No';

            $id_form_type_name = $_f->getStringOffArrayByIndice($static_forms_types_array, 'id_form_type', $id_form_type, 'name');

            // email tmplate
            $email_tpl_file = dirname(__FILE__) . '/material/settings_emails/media/' . $_f->getStringOffArrayByIndice($static_settings_emails_array, 'variable_name', 'contact_email_user', 'file');

            $email_tpl_file = file_get_contents($email_tpl_file);
            $email_tpl_file = str_replace('[[[brand]]]', CONFIG_NAME_SITE, $email_tpl_file);
            $email_tpl_file = str_replace('[[[title]]]', $email_title, $email_tpl_file);
            $email_tpl_file = str_replace('[[[date]]]', CONFIG_DATE, $email_tpl_file);
            $email_tpl_file = str_replace('[[[urlsite]]]', $email_url_to_site, $email_tpl_file);

            $cuerpo_de_email = str_replace('[[[name]]]', $name, $email_body);
            $cuerpo_de_email = str_replace('[[[email]]]', $email, $cuerpo_de_email);
            $cuerpo_de_email = str_replace('[[[cell_phone]]]', $cell_phone, $cuerpo_de_email);
            $cuerpo_de_email = str_replace('[[[id_form_type]]]', $id_form_type_name, $cuerpo_de_email);
            $cuerpo_de_email = str_replace('[[[newsletter]]]', $newsletter, $cuerpo_de_email);
            $cuerpo_de_email = str_replace('[[[message]]]', $message, $cuerpo_de_email);

            $elbody = str_replace('[[[body]]]', $cuerpo_de_email, $email_tpl_file);

            if (CONFIG_EN_DESARROLLO) {

              $email_tracking = "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
              $email_tracking .= "Email destinatario : " . $email_email . "<br>";
              $email_tracking .= "Nombre destinatario : " . $email_name . "<br>";
              $email_tracking .= "Subject : " . $email_subject . "<br>";
              $email_tracking .= "El HTML : " . "<br>";
              $email_tracking .= $elbody . "<br>";

              $for_name = date("d-m-Y_H-i-s", time()) . "_" . rand(10, 20);
              $path = dirname(__FILE__) . '/material/_events/CONTACT_good_EMAIL_user_' . $for_name . '.html';
              $dump_fp = fopen($path, "w");

              if ($dump_fp != false) {
                fwrite($dump_fp, $email_tracking);
                fclose($dump_fp);
              }
            } else {

              $mail = new PHPMailer();

              try {

                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = SMTP_SERVER;
                $mail->SMTPAuth   = SMTP_AUTHENTICATION;
                $mail->Username   = SMTP_USER;
                $mail->Password   = SMTP_PASS;
                $mail->SMTPSecure = SMTP_SECURE;
                $mail->Port       = SMTP_PORT;

                //Recipients
                $mail->setFrom(FROM_EMAIL, FROM_NAME);
                $mail->addAddress($email_email, $email_name);

                // Content
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);
                $mail->Subject = $email_subject;
                $mail->Body    = $elbody;
                $mail->send();

                $email_tracking = "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
                $email_tracking .= "Email destinatario : " . $email_email . "<br>";
                $email_tracking .= "Nombre destinatario : " . $email_name . "<br>";
                $email_tracking .= "Subject : " . $email_subject . "<br>";
                $email_tracking .= "STATUS : Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "<br>";
                $email_tracking .= "El HTML : " . "<br>";
                $email_tracking .= $elbody . "<br>";

                $for_name = date("d-m-Y_H-i-s", time()) . "_" . rand(10, 20);
                $path = dirname(__FILE__) . '/material/_events/CONTACT_good_EMAIL_user_' . $for_name . '.html';
                $dump_fp = fopen($path, "w");

                if ($dump_fp != false) {
                  fwrite($dump_fp, $email_tracking);
                  fclose($dump_fp);
                }
              } catch (Exception $e) {

                $email_tracking = "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
                $email_tracking .= "Email destinatario : " . $email_email . "<br>";
                $email_tracking .= "Nombre destinatario : " . $email_name . "<br>";
                $email_tracking .= "Subject : " . $email_subject . "<br>";
                $email_tracking .= "STATUS : Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "<br>";
                $email_tracking .= "El HTML : " . "<br>";
                $email_tracking .= $elbody . "<br>";

                $for_name = date("d-m-Y_H-i-s", time()) . "_" . rand(10, 20);
                $path = dirname(__FILE__) . '/material/_events/CONTACT_bad_EMAIL_user_' . $for_name . '.html';
                $dump_fp = fopen($path, "w");

                if ($dump_fp != false) {
                  fwrite($dump_fp, $email_tracking);
                  fclose($dump_fp);
                }

                $data = array(
                  'error' => true,
                  'code' => '07',
                  'data' => '',
                  'message' => array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_error_smtp', $session_language, true))
                );

                echo json_encode($data);
                exit();
              } // try

            }
          }
          // } EMAIL TO USER

          // EMAIL TO ADMINISTRATORS {
          if ($email_to_admins === true) {
            $email_url_to_site = CONFIG_HOST_NAME_FRONTEND;
            $a_email_admin_title = $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'email_send_contact_admin_title', $session_language, true);
            $a_email_admin_subject = $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'email_send_contact_admin_subject', $session_language, true);
            $a_cuerpo_de_email = $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'email_send_contact_admin', $session_language);
            $a_email_url_to_framework = CONFIG_HOST_NAME_BACKEND . 'index.php?controller=forms&action=edit&id_form=' . $data->data . '&';

            // email tmplate
            $email_tpl_file = dirname(__FILE__) . '/material/settings_emails/media/' . $_f->getStringOffArrayByIndice($static_settings_emails_array, 'variable_name', 'contact_email_user', 'file');
            $id_form_type_name = $_f->getStringOffArrayByIndice($static_forms_types_array, 'id_form_type', $id_form_type, 'name');

            $a_elbody = file_get_contents($email_tpl_file);
            $a_elbody = str_replace('[[[brand]]]', CONFIG_NAME_SITE, $a_elbody);
            $a_elbody = str_replace('[[[title]]]', $a_email_admin_title, $a_elbody);
            $a_elbody = str_replace('[[[date]]]', CONFIG_DATE, $a_elbody);
            $a_elbody = str_replace('[[[urlsite]]]', $email_url_to_site, $a_elbody);

            $a_cuerpo_de_email = str_replace('[[[name]]]', $name, $a_cuerpo_de_email);
            $a_cuerpo_de_email = str_replace('[[[email]]]', $email, $a_cuerpo_de_email);
            $a_cuerpo_de_email = str_replace('[[[cell_phone]]]', $cell_phone, $a_cuerpo_de_email);
            $a_cuerpo_de_email = str_replace('[[[id_form_type]]]', $id_form_type_name, $a_cuerpo_de_email);
            $a_cuerpo_de_email = str_replace('[[[newsletter]]]', $newsletter, $a_cuerpo_de_email);
            $a_cuerpo_de_email = str_replace('[[[message]]]', $message, $a_cuerpo_de_email);
            $a_cuerpo_de_email = str_replace('[[[user_detail_url]]]', $a_email_url_to_framework, $a_cuerpo_de_email);

            $a_elbody = str_replace('[[[body]]]', $a_cuerpo_de_email, $a_elbody);

            // GET Administrators
            $parameters = array(
              'controller' => 'administrators',
              'action' => 'filterPaged',
              'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
              'personal_key' => base64_encode('7usWlQCZ4v2L6Q0CrZYKzwwnh'),
              'private_key' => base64_encode(CRYPT_VAR_WEB_SERVICE_KEY),
              'status' => '1'
            );

            $_r->setUrl($webservices);
            $_r->setMethod('GET');
            $_r->setParams($parameters);
            $response = $_r->getRequest();

            if (!empty($response)) {
              $retorno = json_decode($response, true);

              if (is_array($retorno) && $retorno['error'] == false) {
                $administrators_array = $retorno['data'];

                foreach ($administrators_array as $administrator) {

                  if ($administrator['moderator'] == '1') {

                    $a_elbody = str_replace('[[[admin_name]]]', $administrator['name'], $a_elbody);
                    $a_elbody = str_replace('[[[admin_last_name]]]', $administrator['last_name'], $a_elbody);

                    if (CONFIG_EN_DESARROLLO) {

                      $email_tracking = "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
                      $email_tracking .= "Email destinatario : " . $administrator['email'] . "<br>";
                      $email_tracking .= "Nombre destinatario : " . $administrator['name'] . ", " . $administrator['last_name'] . "<br>";
                      $email_tracking .= "Subject : " . $a_email_admin_subject . "<br>";
                      $email_tracking .= "El HTML : " . "<br>";
                      $email_tracking .= $a_elbody . "<br>";

                      $for_name = date("d-m-Y_H-i-s", time()) . "_" . rand(10, 20);
                      $path = dirname(__FILE__) . '/material/_events/CONTACT_good_EMAIL_administrators_' . $for_name . '.html';
                      $dump_fp = fopen($path, "w");

                      if ($dump_fp != false) {
                        fwrite($dump_fp, $email_tracking);
                        fclose($dump_fp);
                      }
                    } else {

                      $mail = new PHPMailer();

                      try {

                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host       = SMTP_SERVER;
                        $mail->SMTPAuth   = SMTP_AUTHENTICATION;
                        $mail->Username   = SMTP_USER;
                        $mail->Password   = SMTP_PASS;
                        $mail->SMTPSecure = SMTP_SECURE;
                        $mail->Port       = SMTP_PORT;

                        //Recipients
                        $mail->setFrom(FROM_EMAIL, FROM_NAME);
                        $mail->addAddress($administrator['email'], $administrator['name'] . ' ' . $administrator['last_name']);

                        // Content
                        $mail->CharSet = 'UTF-8';
                        $mail->isHTML(true);
                        $mail->Subject = $a_email_admin_subject;
                        $mail->Body    = $a_elbody;
                        $mail->send();

                        $email_tracking = "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
                        $email_tracking .= "Email destinatario : " . $administrator['email'] . "<br>";
                        $email_tracking .= "Nombre destinatario : " . $administrator['name'] . ", " . $administrator['last_name'] . "<br>";
                        $email_tracking .= "Subject : " . $a_email_admin_subject . "<br>";
                        $email_tracking .= "El HTML : " . "<br>";
                        $email_tracking .= $a_elbody . "<br>";
                        $for_name = date("d-m-Y_H-i-s", time()) . "_" . rand(10, 20);
                        $path = dirname(__FILE__) . '/material/_events/CONTACT_good_EMAIL_user_' . $for_name . '.html';
                        $dump_fp = fopen($path, "w");

                        if ($dump_fp != false) {
                          fwrite($dump_fp, $email_tracking);
                          fclose($dump_fp);
                        }
                      } catch (Exception $e) {

                        $email_tracking = "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
                        $email_tracking .= "Email destinatario : " . $administrator['email'] . "<br>";
                        $email_tracking .= "Nombre destinatario : " . $administrator['name'] . ", " . $administrator['last_name'] . "<br>";
                        $email_tracking .= "Subject : " . $a_email_admin_subject . "<br>";
                        $email_tracking .= "STATUS : Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "<br>";
                        $email_tracking .= "El HTML : " . "<br>";
                        $email_tracking .= $a_elbody . "<br>";

                        $for_name = date("d-m-Y_H-i-s", time()) . "_" . rand(10, 20);
                        $path = dirname(__FILE__) . '/material/_events/CONTACT_bad_EMAL_user_' . $for_name . '.html';
                        $dump_fp = fopen($path, "w");

                        if ($dump_fp != false) {
                          fwrite($dump_fp, $email_tracking);
                          fclose($dump_fp);
                        }

                        $data = array(
                          'error' => true,
                          'code' => '06',
                          'data' => '',
                          'message' => array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_error_smtp', $session_language, true))
                        );

                        echo json_encode($data);
                        exit();
                      } // try
                    }
                  }
                } // foreach
              }
            }
          }
          // } EMAIL TO ADMINISTRATORS
          // } NOTIFICATIONS

          // SUCCESS!!
          $_s->setVariableUnset('session_form');
          $message = array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_success_save_contact_user', $session_language, true));
          $data = array(
            'error' => false,
            'data' => '',
            'message' => $message
          );
          echo json_encode($data);
          exit();
        } else {

          $message = array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_error_save_contact', $session_language, true));
          $data = array(
            'error' => true,
            'code' => '05',
            'data' => '',
            'message' => $message
          );
          echo json_encode($data);
          exit();
        }
      } else {

        $message = array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_error_api', $session_language, true));
        $data = array(
          'error' => true,
          'code' => '04',
          'data' => '',
          'message' => $message
        );
        echo json_encode($data);
        exit();
      }
      ## } WE SAVE DATA

    } else {

      $errors = $post->errors();
      $data = array(
        'error' => true,
        'code' => '03',
        'data' => $errors,
        'message' => ''
      );
      echo json_encode($data);
      exit();
    }
  } else {

    $message = array($_f->getStringOffArrayByNameLang($static_settings_copys_array, 'form_serv_error_terms_and_conditions', $session_language, true));
    $data = array(
      'error' => true,
      'code' => '02',
      'data' => '',
      'message' => $message
    );
    echo json_encode($data);
    exit();
  };
} else if ($action == 'lang') {
  /*echo $_s->getVariable('language',false);
	echo '<br>';
	echo $id_lang;
	exit();*/
  # VALIDACION de datos ingresados
  if (!empty($id_lang)) {
    $_s->setVariable('language', $id_lang);
    header('Location: ' . CONFIG_HOST_NAME_FRONTEND);
    exit();
  } else {
    header('Location: ' . CONFIG_HOST_NAME_FRONTEND);
    exit();
  }
}
