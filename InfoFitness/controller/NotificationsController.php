<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__ . "/../model/Notification.php");
require_once(__DIR__ . "/../model/NotificationMapper.php");

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
      $from = "FROM: InfoFitness App. Don't reply";
      mail( $email, $subject , $message, $from);


      //$this->view->setFlash("Enviado!");
    }
    $this->view->render("notifications","send"); //nombre del controlador y nombre de la vista
  }
}

?>
