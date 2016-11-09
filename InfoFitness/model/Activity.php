<?php

require_once(__DIR__."/../core/ValidationException.php");


class Activity {

    private $id;
    private $activityName;
    private $max_assis;
    private $description;
    private $price;
    private $place;
    private $monitor;

    public function __construct($id=NULL, $activityname=NULL, $max_assis=NULL, $description=NULL, $price=NULL, $place=NULL, $monitor=NULL) {
        $this->id = $id;
        $this->activityName = $activityname;
        $this->max_assis = $max_assis;
        $this->description = $description;
        $this->price = $price;
        $this->place = $place;
        $this->monitor = $monitor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getActivityName()
    {
        return $this->activityName;
    }

    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;
    }

    public function getMaxAssistants()
    {
        return $this->max_assis;
    }

    public function setMaxAssistants($max_assis)
    {
        $this->max_assis = $max_assis;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function getMonitor()
    {
        return $this->monitor;
    }

    public function setMonitor($monitor)
    {
        $this->monitor = $monitor;
    }

    public function changeActivity($activityname=NULL, $max_assis=0, $description=NULL, $price=NULL, $place=NULL, $monitor=NULL) {
        $this->activityName = $activityname;
        $this->max_assis = (integer) $max_assis;
        $this->description = $description;
        $this->price = $price;
        $this->place = $place;
        $this->monitor = (integer) $monitor;
    }

    public function checkValidForAdd() {

        $errors = array();
//TODO
        if (strlen($this->activityName) > 10) {
            $errors["activityName"] = "Activity Name must be max 100 characters length";
        }

        if (sizeof($errors)> 0){
            throw new ValidationException($errors, "Activity is not valid");
        }
    }
}