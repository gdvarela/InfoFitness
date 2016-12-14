<?php
 //file: view/profile/show.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("usuario");
 $view->setVariable("title", "Profile");
 //var_dump($user);
?>
<div id=register>
<h1><?= i18n("Profile")?></h1>
<form action="index.php?controller=profile&amp;action=modify" method="POST">
    <?= i18n("Username")?>:</br> <input type="text" name="username" value="<?= $user->getUsername() ?>">
    <?= isset($errors["username"])?$errors["username"]:"" ?></br></br>

    <?= i18n("Password")?>:</br> <input type="password" name="passwd" value="<?= $user->getPasswd()?>">
    <?= isset($errors["passwd"])?$errors["passwd"]:"" ?></br></br>

    <?= i18n("Name")?>: </br><input type="text" name="name" value="<?= $user->getNombre() ?>">
    <?= isset($errors["name"])?$errors["name"]:"" ?></br></br>

    <?= i18n("Last name")?>: </br><input type="text" name="lastname" value="<?= $user->getApellidos() ?>">
    <?= isset($errors["lastname"])?$errors["lastname"]:"" ?></br></br>

    <?= i18n("Email")?>:</br> <input type="email" name="email" value="<?= $user->getEmail() ?>">
    <?= isset($errors["email"])?$errors["email"]:"" ?></br></br>

    <?= i18n("DNI")?>: </br><input type="text" name="dni" value="<?= $user->getDni() ?>">
    <?= isset($errors["dni"])?$errors["dni"]:"" ?></br></br>

    <?= i18n("Birthday")?>:</br> <input type="date" name="date" value="<?= $user->getFechanac() ?>">
    <?= isset($errors["date"])?$errors["date"]:"" ?></br></br>

    <?= i18n("Phone number")?>:</br> <input type="text" name="phone" value="<?= $user->getTelefono() ?>">
    <?= isset($errors["phone"])?$errors["phone"]:"" ?></br></br>
    <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
    <input class="button" type="submit" name="submit" value="<?= i18n("Modify")?>">
</form>
<form action="?controller=profile&amp;action=delete" method="POST">
    <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
    <input class="button" type="submit" name="baja" value="<?= i18n("Delete")?>">
</form>

</div>
