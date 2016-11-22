<?php
// file: model/Notification.php

require_once(__DIR__."/../core/ValidationException.php");


class Notification {

  private $destino;
  private $subject;
  private $mensaje;

  public function __construct($destino=NULL, $subject=NULL, $mensaje=NULL){
    $this->destino=$destino;
    $this->subject=$subject;
    $this->mensaje=$mensaje;
  }

  public function getDestino(){
    return $this->destino;
  }

  public function setDestino($destino){
    $this->destino=$destino;
  }

  public function getSubject(){
    return $this->subject;
  }

  public function setSubject($subject){
    $this->subject=$subject;
  }

  public function getMensaje(){
    return $this->mensaje;
  }

  public function setMensaje($mensaje){
    $this->mensaje=$mensaje;
  }
}

?>
