<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


?>

<form action="index.php?controller=notifications&amp;action=send" method="POST">
  <?= i18n("To")?>: <input type="email" name="email">
  <?= i18n("Subject")?>: <input type="text" name="subject">
  <?= i18n("Message")?>: <input type="textarea" name="mensaje">

  <input type="submit" value=<?= i18n("Send") ?>>
</form>
