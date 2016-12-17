<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__ . "/../controller/BaseController.php");
require_once(__DIR__ . "/../model/StatisticsMapper.php");


class StatisticsController extends BaseController{

  public function __construct()
  {
    parent::__construct();

    $this->statisticsMapper = new StatisticsMapper();
    $this->view->setLayout("default");
  }

  public function statistics()
  {
      $assitance_statistics = $this->statisticsMapper->getAssistanceStatistics();
      $age_statistics = $this->statisticsMapper->getAgeStatistics();
      $table_statistics = $this->statisticsMapper->getTableStatistics();

      $this->view->setVariable("assitance_statistics", $assitance_statistics);
      $this->view->setVariable("age_statistics", $age_statistics);
      $this->view->setVariable("table_statistics", $table_statistics);

      $this->view->render("statistics", "statistics");
  }

}
?>
