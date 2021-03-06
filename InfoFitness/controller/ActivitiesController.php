<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/Activity.php");
require_once(__DIR__ . "/../model/ActivityMapper.php");
require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserMapper.php");
require_once(__DIR__ . "/../model/SessionMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class ActivitiesController extends BaseController
{

    private $activityMapper;
    private $userMapper;
    private $newActivity;
    private $sessionMapper;

    private $errors = array();

    public function __construct()
    {
        parent::__construct();

        $this->activityMapper = new ActivityMapper();
        $this->userMapper = new UserMapper();
        $this->sessionMapper = new SessionMapper();
        $this->newActivity = new Activity();

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
        $this->view->setVariable("title", "Activities Management");
        $this->view->render("activities", "list");
    }

    public function modify()
    {

        if (isset($_POST["activityId"])) {
            $activity = new Activity($_POST["activityId"], $_POST["activityName"], $_POST["activityMaxAssis"],
                $_POST["activityDes"], $_POST["activityPrice"], $_POST["activityPlace"], $_POST["monitor"], $_POST["startTime"],
                $_POST["endTime"], $_POST["day"]);

            try {
                $activity->checkValidForAdd();
                $this->activityMapper->update($activity);
                $this->view->redirect("activities", "listActivities");
            } catch (ValidationException $ex) {
                $this->errors = $ex->getErrors();
            }
            $this->listActivities();

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
        if (isset($_POST["activityId"])) {

            $users = $this->activityMapper->listUsersOnActivity($_POST["activityId"]);

            $this->view->setVariable("users", $users);
            $this->view->setVariable("activityId", $_POST["activityId"]);
            $this->view->setVariable("activityName", $_POST["activityName"]);
            $this->view->setVariable("date", $_POST["date"]);
            $this->view->setVariable("activityPlace", $_POST["place"]);
            $this->view->setVariable("title", "Assistance Control");
            $this->view->render("activities", "checkAssistance");
        } else {
            $activities = $this->activityMapper->listActivities();
            $monitors = $this->activityMapper->listMonitors();

            $this->view->setVariable("monitors", $monitors);
            $this->view->setVariable("activities", $activities);
            $this->view->setVariable("title", "Assistance Control");
            $this->view->render("activities", "assistanceControl");
        }
    }

    public function checkAssistance()
    {
        if(isset($_POST["activityId"])) {
            $this->sessionMapper->checkAssistance($_POST["activityId"], $_POST["users"], $_POST["date"], $_POST["activityName"]);

            $this->view->redirect("activities", "assistanceControl");
        } else {
            $users = $this->userMapper->listarDeportista();

            $this->view->setVariable("users", $users);
            $this->view->render("activities", "checkAssistance");
        }
    }

    public function slotsControl()
    {
        $unreservedActivities = $this->activityMapper->listUnreservedActivities($_SESSION["userId"]);
        $reservedActivities = $this->activityMapper->listReservedActivities($_SESSION["userId"]);

        $this->view->setVariable("unreservedActivities", $unreservedActivities);
        $this->view->setVariable("reservedActivities", $reservedActivities);

        $this->view->setVariable("title", "Reserve Activities");
        $this->view->render("activities", "slots");

    }

    public function reserve()
    {
        $max_assis = $this->activityMapper->getMaxAssistants($_POST["activityId"]);
        $assis = $this->activityMapper->getAssistants($_POST["activityId"]);

        if ($max_assis > $assis) {

            $this->activityMapper->reserve($_SESSION["userId"], $_POST["activityId"]);
            $this->view->redirect("activities", "slotsControl");

        } else {

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
