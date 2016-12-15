<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/StaticticsActivity.php");

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
        $stmt = $this->db->query("SELECT nombre, id_entrenador FROM Monitor, Usuario WHERE Monitor.id_usuario = Usuario.id_usuario");
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
              WHERE Reserva.id_deportista=$depor");
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

    public function getAssistanceStatictics() {

	    $stmt = $this->db->query("SELECT Actividad.nombre, count(Sesion.id_actividad) as num
                                 FROM Sesion,Actividad,Usuario
                                 WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                       Usuario.id_usuario = Sesion.id_usuario
                                 GROUP BY Actividad.nombre");

        $stmt1 = $this->db->query("SELECT distinct(Actividad.nombre), count(Sesion.id_actividad) as num, AVG(YEAR(CURDATE())-YEAR(Usuario.fecha_nacimiento))  AS media_edad
                                   FROM Sesion,Actividad,Usuario
                                   WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                         Usuario.id_usuario = Sesion.id_usuario AND
                                         Usuario.sexo='mujer' AND Sesion.id_actividad >= 0 or Sesion.id_actividad is null
                                   GROUP BY Actividad.nombre");

      $total_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		  $total_num_women = $stmt1->fetchAll(PDO::FETCH_ASSOC);

      $women_percent = array();
      $men_percentage = array();
      $statictics = array();

      foreach ($total_users as $keyu) {
        foreach($total_num_women as $keyw){
          if($keyu['nombre'] == $keyw['nombre'])
            if($keyw['num'] > 0){
              $women_percent['wa'][$keyu['nombre']] = round(($keyw['num']/$keyu['num'])*100) . "%";
              $men_percentage['ma'][$keyu['nombre']] = round((100-($keyw['num']/$keyu['num'])*100)) . "%";
            }else{
              $women_percent['wa'][$keyu['nombre']] = 0 ."%";
              $men_percentage['ma'][$keyu['nombre']] = 100-0 ."%";
            }
        }

      }

      foreach ($women_percent as $key => $value) {
          foreach ($value as $key1 => $value1) {
            foreach ($men_percentage as $key2 => $value2) {
                foreach ($value2 as $key3 => $value3) {
                  if($key1 == $key3){
                  array_push($statictics, new StaticticsActivity($activity = $key1, $women_percent=$value1,$men_percent=$value3));
                  }
                }

            }
         }

      }
        return $statictics;
    }

    public function getAgeStatictics() {

          $stmt = $this->db->query("SELECT distinct(Actividad.nombre), AVG(YEAR(CURDATE())-YEAR(Usuario.fecha_nacimiento))  AS media_edad
                                     FROM Sesion,Actividad,Usuario
                                     WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                           Usuario.id_usuario = Sesion.id_usuario AND
                                           Usuario.sexo='mujer'
                                     GROUP BY Actividad.nombre");
         $stmt1 = $this->db->query("SELECT distinct(Actividad.nombre), AVG(YEAR(CURDATE())-YEAR(Usuario.fecha_nacimiento))  AS media_edad
                                    FROM Sesion,Actividad,Usuario
                                    WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                          Usuario.id_usuario = Sesion.id_usuario AND
                                          Usuario.sexo='hombre'
                                    GROUP BY Actividad.nombre");

        $avg_women_age = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $avg_men_age = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $age_statictics_men = array();
        $age_statictics_women = array();
        $age_statictics = array();

        foreach ($avg_women_age as $key => $value) {
            foreach ($avg_men_age as $key2 => $value2) {
              if ($value['nombre'] == $value2['nombre']){
                $age_statictics_men['ma'][$value['nombre']] =round($value2['media_edad']);
                $age_statictics_women['wa'][$value['nombre']] =round($value['media_edad']);
              }
          }
       }

       foreach ($age_statictics_men as $key => $value) {
           foreach ($value as $key1 => $value1) {
             foreach ($age_statictics_women as $key2 => $value2) {
                 foreach ($value2 as $key3 => $value3) {
                   if($key1 == $key3){
                   array_push($age_statictics, new StaticticsActivity($activity = $key1, $women_percent=null,$men_percent=null,$avg_women_age = $value3, $avg_men_age = $value1));
                   }
                 }

             }
          }

       }

          return $age_statictics;
    }

}
