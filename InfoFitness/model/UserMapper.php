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
        $stmt = $this->db->query("SELECT * FROM Usuario u, Deportista d WHERE u.id_usuario = d.id_usuario AND permisos =0");
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
        $stmt = $this->db->query("SELECT * FROM Usuario u, Monitor m WHERE u.id_usuario = m.id_usuario AND u.permisos=1");
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
        $stmt = $this->db->query("SELECT * FROM Usuario WHERE permisos=2");
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
    VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array($user->getUsername(), $user->getDni(), $user->getNombre(), $user->getApellidos(), $user->getEmail(),
            $user->getPasswd(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac()));


        //************************************PREGUNTAR ***********
        /*if($user->getPermiso()==0){
          $stmt = $this->db->prepare("INSERT INTO Deportista (tipo_tarjeta, comentario) VALUES (?,?)");
          $stmt->execute(array($user->getTipoDeportista(), $user->getComentario()));
        }

        if($user->getPermiso()==1){
          $stmt = $this->db->prepare("INSERT INTO Monitor (jornada) VALUES (?)");
          $stmt->execute(array($user->getJornada()));
        }*/
    }

    public function usernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT count(login) FROM Usuario WHERE login=?");
        $stmt->execute(array($username));

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validUser($username, $passwd)
    {

        $stmt = $this->db->query("SELECT * FROM Usuario WHERE login= '$username' AND contraseña= '$passwd'");
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($user_db) == 1) {
            $user_db = $user_db[0];
            $user = new User($user_db["id_usuario"], $user_db["login"], $user_db["contraseña"], $user_db["nombre"], $user_db["apellidos"], $user_db["dni"],
                $user_db["fecha_nacimiento"], $user_db["permisos"], $user_db["mail"], $user_db["telefono"], NULL, NULL, NULL);

            return $user;
        } else {
            return null;
        }

    }


    //actualizar/modificar usuario en la BD
    public function update($user)
    {
        $stmt = $this->db->prepare("UPDATE Usuario SET login=?, nombre=?, apellidos=?, mail=?,
          permisos=?, telefono=?, fecha_nacimiento=?, dni= ? WHERE id_usuario=?");
        $stmt->execute(array($user->getUsername(), $user->getNombre(), $user->getApellidos(),
            $user->getEmail(), $user->getPermiso(), $user->getTelefono(), $user->getFechanac(), $user->getDni(), $user->getIdUsr()));

    }


    public function updatemonitor($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE id_usuario=?");
        $stmt->execute(array($user->getIdUsr()));
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->update($user);

        if ($user_db[0]["permisos"] != $user->getPermiso()) {
            $stmt = $this->db->prepare("DELETE FROM Monitor WHERE id_usuario=?");
            $stmt->execute(array($user->getIdUsr()));

            if ($user->getPermiso() == 0) {
                $stmt = $this->db->prepare("INSERT INTO Deportista (id_usuario) values (?)");
                $stmt->execute(array($user->getIdUsr()));
            }
        } else {
            $stmt = $this->db->prepare("UPDATE Monitor SET jornada=? WHERE id_usuario=?");
            $stmt->execute(array($user->getJornada(), $user->getIdUsr()));
        }
    }

    public function updatedepor($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE id_usuario=?");
        $stmt->execute(array($user->getIdUsr()));
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->update($user);

        if ($user_db[0]["permisos"] != $user->getPermiso()) {
            $stmt = $this->db->prepare("DELETE FROM Deportista WHERE id_usuario=?");
            $stmt->execute(array($user->getIdUsr()));

            if ($user->getPermiso() == 1) {
                $stmt = $this->db->prepare("INSERT INTO Monitor (id_usuario) values (?)");
                $stmt->execute(array($user->getIdUsr()));
            }
        } else {
            $stmt = $this->db->prepare("UPDATE Deportista SET tipo_tarjeta=?, comentario=? WHERE id_usuario=?");
            $stmt->execute(array($user->getTipoDeportista(), $user->getComentario(), $user->getIdUsr()));
        }
    }

    public function updateAdmin($user) {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE id_usuario=?");
        $stmt->execute(array($user->getIdUsr()));
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->update($user);

        if ($user_db[0]["permisos"] != $user->getPermiso()) {
            if ($user->getPermiso() == 1) {
                $stmt = $this->db->prepare("INSERT INTO Monitor (id_usuario) values (?)");
                $stmt->execute(array($user->getIdUsr()));
            } else {
                $stmt = $this->db->prepare("INSERT INTO Deportista (id_usuario) values (?)");
                $stmt->execute(array($user->getIdUsr()));
            }
        }
    }


    //eliminar usuario de la BD
    public function delete($id_usuario)
    {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE id_usuario=?");
        $stmt->execute(array($id_usuario));
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($user_db[0]["permisos"] == 1) {
            $stmt = $this->db->prepare("DELETE FROM Monitor WHERE id_usuario=?");
            $stmt->execute(array($id_usuario));
        } else if ($user_db[0]["permisos"] == 0){
            $stmt = $this->db->prepare("DELETE FROM Deportista WHERE id_usuario=?");
            $stmt->execute(array($id_usuario));
        }

        $stmt = $this->db->prepare("DELETE FROM Usuario WHERE id_usuario=?");
        $stmt->execute(array($id_usuario));
    }

    //PARA LA GESTION DE PERFILES
    public function listUser($id_usuario)
    {
        $stmt = $this->db->prepare("SELECT * FROM Usuario U WHERE id_usuario = ?");
        $stmt->execute(array($id_usuario));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


            //$id_usuario = NULL, $username=NULL, $passwd=NULL, $nombre=NULL, $apellidos=NULL,
            //$dni= NULL, $fechanac=NULL, $permiso=NULL, $email=NULL, $telef=NULL, $tipo_deportista=NULL, $comentario=NULL
        $user = new User($result["id_usuario"], $result["login"], $result["contraseña"], $result["nombre"], $result["apellidos"], $result["dni"],
                $result["fecha_nacimiento"], $result["permisos"], $result["mail"], $result["telefono"], NULL, NULL, NULL);


        return $user;
    }

    public function updateUser($user)
    {
        $stmt = $this->db->prepare("UPDATE Usuario SET login=?, nombre=?, apellidos=?, mail=?,
          contraseña=?, telefono=?, fecha_nacimiento=?, dni= ? WHERE id_usuario=?");
        $stmt->execute(array($user->getUsername(), $user->getNombre(), $user->getApellidos(),
            $user->getEmail(), $user->getPasswd(), $user->getTelefono(), $user->getFechanac(), $user->getDni(), $user->getIdUsr()));

    }



}
