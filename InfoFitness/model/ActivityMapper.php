<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ActivityMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function listActivities() {
        $stmt = $this->db->query("SELECT * FROM Actividad");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $activities = array();

        foreach ($list_db as $activity) {
            array_push($activities, new Activity($activity["nombre"], $activity["max_asistentes"], $activity["descricion"],
                $activity["precio"], $activity["lugar"], $activity["monitor"]));
        }

        return $activities;
    }
}