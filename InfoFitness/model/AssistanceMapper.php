<?php

require_once(__DIR__."/../core/PDOConnection.php");

class AssistanceMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function checkAssistance($idActividad, $users, $date) {

        $stmt = $this->db->prepare("INSERT INTO Asistencia (id_actividad, fecha, id_usuario) VALUES (?,?,?)");

        foreach ($users as $user):
            $stmt->execute(array($idActividad, $date, $user));
        endforeach;
    }
}