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
      $user = $this->profileMapper->listUser($_SESSION["userId"]);
      $this->view->setVariable("users", $user);
      $this->view->redirect("index", "welcome");
    }

    public function modify()
    {

        if (isset($_POST["id_usuario"])) {
            $user = new User($_POST["id_usuario"], $_POST["username"], $_POST["passwd"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
                $_POST["fechanac"], NULL, $_POST["email"], $_POST["telef"], NULL, NULL, NULL);

            try {
                //$this->user->checkIsValidForRegister();
                $this->profileMapper->updateUser($user);
            } catch (ValidationException $ex) {
                // Obtener los errores de la validacion
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }


            $this->view->redirect("profile", "listUser");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function delete(){

    }

}//fin class
