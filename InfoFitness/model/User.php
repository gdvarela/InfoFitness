<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");


class User {

//añadir atributo idusuario, pero no mostrarlo en el formulario.
  private $id_usuario;
  private $username;
  private $passwd;
  private $nombre;
  private $apellidos;
  private $dni;
  private $fechanac;
  private $email;
  private $telef;
  private $permiso;
  private $tipo_deportista;
  private $comentario;
  private $jornada_laboral;

  public function __construct($id_usuario = NULL, $username=NULL, $passwd=NULL, $nombre=NULL, $apellidos=NULL,
  $dni= NULL, $fechanac=NULL, $permiso=NULL, $email=NULL, $telef=NULL, $tipo_deportista=NULL, $comentario=NULL, $jornada_laboral=NULL) {

    $this->id_usuario = $id_usuario;
    $this->username = $username;
    $this->passwd = $passwd;
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;
    $this->dni = $dni;
    $this->fechanac = $fechanac;
    $this->permiso = (integer) $permiso;
    $this->email = $email;
    $this->telef = $telef;
    $this->tipo_deportista = $tipo_deportista;
    $this->comentario = $comentario;
    $this->jornada_laboral = $jornada_laboral;
  }

  public function getIdUsr() {
    return $this->id_usuario;
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

  public function getTipoDeportista() {
    return $this->tipo_deportista;
  }

  public function setTipoDeportista() {
   $this->tipo_deportista=$tipo_deportista;
  }

  public function getComentario() {
    return $this->comentario;
  }

  public function setComentario($comentario) {
    $this->comentario = $comentario;
  }

  public function getJornada(){
    return $this->jornada_laboral;
  }

  public function setJornada($jornada_laboral){
    $this->jornada_laboral = $jornada_laboral;
  }

  public function checkIsValidForRegister() {

      $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
      $patron_login = "/^([a-zA-Z]+_?[a-zA-Z0-9]+){5,}/"; //letras, numeros y _
      $patron_telef = "/^\+?[0-9]{1,3}?[0-9]{9}$/"; //(+34 999999999)
      $patron_email = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
      $patron_passwd = "/^[a-zA-Z0-9\.\/\*_]{6,}$/";
      $patron_dnie = "/^[a-zA-Z]?[0-9]{8}[a-zA-Z]/"; //dni o nie
      $patron_num = "/^[0-9]*/";

      $errors = array();

      //login
      if(strlen($this->username) < 5) {
	       $errors["username_lenght"] = "Username must be at least 5 characters length";
      }elseif(preg_match($patron_login, $this->username) == 0 ){
         $errors["username"] = "Login debe contener letras, numeros y/o _";
      }

      //passwd
      if(strlen($this->passwd) < 6) {
	        $errors["passwd_lenght"] = "Password must be at least 6 characters length";
      }elseif(preg_match($patron_passwd, $this->passwd) == 0 ){
          $errors["passwd"] = "Contraseña debe contener letras, numeros y/o ./_*";
      }

      //nombre
      if (preg_match($patron_texto, $this->nombre) == 0) {
          $errors["nombre"] = "Nombre solo debe contener letras";
      }

      //apellidos
      if (preg_match($patron_texto, $this->apellidos) == 0) {
          $errors["apellidos"] = "Apellidos solo debe contener letras";
      }

      //dnie
      if(strlen($this->dni) != 9){
          $errors["dni_length"] = "DNI must be  9 characters length";
      }elseif (preg_match($patron_dnie, $this->dni) == 0) {
            $errors["dni"] = "DNI/NIE must be  like this 12345678A/Z1234567Q";
      }

      //email
      if (preg_match($patron_email, $this->email) == 0) {
          $errors["email"] = "Email must be like aaa@gsaf.cv";
      }

      //telef
      if (preg_match($patron_telef, $this->telef) == 0) {
          $errors["telef"] = "Telefono must be like (+34) 999999999";
      }


      if (sizeof($errors)>0){
	       throw new ValidationException($errors, "user is not valid");
      }
  } //fin funcion chek is valid

} //fin class
