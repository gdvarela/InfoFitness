<?php
// file: model/UserMapper.php

require_once(__DIR__ . "/../core/PDOConnection.php");

class UserMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function listarDeportista()
    {
        $stmt = $this->db->query("SELECT * FROM usuario u, deportista d WHERE u.id_usuario = d.id_usuario");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($list_db as $user) {
            //$id_usuario = NULL, $username=NULL, $passwd=NULL, $nombre=NULL, $apellidos=NULL,
            //$dni= NULL, $fechanac=NULL, $permiso=NULL, $email=NULL, $telef=NULL, $tipo_deportista=NULL, $comentario=NULL
            array_push($users, new User($user["id_usuario"], $user["login"], NULL /*contraseña*/, $user["nombre"], $user["apellidos"], $user["dni"],
                $user["fecha_nacimiento"], $user["permisos"], $user["mail"], $user["telefono"], $user["tipo_tarjeta"], $user["comentario"], NULL));
        }

        return $users;
    }

    public function listarMonitor()
    {
        $stmt = $this->db->query("SELECT * FROM usuario u, monitor m WHERE u.id_usuario = m.id_usuario");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($list_db as $user) {
            //$id_usuario = NULL, $username=NULL, $passwd=NULL, $nombre=NULL, $apellidos=NULL,
            //$dni= NULL, $fechanac=NULL, $permiso=NULL, $email=NULL, $telef=NULL, $tipo_deportista=NULL, $comentario=NULL
            array_push($users, new User($user["id_usuario"], $user["login"], NULL /*contraseña*/, $user["nombre"], $user["apellidos"], $user["dni"],
                $user["fecha_nacimiento"], $user["permisos"], $user["mail"], $user["telefono"], NULL, NULL, $user["jornada"]));
        }

        return $users;
    }

    public function listarAdmin()
    {
        $stmt = $this->db->query("SELECT * FROM usuario WHERE permisos=2");
        $list_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array();

        foreach ($list_db as $user) {
            //$id_usuario = NULL, $username=NULL, $passwd=NULL, $nombre=NULL, $apellidos=NULL,
            //$dni= NULL, $fechanac=NULL, $permiso=NULL, $email=NULL, $telef=NULL, $tipo_deportista=NULL, $comentario=NULL
            array_push($users, new User($user["id_usuario"], $user["login"], NULL /*contraseña*/, $user["nombre"], $user["apellidos"], $user["dni"],
                $user["fecha_nacimiento"], $user["permisos"], $user["mail"], $user["telefono"], NULL, NULL, NULL));
        }

        return $users;
    }

    //añadir/almacenar usuario en la BD
    public function save($user)
    {

        $stmt = $this->db->prepare("INSERT INTO Usuario (login, dni, nombre, apellidos, mail, contraseña, permisos, telefono, fecha_nacimiento)
    values (?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array($user->getUsername(), $user->getDni(), $user->getNombre(), $user->getApellidos(), $user->getEmail(),
            $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac()));
    }

    //Usuario existente??
    public function usernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT count(login) FROM Usuario where login=?");
        $stmt->execute(array($username));

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //usuario y contraseña valido????
    public function validUser($username, $passwd)
    {

        $stmt = $this->db->query("SELECT * FROM Usuario where login= '$username' and contraseña= '$passwd'");
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(sizeof($user_db) == 1) {
            $user_db = $user_db[0];
            $user = new User($user_db["id_usuario"], $user_db["login"], $user_db["contraseña"], $user_db["nombre"], $user_db["apellidos"], $user_db["dni"],
                $user_db["fecha_nacimiento"], $user_db["permisos"], $user_db["mail"], $user_db["telefono"],NULL,NULL);

            return $user;
        } else {
            return null;
        }

    }


    //actualizar/modificar usuario en la BD
    public function update($user)
    {
        $stmt = $this->db->prepare("UPDATE Usuario set login=?, nombre=?, apellidos=?, mail=?, contraseña=?,
          permisos=?, telefono=?, fecha_nacimiento=?, dni= ? where id_usuario=?");
        $stmt->execute(array($user->getUsername(), $user->getNombre(), $user->getApellidos(),
            $user->getEmail(), $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac(), $user->getDni(), $user->getIdUsr()));
    }

    //eliminar usuario de la BD
    public function delete($id_usuario)
    {
        $stmt = $this->db->prepare("DELETE FROM Usuario WHERE id_usuario=?");
        $stmt->execute(array($id_usuario));
    }
}
