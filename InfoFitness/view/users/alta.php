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
    <p class="tittletext"><?=i18n("Athletes") ?></p>
    <div class="datagrid">
    <table class="usertable">
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th>DNI</th>
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

                    <th> <input size=10 name="username" value="<?= $user->getUsername() ?>" required> </th>
                    <th> <input size=10 name="nombre" value="<?= $user->getNombre() ?>"> </th>
                    <th> <input size=10 name="apellidos" value="<?= $user->getApellidos() ?>"> </th>
                    <th> <input size=8 name="dni" value="<?= $user->getDni() ?>" required> </th>
                    <th> <input type="date" name="fechanac" value="<?= $user->getFechanac() ?>"> </th>
                    <th> <input type="email" name="email" value="<?= $user->getEmail() ?>"> </th>
                    <th> <input size=8 name="telef" value="<?= $user->getTelefono() ?>"> </th>
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
                        <button class="button" type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>

                <th>
                    <form action="?controller=users&amp;action=baja" method="POST">
                        <input name="id_usuario" value="<?= $user->getIdUsr() ?>" hidden="true">
                        <button class="button"><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>
    <!--ENTRENADOR-->
      <p class="tittletext"><?=i18n("Monitors") ?></p>
    <table class="usertable">
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th>DNI</th>
            <th><?= i18n("Birthdate")?></th>
            <th><?= i18n("Email")?></th>
            <th><?= i18n("Phone number")?></th>
            <th><?= i18n("Permissions")?></th>
            <th><?= i18n("Working hours")?></th>
        </tr>
        <?php  foreach($monitores as $monitor): ?>
            <tr class="mainTable">
                <form action="?controller=users&amp;action=modificarmonitor" method="POST">

                    <th> <input size=10 name="username" value="<?= $monitor->getUsername() ?>" required> </th>
                    <th> <input size=10 name="nombre" value="<?= $monitor->getNombre() ?>"> </th>
                    <th> <input size=10 name="apellidos" value="<?= $monitor->getApellidos() ?>"> </th>
                    <th> <input size=8 name="dni" value="<?= $monitor->getDni() ?>" required> </th>
                    <th> <input type="date" name="fechanac" value="<?= $monitor->getFechanac() ?>"> </th>
                    <th> <input type="email" name="email" value="<?= $monitor->getEmail() ?>"> </th>
                    <th> <input size=8 name="telef" value="<?= $monitor->getTelefono() ?>"> </th>
                    <th> <select name="permiso">
                          <option <?php if($monitor->getPermiso()==0){echo "selected";} ?> value="0"><?=i18n("Athlete") ?></option>
                          <option <?php if($monitor->getPermiso()==1){echo "selected";} ?> value="1"><?=i18n("Coach") ?></option>
                          <option <?php if($monitor->getPermiso()==2){echo "selected";} ?> value="2"><?=i18n("Administrator") ?></option>
                        </select>
                    </th>
                      <th> <input name="jornada_laboral" value="<?= $monitor->getJornada() ?>"> </th>
                    <th>
                        <input name="id_usuario" value="<?= $monitor->getIdUsr() ?>" hidden="true">
                        <button class="button" type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=users&amp;action=baja" method="POST">
                        <input name="id_usuario" value="<?= $monitor->getIdUsr() ?>" hidden="true">
                        <button class="button"><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>

    </table>

    <!--ADMINISTRADORES-->
      <p class="tittletext"><?=i18n("Administrators") ?><p>
    <table class="usertable">
        <tr class="topTable">
            <th><?= i18n("Username")?></th>
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Surnames")?></th>
            <th>DNI</th>
            <th><?= i18n("Birthdate")?></th>
            <th><?= i18n("Email")?></th>
            <th><?= i18n("Phone number")?></th>
            <th><?= i18n("Permissions")?></th>
        </tr>
        <?php foreach($admins as $admin): ?>
            <tr class="mainTable">
                <form action="?controller=users&amp;action=modificaradmin" method="POST">

                    <th> <input size=10 name="username" value="<?= $admin->getUsername() ?>" required> </th>
                    <th> <input size=10 name="nombre" value="<?= $admin->getNombre() ?>"> </th>
                    <th> <input size=10 name="apellidos" value="<?= $admin->getApellidos() ?>"> </th>
                    <th> <input size=8 name="dni" value="<?= $admin->getDni() ?>" required> </th>
                    <th> <input type="date" name="fechanac" value="<?= $admin->getFechanac() ?>"> </th>
                    <th> <input type="email" name="email" value="<?= $admin->getEmail() ?>"> </th>
                    <th> <input size=8 name="telef" value="<?= $admin->getTelefono() ?>"> </th>
                    <th> <select name="permiso">
                          <option <?php if($admin->getPermiso()==0){echo "selected";} ?> value="0"><?=i18n("Athlete") ?></option>
                          <option <?php if($admin->getPermiso()==1){echo "selected";} ?> value="1"><?=i18n("Coach") ?></option>
                          <option <?php if($admin->getPermiso()==2){echo "selected";} ?> value="2"><?=i18n("Administrator") ?></option>
                        </select>
                    </th>
                    <th>
                        <input name="id_usuario" value="<?= $admin->getIdUsr() ?>" hidden="true">
                        <button class="button" type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=users&amp;action=baja" method="POST">
                        <input name="id_usuario" value="<?= $admin->getIdUsr() ?>" hidden="true">
                        <button class="button"><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>

    </table>
      </div>
