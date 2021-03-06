<?php 

//Incluir el archivo autoload de composer
include'vendor/autoload.php';

//Variables
$nombre  = trim($_REQUEST['nombre']);
$correo  = trim($_REQUEST['correo']);
$asunto  = trim($_REQUEST['asunto']);
$mensaje = trim($_REQUEST['mensaje']);

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Validación de UTF8(ñ,ó,Ü)
$mail->CharSet = "UTF-8";

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "notificacionperutec@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "botellaazul";

//Set who the message is to be sent from : Remitente
$mail->setFrom('notificacionperutec@gmail.com', 'Notificación PerúTec');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to :Destinatario
$mail->addAddress($correo, $nombre);

//$mail->addAddress('soluciones@perutec.com.pe', 'Soluciones');


//Set the subject line : Asunto
$mail->Subject = $asunto;


//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

$html = $mensaje;

//Cuerpo de Correo(HTML)
$mail->msgHTML($html);

//Attach an image file
//$mail->addAttachment('uploads/Costeo.pdf');

//Adjunto #2
//$mail->addAttachment('uploads/phpmailer.png');

if(!$mail->send())
{

  //echo "Mailer Error: " . $mail->ErrorInfo;

  echo json_encode(
   array(
   
   'title' => 'Error',
   'text'  => $mail->ErrorInfo,
   'type'  => 'error'


   )
  );



}
else
{

// echo "Correo Enviado";
 echo json_encode(
   array(
   
   'title' => 'Buen Trabajo',
   'text'  => 'Mensaje Enviado',
   'type'  => 'success'


   )
  );


}


 ?>