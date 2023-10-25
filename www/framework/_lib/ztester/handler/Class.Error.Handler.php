<?php
/**
 * ErrorHandler, Trata lo errores de PHP
 * 
 * ErrorHandler trata todos los errores que pueden aparecer mientras se ejecutan los Scripts de PHP.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * ErrorHandler class,
 * @subpackage database
 * @desc:
 * Esta classe, dependiendo del entorno envia un informe del error por email o lo muestra en panetalla 
 * 
 * @example:
 * $c = new ErrorHandler();
 * $c->setErrorHandler();
 * 
 */
class ErrorHandler
{	
	/**
	 * $_debug, determina si esta en modo de prueba
	 * @access private
	 * @var boolean
	 */
	private $_debug 		= true;
	
	/**
	 * setDebug function
	 * @param boolean $debug
	 * Note: indica si esta en modo de debug, si es true mostra los errores en pantalla sino enviara notificaciones por email
	 */
	public function setDebug($debug=true)
	{
		$this->_debug = $debug;
	}
	
	/**
     * getIp function
	 * @uses strcasecmp(), Function
	 * @uses $_SERVER, Function
	 * @uses isset(), Function
	 * Note: Retorna la IP del usuario
	 */
	private function getIp()
	{
		$_ip = '';
		
		if( isset($_SERVER['HTTP_CLIENT_IP']) && strcasecmp(isset($_SERVER['HTTP_CLIENT_IP']),"0.0.0.0") )
		{
		    $_ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp(isset($_SERVER['HTTP_X_FORWARDED_FOR']),"0.0.0.0"))
		{
		    $_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		elseif(isset($_SERVER['REMOTE_ADDR']) && strcasecmp(isset($_SERVER['REMOTE_ADDR']), "0.0.0.0"))
		{
		    $_ip = $_SERVER['REMOTE_ADDR'];
		}
		elseif(isset($_SERVER['REMOTE_ADDR']) && strcasecmp(isset($_SERVER['REMOTE_ADDR']),"0.0.0.0"))
		{
			$_ip = $_SERVER['REMOTE_ADDR'];
		}
		else
		{
			$_ip = '';
		}
				
		return $_ip;
	}
	/**
	 * Constructor sets up
	 * @see __construct()
	 */
	public function __construct()
	{
		/**
		 * @internal Envio al core de PHP my funcion para tratar los errores, e indico que tiene que tratar.
		 */
		set_error_handler(array(&$this, 'setErrorHandler'));
		error_reporting(E_ALL ^ E_NOTICE);
	}
	/**
	 * function ERROR HANDLING
	 * @global $_SERVER, $_SESSION, $_GET, $_POST, $_COOKIE
	 * @uses CONFIG_HOST, 		anotherconstant
	 * @uses CONFIG_DATE, 		anotherconstant
	 * @var 					string $mail_subject
	 * @var 					string $mail_from
	 * @var 					array $mail_to
	 * @var 					array $errortype
	 * @var 					string $error_handler_string
	 * @param 					string $errno
	 * @param 					string $errstr
	 * @param 					string $errfile
	 * @param 					string $errline
	 * @param 					string $errctx
	 * @return 					string|send  envia email si existe un error o si esta en desarrollo muestra en pantalla el error
	 */
	function setErrorHandler($errno, $errstr, $errfile, $errline, $errctx)
	{
		/**
		 * @internal No tiene en cuenta tipo E_NOTICE
		 */
		//if($errno & E_NOTICE) return;
		/**
		 * @internal Datos para enviar el email de reporte
		 */
		$errortype = array( 
							1=>"Error", 
							2=>"Warning", 
							4=>"Parsing Error", 
							8=>"Notice", 
							16=>"Core Error", 
							32=>"Core Warning", 
							64=>"Compile Error", 
							128=>"Compile Warning", 
							256=>"User Error", 
							512=>"User Warning", 
							1024=>"User Notice", 
							2048=>"PHP5 Strict Notice"
							); 
		/**
		 * @internal variables para el envio de los emails de aviso
		 */
		 $destinatarios = array(
								'USUARIOS'     => array(
														array(
																'TO_NOMBRE'     => 'David Gustavo',
																'TO_APELLIDO'   => 'Fernandez',
																'TO_EMAIL'		=> 'fernandezdg@gmail.com',
																'TO_SUBJECT'	=> 'Error en ' . $_SERVER['HTTP_HOST'],
																'FROM_EMAIL'	=> 'error@'.str_replace('www.','',$_SERVER['HTTP_HOST']),
																'FROM_NOMBRE'	=> 'Test'
															)
														)
								);
	
		/**
		 * @internal Html a parsear y enviar
		 */		
		if( $this->_debug )
		{
			$error_handler_string_html = '<table width="100%" height="100%" cellpadding="20"><tr><td bgcolor="#F3F3F3"><table width="640" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td width="40">&nbsp;</td><td width="560" height="15">&nbsp;</td><td width="40">&nbsp;</td></tr><tr><td height="46" bgcolor="#CC0000"></td><td bgcolor="#CC0000"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF" size="5"><strong>ERROR</strong></font></td><td bgcolor="#CC0000">&nbsp;</td></tr><tr><td height="30">&nbsp;</td><td></td><td></td></tr><tr><td valign="top">&nbsp;</td><td height="220" valign="top"><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="4"><strong>Error en: </strong></font><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="2" color="#CC0000"><strong>[-error_url-]</strong></font><br><br><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="2"><strong>Fecha: </strong>[-error_date-]</font><br><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="2"><strong>Tipo de Error: </strong>[-error_type-]</font><br><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="2"><strong>Descripci&oacute;n: </strong><font color="#CC0000"><strong>[-error_description-]</strong></font></font><br><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="2"><strong>Archivo del Error: </strong><a href="[-error_file-]" target="_blank"><font color="#CC0000">[-error_file-]</font></a></font><br><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif" size="2"><strong>Linea del error: </strong>[-error_line-]<br><strong>Ip Usuario: </strong>[-error_ip-]</font></font><br><br>[-error_session-][-error_get-][-error_post-][-error_cookie-]<br><br><a href="http://www.google.com.ar/search?hl=es&q=[-error_search-]&btnG=Buscar+con+Google&meta=&aq=f&oq=" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2" color="#CC0000">Este error en google</font></a><br><a href="[-error_url_path-]" target="_blank"><font face="Arial, Helvetica, sans-serif" size="2" color="#CC0000">Url al archivo</font></a><br><br><br></td><td valign="top">&nbsp;</td></tr><tr><td height="40"></td><td align="center" valign="middle"><font face="Arial, Helvetica, sans-serif" size="1" color="#555555">Send to: <a href="[-url-]" target="_blank"><font color="#CC0000">[-error_moderators-]</font></a></font></td><td></td></tr></table></td></tr></table>';
		}
		else
		{
			$pathTemplatesMailPhisical 	= dirname(__FILE__). '/mail.html';
			if( file_exists($pathTemplatesMailPhisical) )
			{
				$error_handler_string_html = file_get_contents($pathTemplatesMailPhisical);
			}
		}
		
		$error_in_session =  "";
		$error_in_get =  "";
		$error_in_post =  "";
		$error_in_cookie =  "";
		$error_moderators = "";
		/**
		 * @internal Interaciones que recojen la informacion de $_SESSION, $_GET, $_POST, $_COOKIE
		 */
		if(isset($_SESSION)){
			foreach($_SESSION as $var=> $val)
			{
				$error_in_session .= "_SESSION[".$var."] = ".$val."<BR>";
			}
		}
		if(isset($_GET)){
			foreach($_GET as $var=> $val)
			{
				$error_in_get .= "_GET[".$var."] = ".$val."<BR>";
			}
		}
		if(isset($_POST)){
			foreach($_POST as $var=> $val)
			{
				$error_in_post .= "_POST[".$var."] = ".$val."<BR>";
			}
		}
		if(isset($_COOKIE)){
			foreach($_COOKIE as $var=> $val)
			{
				$error_in_cookie .= "_COOKIE[".$var."] = ".$val."<BR>";
			}
		}
		/**
		 * @internal Indico en el email quienes reciben los mensajes
		 */
		foreach( $destinatarios['USUARIOS'] as $mail_to_str )
		{
			$error_moderators .= '<a href="mailto:' . $mail_to_str['TO_EMAIL'] . '" target="_blank"><font color="#CC0000">' . $mail_to_str['TO_EMAIL'] . '</font></a> ';
		}
		/**
		 * @internal Para ver el error en google
		 */
		$error_google = str_replace(" ","+" ,$errstr);
		/**
		 * @internal Compongo el email a enviar
		 */
		$error_handler_string_html = str_replace('[-error_url-]',"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_date-]',date('F j, Y, H:i:s a') ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_type-]', $errortype[$errno]." (".$errno.")" ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_description-]',$errstr ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_file-]',$errfile ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_line-]',$errline ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_ip-]',$this->getIp(),$error_handler_string_html);
		
		if($error_in_session)
		{
			$error_handler_string_html = str_replace('[-error_session-]','<font face="Verdana, Georgia, Times New Roman, Times, serif" size="1"><strong>SESSION:</strong></font><br><font face="Verdana, Georgia, Times New Roman, Times, serif" size="1">' . $error_in_session . '</font><br>' ,$error_handler_string_html);
		}
		else
		{
			$error_handler_string_html = str_replace('[-error_session-]','' ,$error_handler_string_html);
		}
		
		if($error_in_get)
		{
			$error_handler_string_html = str_replace('[-error_get-]'	,'<font face="Verdana, Georgia, Times New Roman, Times, serif" size="1"><strong>GET:</strong></font><br><font face="Verdana, Georgia, Times New Roman, Times, serif" size="1">' . $error_in_get . '</font><br>' ,$error_handler_string_html);
		}
		else
		{
			$error_handler_string_html = str_replace('[-error_get-]','' ,$error_handler_string_html);
		}
		
		if($error_in_post){
			$error_handler_string_html = str_replace('[-error_post-]'	,'<font face="Verdana, Georgia, Times New Roman, Times, serif" size="1"><strong>POST:</strong></font><br><font face="Verdana, Georgia, Times New Roman, Times, serif" size="1">' . $error_in_post . '</font><br>' ,$error_handler_string_html);
		}
		else
		{
			$error_handler_string_html = str_replace('[-error_post-]','' ,$error_handler_string_html);
		}
		
		if($error_in_cookie){
			$error_handler_string_html = str_replace('[-error_cookie-]','<font face="Verdana, Georgia, Times New Roman, Times, serif" size="1"><strong>COKIES:</strong></font><br><font face="Verdana, Georgia, Times New Roman, Times, serif" size="1">' . $error_in_cookie . '</font><br>' ,$error_handler_string_html);
		}
		else
		{
			$error_handler_string_html = str_replace('[-error_cookie-]',' ' ,$error_handler_string_html);
		}
		
		$error_handler_string_html = str_replace('[-error_search-]',$error_google ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_moderators-]',$error_moderators ,$error_handler_string_html);
		$error_handler_string_html = str_replace('[-error_url_path-]',"http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ,$error_handler_string_html);
		
		/**
		 * @internal Si la aplicacion esta en el server de produccion muestro los errores en pantalla sino envio el email
		 */
		/*if( CONFIG_EN_TESTING )
		{*/
			//die($error_handler_string_html);
			$for_name = date("d-m-Y_H-i-s", time())."_".rand(10000, 20000);
			$path = dirname(__FILE__).'/log/'.$for_name.'.html';
			$dump_fp = fopen($path,"w");
			if($dump_fp != false){
				fwrite($dump_fp, $error_handler_string_html);
				fclose($dump_fp);
			}
			die($error_handler_string_html);
		/*}
		else
		{
			$for_name = date("dmY_His", time())."_".rand(10000000, 20000000);
			$path = dirname(__FILE__).'/log/log_'.$for_name.'.html';
			$dump_fp = fopen($path,"w");
			if($dump_fp != false){
				fwrite($dump_fp, $error_handler_string_html);
				fclose($dump_fp);
			} 
			//die($error_handler_string_html);
			/**
			 * @internal Envio de emails dependiendo del SERVICIO
			 */
			/*if(CONFIG_SENDER_EMAIL=='SMTP')
			{
				foreach( $destinatarios['USUARIOS'] as $to_str )
				{
					$envio = $this->handlerSend($to_str['TO_EMAIL'], $to_str['TO_NOMBRE'], $to_str['TO_SUBJECT'], $error_handler_string_html);
				}
			}elseif(CONFIG_SENDER_EMAIL=='SMTP_GMAIL')
			{
				foreach( $destinatarios['USUARIOS'] as $to_str )
				{
					$envio = $this->handlerSendGemail($to_str['TO_EMAIL'], $to_str['TO_NOMBRE'], $to_str['TO_SUBJECT'], $error_handler_string_html);
				}
			}else{
				foreach( $destinatarios['USUARIOS'] as $to_str )
				{
					@ini_set("sendmail_from",$mail_from);
					mail($to_str['TO_EMAIL'], $to_str['TO_SUBJECT'], $error_handler_string_html, "From: ".$to_str['FROM_EMAIL']."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
				}
			}*/
			
			if ($errno & (E_WARNING | E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR))
			{
				exit();
			}
		//}
	}
	
	/**
	 * Envío de emails
	 */
	/**
	 * function send
	 * @global $_SERVER, $_SESSION, $_GET, $_POST, $_COOKIE
	 * @uses SMTP_AUTHENTICATION, 		anotherconstant
	 * @uses SMTP_SERVER, 		anotherconstant
	 * @uses SMTP_PORT, 		anotherconstant
	 * @uses SMTP_USER, 		anotherconstant
	 * @uses SMTP_PASS, 		anotherconstant
	 * @uses FROM_EMAIL, 		anotherconstant
	 * @uses FROM_NAME, 		anotherconstant
	 * @param 					string $email
	 * @param 					string $nombre
	 * @param 					string $apellido
	 * @param 					string $subject
	 * @return 					string|send 
	 */
	private function handlerSend($email_to, $email_to_name, $email_subjet, $email_contenido)
	{ 
		require_once( dirname(__FILE__) . "/../mails/class.phpmailer.php");
		require_once( dirname(__FILE__) . "/../mails/class.smtp.php");
		
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
		$mail->Subject       = $email_subjet;
		
		$mail->WordWrap = 50; 						// ancho del mensaje
		$mail->IsHTML(true);  						// set email format to HTML //
		$mail->MsgHTML($email_contenido);
		$mail->AddAddress($email_to, $email_to_name);
		//$mail->AddBCC("support@developers-ba.com.ar");
		
		$return = '';
		if(!$mail->Send())
		{
		   $return = "El email NO fue enviado.<br>Email Error: " . $mail->ErrorInfo;
		   //$return = "1";
		}
		else
		{
			$return = "2";
		}
		$mail = null;
		
		return $return;
	}
	
	/**
	 * Envío de emails GMAIL
	 */
	/**
	 * function send
	 * @global $_SERVER, $_SESSION, $_GET, $_POST, $_COOKIE
	 * @uses SMTP_AUTHENTICATION, 		anotherconstant
	 * @uses SMTP_SERVER, 		anotherconstant
	 * @uses SMTP_PORT, 		anotherconstant
	 * @uses SMTP_USER, 		anotherconstant
	 * @uses SMTP_PASS, 		anotherconstant
	 * @uses FROM_EMAIL, 		anotherconstant
	 * @uses FROM_NAME, 		anotherconstant
	 * @param 					string $email
	 * @param 					string $nombre
	 * @param 					string $apellido
	 * @param 					string $subject
	 * @return 					string|send 
	 */
	private function handlerSendGemail($email_to, $email_to_name, $email_subjet, $email_contenido)
	{ 
		require_once( dirname(__FILE__) . "/../mails/class.phpmailer.php");
		require_once( dirname(__FILE__) . "/../mails/class.smtp.php");
		
		$mail                = new PHPMailer();
		$mail->IsSMTP();                            // telling the class to use SMTP    
		$mail->SMTPDebug	 = SMTP_DEBUG;			// permite modo debug para ver mensajes de las cosas que van ocurriendo
		$mail->SMTPAuth      = SMTP_AUTHENTICATION; // enable SMTP authentication
		$mail->SMTPSecure 	 = SMTP_SECURE;			// ssl
		$mail->Host          = SMTP_SERVER;         // sets the SMTP server
		$mail->Port          = SMTP_PORT;           // set the SMTP port for the GMAIL server
		$mail->Username      = SMTP_USER;           // SMTP account username
		$mail->Password      = SMTP_PASS;           // SMTP account password
		$mail->SetFrom(FROM_EMAIL, FROM_NAME);   
		$mail->CharSet 		 = 'UTF-8'; 			// set email Char Set // 
		$mail->Subject       = $email_subjet;
		$mail->MsgHTML($email_contenido);
		$mail->AddAddress($email_to, $email_to_name);
		$mail->IsHTML(true);  						// set email format to HTML //
		
		$return = '';
		if(!$mail->Send())
		{
		   $return = "El email NO fue enviado.<br>Email Error: " . $mail->ErrorInfo;
		   //$return = "1";
		}
		else
		{
			$return = "2";
		}
		$mail = null;
		
		return $return;
	}
	/**
     * Destructor sets up
	 * @see __destruct()
     */
	public function __destruct()
	{
		//unset($this);
	}
} 
?>