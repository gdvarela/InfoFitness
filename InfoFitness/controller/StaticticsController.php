<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__ . "/../controller/BaseController.php");
require_once(__DIR__ . "/../model/StaticticsMapper.php");


class StaticticsController extends BaseController{

  public function __construct()
  {
    parent::__construct();

    $this->staticticsMapper = new StaticticsMapper();
    $this->view->setLayout("default");
  }

  public function statictics()
  {
      $assitance_statictics = $this->staticticsMapper->getAssistanceStatictics();
      $age_statictics = $this->staticticsMapper->getAgeStatictics();
      $table_statictics = $this->staticticsMapper->getTableStatictics();

      $this->view->setVariable("assitance_statictics", $assitance_statictics);
      $this->view->setVariable("age_statictics", $age_statictics);
      $this->view->setVariable("table_statictics", $table_statictics);

      $this->view->render("statictics", "statictics");
  }

}
?>
