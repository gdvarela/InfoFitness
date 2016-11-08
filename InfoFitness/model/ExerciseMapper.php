<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ExerciseMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function listExercises() {
        $stmt = $this->db->query("SELECT * FROM Ejercicio");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exercises = array();

        foreach ($list_db as $exercise) {
            array_push($exercises, new Exercise($exercise["id_ejercicio"], $exercise["nombre"], $exercise["descripcion"],
                $exercise["dificultad"], $exercise["grupo_muscular"], $exercise["multimedia"], $exercise["maquina"]));
        }

        return $exercises;
    }

    public function save($exercise) {
        $stmt = $this->db->prepare("INSERT INTO Ejercicio (nombre, descripcion, dificultad, grupo_muscular, multimedia, maquina) values(?,?,?,?,?,?)");
        $stmt->execute(array($exercise->getExerciseName(), $exercise->getDescription(), $exercise->getDificulty(),
            $exercise->getMuscleGroup(), $exercise->getMedia(), $exercise->getMachine()));
    }

    public function update($exercise) {
        $stmt = $this->db->prepare("UPDATE Ejercicio set nombre=?, descripcion=?, dificultad=?, grupo_muscular=?,
            multimedia=?, maquina=?  where id_ejercicio=?");
        $stmt->execute(array($exercise->getExerciseName(), $exercise->getDescription(), $exercise->getDificulty(),
            $exercise->getMuscleGroup(), $exercise->getMedia(), $exercise->getMachine(), $exercise->getId()));
    }

    public function delete($exerciseId) {
        $stmt = $this->db->prepare("DELETE FROM Ejercicio WHERE id_ejercicio=?");
        $stmt->execute(array($exerciseId));
    }

}
 ?>
