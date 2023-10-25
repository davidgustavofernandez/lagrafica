<?php
/**
 * Sender, Trata los envios de email
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
class SenderSmtp
{
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_PathMailHtml = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_Server = '';
	/**
     * Configuration values
     * @access private
     * @var Number
     */
	private $_Debug = 0;
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_Secure = '';
	/**
     * Configuration values
     * @access private
     * @var Boolean
     */
	private $_Authentication = true;
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_Port = 465;
	/**
     * Configuration values
     * @access private
     * @var Number
     */
	private $_WordWrap = 50;
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_User = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_Password = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailFromName = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailFromEmail = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailToName = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailToEmail = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailCharSet = 'UTF-8';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailSubject = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_EmailConten = '';
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_isHtml = true;
	/**
     * Configuration values
     * @access private
     * @var String
     */
	private $_Sistem = 'MAIL';
	
	/**
	 * setPathMailHtml public function
	 * @uses $PathMailHtml, String
	 * Nota: Set the valor path of recipient email.
	 */
	public function setPathMailHtml($pathMailHtml)
	{
		$this->_PathMailHtml = $pathMailHtml;
	}
	/**
	 * setServer public function
	 * @uses $server, String
	 * Nota: Set the server to send.
	 */
	public function setServer($server)
	{
		$this->_Server = $server;
	}
	/**
	 * setDebug public function
	 * @uses $debug, String
	 * Nota: Set if need debuging.
	 */
	public function setDebug($debug)
	{
		$this->_Debug = $debug;
	}
	/**
	 * setSecure public function
	 * @uses $secure, String
	 * Nota: Set ssl.
	 */
	public function setSecure($secure)
	{
		$this->_Secure = $secure;
	}
	/**
	 * setAuthentication public function
	 * @uses $authentication, String
	 * Nota: Set if need authenticated.
	 */
	public function setAuthentication($authentication)
	{
		$this->_Authentication = $authentication;
	}
	/**
	 * setPort public function
	 * @uses $port, String
	 * Nota: Set if need to define the port.
	 */
	public function setPort($port)
	{
		$this->_Port = $port;
	}
	/**
	 * setWordWrap public function
	 * @uses $port, Number
	 * Nota: Set number of Word Wrap
	 */
	public function setWordWrap($word_wrap)
	{
		$this->_WordWrap = $word_wrap;
	}
	/**
	 * setUser public function
	 * @uses $authentication, String
	 * Nota: Set the User for From Send.
	 */
	public function setUser($user)
	{
		$this->_User = $user;
	}
	/**
	 * setPassword public function
	 * @uses $password, String
	 * Nota: Set the Password for From Send.
	 */
	public function setPassword($password)
	{
		$this->_Password = $password;
	}
	/**
	 * setEmailFromName public function
	 * @uses $emailFromName, String
	 * Nota: Set the From Name.
	 */
	public function setEmailFromName($emailFromName)
	{
		$this->_EmailFromName = $emailFromName;
	}
	/**
	 * setEmailFromEmail public function
	 * @uses $emailFromEmail, String
	 * Nota: Set the From Email.
	 */
	public function setEmailFromEmail($emailFromEmail)
	{
		$this->_EmailFromEmail = $emailFromEmail;
	}
	/**
	 * setEmailToName public function
	 * @uses $emailToName, String
	 * Nota: Set the Name for Send.
	 */
	public function setEmailToName($emailToName)
	{
		$this->_EmailToName = $emailToName;
	}
	/**
	 * setEmailFromEmail public function
	 * @uses $emailFromEmail, String
	 * Nota: Set the From Name for Send.
	 */
	public function setEmailToEmail($emailToEmail)
	{
		$this->_EmailToEmail = $emailToEmail;
	}
	/**
	 * setEmailCharSet public function
	 * @uses $emailCharSet, String
	 * Nota: Set Encode of conten mail.
	 */
	public function setEmailCharSet($emailCharSet)
	{
		$this->_EmailCharSet = $emailCharSet;
	}
	/**
	 * setEmailSubject public function
	 * @uses $emailSubject, String
	 * Nota: Set the From Name for Send.
	 */
	public function setEmailSubject($emailSubject)
	{
		$this->_EmailSubject = $emailSubject;
	}
	/**
	 * setEmailConten public function
	 * @uses $emailConten, String
	 * Nota: Set the conten of mail.
	 */
	public function setEmailConten($emailConten)
	{
		$this->_EmailConten = $emailConten;
	}
	/**
	 * setEmailConten public function
	 * @uses $emailConten, String
	 * Nota: Set the conten of mail.
	 */
	public function setIsHtml($isHtml)
	{
		$this->_isHtml = $isHtml;
	}
	/**
	 * setSender public function
	 * @uses $emailConten, String
	 * Nota: Set the sistem to send the email.
	 */
	public function setSistem($sistem)
	{
		$this->_Sistem = $sistem;
	}
	/**
	 * senderMAIL public function
	 * @uses $emailSubject, String
	 * Nota: Set the From Name for Send.
	 */
	private function _useMail()
	{
		if(isset($this->_EmailToName) && isset($this->_EmailToEmail) && isset($this->_EmailFromName) && isset($this->_EmailFromEmail))
		{
			$headers = "X-Sender: " . $this->_EmailToName . " <" . $this->_EmailToEmail . ">\r\n";
			$headers .= "X-Mailer: PHP\r\n";
			$headers .= "X-Priority: 1\r\n";
			$headers .= "Return-Path: <" . $this->_EmailFromEmail . ">\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "X-MSMail-Priority: High\r\n";
			$headers .= "From: " . $this->_EmailFromName . " <" . $this->_EmailFromEmail . ">\r\n";
			$headers .= "Reply-To: " . $this->_EmailFromName . " <" . $this->_EmailFromEmail . ">\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
			
			@ini_set("sendmail_from", $this->_EmailFromEmail);
			if(mail($this->_EmailToEmail, $this->_EmailSubject, $this->_EmailConten ,$headers))
			{
				$return = 200;
			}
			else
			{
				$return = 400;
			}
			return $return;
		}
		else
		{
			$return = 400;
		}
	}
	/**
	 * Envío de emails
	 */
	/**
	 * function _useSmtp
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
	private function _useSmtp()
	{ 
		if(isset($this->_EmailToName) && isset($this->_EmailToEmail) && isset($this->_EmailFromName) && isset($this->_EmailFromEmail))
		{
			require_once( dirname(__FILE__) . '/class.phpmailer.php');
			require_once( dirname(__FILE__) . '/class.smtp.php');
			
			$mail 					= new PHPMailer();
			$mail->IsSMTP();                            // telling the class to use SMTP    
			$mail->SMTPAuth 		= $this->_Authentication; // enable SMTP authentication
			$mail->SMTPDebug 		= $this->_Debug; 			// Mod degug
			if(!empty($this->_Secure)){
				$mail->SMTPSecure 	= $this->_Secure;
			}
			//$mail->SMTPKeepAlive = true;              // SMTP connection will not close after each email sent
			$mail->Host 			= $this->_Server;         // sets the SMTP server
			$mail->Port 			= $this->_Port;           // set the SMTP port for the GMAIL server
			$mail->Username 		= $this->_User;           // SMTP account username
			$mail->Password 		= $this->_Password;           // SMTP account password
			$mail->SetFrom($this->_EmailFromEmail, $this->_EmailFromName);   
			$mail->CharSet 			= $this->_EmailCharSet; 			// set email Char Set // 
			$mail->Subject 			= $this->_EmailSubject;
			
			$mail->WordWrap 		= $this->_WordWrap; 			// ancho del mensaje
			$mail->IsHTML($this->_isHtml);  						// set email format to HTML //
			$mail->MsgHTML($this->_EmailConten);
			$mail->AddAddress($this->_EmailToEmail, $this->_EmailToName);
			//$mail->AddBCC("");
			$return = '';

			if(!$mail->Send())
			{
				$return = "El email NO fue enviado.<br>Email Error:. " . $mail->ErrorInfo;
			}
			else
			{
				$return = 200;
			}
			$mail = null;
			return $return;
			
		}
		else
		{
			$return = 500;
		}
		return $return;
	}
	/**
	 * Envío de emails
	 */
	/**
	 * function _useSmtpGmail
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
	private function _useSmtpGmail()
	{ 
		if(isset($this->_EmailToName) && isset($this->_EmailToEmail) && isset($this->_EmailFromName) && isset($this->_EmailFromEmail))
		{
			require_once( dirname(__FILE__) . "/class.phpmailer.php");
			require_once( dirname(__FILE__) . "/class.smtp.php");
			$mail               = new PHPMailer();
			$mail->IsSMTP();                            	// telling the class to use SMTP    
			$mail->SMTPDebug 	= $this->_Debug;			// permite modo debug para ver mensajes de las cosas que van ocurriendo
			$mail->SMTPAuth 	= $this->_Authentication; 	// enable SMTP authentication
			$mail->SMTPSecure 	= $this->_Secure;			// ssl
			$mail->Host 		= $this->_Server;         	// sets the SMTP server
			$mail->Port 		= $this->_Port;           	// set the SMTP port for the GMAIL server
			$mail->Username 	= $this->_User;           	// SMTP account username
			$mail->Password 	= $this->_Password;        	// SMTP account password
			$mail->SetFrom($this->_EmailFromEmail, $this->_EmailFromName);   
			$mail->CharSet 		= $this->_EmailCharSet; 	// set email Char Set // 
			$mail->Subject 		= $this->_EmailSubject; 	// asunto
			//$mail->WordWrap 	= $this->_WordWrap; 		// ancho del mensaje
			$mail->MsgHTML($this->_EmailConten);
			$mail->AddAddress($this->_EmailToEmail, $this->_EmailToName);
			$mail->IsHTML($this->_isHtml);  					// set email format to HTML //
			
			$return = '';
			
			if(!$mail->Send())
			{
			   $return = "El email NO fue enviado.<br>Email Error: " . $mail->ErrorInfo;
				// $return = 400;
			}
			else
			{
				$return = 200; //ok
			}
			$mail = null;
			
			return $return;
		}
		else
		{
			$return = 400;
		}
	}
	/**
	 * getSender public function
	 * @uses $_Sistem, String
	 * Nota: Send email an return the result.
	 */
	public function getSender()
	{
		if($this->_Sistem=='SMTP')
		{
			return $this->_useSmtp();
		}
		if($this->_Sistem=='SMTP_GMAIL')
		{
			return $this->_useSmtpGmail();
		}
		else
		{
			return $this->_useMail();
		}
	}
}

?>