<?php
// file: model/Notification.php

require_once(__DIR__."/../core/ValidationException.php");


class Notification {

  private $destino;
  private $subject;
  private $message;

  public function __construct($destino=NULL, $subject=NULL, $message=NULL){
    $this->destino=$destino;
    $this->subject=$subject;
    $this->message=$message;
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

  public function getMessage(){
    return $this->message;
  }

  public function setMessage($message){
    $this->message=$message;
  }
}

?>
