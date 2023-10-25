<?php 
#-----------------------------------------------------------------------
#VARIABLES generales
#-----------------------------------------------------------------------
date_default_timezone_set("America/Argentina/Buenos_Aires");

define("THE_HORA", date("H:i:s"));
define("THE_FECHA", date("Y-m-d"));
define("MAIL_SISTEMA_NAME", "Formulario de Contacto");
define('MAIL_SISTEMA','no-reply@asmazero.com.ar');
#-----------------------------------------------------------------------
# ERROR HANDLING
#-----------------------------------------------------------------------
function error_handler($errno, $errstr, $errfile, $errline, $errctx) {
	if($errno & E_NOTICE) return;
	
	$host = $_SERVER['HTTP_HOST'];
	
	$mail_subject = 'Error en '.$_SERVER['HTTP_HOST'];
	$mail_from = 'error@'.str_replace('www.','',$_SERVER['HTTP_HOST']);
	
	$mail_to = array('fernandezdg@gmail.com');

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

	if( EN_DESARROLLO ){
		die($error_handler_string);
	}else{
		@ini_set("sendmail_from",$mail_from);
		foreach( $mail_to as $mail_to_str ){
			mail($mail_to_str, $mail_subject, $error_handler_string, "From: ".$mail_from."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
		}
	
		if ($errno & (E_WARNING | E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR)){
			header("Location: http://".$host); 
			exit();
		}
	}
}
set_error_handler("error_handler");
error_reporting(E_ALL ^ E_NOTICE);
#-----------------------------------------------------------------------
#ENVIA EMAIL
#-----------------------------------------------------------------------
function enviaEmail($email_from, $email_to, $email_to_name, $email_subjet, $email_contenido){

	if(isset($email_to_name) && isset($email_to)){

		$headers = "X-Sender: ".$email_to_name." <".$email_to.">\r\n";
		$headers .= "X-Mailer: PHP\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "Return-Path: <".$email_from.">\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "X-MSMail-Priority: High\r\n";
		$headers .= "From: ".MAIL_SISTEMA_NAME." <".MAIL_SISTEMA.">\r\n";
		$headers .= "Reply-To: ".$email_to_name." <".$email_to.">\r\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
		
		@ini_set("sendmail_from",$email_from);
		
		return mail($email_to, $email_subjet, $email_contenido,$headers);
	}

}
#-----------------------------------------------------------------------
#VARIABLES para el email
#-----------------------------------------------------------------------
$email_usuario = 'fernandezdg@gmail.com';
$email_nombre = 'David';
$email_fecha = THE_FECHA . ' | ' . THE_HORA;
$email_titulo = 'Email de muestra';
$email_detalle = 'Envio de muestra de email';
#-----------------------------------------------------------------------
#GENERO CONTENIDO DEL EMAIL
#-----------------------------------------------------------------------
$elbody = file_get_contents('email_test_plantilla.html');
$elbody = str_replace('[-titulo-]',$email_titulo,$elbody);
$elbody = str_replace('[-fecha-]',$email_fecha,$elbody);
$elbody = str_replace('[-detalle-]',$email_detalle,$elbody);
$elbody = str_replace('[-url-]',$_SERVER['HTTP_HOST'],$elbody);
#-----------------------------------------------------------------------
#ENVIO EL EMAIL
#-----------------------------------------------------------------------
$envio = enviaEmail(MAIL_SISTEMA, $email_usuario, $email_nombre, $email_titulo, $elbody);
#-----------------------------------------------------------------------

echo "<br>";
echo "Form Mail: " . MAIL_SISTEMA . "<br>";
echo "Estado del Envio : " . $envio . "<br>";
echo "Email destinatario : " . $email_usuario . "<br>";
echo "Nombre destinatario : " . $email_nombre . "<br>";
echo "Subject : " . $email_titulo . "<br>";
echo "El HTML : " . "<br>";
echo $elbody . "<br>";


?>