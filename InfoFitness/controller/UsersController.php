<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class UsersController extends BaseController
{

    private $userMapper;
    private $newUser;

    public function __construct()
    {
        parent::__construct();

        $this->userMapper = new UserMapper();
        $this->newUser = new User();
        $this->view->setLayout("default");
    }

    public function login()
    {
        if (isset($_POST["username"])) { // reaching via HTTP Post...
            //process login form
            $user = $this->userMapper->validUser($_POST["username"], $_POST["passwd"]);
            if (isset($user)) {

                $_SESSION["userId"] = $user->getIdUsr();
                $_SESSION["currentuser"] = $_POST["username"];
                $_SESSION["type"] = $user->getPermiso();
                // send user to the restricted area (HTTP 302 code)
                $this->view->redirect("index", "welcome");

            } else {
                $errors = array();
                $errors["general"] = "Username is not valid";
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->setVariable("title", "login");
        $this->view->render("users", "login");
    }

    public function logout(){
      session_destroy();

      header('Location: index.php');
    }

    public function listUsuario()
    {
        $users = $this->userMapper->listarDeportista();
        $this->view->setVariable("users", $users);
        //$this->view->setVariable("newUser", $this->newUser);
      //  $this->view->render("users", "alta");

        $monitores= $this->userMapper->listarMonitor();
        $this->view->setVariable("monitores", $monitores);

        $admins= $this->userMapper->listarAdmin();
        $this->view->setVariable("admins", $admins);
        $this->view->setVariable("title", "Users Management");
        $this->view->render("users", "alta");
    }

    public function alta()
    {

        //si los campos del formulario no estan vacios
        if (isset($_POST["username"])
            && isset($_POST["passwd"])
            && isset($_POST["nombre"])
            && isset($_POST["apellidos"])
            && isset($_POST["dni"])
            && isset($_POST["fechanac"])
            && isset($_POST["email"])
            && isset($_POST["telef"])
            && isset($_POST["permiso"])
        ) {


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

            try {
                //comprobar que los datos recibidos del formulario son validos
                //  $this->newUser->checkIsValidForRegister();

                //comprobar que el usuario a insertar no existe en la BD
                if (!($this->userMapper->usernameExists($_POST["username"]))) {

                    //echo "Usuario añadido a la BD";
                    $this->userMapper->save($this->newUser);
                    //  $this->newUser = null;
                    $this->view->setFlash("Usuario añadido a la BD");
                    $this->view->redirect("users", "listUsuario");

                    //si ya existe el usuario
                } else {
                    $errors = array();
                    $errors["username"] = "Username already exists";
                    $this->view->setVariable("errors", $errors);
                }

            } catch (ValidationException $ex) {
                // Obtener los errores de la validacion
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }

            $this->listUsuario();

        } else {
            $this->view->redirect("users", "listUsuario");
            //throw new Exception("Add only form POST");

        }

    }//fin funcion alta

    public function modificaradmin()
    {

        if (isset($_POST["id_usuario"])) {
            $user = new User($_POST["id_usuario"], $_POST["username"], NULL, $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
                $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"], NULL, NULL, NULL);

            try {
              //  $user->checkIsValidForRegister();
                $this->userMapper->updateAdmin($user);
            } catch (ValidationException $ex) {
                // Obtener los errores de la validacion
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }

            $this->view->redirect("users", "listUsuario");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function modificarmonitor()
    {

        if (isset($_POST["id_usuario"])) {
            $user = new User($_POST["id_usuario"], $_POST["username"], NULL,$_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
                $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"], NULL, NULL, $_POST["jornada_laboral"]);

            try {
            //    $user->checkIsValidForRegister();
                $this->userMapper->updatemonitor($user);
            } catch (ValidationException $ex) {
                // Obtener los errores de la validacion
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }


            $this->view->redirect("users", "listUsuario");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function modificardeportista()
    {

        if (isset($_POST["id_usuario"])) {
            $user = new User($_POST["id_usuario"], $_POST["username"], NULL, $_POST["nombre"], $_POST["apellidos"], $_POST["dni"],
                $_POST["fechanac"], $_POST["permiso"], $_POST["email"], $_POST["telef"], $_POST["tipo_deportista"], $_POST["comentario"], NULL);

            try {
                //$user->checkIsValidForRegister();
                $this->userMapper->updatedepor($user);
            } catch (ValidationException $ex) {
                // Obtener los errores de la validacion
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }


            $this->view->redirect("users", "listUsuario");
        } else {
            throw new Exception("modify only form POST");
        }
    }


    public function baja()
    {
        if (isset($_POST["id_usuario"])) {
            $this->userMapper->delete($_POST["id_usuario"]);
            $this->view->redirect("users", "listUsuario");
            echo "Usuario eliminado";
        } else {
            throw new Exception("delete only form POST");
        }
    }

    public function register() {

        $user = new User();

        if (isset($_POST["username"])){

            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["passwd"]);
            $user->setNombre($_POST["name"]);
            $user->setApellidos($_POST["lastname"]);
            $user->setDni($_POST["dni"]);
            $user->setFechanac($_POST["date"]);
            $user->setEmail($_POST["email"]);
            $user->setTelefono($_POST["phone"]);
            $user->setPermiso(0);

            try{
                $user->checkIsValidForRegister();

                if (!$this->userMapper->usernameExists($_POST["username"])){

                    $this->userMapper->save($user);

                    $this->view->setFlash("Username ".$user->getUsername()." successfully added. Please login now");
                    $this->view->redirect("users", "login");
                } else {
                    $errors = array();
                    $errors["username"] = "Username already exists";
                    $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        // Put the User object visible to the view
        $this->view->setVariable("user", $user);

        // render the view (/view/users/register.php)
        $this->view->render("users", "register");

    }


}
