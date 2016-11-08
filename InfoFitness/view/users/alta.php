<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


?>
<!DOCTYPE html>
<html>
  <form action="index.php?controller=users&amp;action=alta" method="POST">
      <?= i18n("Username")?>: <input type="text" name="username" value=""><br>
      <?= i18n("Password")?>: <input type="password" name="passwd" value=""><br>
      <?= i18n("Name")?>: <input type="text" name="nombre" value=""><br>
      <?= i18n("Surnames")?>: <input type="text" name="apellidos" value=""><br>
      <?= i18n("ID")?>: <input type="text" name="dni" value=""><br>
      <?= i18n("Birthdate")?>: <input type="date" name="fechanac" value=""><br>
      <?= i18n("Email")?>: <input type="email" name="email" value=""><br>
      <?= i18n("Phone number")?>: <input type="text" name="telef" value=""><br>
      <?= i18n("Permissions")?>: <input type="number" name="permiso" value=""><br>

      <input type="submit" value="<?= i18n("Register")?>">
  </form>
</html>
