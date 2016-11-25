<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


?>

<div id=notifications>
  <h1><?= i18n("Notifications")?></h1>
<?= $view->popFlash()?>
<form action="index.php?controller=notifications&amp;action=send" method="POST">
  <?= i18n("All")?><input type="radio" name="grupoemail" value="all" />
  <?= i18n("Athlete")?><input type="radio" name="grupoemail" value="deportistas" />
  <?= i18n("Coach")?><input type="radio" name="grupoemail" value="monitores" /></br></br>
  <?= i18n("Subject")?>: <input type="text" name="subject"></br></br>
  <?= i18n("Message")?>:</br> <textarea type="textarea" name="message" placeholder="<?=i18n("Add comment")?>" cols="40" rows="10"></textarea></br>

  <input class="button" type="submit" value=<?= i18n("Send") ?>>
</form>
</div>
