<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class UsersController extends BaseController {

  private $userMapper;

  public function __construct() {
    parent::__construct();

    $this->userMapper = new UserMapper();

    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    $this->view->setLayout("welcome");
  }

  /*public function alta() {

      if (isset($_POST["username"])){

          $user = new User($_POST["username"], $_POST["passwd"]);

          $this->userMapper->save($user);

      } else {
          $this->view->render("users", "alta");
      }
  }*/
  public function alta() {
    //$name=NULL,$firstname=NULL, $dni=NULL, $fechanac=NULL, $email=NULL, $telef=NULL
      if (isset($_POST["username"])
              && $_POST["passwd"]
              && $_POST["nombre"]
              && $_POST["apellidos"]
              && $_POST["dni"]
              && $_POST["fechanac"]
              && $_POST["email"]
              && $_POST["telef"]
              && $_POST["permiso"]){

          /*llamar a  la funcion validar datos del modelo user*/
          $user = new User($_POST["username"], $_POST["passwd"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"], $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"]);


          $this->userMapper->save($user);


      } else {
          $this->view->render("users", "alta");
      }
  }
}
