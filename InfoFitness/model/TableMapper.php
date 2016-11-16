<?php

require_once(__DIR__."/../core/PDOConnection.php");

class TableMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
}

    public function listTables() {
        $stmt = $this->db->query("SELECT * FROM tabla_ejercicios " );
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tables = array();

        foreach ($list_db as $table) {
            array_push($tables, new Table($table["id_tabla"],$table["nombre"], $table["descripcion"]));
        }

        return $tables;
    }
    public function listWorkouts() {
        $id=$_SESSION["userId"];
        $stmt = $this->db->query("SELECT * FROM tabla_ejercicios_deportista as ted, tabla_ejercicios as te
          WHERE id_deportista=$id and ted.id_tabla=te.id_tabla");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $workouts = array();

        foreach ($list_db as $workout) {
            array_push($workouts, new Table($workout["id_tabla"],$workout["nombre"], $workout["descripcion"]));
        }

        return $workouts;

    }

    public function fechTable($id_tabla) {
      $stmt = $this->db->prepare("SELECT * FROM tabla_ejercicios WHERE id_tabla=?");
      $stmt->execute(array($id_tabla));
      $table = $stmt->fetch(PDO::FETCH_ASSOC);

      if($table != null) {
        return new Table($table["id_tabla"],$table["nombre"],$table["descripcion"]);
      }
    }

    public function fechExercisesTable($id_tabla) {
      $stmt = $this->db->prepare("SELECT ejercicio.nombre, ejercicio.descripcion, ejercicio.id_ejercicio FROM tabla_ejercicios_detalles inner join ejercicio on
                                  tabla_ejercicios_detalles.id_ejercicio=ejercicio.id_ejercicio
                                   WHERE tabla_ejercicios_detalles.id_tabla=?");
      $stmt->execute(array($id_tabla));
      $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if($exercises != null) {
        return $exercises;
      }
    }

    public function fechExercises($id_tabla) {
      $stmt = $this->db->prepare("SELECT ejercicio.nombre,ejercicio.id_ejercicio FROM ejercicio
                                   WHERE  ejercicio.id_ejercicio not in (SELECT tabla_ejercicios_detalles.id_ejercicio
                                                     FROM tabla_ejercicios_detalles
                                                     WHERE tabla_ejercicios_detalles.id_tabla = ?)");
      $stmt->execute(array($id_tabla));
      $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if($exercises != null) {
        return $exercises;
      }
    }

    public function addExercise($id_exercise,$id_tabla) {
        $stmt = $this->db->prepare("INSERT INTO tabla_ejercicios_detalles (id_tabla,id_ejercicio) values(?,?)");
        $stmt->execute(array($id_tabla,$id_exercise));
    }

    public function deleteExecise($id_exercise,$id_tabla) {
      $stmt = $this->db->prepare("DELETE FROM tabla_ejercicios_detalles WHERE id_ejercicio=? AND id_tabla=?");
      $stmt->execute(array($id_exercise,$id_tabla));
    }

    public function save($table) {
        $stmt = $this->db->prepare("INSERT INTO tabla_ejercicios (nombre_tabla, descripcion) values(?,?)");
        $stmt->execute(array($table->getTableName(), $table->getTableDes()));
    }

    public function update($table) {
        $stmt = $this->db->prepare("UPDATE tabla_ejercicios set nombre_tabla=?, descripcion=?  where id_tabla=?" );
        $stmt->execute(array($table->getTableName(), $table->getTableDes(), $table->getId()));
    }

    public function delete($tableId) {
        $stmt = $this->db->prepare("DELETE FROM tabla_ejercicios WHERE id_tabla=?");
        $stmt->execute(array($tableId));
    }


}
