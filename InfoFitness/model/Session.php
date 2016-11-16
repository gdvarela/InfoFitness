<?php

 require_once(__DIR__."/../core/ValidationException.php");

 class Session{
  private $id;
  private $fecha;
  private $idUsuario;
  private $comentario;
  private $idTabla;

  public function __construct($id=NULL, $fecha=NULL, $idUsuario=NULL, $comentario=NULL, $idTabla=NULL){
    $this->id = $id;
    $this->fecha = $fecha;
    $this->idUsuario = $idUsuario;
    $this->comentario = $comentario;
    $this->idTabla = $idTabla;
  }

  public function getId()
  {
      return $this->id;
  }

  public function getUsuario()
  {
      return $this->idUsuario;
  }

   public function setUsuario($idUsuario)
  {
       $this->$idUsuario = $idUsuario;
  }


 }
 ?>
