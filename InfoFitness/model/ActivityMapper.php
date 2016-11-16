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
            array_push($activities, new Activity($activity["id_actividad"], $activity["nombre"], $activity["max_asistentes"],
                $activity["descripcion"], $activity["precio"], $activity["lugar"], $activity["monitor"], $activity["hora_ini"],
                $activity["hora_fin"], $activity["dia"]));
        }

        return $activities;
    }

    public function listMonitors() {
        $stmt = $this->db->query("SELECT nombre, id_entrenador FROM Monitor, usuario WHERE Monitor.id_usuario = usuario.id_usuario");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $list_db;
    }

    public function save($activity) {
        $stmt = $this->db->prepare("INSERT INTO Actividad (nombre, max_asistentes, descripcion, precio, lugar, monitor, hora_ini, hora_fin, dia) values(?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array($activity->getActivityName(), $activity->getMaxAssistants(), $activity->getDescription(),
            $activity->getPrice(), $activity->getPlace(), $activity->getMonitor(), $activity->getStartTime(), $activity->getEndTime(), $activity->getDay()));
    }

    public function update($activity) {
        $stmt = $this->db->prepare("UPDATE Actividad set nombre=?, max_asistentes=?, descripcion=?, precio=?,
            lugar=?, monitor=?, hora_ini=?, hora_fin=?, dia=?  where id_actividad=?");
        $stmt->execute(array($activity->getActivityName(), $activity->getMaxAssistants(), $activity->getDescription(),
            $activity->getPrice(), $activity->getPlace(), $activity->getMonitor(), $activity->getStartTime(),
            $activity->getEndTime(), $activity->getDay(), $activity->getId()));
    }

    public function delete($activityId) {
        $stmt = $this->db->prepare("DELETE FROM Actividad WHERE id_actividad=?");
        $stmt->execute(array($activityId));
    }
}
