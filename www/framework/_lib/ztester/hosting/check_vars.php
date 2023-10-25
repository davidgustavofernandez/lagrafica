<?php
# la mayor�a de las funciones de configuraci�n ac� especificadas pueden ser tratadas desde un archivo .htaccess
##################################################################################################################################################################
# Es recomendable definir siempre la zona Horaria si se trabaja con las funciones time(), date(), strtotime() asi no hay incongruencias al aplicarlo en un servidor que tiene una hora diferente por defecto.
date_default_timezone_set("America/Argentina/Buenos_Aires");
########################################################################################################################################################
# Generalmente en los SERVIDORES profesionales no contaran con estas funcionalidades ya que las deshabilitan por seguridad.
# ini_set() si esta habilitado nos permitir� modificar los valores de las variables del servidor en el momento de ejecuci�n.
# listado ejemplos t�picos.
echo '---------------------------------------------------------------------------------------<br>';
echo 'Estado de variables por defecto de servidor:<br>';
echo '---------------------------------------------------------------------------------------<br>';
echo 'post_max_size = ' . ini_get('post_max_size') . '<br/>';
echo 'upload_max_filesize = ' . ini_get('upload_max_filesize') . '<br/>';
echo 'max_execution_time = ' . ini_get('max_execution_time') . '<br/>';
echo 'max_input_time = ' . ini_get('max_input_time') . '<br/>';

echo 'error_repoting = ' . ini_get('error_repoting') . '<br/>';
echo 'display_errors = ' . ini_get('display_errors') . '<br/>';
echo 'display_startup_errors = ' . ini_get('display_startup_errors') . '<br/>';

echo 'log_errors = ' . ini_get('log_errors') . '<br/>';
echo 'error_log = ' . ini_get('error_log') . '<br/>';
echo 'log_errors_max_len = ' . ini_get('log_errors_max_len') . '<br/>';
echo 'ignore_repeated_errors = ' . ini_get('ignore_repeated_errors') . '<br/>';
echo 'track_errors = ' . ini_get('track_errors') . '<br/>';

echo 'memory_limit = ' . ini_get('memory_limit') . '<br/>';
########################################################################################################################################################
#trato de modificar las variables con INI_SET()
########################################################################################################################################################
ini_set("post_max_size","90M");													// Define el peso que ser� admitido por POST.
ini_set("upload_max_filesize","90M");												// Define el peso que ser� admitido para los uploads.
ini_set("max_execution_time",60*10);												// Tiempo m�ximo de ejecuci�n de un script.
ini_set("max_input_time","600");													// Tirmpo maximo en imputs.
ini_set("memory_limit","100M");														// Define el espacio disponible de memoria en el server.
ini_set("error_repoting", E_ALL);													// E_ALL muestra todos los errores
#-#ini_set("error_repoting", E_ALL ^ E_NOTICE);										// E_ALL muestra todos los errores ^ E_NOTICE menos las noticias (opcional)
ini_set("display_errors", 1); 														// en 0 no muestra los errores
ini_set("display_startup_errors", 1); 												// en 0 no muestra los errores al iniciar PHP
ini_set("log_errors", 1); 															// en 0 desactiva el archivo de reporte de errores
ini_set("error_log", "\\errores\\errores.txt");										// path al archivo donde guardara los errores // respetar las \\ (barras invertidas)
ini_set("log_errors_max_len", 0); 													// en 0 no tiene m�ximo el peso del archivo errores.txt
ini_set("ignore_repeated_errors", 0); 												// en 1 no mostrara errores repetidos solo uno 
ini_set("track_errors", 1); 														// en 1 activo track de errores

