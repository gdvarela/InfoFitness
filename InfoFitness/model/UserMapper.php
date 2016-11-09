<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  public function listarUsuario() {
      $stmt = $this->db->query("SELECT * FROM Usuario");
      $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $users = array();

      foreach ($list_db as $user) {
          array_push($users, new User($user["id_usuario"], $user["login"], $user["dni"], $user["nombre"], $user["apellidos"],
              $user["mail"], $user["contraseña"], $user["permisos"], $user["telefono"], $user["fecha_nacimiento"]));
      }

      return $users;
  }

  //añadir/almacenar usuario en la BD
  public function save($user) {

    $stmt = $this->db->prepare("INSERT INTO Usuario (login, dni, nombre, apellidos, mail, contraseña, permisos, telefono, fecha_nacimiento)
    values (?,?,?,?,?,?,?,?,?)");
    $stmt->execute(array($user->getUsername(), $user->getDni(), $user->getNombre(), $user->getApellidos(), $user->getEmail(),
     $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac()));
  }

  //Usuario existente??
  public function usernameExists($username) {
    $stmt = $this->db->prepare("SELECT count(login) FROM Usuario where login=?");
    $stmt->execute(array($username));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }

  //usuario y contraseña valido????
  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(login) FROM Usuario where login=? and contraseña=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }

  //actualizar/modificar usuario en la BD
  public function update($user) {
      $stmt = $this->db->prepare("UPDATE Usuario set login=?, nombre=?, apellidos=?, mail=?, contraseña=?,
          permisos=?, telefono=?, fecha_nacimiento=?  where dni=?");
      $stmt->execute(array($user->getUsername(), $user->getNombre(), $user->getApellidos(),
          $user->getEmail(), $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac(), $user->getDni()));
  }

  //eliminar usuario de la BD
  public function delete($id_usuario) {
      $stmt = $this->db->prepare("DELETE FROM Usuario WHERE id_usuario=?");
      $stmt->execute(array($id_usuario));
  }
}
