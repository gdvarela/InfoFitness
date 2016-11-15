<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class IndexController extends BaseController
{

    public function welcome()
    {
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
            case 3:
                $this->view->render("index", "test");
                break;
            default:
                $this->view->render("index", "error");
                break;
        }
    }
}

?>