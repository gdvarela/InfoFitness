<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Exercise.php");
require_once(__DIR__."/../model/ExerciseMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ExercisesController extends BaseController {

  private $exerciseMapper;
  private $newExercise;

  public function __construct() {
      parent::__construct();

      $this->exerciseMapper = new exerciseMapper();
      $this->newExercise = new Exercise();
      // Users controller operates in a "welcome" layout
      // different to the "default" layout where the internal
      // menu is displayed
      $this->view->setLayout("default");
  }
  public function listExercises() {

      $exercises = $this->exerciseMapper->listExercises();
      $this->view->setVariable("exercises", $exercises);

      $this->view->setVariable("newExercise", $this->newExercise);

      $this->view->render("exercises", "list");
  }

  public function modify() {

      if(isset($_POST["exerciseId"])) {
          $exercise = new Exercise($_POST["exerciseId"], $_POST["exerciseName"], $_POST["exerciseDes"], $_POST["exerciseDificulty"],
                $_POST["exerciseMuscleGroup"], $_POST["exerciseMedia"], $_POST["exerciseMachine"]);

          $this->exerciseMapper->update($exercise);

          $this->view->redirect("exercises", "listExercises");
      } else {
          throw new Exception("modify only form POST");
      }
  }

  public function delete() {

      if(isset($_POST["exerciseId"])) {
          $this->exerciseMapper->delete($_POST["exerciseId"]);
          $this->view->redirect("exercises", "listExercises");
      } else {
          throw new Exception("delete only form POST");
      }
  }

  public function add() {

      if(isset($_POST["exerciseName"])) {
          $this->newExercise->changeExercise($_POST["exerciseName"], $_POST["exerciseDes"], $_POST["exerciseDificulty"],
                $_POST["exerciseMuscleGroup"], $_POST["exerciseMedia"], $_POST["exerciseMachine"]);

          $this->exerciseMapper->save($this->newExercise);
          $this->view->redirect("exercises", "listExercises");
      } else {
          throw new Exception("add only form POST");
      }
  }

}

?>
