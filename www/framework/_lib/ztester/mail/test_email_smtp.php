<?php
require_once( dirname(__FILE__) . '/../../../_common/Class.Config.php');
$_c = new Configuration();
require_once( dirname(__FILE__) . '/../../handler/Class.Error.Handler.php');
$_e = new ErrorHandler();

#-----------------------------------------------------------------------
# VARIABLES para el email
#-----------------------------------------------------------------------
$email_usuario = 'fernandezdg@gmail.com';
$email_nombre = 'David Fernandez';

// $email_usuario = 'test@apsiadis.com.ar';
// $email_nombre = 'Test tester';

$email_subject = 'Email de muestra';
$email_title = 'email de muestra';
$email_url_to = 'developersba.com';
$email_detail = 'detalle de muestra';

#-----------------------------------------------------------------------
# GENERO CONTENIDO DEL EMAIL
#-----------------------------------------------------------------------
$elbody = file_get_contents('email_test_plantilla.html');
$elbody = str_replace('[[[brand]]]',CONFIG_NAME_SITE,$elbody);
$elbody = str_replace('[[[title]]]',$email_title,$elbody);
$elbody = str_replace('[[[date]]]',CONFIG_DATE,$elbody);
$elbody = str_replace('[[[urlsite]]]',$email_url_to,$elbody);
$elbody = str_replace('[[[detail]]]',$email_detail,$elbody);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once( dirname(__FILE__) . '/PHPMailer-master/src/Exception.php');
require_once( dirname(__FILE__) . '/PHPMailer-master/src/PHPMailer.php');
require_once( dirname(__FILE__) . '/PHPMailer-master/src/SMTP.php');

$mail = new PHPMailer();

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                           // Send using SMTP
    $mail->Host       = SMTP_SERVER;           // Set the SMTP server to send through
    $mail->SMTPAuth   = SMTP_AUTHENTICATION;   // Enable SMTP authentication
    $mail->Username   = SMTP_USER;             // SMTP username
    $mail->Password   = SMTP_PASS;             // SMTP password
    $mail->SMTPSecure = SMTP_SECURE;           // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = SMTP_PORT;             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($email_usuario, $email_nombre);   // Add a recipient
    // $mail->addAddress('ellen@example.com');          // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');      // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

    // Content
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $email_subject;
    $mail->Body    = $elbody;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}





?>