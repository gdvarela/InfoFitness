<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<div id=monitor>
<a href="?controller=exercises&action=listExercises"><div class="mainexercise"><?= i18n("Exercises Management") ?></a></br>
<a href="?controller=tables&action=listTables"><div class="maintable"><?= i18n("Tables Management") ?></a></br>
<a href="?controller=activities&action=assistanceControl"><div class="mainassistance"><?= i18n("Assistance Control") ?></a>
</div><div class="">
