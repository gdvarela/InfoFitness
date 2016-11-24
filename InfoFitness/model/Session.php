<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Session
{
    private $id;
    private $fecha;
    private $idUsuario;
    private $comentario;
    private $descripcion;
    private $idTabla;

    public function __construct($id = NULL, $fecha = NULL, $idUsuario = NULL, $comentario = NULL, $descripcion = NULL, $idTabla=NULL)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->idUsuario = $idUsuario;
        $this->comentario = $comentario;
        $this->descripcion = $descripcion;
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

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getTabla()
    {
        return $this->idTabla;
    }

    public function changeSession($fecha = NULL, $idUsuario = NULL, $comentario = NULL, $descripcion = NULL, $idTabla=NULL)
    {
        $this->fecha = $fecha;
        $this->idUsuario = $idUsuario;
        $this->comentario = $comentario;
        $this->descripcion = $descripcion;
        $this->idTabla = $idTabla;
    }
}

?>
