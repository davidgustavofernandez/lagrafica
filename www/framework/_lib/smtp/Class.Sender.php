<?php
/**
 * Sender, Trata los encios de email
 * 
 * La Calsse Sender es la encargada de tratar el envio de email via SMTP o usando la funcion nativa mail() de PHP es la encargada de manipular todo lo relacionado a las Sessiones
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Sesion class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
//class Sender



require_once("includes/class.phpmailer.php");
#-----------------------------------------------------------------------
#VARIABLES generales SMTP
#-----------------------------------------------------------------------
define("PATH_MAIL_HTML"                 , 'dev.email/');
define("SMTP_SERVER"                    , '192.168.1.15' );
define("SMTP_AUTHENTICATION"            , false );
define("SMTP_PORT"                      , 25 );
define("SMTP_USER"                      , '' );
define("SMTP_PASS"                      , '' );
define("FROM_EMAIL"                     , 'support@developers-ba.com.ar' );
define("FROM_NAME"                      , 'Test' );
#-----------------------------------------------------------------------
$envio = send($rsUsuarios->email, $rsUsuarios->nombre, $rsUsuarios->apellido, $body, $newsTitulo, $adjuntoName, $adjuntoPath);
#-----------------------------------------------------------------------
#ENVIA EMAIL SMTP
#-----------------------------------------------------------------------
function send($email= '',$nombre='', $apellido='', $body='', $subject='', $adjuntoName='', $adjuntoPath='')
{ 
	$mail                = new PHPMailer();
	$mail->IsSMTP();                            // telling the class to use SMTP    
	$mail->SMTPAuth      = SMTP_AUTHENTICATION; // enable SMTP authentication
	//$mail->SMTPKeepAlive = true;                // SMTP connection will not close after each email sent
	$mail->Host          = SMTP_SERVER;         // sets the SMTP server
	$mail->Port          = SMTP_PORT;           // set the SMTP port for the GMAIL server
	$mail->Username      = SMTP_USER;           // SMTP account username
	$mail->Password      = SMTP_PASS;           // SMTP account password
	$mail->SetFrom(FROM_EMAIL, FROM_NAME);   
	$mail->CharSet 		 = 'UTF-8'; 			// set email Char Set // 
	$mail->Subject       = $subject;
	
	$mail->WordWrap = 50; 						// ancho del mensaje
	$mail->IsHTML(true);  						// set email format to HTML //
	$mail->MsgHTML($body);
	$mail->AddAddress($email, $nombre ." ". $apellido);
	
	if($adjuntoPath!='' && $adjuntoName!='' && file_exists($adjuntoPath.$adjuntoName))
	{
		$mail->AddAttachment($adjuntoPath.$adjuntoName, $adjuntoName);
	}
	
	$return = '';
	
	if(!$mail->Send())
	{
	   $return = "El email NO fue enviado.<br>Email Error: " . $mail->ErrorInfo;
	}
	else
	{
		$return = "El fue enviado.";
	}
	$mail = null;
	
	return $return;
	  
}



?>