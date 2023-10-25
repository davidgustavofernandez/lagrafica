<?php

/**
 * Functions, Funciones generales
 * 
 * Functions pone a disposición funciones
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Config class,
 * @subpackage Functions
 */
class Functions
{
  /**
   * chek_field public function
   * @uses $find, String
   * @uses $in, Array
   * Note: Valid if a field exists within a matrix of the table
   */
  public function chek_field($find, $in)
  {
    $retorno = false;

    foreach ($in as $key => $value) {
      if ($key == $find) {
        $retorno = true;
        return $retorno;
      }
    }
    return $retorno;
  }

  /**
   * pr function
   * @uses func_get_args, Function
   * @uses $arr, Variable
   * Note: Imprime los valores de una matriz
   */
  public function pr()
  {
    $retorno = '';
    $arr = func_get_args();

    foreach ($arr as $a) {
      $retorno .= "<pre>";
      $retorno .= print_r($a, true);
      $retorno .= "</pre>";
    }
    return $retorno;
  }
  /**
   * prx function
   * @uses func_get_args, Function
   * @uses $arr, Variable
   * Note: Imprime los valores de una matriz pasada
   */
  public function prx($params)
  {
    $retorno = '';
    if (isset($params)) {
      foreach ($params as $var => $val) {
        $retorno .= "[" . $var . "] = " . $val . "<BR>";
      }
    }
    return $retorno;
  }
  /**
   * parseText function
   * @uses $text, Variable
   * @uses $data, Array
   * Note: Parsea documento, cambia bariables espesificas en un doc.
   */
  public function parseText($text = '', $data = array())
  {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        print_r($value);
        die('Corroborar template de datos');
      }
      $text = str_replace('{' . $key . '}', $value, $text);
    }
    return $text;
  }

  public function headerRedirect($url, $params)
  {
    $parameters = $this->create_url_string($params);
    if (!empty($parameters)) {
      header('Location: ' . $url . '?' . $parameters . '');
    } else {
      header('Location: ' . $url . '');
    }
    exit();
  }

  private function create_url_string($params)
  {
    $post_params = array();
    foreach ($params as $key => &$val) {
      $post_params[] = $key . '=' . urlencode($val);
    }
    return implode('&', $post_params);
  }

  public function exitCode($code)
  {
    echo $code;
    exit();
  }

  public function convertSize($size)
  {
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
  }

  public function convertMicrotime($time)
  {
    list($usec, $sec) = explode(" ", $time);
    return ((float)$usec + (float)$sec);
  }

  public function _injection($chain, $filter = true)
  {
    if ($filter === true) {
      $no_admite = array(
        //'"',
        "'",
        //"&",
        "--",
        "select",
        "insert",
        "update",
        "delete",
        "drop",
        "%",
        ";",
        //"=",
        "\\",
        "<script>",
        "< /script>",
        "</script>",
        "#",
        "<input",
        "<textarea",
        "<option",
        "<select",
        "<button",
        "!",
        "`",
        "\\",
        //"/",
        // "(",
        // ")",
        "*"
      );

      foreach ($no_admite as $no_admite_str) {
        $chain = str_replace($no_admite_str, "", $chain);
        $chain = str_replace(strtoupper($no_admite_str), "", $chain);
      }
    }

    return (string) $this->escapeString($chain);
  }

  function getCodigoTarjeta($pais, $empresa, $usuario)
  {
    $codeString = $this->getStringCode($pais, $empresa, $usuario);
    $codeArray = str_split($codeString);
    $numbersEven = array();
    $numbersOdd = array();
    $numbersEvenFor = 0;
    $numbersOddFor = 0;

    foreach ($codeArray as $key => $value) {
      if (is_int($key / 2)) {
        $numbersEven[] = $value;
      } else {
        $numbersOdd[] = $value;
      }
    }

    foreach ($numbersEven as $k => $v) {
      $numbersEvenFor = ($v * 1) + $numbersEvenFor;
    }

    foreach ($numbersOdd as $ke => $va) {
      $numbersOddFor = ($va * 3) + $numbersOddFor;
    }

    $sumEvenOdd = $numbersEvenFor + $numbersOddFor;

    return $codeString . ($this->getTenMore($sumEvenOdd) - $sumEvenOdd);
  }

  function getStringCode($pais, $empresa, $usuario)
  {
    $intPaises = 2;
    $intEmpresas = 3;
    $intUsuarios = 7;
    $retorno = (string) $this->getFullPositions($pais, $intPaises) . $this->getFullPositions($empresa, $intEmpresas) . $this->getFullPositions($usuario, $intUsuarios);
    return $retorno;
  }
  /**
   * getFullPositions function
   * @uses $valor, number
   * @uses $len, number
   * Note: Dado un $valor cuenta las posiciones que tiene, Luego genera un string restando el leng del valor con el del $len y se completa adelante las posiciones faltantes para llegar a $len con el numero 0.
   */
  function getFullPositions($valor, $len)
  {
    $totalLen = (int) $len;
    $lenValor = (int) strlen($valor);
    $lopValor = $totalLen - $lenValor;
    $ceroString = '';
    for ($i = 1; $i <= $lopValor; $i++) {
      $ceroString = '0' . $ceroString;
    }
    $retorno = (string)$ceroString . $valor;

    return (string) $retorno;
  }

  function getTenMore($valor)
  {
    $valorArray = str_split($valor);
    $ultimoValor = (int) end($valorArray);

    if ($ultimoValor >= 1) {
      $valorDecenaSuperior = ($valor + 10) - $ultimoValor;
      $retorno = $valorDecenaSuperior;
    } else {
      $retorno = $valor;
    }

    return (int) $retorno;
  }

  /**
   * Return sub string sin etiquetas HTML y puntos suspensivos al final
   * @param $string String
   * @param $length Long we want the substring
   * @param $end Symbols to add at the end
   * @return String With ...
   */
  public function getSubString($string, $length = NULL, $end)
  {
    // If not specified the default length is 50
    $length = $length == NULL ? 50 : $length;
    // First we remove the html tags and then we cut the string
    $stringDisplay = substr(strip_tags($string), 0, $length);
    // If the text is greater than the length, an ellipsis is added
    if (strlen(strip_tags($string)) > $length) {
      $stringDisplay .= $end;
    }

    return $stringDisplay;
  }

  public function getSubStringFull($string, $length = NULL, $end)
  {
    $length = $length == NULL ? 50 : $length;
    $stringDisplay = substr($string, 0, $length);
    if (strlen($string) > $length) {
      $stringDisplay .= $end;
    }

    return $stringDisplay;
  }

  public function getMonth($number)
  {
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $number = intval($number) - 1;
    $retorno = $meses[$number];
    return $retorno;
  }

  public function getHour($hour)
  {
    $hour = explode(':', $hour);
    $new_hour = $hour[0] . ':' . $hour[1] . 'hs.';
    return $new_hour;
  }

  public function cortarFrase($frase, $cantPalabras)
  {
    $frase = strip_tags($frase);
    $frase2 = explode(' ', $frase);
    if (count($frase2) > $cantPalabras) {
      $tmp = '';
      for ($j = 0; $j < $cantPalabras; ++$j) {
        $tmp .= $frase2[$j] . ' ';
      }
      $tmp .= ' ...';
    } else {
      $tmp = $frase;
    }
    return $tmp;
  }

  /**
   * escapeString public function
   * @uses $variable, String
   * @return String
   * Note: Funcion que limpia los Strings.
   */
  public function escapeString($chain)
  {
    if (get_magic_quotes_gpc() != 0) {
      $chain = stripslashes($chain);
    }
    $connex = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_NAME, CONFIG_DB_PORT) or trigger_error($connex->error($connex), E_USER_ERROR);
    $retorno = $connex->real_escape_string($chain);
    $connex->close();
    return $retorno;
  }

  /**
   * fullUpper public function
   * @uses $string, String
   * @return String
   * Note: Funcion para pasar cadena a mayúsculas.
   */
  public function fullUpper($string)
  {
    return strtr(strtoupper($string), array(
      "à" => "À",
      "è" => "È",
      "ì" => "Ì",
      "ò" => "Ò",
      "ù" => "Ù",
      "á" => "Á",
      "é" => "É",
      "í" => "Í",
      "ó" => "Ó",
      "ú" => "Ú",
      "â" => "Â",
      "ê" => "Ê",
      "î" => "Î",
      "ô" => "Ô",
      "û" => "Û",
      "ç" => "Ç",
    ));
  }

  /**
   * getFormatFecha function
   * @uses $fecha, String
   * Note: Retorna una fecha con el mes en String (ingresa 2014-01-25 retorna 25 Enero 2014)
   */
  public function getFormatFecha($fecha)
  {
    $arrayfecha = explode('-', $fecha);
    $fechaint = mktime(0, 0, 0, $arrayfecha[1], $arrayfecha[2], $arrayfecha[0]);
    $fechaconformato = date('d/m/Y', $fechaint);

    $lista_dias = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
    $lista_mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $fecha = $fechaconformato;
    $fecha_cachos = explode("/", $fecha);

    $dia = $fecha_cachos[0];
    $mes = $fecha_cachos[1];
    $year = $fecha_cachos[2];
    $dia = $lista_dias[$dia - 1];

    $retorno = $dia . " " . $mes . " " . $year;
    return $retorno;
  }

  public function getFormatDate($fecha, $separator_in, $separator_off)
  {
    if (!empty($fecha)) {
      $fecha_array = explode(' ', $fecha);
      $arrayfecha = explode($separator_in, $fecha_array[0]);
      $fechaint = mktime(0, 0, 0, $arrayfecha[1], $arrayfecha[2], $arrayfecha[0]);
      $fechaconformato = date('d/m/Y', $fechaint);

      $lista_dias = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
      $lista_mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

      $fecha = $fechaconformato;
      $fecha_cachos = explode("/", $fecha);

      $dia = $fecha_cachos[0];
      $mes = $fecha_cachos[1];
      $year = $fecha_cachos[2];
      $dia = $lista_dias[$dia - 1];

      $retorno = $dia . $separator_off . $mes . $separator_off . $year;
      return $retorno;
    } else {
      return $fecha;
    }
  }

  public function getFormatDateInsert($date, $separator_in, $separator_off)
  {
    if (!empty($date)) {
      $date = str_replace(' ', '', $date);
      $date_array = explode($separator_in, $date);
      if (!empty($date_array[0]) && !empty($date_array[1]) && !empty($date_array[2])) {
        return $date_array[2] . $separator_off . $date_array[1] . $separator_off . $date_array[0];
      } else {
        return $date;
      }
    } else {
      return $date;
    }
  }

  public function getCheckDate($date, $separator, $first_year = false)
  {
    if (!empty($date)) {
      $pdacurrendate = explode($separator, str_replace(' ', '', $date));
      if ($first_year) {
        if (checkdate($pdacurrendate[1], $pdacurrendate[2], $pdacurrendate[0])) {
          return true;
        } else {
          return false;
        }
      } else {
        if (checkdate($pdacurrendate[1], $pdacurrendate[0], $pdacurrendate[2])) {
          return true;
        } else {
          return false;
        }
      }
    } else {
      return false;
    }
  }

  /**
   * format_price function
   * @uses $price, Number
   * Note: Retorna una fecha con el mes en String (ingresa 2014-01_25 retorna 25 Enero 2014)
   */
  public function format_price($price)
  {
    $price_array = explode('.', $price);
    $price_lenght = strlen($price_array[0]);

    if ($price_lenght == 3) {
      $retorno = $price_array[0] . ',' . $price_array[1];
    } else {
      $cinetos = substr($price_array[0], -3);
      $para_miles = explode($cinetos . '.' . $price_array[1], $price);
      $miles = $para_miles[0];
      $retorno = $miles . '.' . $cinetos . ',' . $price_array[1];
    }

    return $retorno;
  }

  public function getYear($fecha)
  {
    $arrayfecha = explode('-', $fecha);
    $retorno = $arrayfecha[0];
    return $retorno;
  }

  public function getStringOffArrayByIndice($matriz, $ordinal, $valor, $ordinal_return)
  {
    $leng_matriz = count($matriz) - 1;
    for ($i = 0; $i <= $leng_matriz; $i++) {
      if ($matriz[$i][$ordinal] == $valor) {
        return $matriz[$i][$ordinal_return];
      }
    }
  }

  public function getStringOffObjectByIndice($matriz, $ordinal, $valor, $ordinal_return)
  {
    $leng_matriz = count($matriz) - 1;
    for ($i = 0; $i <= $leng_matriz; $i++) {
      if ($matriz[$i]->$ordinal == $valor) {
        return $matriz[$i]->$ordinal_return;
      }
    }
  }

  public function getArrayOnArrayByIndice($matriz, $ordinal, $valor)
  {
    foreach ($matriz as $mat) {
      if ($mat[$ordinal] == $valor) {
        return $mat;
      }
    }
  }

  public function getArraysOnArrayByIndice($matriz, $ordinal, $valor)
  {
    $returned = array();
    foreach ($matriz as $mat) {
      if ($mat[$ordinal] == $valor) {
        array_push($returned, $mat);
      }
    }
    return $returned;
  }

  public function getArraySectionByNameLang($matriz, $valor, $lang, $strip = false)
  {
    $returned = array();
    foreach ($matriz as $section) {
      if (!empty($section['id_setting_country_language']) && $section['id_setting_country_language'] == $lang && !empty($section['name']) &&  $section['name'] == $valor) {
        $returned = $section;
      }
    }
    return $returned;
  }

  public function in_array_r($needle, $haystack, $strict = false)
  {
    foreach ($haystack as $item) {
      if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
        return true;
      }
    }
    return false;
  }

  public function getStringOffArrayByNameLang($matriz, $valor, $lang, $strip = false)
  {
    $leng_matriz = count($matriz) - 1;
    $returned = '';
    for ($i = 0; $i <= $leng_matriz; $i++) {
      if ($matriz[$i]['name'] == $valor && $matriz[$i]['id_setting_country_language'] == $lang) {
        $returned = $matriz[$i]['copy'];
        $returned = str_replace("[[[CONFIG_HOST_NAME_FRONTEND]]]", CONFIG_HOST_NAME_FRONTEND, $returned);
        $returned = str_replace("[[[CONFIG_NAME_SITE]]]", CONFIG_NAME_SITE, $returned);
      }
    }
    if ($strip !== false) {
      $returned = trim(strip_tags($returned));
      $returned = str_replace("[[[CONFIG_HOST_NAME_FRONTEND]]]", CONFIG_HOST_NAME_FRONTEND, $returned);
      $returned = str_replace("[[[CONFIG_NAME_SITE]]]", CONFIG_NAME_SITE, $returned);
    }
    return $returned;
  }

  public function getStringOffArrayByNameLangElse($matriz, $valor, $lang, $strip = false, $tag = '')
  {
    $leng_matriz = count($matriz) - 1;
    $returned = '';
    for ($i = 0; $i <= $leng_matriz; $i++) {
      if ($matriz[$i]['name'] == $valor && $matriz[$i]['id_setting_country_language'] == $lang) {
        $returned = $matriz[$i]['copy'];
      }
    }
    if ($strip !== false) {
      if (!empty($tag)) {
        $returned = strip_tags($returned, $tag);
      } else {
        $returned = strip_tags($returned);
      }
    }
    return $returned;
  }

  public function getStringOffArrayByName($matriz, $valor, $strip = false)
  {
    $returned = '';
    foreach ($matriz as $mat) {
      if ($mat['name'] == $valor) {
        if ($strip !== false) {
          $returned = strip_tags($mat['copy']);
        } else {
          $returned = $mat['copy'];
        }
        return $returned;
      }
    }
  }

  public function clean_string($chain)
  {
    $chain = trim($chain);
    $chain = strip_tags($chain);
    return $chain;
  }

  public function enviaEmail($email_from, $email_from_name, $email_to, $email_to_name, $email_subjet, $email_contenido)
  {
    if (isset($email_to_name) && isset($email_to)) {
      $headers = "X-Sender: " . $email_to_name . " <" . $email_to . ">\r\n";
      $headers .= "X-Mailer: PHP\r\n";
      $headers .= "X-Priority: 1\r\n";
      $headers .= "Return-Path: <" . $email_from . ">\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "X-MSMail-Priority: High\r\n";
      $headers .= "From: " . $email_from_name . " <" . $email_from . ">\r\n";
      $headers .= "Reply-To: " . $email_to_name . " <" . $email_to . ">\r\n";
      $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";

      @ini_set("sendmail_from", $email_from);

      return mail($email_to, $email_subjet, $email_contenido, $headers);
    }
  }

  function enviaEmailSmtp($email = '', $nombre = '', $body = '', $subject = '')
  {
    require_once(dirname(__FILE__) . '/../mails/class.phpmailer.php');
    require_once(dirname(__FILE__) . '/../mails/class.smtp.php');

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = SMTP_AUTHENTICATION;
    $mail->SMTPDebug = 0;
    if (!empty(SMTP_SECURE)) {
      $mail->SMTPSecure = SMTP_SECURE;
    }
    //$mail->SMTPKeepAlive = true;
    $mail->Host = SMTP_SERVER;
    $mail->Port = SMTP_PORT;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SetFrom(FROM_EMAIL, FROM_NAME);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $subject;
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->MsgHTML($body);
    $mail->AddAddress($email, $nombre);
    //$mail->AddBCC("");

    if (!$mail->Send()) {
      $return = "El email NO fue enviado.<br>Email Error: " . $mail->ErrorInfo;
    } else {
      $return = 1;
    }
    $mail = null;

    return $return;
  }

  /**
   * getCustomUrl
   * @uses $friendly, string
   * @uses $slug_parent, string
   * @uses $slug, string
   * @uses $canonical, string
   * @uses $anchor, string
   * Note: Construye y retorna URL
   */
  public function getCustomUrl($friendly, $slug_parent, $slug, $canonical, $anchor, $section = '')
  {
    $retorno = $slug_parent . '-' . $slug . '-' . $canonical . '-' . $anchor;

    if ($friendly == true) {
      if (!empty($slug_parent) && !empty($slug) && empty($anchor)) { // YES: parent_slug - slug | NO: anchor
        $retorno = CONFIG_HOST_NAME_FRONTEND . $slug_parent . '/' . $slug . '/';
      } elseif (empty($slug_parent) && !empty($slug) && !empty($anchor)) { // YES: slug - anchor | NO: parent_slug
        $retorno = CONFIG_HOST_NAME_FRONTEND . $slug . '/' . $anchor;
      } elseif (empty($slug_parent) && !empty($slug) && empty($anchor)) { // YES: slug | NO: parent_slug - anchor
        $retorno = CONFIG_HOST_NAME_FRONTEND . $slug . '/';
      } elseif (empty($slug_parent) && empty($slug) && !empty($anchor)) { // YES: anchor | NO: parent_slug - slug
        if (!empty($section) && $section == 'index') {
          $retorno = $anchor;
        } else {
          $retorno = CONFIG_HOST_NAME_FRONTEND . $anchor;
        }
      } else { // YES: | NO: parent_slug - slug - anchor
        $retorno = CONFIG_HOST_NAME_FRONTEND;
      }
    } else if ($friendly == false) {
      if (!empty($canonical) && !empty($anchor)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $canonical . '/' . $anchor;
      } elseif (!empty($canonical) && empty($anchor)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $canonical;
      } elseif (empty($canonical) && empty($anchor)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND;
      }
    }
    return (string) $retorno;
  }

  public function getCustomUrls($path, $slug, $slug_parent, $url_canonical)
  {
    $retorno = '';

    if (CONFIG_URL_FRIENDLY == true) {
      if (!empty($path) && !empty($slug) && !empty($slug_parent)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $path . '/' . $slug . '/' . $slug_parent . '/';
      } elseif (!empty($path) && !empty($slug)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $path . '/' . $slug . '/';
      } elseif (empty($path) && !empty($slug)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $slug . '/';
      }
    } else {
      $retorno = CONFIG_HOST_NAME_FRONTEND . $url_canonical;
    }
    return (string) $retorno;
  }

  public function getUrlFriendly($slug, $id, $url)
  {
    $retorno = '';

    if (CONFIG_URL_FRIENDLY == true) {
      if (!empty($slug) && !empty($id)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $slug . '/' . $id . '/';
      } elseif (!empty($slug)) {
        $retorno = CONFIG_HOST_NAME_FRONTEND . $slug . '/';
      }
    } else {
      $retorno = CONFIG_HOST_NAME_FRONTEND . $url;
    }
    return (string) $retorno;
  }

  public function getSegmentOffArrayByIndice($matriz, $ordinal, $valor)
  {
    $leng_matriz = count($matriz) - 1;
    for ($i = 0; $i <= $leng_matriz; $i++) {
      if ($matriz[$i][$ordinal] == $valor) {
        return $matriz[$i];
      }
    }
  }

  public function strireplace($chain, $replace = '')
  {
    $buscar = array(chr(13) . chr(10), "\r\n", "\n", "\r");
    $reemplazar = array($replace, $replace, $replace, $replace);
    $chain = str_ireplace($buscar, $reemplazar, $chain);
    return $chain;
  }

  public function full_str_replace($chain)
  {
    $chain = trim($chain);
    $chain = strip_tags($chain);
    $buscar = array(chr(13) . chr(10), "\r\n", "\n", "\r");
    $reemplazar = array('', '', '', '');
    $chain = str_ireplace($buscar, $reemplazar, $chain);
    return $chain;
  }

  # SLUG
  public function noDiacritics($string)
  {
    $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $cyrylicTo = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia');
    $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
    $to = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");

    $from = array_merge($from, $cyrylicFrom);
    $to = array_merge($to, $cyrylicTo);

    $newstring = str_replace($from, $to, $string);

    return $newstring;
  }

  public function makeSlugs($string, $maxlen = 0)
  {
    $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
    $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
    $consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $string);
    $consultaBusqueda = strtolower($consultaBusqueda);
    $consultaBusqueda = str_replace(' ', '-', $consultaBusqueda);
    $newStringTab = array();
    $string = strtolower($this->noDiacritics($string));
    $stringTab = str_split($string);
    $numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "-");

    foreach ($stringTab as $letter) {
      if (in_array($letter, range("a", "z")) || in_array($letter, $numbers)) {
        $newStringTab[] = $letter;
      } elseif ($letter == " ") {
        $newStringTab[] = "-";
      }
    }

    if (count($newStringTab)) {
      $newString = implode($newStringTab);

      if ($maxlen > 0) {
        $newString = substr($newString, 0, $maxlen);
      }

      $newString = $this->removeDuplicates('--', '-', $newString);
    } else {
      $newString = '';
    }

    return $newString;
  }

  public function checkSlug($slug)
  {
    $patron = "/^[a-zA-Z0-9]+[a-zA-Z0-9_-]*$/";
    if (preg_match($patron, $slug)) {
      return true;
    } else {
      return false;
    }
  }

  public function removeDuplicates($sSearch, $sReplace, $sSubject)
  {
    $i = 0;
    do {
      $sSubject = str_replace($sSearch, $sReplace, $sSubject);
      $pos = strpos($sSubject, $sSearch);

      $i++;
      if ($i > 100) {
        die('removeDuplicates() loop error');
      }
    } while ($pos !== false);

    return $sSubject;
  }

  public function date_decode($str_server_datetime, $str_user_timezone, $str_user_dateformat)
  {
    // create date object
    try {
      $date = new DateTime($str_server_datetime);
    } catch (Exception $e) {
      trigger_error('date_decode: Invalid datetime: ' . $e->getMessage(), E_USER_ERROR);
    }

    // convert to user timezone
    $userTimeZone = new DateTimeZone($str_user_timezone);
    $date->setTimeZone($userTimeZone);

    // convert to user dateformat
    $str_user_datetime = $date->format($str_user_dateformat);

    return $str_user_datetime;
  }

  public function magnificPpoUp($campo, $type, $path)
  {
    if ($type == 'image') {
      $html_return = "
        $(document).ready(function() {
          $('." . $campo . "').magnificPopup({
            items: {src: '" . $path . "'},
            type: 'image'
          });
        });
      ";
    } else {
      $html_return = "
        $(document).ready(function() {
          $('." . $campo . "').magnificPopup({
            items: {src: '" . $path . "'},
            type: 'iframe'
          });
        });
      ";
    }
    return $html_return;
  }

  public function getDataByApi($controller, $scryptInCrypter, $webservices, $curl)
  {
    $parameters = array(
      'controller' => $controller,
      'action' => 'give',
      'query' => $scryptInCrypter,
      'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
      'personal_key' => base64_encode('I3dnZ8lIEsCXr0jYfAmv')
    );

    $curl->setUrl($webservices);
    $curl->setParams($parameters);
    $curl->setMethod('GET');
    $response = $curl->getRequest();

    if (!empty($response)) {
      $return_decode = json_decode($response, true);
      if (is_array($return_decode) && $return_decode['error'] == false) {
        return $return_decode;
      } else {
        return 'error script';
      }
    } else {
      return 'error api';
    }
  }

  /*
  * this function removes a directory and its contents.
  * use with careful, no undo!
  */
  public function rmdir_recursive($dir)
  {
    $files = scandir($dir);
    array_shift($files);    // remove '.' from array
    array_shift($files);    // remove '..' from array

    foreach ($files as $file) {
      $file = $dir . '/' . $file;
      if (is_dir($file)) {
        $this->rmdir_recursive($file);
        rmdir($file);
      } else {
        unlink($file);
      }
    }
    rmdir($dir);
  }

  public function encodeLatin1($txt)
  {
    $encoding = mb_detect_encoding($txt, "ASCII,UTF-8,ISO-8859-1");
    if ($encoding == "UTF-8") {
      $txt = utf8_decode($txt);
    }
    return $txt;
  }

  public function encodeUtf8($txt)
  {
    $encoding = mb_detect_encoding($txt, "ASCII,UTF-8,ISO-8859-1");
    if ($encoding == "ISO-8859-1") {
      $txt = utf8_encode($txt);
    }
    return $txt;
  }

  public function encoding($txt)
  {
    $encoding = mb_detect_encoding($txt, "ASCII,UTF-8,ISO-8859-1");
    if ($encoding == "ISO-8859-1") {
      $txt = utf8_encode($txt);
    } elseif ($encoding == "UTF-8") {
      $txt = utf8_decode($txt);
    } elseif ($encoding == "ASCII") {
      $txt = $txt;
    }
    return $txt;
  }

  function normalizeCain($rb)
  {
    $rb = str_replace("Ã¡", "á", $rb);
    $rb = str_replace("Ã©", "é", $rb);
    $rb = str_replace("Â®", "®", $rb);
    $rb = str_replace("Ã­", "í", $rb);
    $rb = str_replace("ï¿½", "í", $rb);
    $rb = str_replace("Ã³", "ó", $rb);
    $rb = str_replace("Ãº", "ú", $rb);
    $rb = str_replace("n~", "ñ;", $rb);
    $rb = str_replace("Âº", "&ordm;", $rb);
    $rb = str_replace("Âª", "&ordf;", $rb);
    $rb = str_replace("ÃƒÂ¡", "á", $rb);
    $rb = str_replace("Ã±", "ñ", $rb);
    $rb = str_replace("Ã‘", "Ñ", $rb);
    $rb = str_replace("ÃƒÂ±", "ñ", $rb);
    $rb = str_replace("n~", "ñ", $rb);
    $rb = str_replace("Ãš", "Ú", $rb);
    return $rb;
  }

  function getHoursSegmentByFraction($fraction, $init, $end)
  {
    $hour = 60;
    $day = 24 * 60;
    $fraction = $fraction; // 45;
    $segment = $day / $fraction;
    $init = $init * 60;
    $end = $end * 60;
    $_segment_array = array();
    $seconds = ':00';

    for ($i = 0; $i < $segment; $i++) {
      $minuts = $fraction * $i;
      if ($minuts >= $init && $minuts <= $end) {
        $_hour = intval($minuts / $hour);
        $_minuts = $minuts - ($_hour * $hour);
        $_minuts = $_minuts == 0 ? '00' : $_minuts;
        $_segment_array[] = $_hour . ':' . $_minuts . $seconds;
        // echo 'HOUR:' . $_hour . ' - RESTO:' . $_minuts;
      }
    }
    return $_segment_array;
  }

  public function formatEmail($email)
  {
    if (!empty($email)) {
      $email_array = explode('@', $email);
      return $email_array[0] . '<br>@' . $email_array[1];
    } else {
      return '';
    }
  }

  public function getAgeByBirthDate($fecha_nacimiento)
  {
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
  }

  public function getDaysByRange($init, $end, $format = 'string')
  {
    // echo $init.'|'.$end.'|'.$format;
    if (!empty($init) && !empty($end) && !empty($format)) {
      $days_array = array();
      $days_array_count = 1;
      $days_compare = $init;

      $days_string = $init;
      $days_array[] = $init;

      while (strtotime($end) >= strtotime($init)) {
        if (strtotime($end) != strtotime($days_compare)) {
          $days_compare = date("Y-m-d", strtotime($days_compare . " + 1 day"));
          $days_string = $days_string . ',' . $days_compare;
          $days_array[] = $days_compare;
          $days_array_count = $days_array_count + 1;
        } else {
          break;
        }
      }

      $returned = array(
        'total' => $days_array_count,
        'data' => $format == 'array' ? $days_array : $days_string
      );

      return $returned;
    }
  }
  function hex2rgba($color)
  {
    $default = '0,0,0';

    //Return default if no color provided
    if (empty($color)) {
      return $default;
    }

    //Sanitize $color if "#" is provided 
    if ($color[0] == '#') {
      $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
      $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
      $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
      return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);
    $output = implode(",", $rgb);

    //Return rgb(a) color string
    return $output;
  }
}
