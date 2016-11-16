<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SessionMapper {
  private $db;

  public function __construct() {
      $this->db = PDOConnection::getInstance();
  }

public function listSessions() {
  $id=$_SESSION["userId"];
  $stmt = $this->db->query("SELECT * FROM Sesion WHERE id_usuario=$id");
  $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);


  return $sessions;

}

  public function save($session) {
    $stmt = $this->db->prepare("INSERT INTO Sesion (fecha, id_usuario, comentario, id_tabla) values(?,?,?,?)");
      $stmt->execute(array($session->getFecha(), $session->getUsuario(), $session->getComentario(), $session->getTabla()));
  }
}
?>
