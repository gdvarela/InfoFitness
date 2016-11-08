<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

/*  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO usuario values (?,?)");
    $stmt->execute(array($user->getUsername(), $user->getPasswd()));
  }*/
  public function save($user) {
    //$name=NULL,$firstname=NULL, $dni=NULL, $fechanac=NULL, $email=NULL, $telef=NULL
    $stmt = $this->db->prepare("INSERT INTO usuario values (?,?,?,?,?,?,?,?,?)");
    $stmt->execute(array($user->getUsername(), $user->getDni(), $user->getNombre(), $user->getApellidos(), $user->getEmail(), $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac()));
  }

  public function usernameExists($username) {
    $stmt = $this->db->prepare("SELECT count(id_usuario) FROM usuario where id_usuario=?");
    $stmt->execute(array($username));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(id_usuario) FROM usuario where id_usuario=? and contraseña=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }
}
