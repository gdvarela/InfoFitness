<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/Machine.php");
require_once(__DIR__ . "/../model/MachineMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

class MachinesController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->machineMapper = new MachineMapper();
        $this->newMachine = new Machine();

        $this->view->setLayout("default");
    }

    public function listMachines()
    {
        $machines = $this->machineMapper->listMachines();
        $this->view->setVariable("machines", $machines);

        $this->view->setVariable("newMachine", $this->newMachine);

        if (!empty($this->errors)) {
            $this->view->setVariable("errors", $this->errors);
            $this->errors = null;
        }

        $this->view->setVariable("title", "Machines Management");
        $this->view->render("machines", "list");
    }

    public function modify()
    {

        if (isset($_POST["machineId"])) {
            $machine = new Machine($_POST["machineId"], $_POST["machineName"], $_POST["description"]);

            $this->machineMapper->update($machine);

            $this->view->redirect("machines", "listMachines");
        } else {
            throw new Exception("modify only form POST");
        }
    }

    public function delete()
    {

        if (isset($_POST["machineId"])) {
            $this->machineMapper->delete($_POST["machineId"]);
            $this->view->redirect("machines", "listMachines");
        } else {
            throw new Exception("delete only form POST");
        }
    }

    public function add()
    {

        if (isset($_POST["machineName"])) {
            $this->newMachine->changeMachine($_POST["machineName"], $_POST["description"]);

            try {
                $this->newMachine->checkValidForAdd();
                $this->machineMapper->save($this->newMachine);
                $this->newMachine = null;
                $this->view->redirect("machines", "listMachines");
            } catch (ValidationException $ex) {
                $this->errors = $ex->getErrors();
            }
        } else {
            throw new Exception("add only form POST");
        }
    }
}