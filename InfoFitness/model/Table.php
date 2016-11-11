<?php

require_once(__DIR__."/../core/ValidationException.php");


class Table {

    private $id;
    private $tableName;
    private $tableDes;




    public function __construct($id=NULL,$tableName=NULL, $tableDes=NULL) {
        $this->id = $id;
        $this->tableName = $tableName;
        $this->tableDes = $tableDes;

    }

    public function getId()
    {
        return $this->id;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }


    public function getTableDes()
    {
        return $this->tableDes;
    }

    public function setTableDes($tableDes)
    {
        $this->tableDes = $tableDes;
    }

    public function changeTable($tableName=NULL,$tableDes=NULL) {
        $this->tableName = $tableName;
        $this->tableDes = $tableDes;

    }
}
