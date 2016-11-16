<?php

require_once(__DIR__."/../core/PDOConnection.php");

class SessionMapper {
  private $db;

  public function __construct() {
      $this->db = PDOConnection::getInstance();
  }
  public function save($sesion) {
      $stmt = $this->db->prepare("INSERT INTO Sesion (fecha, id_usuario, comentario, id_tabla) values(?,?,?,?,)");
      $stmt->execute(array($sesion->getFecha(), $sesion->getUsuario(), $sesion->getComentario(), $sesion->getTabla()));
  }
}
?>
