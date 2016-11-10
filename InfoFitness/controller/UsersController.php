<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class UsersController extends BaseController {

  private $userMapper;
  private $newUser;

  public function __construct() {
    parent::__construct();

    $this->userMapper = new UserMapper();
    $this->newUser = new User();
    $this->view->setLayout("default");
  }

  public function listUsuario(){
    $users = $this->userMapper->listarUsuario();
    $this->view->setVariable("users", $users);
    $this->view->setVariable("newUser", $this->newUser);
    $this->view->render("users", "alta");
  }


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

            /*$user = new User($_POST["username"], $_POST["passwd"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
            $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"]);*/
            $this->newUser->setUsername($_POST["username"]);
            $this->newUser->setPassword($_POST["passwd"]);
            $this->newUser->setNombre($_POST["nombre"]);
            $this->newUser->setApellidos($_POST["apellidos"]);
            $this->newUser->setDni($_POST["dni"]);
            $this->newUser->setFechanac($_POST["fechanac"]);
            $this->newUser->setPermiso($_POST["permiso"]);
            $this->newUser->setEmail($_POST["email"]);
            $this->newUser->setTelefono($_POST["telef"]);

            $this->userMapper->save($this->newUser);

            echo "Usuario añadido a la BD";
          }else{
            echo "Uuario existente";
          }

      } else {
          $this->view->redirect("users", "listUsuario");
      }
  }

  public function modificar(){
    if(isset($_POST["username"])) {
        $user = new User($_POST["username"], $_POST["passwd"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
         $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"]);

        $this->userMapper->update($user);

      $this->view->redirect("users", "listUsuario");
    } else {
        throw new Exception("modify only form POST");
    }
  }


  public function baja(){
        if(isset($_POST["username"])) {
            $this->userMapper->delete($_POST["username"]);
            $this->view->redirect("user", "listUsuario");
            echo "Usuario eliminado";
        } else {
            throw new Exception("delete only form POST");
        }
    }

  }