# ejemplo para saber o poder recuperar el valor de una variable antes mencionadas.
#-#echo 'upload_max_filesize = ' . ini_get('upload_max_filesize'); // Mostrara el valor actual de esa variable.
########################################################################################################################################################
# Si los datos son exactamente que los anteriores NO se pudo modificar. 
# En caso de que no se disponga de ini_set() usar:
# .htaccess (si PHP corre como mod_php) 
# o php.ini (si PHP corre como SGI) 
# siempre y cuando el server permita modificar as variables con alguna de estad dos alternativas.
## Si necesitamos crear un archivo .htaccess (PHP como mod_php) ejecutar el siguiente script:
#---------------------------------------
#|<?php
#|touch(".htaccess");
#|? >
#-#--------------------------------------
# esto creara un archivo .htaccess en blanco luego agregar las directiva de la siguiente manera:
#---------------------------------------
#|php_value post_max_size 100M
#|php_value upload_max_filesize 100M
#|php_value max_execution_time 600
#|php_value max_input_time 600
#|php_value memory_limit 100M
#--------------------------------------
## Si necesitamos crear un archivo php.ini (PHP como CGI) ejecutar el siguiente script:
#---------------------------------------
#|<?php
#|touch("php.ini");
#|? >
#-#--------------------------------------
# esto creara un archivo php.ini en blanco luego agregar las directiva de la siguiente manera:
#---------------------------------------
#|post_max_size = 100M
#|upload_max_filesize = 100M
#|max_execution_time = 600
#|max_input_time = 600
#|memory_limit = 100M
#--------------------------------------
########################################################################################################################################################
echo '---------------------------------------------------------------------------------------<br>';
echo 'Estado actual de variables de servidor:<br>';
echo '---------------------------------------------------------------------------------------<br>';
echo 'post_max_size = ' . ini_get('post_max_size') . '<br/>';
echo 'upload_max_filesize = ' . ini_get('upload_max_filesize') . '<br/>';
echo 'max_execution_time = ' . ini_get('max_execution_time') . '<br/>';
echo 'max_input_time = ' . ini_get('max_input_time') . '<br/>';

echo 'error_repoting = ' . ini_get('error_repoting') . '<br/>';
echo 'display_errors = ' . ini_get('display_errors') . '<br/>';
echo 'display_startup_errors = ' . ini_get('display_startup_errors') . '<br/>';

echo 'log_errors = ' . ini_get('log_errors') . '<br/>';
echo 'error_log = ' . ini_get('error_log') . '<br/>';
echo 'log_errors_max_len = ' . ini_get('log_errors_max_len') . '<br/>';
echo 'ignore_repeated_errors = ' . ini_get('ignore_repeated_errors') . '<br/>';
echo 'track_errors = ' . ini_get('track_errors') . '<br/>';

echo 'memory_limit = ' . ini_get('memory_limit') . '<br/>';
# para recuperar todas la variables del servidor crear un nuevo archivo con estas lineas y explorarlo.
#---------------------------------------
#|<?php
#|phpinfo();
#|? >
# luego comprobar SIEMPRE el estado de la directiva register_globals mas aun si es una vercion inferior a PHP5
##################################################################################################################################################################
##################################################################################################################################################################

define('CONFIG_DB_PREFIX', '');
define('CONFIG_DB_HOST', 'localhost');
define('CONFIG_DB_NAME', '');
define('CONFIG_DB_USER', 'root');
define('CONFIG_DB_PASS', '');
define('CONFIG_DB_PORT', '3306');
define('EN_DESARROLLO', true); // Si esta constante esta en true se imprimir� el error en pantalla de lo contrario se enviara un email.
# Si trabajan en un entorno propio de desarrollo lo mas seguro dispongan de un server o URL que no es la final en esa situaci�n pueden configurar la constante de esta manera
#-#define('EN_DESARROLLO', ( $_SERVER['HTTP_HOST'] == 'reemplaza_por_tu_dominio_de_producion'? true : false ) );
# Ejemplo b�sico de traqueo de errores en tiempo real
# Si el escript que se esta ejecutando es correcto no recibiremos ning�n email 
# ERROR HANDLING
function error_handler($errno, $errstr, $errfile, $errline, $errctx) {
	//if($errno & E_NOTICE) return; // Esta line escapa los mensajes que son noticias (opcional)
	$host = $_SERVER['HTTP_HOST'];
	$mail_subject = 'Error en '.$_SERVER['HTTP_HOST'];
	$mail_from = 'error@'.str_replace('www.','',$_SERVER['HTTP_HOST']);

	$mail_to = array('fernandezdg@gmail.com'); // array de emails a los que le llegaran los mensajes de error

	$errortype = array(1=>"Error", 2=>"Warning", 4=>"Parsing Error", 8=>"Notice", 16=>"Core Error", 32=>"Core Warning", 64=>"Compile Error", 128=>"Compile Warning", 256=>"User Error", 512=>"User Warning", 1024=>"User Notice", 2048=>"PHP5 Strict Notice"); 
	$error_handler_string =  "<font size=2 face=Arial><h3>Error en ".$host."<br></h3><b>Date: </b>".date('F j, Y, H:i:s a')."<br><b>Error Type: </b>". $errortype[$errno]." (".$errno.")<br><b>Description: <font color=ff0000>".$errstr."</font></b><br><b>Error File: </b>".$errfile."<br><b>Error Line: </b>".$errline."<br><br>";

	if(isset($_SESSION)){
		foreach($_SESSION as $var=>$val)
		{
			$error_handler_string .= "_SESSION[".$var."] = ".$val."<BR>";
		}
	}
	if(isset($_GET)){
		foreach($_GET as $var=>$val)
		{
			$error_handler_string .= "_GET[".$var."] = ".$val."<BR>";
		}
	}
	if(isset($_POST)){
		foreach($_POST as $var=>$val)
		{
			$error_handler_string .= "_POST[".$var."] = ".$val."<BR>";
		}
	}
	if(isset($_COOKIE)){
		foreach($_COOKIE as $var=>$val)
		{
			$error_handler_string .= "_COOKIE[".$var."] = ".$val."<BR>";
		}
	}
	
	# Cada vez que se detecte un error el ERROR HANDLING es invocado procesando la situaci�n.
	//if( EN_DESARROLLO ){ 
		die($error_handler_string);
	/*}else{
		@ini_set("sendmail_from",$mail_from);
		foreach( $mail_to as $mail_to_str ){
			mail($mail_to_str, $mail_subject, $error_handler_string, "From: ".$mail_from."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
		}
	
		if ($errno & (E_WARNING | E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR)){
			header("Location: http://".$host); 
			exit();
		}
	}*/

}
set_error_handler("error_handler");
error_reporting(E_ALL); // defino que muestre TODOS los mensajes
#-#error_reporting(E_ALL ^ E_NOTICE); // defino que muestre TODOS los mensajes menos los que sean noticias. (opcional)
##################################################################################################################################################################
##################################################################################################################################################################
# Ejemplo Basico nivel 0.5 de seguridad (SLS 0.5).
# INJECTION
/**
 * Configuration values
 * @access private
 * @var array
 */
