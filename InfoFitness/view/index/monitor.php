<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<div id=monitor>
  <a href="?controller=exercises&action=listExercises">
    <div class="mainexercises">
      <?= i18n("Exercises Management") ?>
    </div>
  </a>
  <a href="?controller=tables&action=listTables">
    <div class="maintables">
      <?= i18n("Tables Management") ?>
    </div>
  </a>
  <a href="?controller=activities&action=assistanceControl">
    <div class="mainassistance">
      <?= i18n("Assistance Control") ?>
    </div>
  </a>
</div>
