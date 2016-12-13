<?php

require_once(__DIR__."/../core/PDOConnection.php");

class MachineMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function listMachines() {
        $stmt = $this->db->query("SELECT * FROM Maquina");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $machines = array();

        foreach ($list_db as $machine) {
            array_push($machines, new Machine($machine["idMaquina"], $machine["nombre"],
                $machine["descripcion"]));
        }

        return $machines;
    }

    public function save($machine) {
        $stmt = $this->db->prepare("INSERT INTO Maquina (nombre, descripcion) values(?,?)");
        $stmt->execute(array($machine->getName(), $machine->getDescription()));
    }

    public function update($machine) {
        $stmt = $this->db->prepare("UPDATE Maquina set nombre=?, descripcion=? where idMaquina=?");
        $stmt->execute(array($machine->getName(), $machine->getDescription(), $machine->getId()));
    }

    public function delete($machineId) {
        $stmt = $this->db->prepare("DELETE FROM Maquina WHERE idMaquina=?");
        $stmt->execute(array($machineId));
    }
}