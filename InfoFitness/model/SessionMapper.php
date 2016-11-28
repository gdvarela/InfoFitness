<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class SessionMapper
{
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function listSessions()
    {
        $id = $_SESSION["userId"];
        $stmt = $this->db->query("SELECT id_sesion, id_usuario, fecha, comentario, (case
            when Sesion.id_actividad is not null
            then Actividad.descripcion else Tabla_Ejercicios.descripcion
            end) as descripcion FROM Sesion, Tabla_Ejercicios, Actividad
            where id_usuario=$id and (Sesion.id_actividad = Actividad.id_actividad or Sesion.id_tabla = Tabla_Ejercicios.id_tabla)
            order by fecha desc;");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sessions = array();
        foreach ($list_db as $session) {
            array_push($sessions, new Session($session["id_sesion"], $session["fecha"], $session["id_usuario"],
                $session["comentario"], $session["descripcion"]));
        }

        return $sessions;

    }

    public function save($session)
    {
        $stmt = $this->db->prepare("INSERT INTO Sesion (fecha, id_usuario, comentario, id_tabla) values(?,?,?,?)");
        $stmt->execute(array($session->getFecha(), $session->getUsuario(), $session->getComentario(), $session->getTabla()));
    }

    public function checkAssistance($idActividad, $users, $date, $activityName)
    {

        $stmt = $this->db->prepare("INSERT INTO Sesion (id_actividad, fecha, id_usuario, comentario) VALUES (?,?,?,?)");

        foreach ($users as $user):
            $stmt->execute(array($idActividad, $date, $user, $activityName));
        endforeach;
    }
}

?>
