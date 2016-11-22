<?php 
 //file: view/users/register.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Register");
?>
<h1><?= i18n("Register")?></h1>
<form action="index.php?controller=users&amp;action=register" method="POST">
        <?= i18n("Username")?>: <input type="text" name="username" value="<?= $user->getUsername() ?>">
    <?= isset($errors["username"])?$errors["username"]:"" ?><br>
      
      <?= i18n("Password")?>: <input type="password" name="passwd" value="">
      <?= isset($errors["passwd"])?$errors["passwd"]:"" ?><br>

    <?= i18n("Name")?>: <input type="text" name="name" value="<?= $user->getNombre() ?>">
    <?= isset($errors["name"])?$errors["name"]:"" ?><br>

    <?= i18n("Lastname")?>: <input type="text" name="lastname" value="<?= $user->getApellidos() ?>">
    <?= isset($errors["lastname"])?$errors["lastname"]:"" ?><br>

    <?= i18n("Email")?>: <input type="email" name="email" value="<?= $user->getEmail() ?>">
    <?= isset($errors["email"])?$errors["email"]:"" ?><br>

    <?= i18n("DNI")?>: <input type="text" name="dni" value="<?= $user->getDni() ?>">
    <?= isset($errors["dni"])?$errors["dni"]:"" ?><br>

    <?= i18n("Birth")?>: <input type="date" name="date" value="<?= $user->getFechanac() ?>">
    <?= isset($errors["date"])?$errors["date"]:"" ?><br>

    <?= i18n("Phone")?>: <input type="text" name="phone" value="<?= $user->getTelefono() ?>">
    <?= isset($errors["phone"])?$errors["phone"]:"" ?><br>

    <input type="submit" value="<?= i18n("Register")?>">
</form>
