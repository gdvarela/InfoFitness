<?php

require_once(__DIR__."/../core/ValidationException.php");

class Exercise{
  private $id;
  private $exerciseName;
  private $machine;
  private $description;
  private $dificulty;
  private $media;
  private $muscleGroup;

  public function __construct($id=NULL, $exercisename=NULL, $description=NULL, $dificulty=NULL, $musclegroup=NULL, $media=NULL, $machine=NULL) {
      $this->id = $id;
      $this->exerciseName = $exercisename;
      $this->machine = $machine;
      $this->description = $description;
      $this->dificulty = $dificulty;
      $this->media = $media;
      $this->muscleGroup = $musclegroup;
  }

  public function getId()
  {
      return $this->id;
  }

  public function getExerciseName()
  {
      return $this->exerciseName;
  }

  public function setExerciseName($exerciseName)
  {
      $this->exerciseName = $exerciseName;
  }

  public function getMachine()
  {
      return $this->machine;
  }

  public function setMachine($machine)
  {
      $this->machine = $machine;
  }

  public function getDescription()
  {
      return $this->description;
  }

  public function setDescription($description)
  {
      $this->description = $description;
  }

  public function getDificulty()
  {
      return $this->dificulty;
  }

  public function setdificulty($dificulty)
  {
      $this->dificulty = $dificulty;
  }

  public function getMedia()
  {
      return $this->media;
  }

  public function setMedia($media)
  {
      $this->media = $media;
  }

  public function getMuscleGroup()
  {
      return $this->muscleGroup;
  }

  public function setMuscleGroup($muscleGroup)
  {
      $this->muscleGroup = $muscleGroup;
  }

  public function changeExercise($exercisename=NULL, $description=NULL, $dificulty=NULL, $musclegroup=NULL, $media=NULL, $machine=NULL) {
      $this->exerciseName = $exercisename;
      $this->machine = $machine;
      $this->description = $description;
      $this->dificulty = $dificulty;
      $this->media = $media;
      $this->muscleGroup = (integer) $musclegroup;
  }

}


 ?>
