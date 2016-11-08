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
              && isset($_POST["passwd"])
              && isset($_POST["nombre"])
              && isset($_POST["apellidos"])
              && isset($_POST["dni"])
              && isset($_POST["fechanac"])
              && isset($_POST["email"])
              && isset($_POST["telef"])
              && isset($_POST["permiso"])){

          /*llamar a  la funcion validar datos del modelo user*/

          //comprobar que el usuario a insertar no existe en la BD
          if(!($this->userMapper->usernameExists($_POST["username"]))) {

            $user = new User($_POST["username"], $_POST["passwd"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
            $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"]);

            $this->userMapper->save($user);

            echo "Usuario añadido a la BD";
          }else{
            echo "Uuario existente";
          }

      } else {
          $this->view->render("users", "alta");
      }
  }

  public function modificar(){
    if(isset($_POST["username"])) {
        $user = new User($_POST["username"], $_POST["passwd"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
         $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"]);

        $this->userMapper->update($user);

      $this->view->redirect("users", "alta");
    } else {
        throw new Exception("modify only form POST");
    }
  }


  public function baja(){
        if(isset($_POST["username"])) {
            $this->userMapper->delete($_POST["username"]);
            $this->view->redirect("user", "alta");
            echo "Usuario eliminado";
        } else {
            throw new Exception("delete only form POST");
        }
    }

  }
}
