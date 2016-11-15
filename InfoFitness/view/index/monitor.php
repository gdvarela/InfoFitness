<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<a href="?controller=exercises&action=listExercises"><?= i18n("Exercises Management") ?></a></br>
<a href="?controller=tables&action=listtables"><?= i18n("Tables Management") ?></a></br>
<a href="?controller=activities&action=assistanceControl"><?= i18n("Assistance Control") ?></a>