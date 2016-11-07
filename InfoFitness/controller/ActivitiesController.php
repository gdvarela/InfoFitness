<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ActivitiesController extends BaseController {

    private $activityMapper;

    public function __construct() {
        parent::__construct();

        $this->activityMapper = new ActivityMapper();

        // Users controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("default");
    }

    public function listActivities() {

        $activities = $this->activityMapper->listActivities();

        $this->view->setVariable("activities", $activities);
        $this->view->render("activities", "list");
    }
}
?>