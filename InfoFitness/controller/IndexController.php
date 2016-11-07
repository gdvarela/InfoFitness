<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class IndexController extends BaseController {

    public function welcome () {

       $this->view->render("index", "welcome");
    }
}

?>