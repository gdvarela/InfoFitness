<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


?>

<form action="index.php?controller=notifications&amp;action=send" method="POST">
  <?= i18n("To")?>: <input type="email" name="email"></br>

  <!--<input type="radio" name="Departamento" value="informacion@empresa.com" id="Departamento_0"  /> Informacion-->
  <!--<input type="radio" name="Departamento" value="compras@empresa.com" id="Departamento_1" /> Compras-->
  <?= i18n("Subject")?>: <input type="text" name="subject"></br>
  <?= i18n("Message")?>: <textarea type="textarea" name="message" cols="32" rows="32"></textarea></br>

  <input type="submit" value=<?= i18n("Send") ?>>
</form>
