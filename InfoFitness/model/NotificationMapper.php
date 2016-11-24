<?php
// file: model/NotificationMapper.php

require_once(__DIR__ . "/../core/PDOConnection.php");

class NotificationMapper{

  private $db;

  public function __construct()
  {
      $this->db = PDOConnection::getInstance();
  }

  public function selectEmails(){
      $stmt = $this->db->query("SELECT mail, nombre FROM  Usuario");
      $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $array = array();
      foreach ($list_db as $email => $name) {
        $array[$email] =$name;
      }

      return $array;
  }

  public function selectEmailsDep(){
      $stmt = $this->db->query("SELECT mail, nombre FROM  Usuario WHERE permisos =0 ");
      $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $array = array();
      foreach ($list_db as $email => $name) {
        $array[$email] =$name;
      }

      return $array;
  }

  public function selectEmailsMonit(){
      $stmt = $this->db->query("SELECT mail, nombre FROM  Usuario WHERE permisos =1 ");
      $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $array = array();
      foreach ($list_db as $email => $name) {
        $array[$email] =$name;
      }

      return $array;
  }
}
?>
