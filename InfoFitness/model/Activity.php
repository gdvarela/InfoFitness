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
    private $startTime;
    private $endTime;
    private $date;
    private $period;

    public function __construct($id=NULL, $activityname=NULL, $max_assis=NULL, $description=NULL, $price=NULL, $place=NULL,
                                $monitor=NULL, $startTime=NULL, $endTime=NULL, $date=NULL, $period=NULL) {
        $this->id = $id;
        $this->activityName = $activityname;
        $this->max_assis = $max_assis;
        $this->description = $description;
        $this->price = $price;
        $this->place = $place;
        $this->monitor = $monitor;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->date = $date;
        $this->period = $period;
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

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setPeriod($period)
    {
        $this->period = $period;
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

        if (strlen($this->activityName) > 10) {
            $errors["activityName"] = "Activity Name length must be max 100 characters length";
        }

        if (sizeof($errors)> 0){
            throw new ValidationException($errors, "Activity is not valid");
        }
    }
}