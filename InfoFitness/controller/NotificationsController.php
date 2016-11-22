<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

class NotificationsController extends BaseController{

  //modificar!!!!!! y comprobar
  public function send(){

    if(isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["subject"]) && !empty($_POST["subject"]
    && isset($_POST["mensaje"]) && !empty($_POST["mensaje"]){

      mail($_POST["email"], $_POST["subject"],$_POST["mensaje"]);
    }
  }

}
?>
