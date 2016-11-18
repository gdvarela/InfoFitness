<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>
<a href="?controller=activities&action=slotsControl"><?= i18n("Slots Control") ?></a></br>
<a href="?controller=tables&action=listWorkouts"><?= i18n("Workout Monitoring") ?></a></br>
<a href="?controller=session&action=listSessions"><?= i18n("Session History") ?></a></br>
<a href="?controller=exercises&action=listExercises"><?= i18n("Exercises List") ?></a></br>
