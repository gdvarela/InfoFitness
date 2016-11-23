<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


?>

<form action="index.php?controller=notifications&amp;action=send" method="POST">
  <?= i18n("To")?>: <input type="email" name="email"></br>

<!--  <?= i18n("All")?><input type="radio" name=all value="" />
  <?= i18n("Athlete")?><input type="radio" name=deportista value="" />
  <?= i18n("Coach")?><input type="radio" name=monitores value="" /></br></br> -->
  <?= i18n("Subject")?>: <input type="text" name="subject"></br></br>
  <?= i18n("Message")?>:</br> <textarea type="textarea" name="message" cols="40" rows="10"></textarea></br>

  <input type="submit" value=<?= i18n("Send") ?>>
</form>
