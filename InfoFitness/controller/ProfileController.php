<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class ProfileController extends BaseController
{

    private $profileMapper;
    private $newUser;

    public function __construct()
    {
        parent::__construct();

        $this->profileMapper = new UserMapper();
        $this->newUser = new User();
        $this->view->setLayout("default");
    }

    public function showUser(){
      if(isset($_SESSION["userId"])){
        $user = $this->profileMapper->listUser($_SESSION["userId"]);
        $this->view->setVariable("usuario", $user);

        $this->view->render("profiles", "show");
      }else{
        echo "no hay id user";
      }


    }

    public function modify()
    {
      if(isset($_POST["submit"])){
        if (isset($_POST["id_usuario"])) {
            $user = new User($_POST["id_usuario"], $_POST["username"], $_POST["passwd"], $_POST["name"], $_POST["lastname"], $_POST["dni"],
                $_POST["date"], NULL, $_POST["email"], $_POST["phone"], NULL, NULL, NULL);

            try {
                //$this->user->checkIsValidForRegister();
                $this->profileMapper->updateUser($user);
            } catch (ValidationException $ex) {
                // Obtener los errores de la validacion
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }


            $this->view->redirect("profile", "showUser");
        } else {
            throw new Exception("modify only form POST");
        }
      }else{
          $this->view->render("profiles", "show");
      }
    }

    public function delete(){
      if(isset($_POST["baja"])){

        if (isset($_POST["id_usuario"])) {
            $this->profileMapper->delete($_POST["id_usuario"]);
            $this->view->render("index", "unauthorized");

        } else {
            throw new Exception("delete only form POST");
        }
      }
    }

}//fin class
