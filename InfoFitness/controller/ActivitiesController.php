<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ActivitiesController extends BaseController {

    private $activityMapper;
    private $newActivity;

    public function __construct() {
        parent::__construct();

        $this->activityMapper = new ActivityMapper();
        $this->newActivity = new Activity();
        // Users controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("default");
    }

    public function listActivities() {

        $activities = $this->activityMapper->listActivities();
        $this->view->setVariable("activities", $activities);

        $this->view->setVariable("newActivity", $this->newActivity);

        $this->view->render("activities", "list");
    }

    public function modify() {

        if(isset($_POST["activityId"])) {
            $activity = new Activity($_POST["activityId"], $_POST["activityName"], $_POST["activityMaxAssis"],
                $_POST["activityDes"], $_POST["activityPrice"], $_POST["activityPlace"]);

            $this->activityMapper->update($activity);

            $this->view->redirect("activities", "listActivities");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function delete() {

        if(isset($_POST["activityId"])) {
            $this->activityMapper->delete($_POST["activityId"]);
            $this->view->redirect("activities", "listActivities");
        } else {
            throw new Exception("delete only form POST");
        }
    }

    public function add() {

        if(isset($_POST["activityName"])) {
            $this->newActivity->changeActivity($_POST["activityName"], $_POST["activityMaxAssis"], $_POST["activityDes"],
                $_POST["activityPrice"], $_POST["activityPlace"]);

            $this->activityMapper->save($this->newActivity);
            $this->view->redirect("activities", "listActivities");
        } else {
            throw new Exception("add only form POST");
        }
    }
}
?>