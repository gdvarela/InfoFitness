<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }


  //añadir/almacenar usuario en la BD
  public function save($user) {

    $stmt = $this->db->prepare("INSERT INTO usuario values (?,?,?,?,?,?,?,?,?)");
    $stmt->execute(array($user->getUsername(), $user->getDni(), $user->getNombre(), $user->getApellidos(), $user->getEmail(),
     $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac()));
  }

  //Usuario existente??
  public function usernameExists($username) {
    $stmt = $this->db->prepare("SELECT count(id_usuario) FROM usuario where id_usuario=?");
    $stmt->execute(array($username));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }

  //usuario y contraseña valido????
  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(id_usuario) FROM usuario where id_usuario=? and contraseña=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else{
      return false;
    }
  }

  //actualizar/modificar usuario en la BD
  public function update($user) {
      $stmt = $this->db->prepare("UPDATE usuario set id_usuario=?, nombre=?, apellidos=?, mail=?, contraseña=?,
          permisos=?, telefono=?, fecha_nacimiento=?  where dni=?");
      $stmt->execute(array($user->getUsername(), $user->getNombre(), $user->getApellidos(),
          $user->getEmail(), $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac(), $user->getDni()));
  }

  //eliminar usuario de la BD
  public function delete($username) {
      $stmt = $this->db->prepare("DELETE FROM usuario WHERE id_usuario=?");
      $stmt->execute(array($username));
  }
}
