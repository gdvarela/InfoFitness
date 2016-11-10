<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$users = $view->getVariable("users");
$newUser = $view->getVariable("newUser");


?>

    <table>
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Password")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th><?= i18n("ID")?></th>
            <th><?= i18n("Birthdate")?></th>
            <th><?= i18n("Email")?></th>
            <th><?= i18n("Phone number")?></th>
            <th><?= i18n("Permissions")?></th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr class="mainTable">
                <form action="?controller=users&action=modificar" method="POST">

                    <th> <input name="username" value="<?= $user->getUsername() ?>"> </th>
                    <th> <input name="passwd" value="<?= $user->getPasswd() ?>"> </th>
                    <th> <input name="nombre" value="<?= $user->getNombre() ?>"> </th>
                    <th> <input name="apellidos" value="<?= $user->getApellidos() ?>"> </th>
                    <th> <input name="dni" value="<?= $user->getDni() ?>"> </th>
                    <th> <input type="date" name="fechanac" value="<?= $user->getFechanac() ?>"> </th>
                    <th> <input type="email" name="email" value="<?= $user->getEmail() ?>"> </th>
                    <th> <input name="telef" value="<?= $user->getTelefono() ?>"> </th>
                    <th> <select name="permiso">
                          <option <?php if($user->getPermiso()==0){echo "selected";} ?> value="0"><?=i18n("Athlete") ?></option>
                          <option <?php if($user->getPermiso()==1){echo "selected";} ?> value="1"><?=i18n("Coach") ?></option>
                          <option <?php if($user->getPermiso()==2){echo "selected";} ?> value="2"><?=i18n("Administrator") ?></option>
                        </select>
                    </th>
                    <th>
                        <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
                        <button type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=users&action=baja" method="POST">
                        <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
                        <button><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>
        <tr>
            <form action="?controller=users&action=alta" method="POST">
              <th> <input name="username" value="<?= $newUser->getUsername() ?>"> </th>
              <th> <input name="passwd" value="<?= $newUser->getPasswd() ?>"> </th>
              <th> <input name="nombre" value="<?= $newUser->getNombre() ?>"> </th>
              <th> <input name="apellidos" value="<?= $newUser->getApellidos() ?>"> </th>
              <th> <input name="dni" value="<?= $newUser->getDni() ?>"> </th>
              <th> <input type="date" name="fechanac" value="<?= $newUser->getFechanac() ?>"> </th>
              <th> <input type="email" name="email" value="<?= $newUser->getEmail() ?>"> </th>
              <th> <input name="telef" value="<?= $newUser->getTelefono() ?>"> </th>
              <th> <select name="permiso">
                    <option value="0"><?=i18n("Athlete") ?></option>
                    <option value="1"><?=i18n("Coach") ?></option>
                    <option value="2"><?=i18n("Administrator") ?></option>
                  </select>
              </th>

                <th>
                    <button type="submit"><?= i18n("Add")?></button>
                </th>
            </form>
        </tr>
    </table>
