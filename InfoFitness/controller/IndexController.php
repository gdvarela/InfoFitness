<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class IndexController extends BaseController
{

    public function welcome()
    {
        if (isset($_SESSION["userId"])) {
            $this->view->setVariable("title", "InfoFitness");
            switch ($_SESSION["type"]) {
                case 0:
                    $this->view->render("index", "user");
                    break;
                case 1:
                    $this->view->render("index", "monitor");
                    break;
                case 2:
                    $this->view->render("index", "admin");
                    break;
                default:
                    $this->view->render("index", "error");
                    break;
            }
        } else {
            $this->view->render("users", "login");
        }
    }

    public function unauthorized()
    {
        $this->view->render("index", "unauthorized");
    }
}

?>
