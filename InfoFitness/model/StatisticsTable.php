<?php

require_once(__DIR__."/../core/ValidationException.php");


class StatisticsTable {

    private $table;
    private $table_percent;

    public function __construct($table = NULL, $table_percent=NULL) {
        $this->table = $table;
        $this->table_percent = $table_percent;
    }

    public function getTableName()
    {
        return $this->table;
    }

    public function setTableName($table)
    {
        $this->table = $table;
    }


    public function getTablePercent()
    {
        return $this->table_percent;
    }

    public function setTablePercent($table_percent)
    {
        return $this->table_percent = $table_percent;
    }

}
