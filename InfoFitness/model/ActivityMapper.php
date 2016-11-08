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
            array_push($activities, new Activity($activity["id_actividad"], $activity["nombre"], $activity["max_asistentes"], $activity["descricion"],
                $activity["precio"], $activity["lugar"], $activity["monitor"]));
        }

        return $activities;
    }

    public function save($activity) {
        $stmt = $this->db->prepare("INSERT INTO Actividad (nombre, max_asistentes, descricion, precio, lugar) values(?,?,?,?,?)");
        $stmt->execute(array($activity->getActivityName(), $activity->getMaxAssistants(), $activity->getDescription(),
            $activity->getPrice(), $activity->getPlace()));
    }

    public function update($activity) {
        $stmt = $this->db->prepare("UPDATE Actividad set nombre=?, max_asistentes=?, descricion=?, precio=?,
            lugar=?  where id_actividad=?");
        $stmt->execute(array($activity->getActivityName(), $activity->getMaxAssistants(), $activity->getDescription(),
            $activity->getPrice(), $activity->getPlace(), $activity->getId()));
    }

    public function delete($activityId) {
        $stmt = $this->db->prepare("DELETE FROM Actividad WHERE id_actividad=?");
        $stmt->execute(array($activityId));
    }
}