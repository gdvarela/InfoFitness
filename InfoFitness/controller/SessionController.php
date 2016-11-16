<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class SessionController extends BaseController {
  public function __construct() {
      parent::__construct();

      $this->sessionMapper = new SessionMapper();
      $this->newSession = new Session();

      $this->view->setLayout("default");
  }

  
}


?>