//$_method_available = array('get','post','request');
function spread($method='post', $variable, $else='')
{
	$method_available = array('get','post','request');
	
	if(in_array($method,$method_available))
	{
		//global ${$variable};
		switch($method)
		{
			case 'get':
				if(is_numeric($else))
				{
					return isset($_GET[$variable])? intval($_GET[$variable]) : intval($else) ;
				}
				else
				{
					return isset($_GET[$variable])? injection($_GET[$variable],true) : $else ;
				}
			break;
			
			case 'post':
				if(is_numeric($else))
				{
					return isset($_POST[$variable])? intval($_POST[$variable]) : intval($else) ;
				}
				else
				{
					return isset($_POST[$variable])? injection($_POST[$variable],true) : $else ;
				}
			break;
			
			case 'request':
				if(is_numeric($else))
				{
					return isset($_REQUEST[$variable])? intval($_REQUEST[$variable]) : intval($else) ;
				}
				else
				{
					return isset($_REQUEST[$variable])? injection($_REQUEST[$variable],true) : $else ;
				}
			break;
			
			default:
				return '';
			break;
		}
	}
}

function injection($chain,$filter)
{
	if($filter === true)
	{
		$no_admite = array(
						   '"',
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
						   "*"
						   );
		
		foreach( $no_admite as $no_admite_str )
		{
			$chain = str_replace($no_admite_str,"", $chain);
			$chain = str_replace(strtoupper($no_admite_str),"", $chain);
		}
	}
	
	return (string) escapeString($chain);
}

function escapeString($chain)
{
	if(get_magic_quotes_gpc() != 0)
	{
		$chain = stripslashes($chain);
	}
	$connex = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_NAME, CONFIG_DB_PORT) or trigger_error($connex->error($connex),E_USER_ERROR);
	$retorno = $connex->real_escape_string($chain);
	$connex->close();
	return $retorno;
}

# Modo de uso
# SITUACION:
# Recibo y trato una variable que viene por GET
# http://www.elogia.net/index.php?codigo=555
# Recupero el valor de la variable numerica codigo que viene por GET
#-#cargar('g','codigo','0'); // Cero determina que tiene que ser tratada como variable numerica y si no tiene valor aplica 0.
# resultado: se genera dinamicamente la variable $codigo con su respectivo valor (555)

# recupero el valor (pepe) de la variable nombre que viene por POST
#-#cargar('p','nombre');
# resultado: se genera dinamicamente la variable $nombre con su respectivo valor (pepe)
$_metodo 	= 'request';
$dato 		= spread($_metodo,"dato",'');
echo '---------------------------------------------------------------------------------------<br>';
echo 'Variable por get:<br>';
echo '---------------------------------------------------------------------------------------<br>';
echo 'dato:'.$dato;
//echo $ara;

?>