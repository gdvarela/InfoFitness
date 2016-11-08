<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");


class User {

  private $username;
  private $passwd;
  private $nombre;
  private $apellidos;
  private $dni;
  private $fechanac;
  private $email;
  private $telef;
  private $permiso; //el tema de los permisos?????????????

  public function __construct($username=NULL, $passwd=NULL, $nombre=NULL, $apellidos=NULL, $dni, $fechanac=NULL, $permiso=NULL, $email=NULL, $telef=NULL) {
    $this->username = $username;
    $this->passwd = $passwd;
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;
    $this->dni = $dni;
    $this->fechanac = $fechanac;
    $this->permiso = $permiso;
    $this->email = $email;
    $this->telef = $telef;
  }

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function getPasswd() {
    return $this->passwd;
  }

  public function setPassword($passwd) {
    $this->passwd = $passwd;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function getApellidos() {
    return $this->apellidos;
  }

  public function setApellidos($apellidos) {
    $this->apellidos = $apellidos;
  }

  public function getDni() {
    return $this->dni;
  }

  public function setDni($dni) {
    $this->dni = $dni;
  }

  public function getFechanac() {
    return $this->fechanac;
  }

  public function setFechanac($fechanac) {
    $this->fechanac = $fechanac;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getTelefono() {
    return $this->telef;
  }

  public function setTelefono($telef) {
    $this->telef = $telef;
  }

  public function getPermiso() {
    return $this->permiso;
  }

  public function setPermiso($permiso) {
    $this->permiso = $permiso;
  }

  public function checkIsValidForRegister() {
      $errors = array();
      if (strlen($this->username) < 5) {
	$errors["username"] = "Username must be at least 5 characters length";

      }
      if (strlen($this->passwd) < 5) {
	$errors["passwd"] = "Password must be at least 5 characters length";
      }

      if(strlen($this->telef) != 9){
        $errors["telef"] = "Phone number must be  9 characters length";
      }
      if(strlen($this->dni) != 9){ //**************** validar letra!!!!
        $errors["dni"] = "DNI must be  9 characters length";
      }

      if (sizeof($errors)>0){
	       throw new ValidationException($errors, "user is not valid");
      }
  }

  /*public function validarDatos(){
    $aErrores = array();
    $aMensajes = array();

    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


     if( preg_match($patron_texto, $_POST['txtNombre']) )
                   $aMensajes[] = "Nombre: [".$_POST['txtNombre']."]";
               else
                   $aErrores[] = "El nombre sólo puede contener letras y espacios";
           }
  }*/
}
