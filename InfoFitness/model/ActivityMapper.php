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
        $stmt = $this->db->query("SELECT nombre, id_entrenador FROM Monitor, Usuario WHERE Monitor.id_usuario = usuario.id_usuario");
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

    public function listReservedActivities($user) {
        $depor = $this->getDeporId($user);
        $stmt = $this->db->query("SELECT * FROM Actividad LEFT JOIN Reserva ON Actividad.id_actividad=Reserva.id_actividad
              WHERE Reserva.id_deportista=$depor GROUP BY Actividad.id_actividad");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $activities = array();

        foreach ($list_db as $activity) {
            array_push($activities, new Activity($activity["id_actividad"], $activity["nombre"], $activity["max_asistentes"],
                $activity["descripcion"], $activity["precio"], $activity["lugar"], $activity["monitor"], $activity["hora_ini"],
                $activity["hora_fin"], $activity["dia"]));
        }

        return $activities;
    }

    public function listUnreservedActivities($user) {
        $depor = $this->getDeporId($user);
        $stmt = $this->db->query("SELECT * FROM Actividad where id_actividad NOT IN (SELECT id_actividad FROM Reserva where id_deportista=$depor)");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $activities = array();

        foreach ($list_db as $activity) {
            array_push($activities, new Activity($activity["id_actividad"], $activity["nombre"], $activity["max_asistentes"],
                $activity["descripcion"], $activity["precio"], $activity["lugar"], $activity["monitor"], $activity["hora_ini"],
                $activity["hora_fin"], $activity["dia"]));
        }

        return $activities;
    }

    public function reserve($user, $activityID) {
        $depor = $this->getDeporId($user);
        $stmt = $this->db->prepare("INSERT INTO Reserva (id_actividad, id_deportista) values(?,?)");
        $stmt->execute(array($activityID, $depor));
    }

    public function unReserve($user, $activityID) {
        $depor = $this->getDeporId($user);
        $stmt = $this->db->prepare("DELETE FROM Reserva WHERE id_actividad=? AND id_deportista=?");
        $stmt->execute(array($activityID, $depor));
    }

    public function getMaxAssistants($activityId) {
      $stmt = $this->db->query("SELECT max_asistentes FROM Actividad WHERE id_actividad=$activityId");
      $max_assistans = $stmt->fetchColumn();
      return $max_assistans;
    }

    public function getAssistants($activityId) {
      $stmt = $this->db->query("SELECT count(*) FROM Reserva WHERE id_actividad=$activityId");
      $assistans = $stmt->fetchColumn();
      return $assistans;
    }

    public function listUsersOnActivity($activity) {
        $stmt = $this->db->query("SELECT * FROM Usuario, Reserva, Deportista where Deportista.id_deportista = Reserva.id_deportista
              AND Usuario.id_usuario = Deportista.id_usuario AND id_actividad=$activity");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($list_db as $user) {
            array_push($users, new User($user["id_usuario"], $user["login"], NULL , $user["nombre"], $user["apellidos"], $user["dni"],
                $user["fecha_nacimiento"], $user["permisos"], $user["mail"], $user["telefono"], $user["tipo_tarjeta"], $user["comentario"], NULL));
        }

        return $users;
    }

    public function getDeporId($user) {
        $stmt = $this->db->query("SELECT * FROM Deportista WHERE id_usuario=$user");
        $depor = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $depor[0]['id_deportista'];
    }
}
