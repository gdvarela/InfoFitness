<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__ . "/../model/Notification.php");
require_once(__DIR__ . "/../model/NotificationMapper.php");
require_once(__DIR__."/../mail/PHPMailerAutoload.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class NotificationsController extends BaseController{




  //modificar!!!!!! y comprobar
  public function send(){


    if(isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["subject"]) && !empty($_POST["subject"])
    && isset($_POST["message"]) && !empty($_POST["message"])){

      $email = $_POST["email"];
      $subject = $_POST["subject"];
      $message = $_POST["message"];


      //$this->view->setFlash("Enviado!");


  $mail = new phpmailer();

  //Definimos las propiedades y llamamos a los métodos
  //correspondientes del objeto mail

  //Con PluginDir le indicamos a la clase phpmailer donde se
  //encuentra la clase smtp que como he comentado al principio de
  //este ejemplo va a estar en el subdirectorio includes
  /*$mail->PluginDir = "includes/";

  //Con la propiedad Mailer le indicamos que vamos a usar un
  //servidor smtp
  $mail->Mailer = "smtp";

  //Asignamos a Host el nombre de nuestro servidor smtp
  $mail->Host = "smtp.gmail.com";

  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = true;

  //Le decimos cual es nuestro nombre de usuario y password
  $mail->Username = "infofitnessapp@gmail.com";
  $mail->Password = "infofitnessmail";

  //Indicamos cual es nuestra dirección de correo y el nombre que
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = "infofitnessapp@gmail.com";
  $mail->FromName = "infoFitness admin";

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar
  //una cuenta gratuita, por tanto lo pongo a 30
  $mail->Timeout=30;

  //Indicamos cual es la dirección de destino del correo
  $mail->AddAddress($email);

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo
  //que se vea en negrita
  $mail->Subject = $subject;
  $mail->Body = $message;

  //Definimos AltBody por si el destinatario del correo no admite email con formato html
  $mail->AltBody = $message;

  //se envia el mensaje, si no ha habido problemas
  //la variable $exito tendra el valor true
  $exito = $mail->Send();

  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues
  //del anterior, para ello se usa la funcion sleep
  $intentos=1;
  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	echo $mail->ErrorInfo;
     	$exito = $mail->Send();
     	$intentos=$intentos+1;

   }


   if(!$exito)
   {
	echo "Problemas enviando correo electrónico a ".$valor;
	echo "<br/>".$mail->ErrorInfo;
   }
   else
   {
	echo "Mensaje enviado correctamente";
}*/
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "infofitnessapp@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "infofitnessmail";
//Set who the message is to be sent from
$mail->setFrom('from@example.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo("infofitnessapp@gmail.com", 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email, $email);
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = $message;
//Replace the plain text body with one created manually
$mail->AltBody = $message;
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

  }
  //$this->view->setVariable("Notificaciones");
  $this->view->render("notifications","send");
  }
}
?>
