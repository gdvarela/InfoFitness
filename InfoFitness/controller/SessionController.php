<?php

 require_once(__DIR__."/../core/ViewManager.php");
 require_once(__DIR__."/../core/I18n.php");

 require_once(__DIR__."/../model/Session.php");
 require_once(__DIR__."/../model/SessionMapper.php");

 require_once(__DIR__."/../controller/BaseController.php");

 class SessionController extends BaseController {

  private $sessionMapper;
  private $newSession;

   public function __construct() {
       parent::__construct();

       $this->sessionMapper = new SessionMapper();
       $this->newSession = new Session();
       // Users controller operates in a "welcome" layout
       // different to the "default" layout where the internal
       // menu is displayed
       $this->view->setLayout("default");
   }

   public function listSessions(){
     $sessions = $this->sessionMapper->listSessions();
     $this->view->setVariable("sessions", $sessions);
       $this->view->setVariable("title", "Sessions");
     $this->view->render("session", "list");
   }

   public function newSession(){
     if(isset($_POST["tableId"])){
       $date=date("Y-m-d H:m", time());
       $idUser=$_SESSION["userId"];
       $this->newSession->changeSession($date, $idUser, $_POST["anotacion"], $_POST["tableId"]);
       $this->sessionMapper->save($this->newSession);
       $this->view->redirect("session", "listSessions");
     }
   }


 }


 ?>
