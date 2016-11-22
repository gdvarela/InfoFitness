<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<div id="user">
  <a class="linkgeneral" href="?controller=activities&action=slotsControl">
    <div class="assistance">
    </br></br><?= i18n("Slots Control") ?>
  </div>
 </a>
 <a class="linkgeneral" href="?controller=tables&action=listWorkouts">
  <div class="workout">
    </br></br><?= i18n("Workout Monitoring") ?>
  </div>
 </a>
 <a class="linkgeneral" href="?controller=session&action=listSessions">
    <div class="session">
    </br></br><?= i18n("Session History") ?>
  </div>
 </a>
 <a class="linkgeneral" href="?controller=exercises&action=listExercises">
  <div class="exercisepublic">
    </br></br><?= i18n("Exercises List") ?>
  </div>
 </a>
</div>
