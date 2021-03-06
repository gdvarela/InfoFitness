<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/Table.php");
require_once(__DIR__ . "/../model/TableMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class TablesController extends BaseController
{

    private $tableMapper;
    private $newTable;

    public function __construct()
    {
        parent::__construct();

        $this->tableMapper = new TableMapper();
        $this->newTable = new Table();
        // Users controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("default");
    }

    public function listWorkouts()
    {

        $workouts = $this->tableMapper->listWorkouts();
        $this->view->setVariable("workouts", $workouts);
        $this->view->setVariable("newWorkout", $this->newTable);
        $this->view->setVariable("title", "Workout");
        $this->view->render("workouts", "list");
    }

    public function listTables()
    {
        $tables = $this->tableMapper->listTables();
        $this->view->setVariable("tables", $tables);
        $this->view->setVariable("newTable", $this->newTable);
        $this->view->setVariable("title", "Tables Management");
        $this->view->render("tables", "list");
    }

    public function details()
    {
        $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
        $exercisesTable = $this->tableMapper->fechExercisesSimpleTable($_REQUEST["tableId"]);
        $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
        $this->view->setVariable("tables", $tables);
        $this->view->setVariable("newTable", $this->newTable);
        $this->view->setVariable("exercisesTable", $exercisesTable);
        $this->view->setVariable("exercises", $exercises);
        $this->view->render("tables", "details");
    }

    public function detailsPublic()
    {
        $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
        $exercisesTable = $this->tableMapper->fechExercisesTable($_REQUEST["tableId"]);
        $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
        $this->view->setVariable("tables", $tables);
        $this->view->setVariable("newTable", $this->newTable);
        $this->view->setVariable("exercisesTable", $exercisesTable);
        $this->view->setVariable("exercises", $exercises);
        $this->view->render("workouts", "details");
    }

    public function detailsAdd()
    {
        if (isset($_POST["exerciseId"])) {
            $this->tableMapper->addExercise($_POST["exerciseId"], $_POST["tableId"],$_POST["charge"],$_POST["repetitions"] );
            $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
            $exercisesTable = $this->tableMapper->fechExercisesSimpleTable($_REQUEST["tableId"]);
            $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
            $this->view->setVariable("tables", $tables);
            $this->view->setVariable("newTable", $this->newTable);
            $this->view->setVariable("exercisesTable", $exercisesTable);
            $this->view->setVariable("exercises", $exercises);
            $this->view->render("tables", "details");
            //$this->view->redirect("tables", "details");
        } else {
            throw new Exception("add only form POST");
        }
    }

    public function detailsDelete()
    {
        if (isset($_POST["exerciseId"])) {
            $this->tableMapper->deleteExecise($_POST["exerciseId"], $_POST["tableId"]);
            $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
            $exercisesTable = $this->tableMapper->fechExercisesSimpleTable($_REQUEST["tableId"]);
            $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
            $this->view->setVariable("tables", $tables);
            $this->view->setVariable("newTable", $this->newTable);
            $this->view->setVariable("exercisesTable", $exercisesTable);
            $this->view->setVariable("exercises", $exercises);
            $this->view->render("tables", "details");
        } else {
            throw new Exception("delete only form POST");
        }
    }

    public function modify()
    {

        if (isset($_POST["tableId"])) {
            $table = new Table($_POST["tableId"], $_POST["tableName"], $_POST["tableDes"]);
            $this->tableMapper->update($table);
            $this->view->redirect("tables", "listTables");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function add()
    {
        if (isset($_POST["tableName"])) {
            $this->newTable->changeTable($_POST["tableName"], $_POST["tableDes"]);
            $this->tableMapper->save($this->newTable);
            $this->view->redirect("tables", "listTables");
        } else {
            throw new Exception("add only form POST");
        }
    }

    public function delete()
    {

        if (isset($_POST["tableId"])) {
            $this->tableMapper->delete($_POST["tableId"]);
            $this->view->redirect("tables", "listTables");
        } else {
            throw new Exception("delete only form POST");
        }
    }

    public function assign()
    {
            $usersOnTable = $this->tableMapper->fechUsersTable($_REQUEST["tableId"]);
            $usersNotOnTable = $this->tableMapper->fechUsers($_REQUEST["tableId"]);
            $table = $this->tableMapper->fechTable($_REQUEST["tableId"]);

            $this->view->setVariable("table", $table);
            $this->view->setVariable("usersTable", $usersOnTable);
            $this->view->setVariable("usersNotOnTable", $usersNotOnTable);
            $this->view->render("tables", "assign");
    }

    public function addUser()
    {
        if (isset($_POST["tableId"])) {
            $add_user = $this->tableMapper->addUser($_POST["users"], $_POST["tableId"]);
            if($add_user){
              $this->view->redirect("tables", "assign", "tableId=".$_POST["tableId"]);
            }
            else{
              $this->view->setFlash(sprintf(i18n("Table does not contain exercises.")));
              $this->view->redirect("tables", "assign", "tableId=".$_POST["tableId"]);
            }

        } else {
            throw new Exception("add only form POST");
        }
    }

    public function deleteUser()
    {
        if (isset($_POST["tableId"])) {
            $this->tableMapper->deleteUser($_POST["users"], $_POST["tableId"]);
            $this->view->redirect("tables", "assign", "tableId=".$_POST["tableId"]);
        } else {
            throw new Exception("delete only form POST");
        }
    }


    public function addcomment()
    {
      echo $_POST["tableID"];

       if($_POST["tableID"] && $_POST["exerciseID"] && $_POST["deporID"]){
         $this->tableMapper->addcomment($_POST["tableID"],$_POST["exerciseID"],$_POST["deporID"],$_POST["commentExercise"]);
         $this->view->redirect("tables", "detailsPublic", "tableId=".$_POST["tableID"]);
       }
    }
}

?>
