<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/Activity.php");
require_once(__DIR__ . "/../model/ActivityMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class ActivitiesController extends BaseController
{

    private $activityMapper;
    private $newActivity;
    private $errors = array();

    public function __construct()
    {
        parent::__construct();

        $this->activityMapper = new ActivityMapper();
        $this->newActivity = new Activity();
        // Users controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("default");
    }

    public function listActivities()
    {

        $activities = $this->activityMapper->listActivities();
        $this->view->setVariable("activities", $activities);

        $this->view->setVariable("newActivity", $this->newActivity);

        if (!empty($this->errors)) {
            $this->view->setVariable("errors", $this->errors);
            $this->errors = null;
        }

        $monitors = $this->activityMapper->listMonitors();
        $this->view->setVariable("monitors", $monitors);

        $this->view->render("activities", "list");
    }

    public function modify()
    {

        if (isset($_POST["activityId"])) {
            $activity = new Activity($_POST["activityId"], $_POST["activityName"], $_POST["activityMaxAssis"],
                $_POST["activityDes"], $_POST["activityPrice"], $_POST["activityPlace"], $_POST["monitor"], $_POST["startTime"],
                $_POST["endTime"], $_POST["day"]);

            $this->activityMapper->update($activity);

            $this->view->redirect("activities", "listActivities");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function delete()
    {

        if (isset($_POST["activityId"])) {
            $this->activityMapper->delete($_POST["activityId"]);
            $this->view->redirect("activities", "listActivities");
        } else {
            throw new Exception("delete only form POST");
        }
    }

    public function add()
    {

        if (isset($_POST["activityName"])) {
            $this->newActivity->changeActivity($_POST["activityName"], $_POST["activityMaxAssis"], $_POST["activityDes"],
                $_POST["activityPrice"], $_POST["activityPlace"], $_POST["monitor"], $_POST["startTime"], $_POST["endTime"],
                $_POST["day"]);

            try {
                $this->newActivity->checkValidForAdd();
                $this->activityMapper->save($this->newActivity);
                $this->newActivity = null;
                $this->view->redirect("activities", "listActivities");
            } catch (ValidationException $ex) {
                $this->errors = $ex->getErrors();
            }
            $this->listActivities();
        } else {
            throw new Exception("add only form POST");
        }
    }

    public function assistanceControl()
    {
        $activities = $this->activityMapper->listActivities();
    }

    public function slotsControl()
    {
        $unreservedActivities = $this->activityMapper->listUnreservedActivities($_SESSION["userId"]);
        $reservedActivities = $this->activityMapper->listReservedActivities($_SESSION["userId"]);

        $this->view->setVariable("unreservedActivities", $unreservedActivities);
        $this->view->setVariable("reservedActivities", $reservedActivities);

        $this->view->render("activities", "slots");

    }

    public function reserve()
    {
        $max_assis = $this->activityMapper->getMaxAssistants($_POST["activityId"]);
        $assis = $this->activityMapper->getAssistants($_POST["activityId"]);

        if($max_assis > $assis){

          $this->activityMapper->reserve($_SESSION["userId"], $_POST["activityId"]);
          $this->view->redirect("activities", "slotsControl");

        }
        else{

          $this->view->setFlash(i18n("Slot complete"));
          $this->view->redirect("activities", "slotsControl");

        }
    }


    public function unreserve()
    {
        $this->activityMapper->unReserve($_SESSION["userId"], $_POST["activityId"]);
        $this->view->redirect("activities", "slotsControl");
    }
}

?>
