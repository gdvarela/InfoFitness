<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 2) {
    $view->redirect("index", "unauthorized");
}

$users = $view->getVariable("users");
$monitores = $view->getVariable("monitores");
$admins = $view->getVariable("admins");
//$newUser = $view->getVariable("newUser");

//***************************************VISTA ADMIN*******************************************
?>
    <!-- DEPORTISTAS -->
    <h2><?=i18n("Athlete") ?></h2>
    <div class="datagrid">
    <table>
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th><?= i18n("ID")?></th>
            <th><?= i18n("Birthdate")?></th>
            <th><?= i18n("Email")?></th>
            <th><?= i18n("Phone number")?></th>
            <th><?= i18n("Permissions")?></th>
            <th><?= i18n("Type")?></th>
            <th><?= i18n("Comment")?></th>
        </tr>

        <?php  foreach($users as $user): ?>
            <tr class="mainTable">
                <form action="?controller=users&amp;action=modificardeportista" method="POST">

                    <th> <input name="username" value="<?= $user->getUsername() ?>"> </th>
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
                    <th> <select name="tipo_deportista">
                        <option <?php if($user->getTipoDeportista()==0){echo "selected";} ?> value="0"><?=i18n("PEF") ?></option>
                        <option <?php if($user->getTipoDeportista()==1){echo "selected";} ?> value="1"><?=i18n("TDU") ?></option>
                    </th>
                    <th> <input name="comentario" value="<?= $user->getComentario() ?>"> </th>

                    <th>
                        <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
                        <button type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>

                <th>
                    <form action="?controller=users&amp;action=baja" method="POST">
                        <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
                        <button><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>
    <!--ENTRENADOR-->
    <h2><?=i18n("Coach") ?></h2>
    <table>
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th><?= i18n("ID")?></th>
            <th><?= i18n("Birthdate")?></th>
            <th><?= i18n("Email")?></th>
            <th><?= i18n("Phone number")?></th>
            <th><?= i18n("Permissions")?></th>
            <th><?= i18n("Working hours")?></th>
        </tr>
        <?php  foreach($monitores as $monitor): ?>
            <tr class="mainTable">
                <form action="?controller=users&amp;action=modificarmonitor" method="POST">

                    <th> <input name="username" value="<?= $monitor->getUsername() ?>"> </th>
                    <th> <input name="nombre" value="<?= $monitor->getNombre() ?>"> </th>
                    <th> <input name="apellidos" value="<?= $monitor->getApellidos() ?>"> </th>
                    <th> <input name="dni" value="<?= $monitor->getDni() ?>"> </th>
                    <th> <input type="date" name="fechanac" value="<?= $monitor->getFechanac() ?>"> </th>
                    <th> <input type="email" name="email" value="<?= $monitor->getEmail() ?>"> </th>
                    <th> <input name="telef" value="<?= $monitor->getTelefono() ?>"> </th>
                    <th> <select name="permiso">
                          <option <?php if($monitor->getPermiso()==0){echo "selected";} ?> value="0"><?=i18n("Athlete") ?></option>
                          <option <?php if($monitor->getPermiso()==1){echo "selected";} ?> value="1"><?=i18n("Coach") ?></option>
                          <option <?php if($monitor->getPermiso()==2){echo "selected";} ?> value="2"><?=i18n("Administrator") ?></option>
                        </select>
                    </th>
                      <th> <input name="jornada_laboral" value="<?= $monitor->getJornada() ?>"> </th>
                    <th>
                        <input name="id_usuario" value="<?= $monitor->getIdUsr() ?>" hidden="true">
                        <button type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=users&amp;action=baja" method="POST">
                        <input name="id_usuario" value="<?= $monitor->getIdUsr() ?>" hidden="true">
                        <button><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>

    </table>

    <!--ADMINISTRADORES-->
    <h2><?=i18n("Administrator") ?></h2>
    <table>
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th><?= i18n("ID")?></th>
            <th><?= i18n("Birthdate")?></th>
            <th><?= i18n("Email")?></th>
            <th><?= i18n("Phone number")?></th>
            <th><?= i18n("Permissions")?></th>
        </tr>
        <?php foreach($admins as $admin): ?>
            <tr class="mainTable">
                <form action="?controller=users&amp;action=modificaradmin" method="POST">

                    <th> <input name="username" value="<?= $admin->getUsername() ?>"> </th>
                    <th> <input name="nombre" value="<?= $admin->getNombre() ?>"> </th>
                    <th> <input name="apellidos" value="<?= $admin->getApellidos() ?>"> </th>
                    <th> <input name="dni" value="<?= $admin->getDni() ?>"> </th>
                    <th> <input type="date" name="fechanac" value="<?= $admin->getFechanac() ?>"> </th>
                    <th> <input type="email" name="email" value="<?= $admin->getEmail() ?>"> </th>
                    <th> <input name="telef" value="<?= $admin->getTelefono() ?>"> </th>
                    <th> <select name="permiso">
                          <option <?php if($admin->getPermiso()==0){echo "selected";} ?> value="0"><?=i18n("Athlete") ?></option>
                          <option <?php if($admin->getPermiso()==1){echo "selected";} ?> value="1"><?=i18n("Coach") ?></option>
                          <option <?php if($admin->getPermiso()==2){echo "selected";} ?> value="2"><?=i18n("Administrator") ?></option>
                        </select>
                    </th>
                    <th>
                        <input name="id_usuario" value="<?= $admin->getIdUsr() ?>" hidden="true">
                        <button type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=users&amp;action=baja" method="POST">
                        <input name="id_usuario" value="<?= $admin->getIdUsr() ?>" hidden="true">
                        <button><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>

    </table>
      </div>
