<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class TableMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function listTables()
    {
        $stmt = $this->db->query("SELECT * FROM Tabla_Ejercicios ");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tables = array();

        foreach ($list_db as $table) {
            array_push($tables, new Table($table["id_tabla"], $table["nombre"], $table["descripcion"]));
        }

        return $tables;
    }

    public function listWorkouts()
    {
        $id = $_SESSION["userId"];
        $stmt = $this->db->query("select te.id_tabla, nombre, descripcion from Tabla_Ejercicios_Deportista as ted, Tabla_Ejercicios as te, Deportista as de
            where de.id_usuario = $id and de.id_deportista = ted.id_deportista and ted.id_tabla=te.id_tabla
            ");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $workouts = array();

        foreach ($list_db as $workout) {
            array_push($workouts, new Table($workout["id_tabla"], $workout["nombre"], $workout["descripcion"]));
        }

        return $workouts;

    }

    public function fechTable($id_tabla)
    {
        $stmt = $this->db->prepare("SELECT * FROM Tabla_Ejercicios WHERE id_tabla=?");
        $stmt->execute(array($id_tabla));
        $table = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($table != null) {
            return new Table($table["id_tabla"], $table["nombre"], $table["descripcion"]);
        }
    }

    public function fechExercisesTable($id_tabla)
    {
        $stmt = $this->db->prepare("SELECT Ejercicio.nombre, Ejercicio.descripcion,Ejercicio.grupo_muscular, Ejercicio.dificultad, Ejercicio.multimedia, Maquina.nombre as maquina, Ejercicio.id_ejercicio FROM Tabla_Ejercicios_Detalles, Ejercicio, Maquina
                WHERE  Tabla_Ejercicios_Detalles.id_ejercicio=Ejercicio.id_ejercicio and Ejercicio.maquina = Maquina.idMaquina and Tabla_Ejercicios_Detalles.id_tabla=?");
        $stmt->execute(array($id_tabla));
        $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($exercises != null) {
            return $exercises;
        }
    }

    public function fechExercises($id_tabla)
    {
        $stmt = $this->db->prepare("SELECT Ejercicio.nombre,Ejercicio.id_ejercicio FROM Ejercicio
                                   WHERE  Ejercicio.id_ejercicio not in (SELECT Tabla_Ejercicios_Detalles.id_ejercicio
                                                     FROM Tabla_Ejercicios_Detalles
                                                     WHERE Tabla_Ejercicios_Detalles.id_tabla = ?)");
        $stmt->execute(array($id_tabla));
        $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($exercises != null) {
            return $exercises;
        }
    }

    public function fechUsersTable($id_tabla)
    {
        $stmt = $this->db->prepare("select Usuario.id_usuario, Usuario.nombre, Usuario.apellidos from Usuario, Deportista, Tabla_Ejercicios_Deportista
          where Deportista.id_deportista = Tabla_Ejercicios_Deportista.id_deportista and
          Usuario.id_usuario = Deportista.id_usuario and Tabla_Ejercicios_Deportista.id_tabla = ?
          ");
        $stmt->execute(array($id_tabla));
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($list_db as $user) {
            array_push($users, new User($user["id_usuario"], NULL, NULL , $user["nombre"], $user["apellidos"], NULL,
                NULL, NULL, NULL, NULL, NULL, NULL, NULL));
        }

        return $users;
    }

    public function fechUsers($id_tabla)
    {
        $stmt = $this->db->prepare("select Usuario.id_usuario, Usuario.nombre, Usuario.apellidos from Usuario
            where Usuario.id_usuario not in
            (select Deportista.id_usuario from Deportista, Tabla_Ejercicios_Deportista
            where Deportista.id_deportista = Tabla_Ejercicios_Deportista.id_deportista and
             Tabla_Ejercicios_Deportista.id_tabla = ?) and Usuario.id_usuario in
            (select Deportista.id_usuario from Deportista)");
        $stmt->execute(array($id_tabla));
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($list_db as $user) {
            array_push($users, new User($user["id_usuario"], NULL, NULL , $user["nombre"], $user["apellidos"], NULL,
                NULL, NULL, NULL, NULL, NULL, NULL, NULL));
        }

        return $users;
    }

    public function addExercise($id_exercise, $id_tabla)
    {
        $stmt = $this->db->prepare("INSERT INTO Tabla_Ejercicios_Detalles (id_tabla,id_ejercicio) values(?,?)");
        $stmt->execute(array($id_tabla, $id_exercise));
    }

    public function deleteExecise($id_exercise, $id_tabla)
    {
        $stmt = $this->db->prepare("DELETE FROM Tabla_Ejercicios_Detalles WHERE id_ejercicio=? AND id_tabla=?");
        $stmt->execute(array($id_exercise, $id_tabla));
    }

    public function addUser($users, $id_tabla)
    {
        $stmt = $this->db->prepare("SELECT id_deportista FROM Deportista WHERE id_usuario = ?");
        $depors = array();
        foreach ($users as $user):
            $stmt->execute(array($user));
            array_push($depors, $stmt->fetch(PDO::FETCH_ASSOC));
        endforeach;
        $stmt = $this->db->prepare("INSERT INTO Tabla_Ejercicios_Deportista (id_tabla, id_deportista) values(?,?)");
        foreach ($depors as $depor):
            $stmt->execute(array($id_tabla, $depor["id_deportista"]));
        endforeach;
    }

    public function deleteUser($users, $id_tabla)
    {
        $stmt = $this->db->prepare("SELECT id_deportista FROM Deportista WHERE id_usuario = ?");
        $depors = array();
        foreach ($users as $user):
            $stmt->execute(array($user));
            array_push($depors, $stmt->fetch(PDO::FETCH_ASSOC));
        endforeach;
        $stmt = $this->db->prepare("DELETE FROM Tabla_Ejercicios_Deportista WHERE id_deportista=? and id_tabla=? ");
        foreach ($depors as $depor):
            $stmt->execute(array($depor["id_deportista"], $id_tabla));
        endforeach;
    }

    public function save($table)
    {
        $stmt = $this->db->prepare("INSERT INTO Tabla_Ejercicios (nombre, descripcion) values(?,?)");
        $stmt->execute(array($table->getTableName(), $table->getTableDes()));
    }

    public function update($table)
    {
        $stmt = $this->db->prepare("UPDATE Tabla_Ejercicios set nombre=?, descripcion=?  where id_tabla=?");
        $stmt->execute(array($table->getTableName(), $table->getTableDes(), $table->getId()));
    }

    public function delete($tableId)
    {
        $stmt = $this->db->prepare("DELETE FROM Tabla_Ejercicios WHERE id_tabla=?");
        $stmt->execute(array($tableId));
    }


}
