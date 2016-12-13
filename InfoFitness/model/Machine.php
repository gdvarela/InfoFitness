<?php

require_once(__DIR__."/../core/ValidationException.php");


class Machine {

    private $id;
    private $name;
    private $description;

    public function __construct($id=NULL, $name=NULL, $description=NULL) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function changeMachine($name=NULL, $description=NULL) {
        $this->name = $name;
        $this->description = $description;
    }

    public function checkValidForAdd() {

        $errors = array();

        if (strlen($this->name) > 10) {
            $errors["machineName"] = "Machine Name length must be max 100 characters length";
        }

        if (sizeof($errors)> 0){
            throw new ValidationException($errors, "Machine is not valid");
        }
    }
}