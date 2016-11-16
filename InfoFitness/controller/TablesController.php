<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class TablesController extends BaseController {

    private $tableMapper;
    private $newTable;

    public function __construct() {
        parent::__construct();

        $this->tableMapper = new TableMapper();
        $this->newTable = new Table();
        // Users controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("default");
    }
    public function listWorkouts() {

        $workouts = $this->tableMapper->listWorkouts();
        $this->view->setVariable("workouts", $workouts);
        $this->view->setVariable("newWorkout", $this->newTable);
        $this->view->render("workouts", "list");
    }

    public function listTables() {
        $tables = $this->tableMapper->listTables();
        $this->view->setVariable("tables", $tables);
        $this->view->setVariable("newTable", $this->newTable);
        $this->view->render("tables", "list");
    }

    public function details() {
          $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
          $exercisesTable = $this->tableMapper->fechExercisesTable($_REQUEST["tableId"]);
          $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
          $this->view->setVariable("tables", $tables);
          $this->view->setVariable("newTable", $this->newTable);
          $this->view->setVariable("exercisesTable", $exercisesTable);
          $this->view->setVariable("exercises", $exercises);
          $this->view->render("tables", "details");
    }
    public function detailsPublic() {
          $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
          $exercisesTable = $this->tableMapper->fechExercisesTable($_REQUEST["tableId"]);
          $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
          $this->view->setVariable("tables", $tables);
          $this->view->setVariable("newTable", $this->newTable);
          $this->view->setVariable("exercisesTable", $exercisesTable);
          $this->view->setVariable("exercises", $exercises);
          $this->view->render("tables", "details_public");
    }

    public function detailsAdd() {
      if(isset($_POST["exerciseId"])) {
          $this->tableMapper->addExercise($_POST["exerciseId"],$_POST["tableId"]);
          $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
          $exercisesTable = $this->tableMapper->fechExercisesTable($_REQUEST["tableId"]);
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

    public function detailsDelete() {
      if(isset($_POST["exerciseId"])) {
          $this->tableMapper->deleteExecise($_POST["exerciseId"],$_POST["tableId"]);
          $tables = $this->tableMapper->fechTable($_REQUEST["tableId"]);
          $exercisesTable = $this->tableMapper->fechExercisesTable($_REQUEST["tableId"]);
          $exercises = $this->tableMapper->fechExercises($_REQUEST["tableId"]);
          $this->view->setVariable("tables", $tables);
          $this->view->setVariable("newTable", $this->newTable);
          $this->view->setVariable("exercisesTable", $exercisesTable);
          $this->view->setVariable("exercises", $exercises);
          $this->view->render("tables", "details");
          //$this->view->redirect("tables", "details");
      } else {
          throw new Exception("delete only form POST");
      }
    }

    public function modify() {

        if(isset($_POST["tableId"])) {
            $table = new Table($_POST["tableId"],$_POST["tableName"], $_POST["tableDes"]);
            $this->tableMapper->update($table);
            $this->view->redirect("tables", "listTables");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function add() {
        if(isset($_POST["tableId"])) {
            $this->newTable->changeTable($_POST["tableName"], $_POST["tableDes"]);
            $this->tableMapper->save($this->newTable);
            $this->view->redirect("tables", "listTables");
        } else {
            throw new Exception("add only form POST");
        }
    }

    public function delete() {

        if(isset($_POST["tableId"])) {
            $this->tableMapper->delete($_POST["tableId"]);
            $this->view->redirect("tables", "listTables");
        } else {
            throw new Exception("delete only form POST");
        }
    }
}
?>
