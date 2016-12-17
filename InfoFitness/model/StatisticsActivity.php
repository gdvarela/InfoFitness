<?php

require_once(__DIR__."/../core/ValidationException.php");


class StatisticsActivity {

    private $activity;
    private $women_percent;
    private $men_percent;
    private $avg_women_age;
    private $avg_men_age;

    public function __construct($activity = NULL, $women_percent=NULL, $men_percent = NULL, $avg_women_age = NULL, $avg_men_age = NULL) {
        $this->activity = $activity;
        $this->women_percent = $women_percent;
        $this->men_percent = $men_percent;
        $this->avg_women_age = $avg_women_age;
        $this->avg_men_age = $avg_men_age;

    }

    public function getActivityName()
    {
        return $this->activity;
    }

    public function setActivityName($activity)
    {
        $this->activity = $activity;
    }

    public function getWomenPercent()
    {
        return $this->women_percent;
    }

    public function setWomenPercent($women_percent)
    {
        $this->women_percent = $womens_percent;
    }

    public function getMenPercent()
    {
        return $this->men_percent;
    }

    public function setMenPercent($men_percent)
    {
        $this->men_percent = $men_percent;
    }

    public function getAvgWomenAge()
    {
        return $this->avg_women_age;
    }

    public function setAvgWomenAge($avg_women_age)
    {
        return $this->avg_women_age = $avg_women_age;
    }

    public function getAvgMenAge()
    {
        return $this->avg_men_age;
    }

    public function setAvgMenAge($avg_men_age)
    {
        return $this->avg_men_age = $avg_men_age;
    }

}
