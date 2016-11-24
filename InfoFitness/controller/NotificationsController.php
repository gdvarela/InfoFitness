<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__ . "/../model/Notification.php");
require_once(__DIR__ . "/../model/NotificationMapper.php");
require_once(__DIR__."/../mail/PHPMailerAutoload.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class NotificationsController extends BaseController{

  public function __construct()
  {
    parent::__construct();

    $this->notificationMapper = new NotificationMapper();
  }

  public function send(){

    $arrayemails = array();

    if(isset($_POST["grupoemail"]) 
    && isset($_POST["subject"]) && !empty($_POST["subject"])
    && isset($_POST["message"]) && !empty($_POST["message"])){

      //$email = $_POST["email"];
      $grupoemail = $_POST["grupoemail"];
      $subject = $_POST["subject"];
      $message = $_POST["message"];

      switch ($grupoemail) {
        case 'all':
          $arrayemails = $this->notificationMapper->selectEmails();
          break;
        case 'deportistas':
          $arrayemails = $this->notificationMapper->selectEmailsDep();
          break;
        case 'monitores':
            $arrayemails = $this->notificationMapper->selectEmailsMonit();
            break;
        default:
          echo "Seleccione un grupo de usuarios";
          break;
      }


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
     //$mail->Host = gethostbyname('smtp.gmail.com');
      // if your network does not support SMTP over IPv6
      //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
      $mail->Port =587;
      //Set the encryption system to use - ssl (deprecated) or tls
      $mail->SMTPSecure = 'tls';
      //Whether to use SMTP authentication
      $mail->SMTPAuth = true;
      //Username to use for SMTP authentication - use full email address for gmail
      $mail->Username = "infofitnessapp@gmail.com";
      //Password to use for SMTP authentication
      $mail->Password = "infofitnessmail";
      //Set who the message is to be sent from
    /*  $mail->setFrom("infofitnessapp@gmail.com", 'Infofitness Admin');
      //Set an alternative reply-to address
      $mail->addReplyTo("infofitnessapp@gmail.com", 'Infofitness Admin');*/
      //Set who the message is to be sent to
      //$mail->addAddress($email, $email);

      foreach ($arrayemails as $email) {
        $mail->setFrom("infofitnessapp@gmail.com", 'Infofitness Admin');
        $mail->addReplyTo("infofitnessapp@gmail.com", 'Infofitness Admin');
        $mail->addAddress($email["mail"],$email["nombre"]);
        //Set the subject line
        $mail->Subject = $subject;
        //convert HTML into a basic plain-text alternative body
        $mail->Body = $message;
        //Replace the plain text body with one created manually
        $mail->AltBody = $message;
        //send the message, check for errors
        if (!$mail->send()) {
            $this->view->setFlash("Impossible to send messages");
        }
      }
    }

  $this->view->setVariable("title", "Notificaciones");
  $this->view->render("notifications","send");
  }
}
?>
