<?php

require_once(__DIR__."/../core/ValidationException.php");


class Activity {

    private $activityName;
    private $max_assis;
    private $description;
    private $price;
    private $place;
    private $monitor;

    public function __construct($activityname=NULL, $max_assis=NULL, $description=NULL, $price=NULL, $place=NULL, $monitor=NULL) {
        $this->activityName = $activityname;
        $this->max_assis = $max_assis;
        $this->description = $description;
        $this->price = $price;
        $this->place = $place;
        $this->monitor = $monitor;
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
}