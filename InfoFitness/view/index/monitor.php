<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<div id=monitor>
  <a href="?controller=exercises&action=listExercises">
    <div class="mainexercises">
    </br></br><?= i18n("Exercises Management") ?>
    </div>
  </a>
  <a href="?controller=tables&action=listTables">
    <div class="maintables">
      </br></br><?= i18n("Tables Management") ?>
    </div>
  </a>
  <a href="?controller=activities&action=assistanceControl">
    <div class="mainassistance">
      </br></br><?= i18n("Assistance Control") ?>
    </div>
  </a>
  <a class="linkgeneral" href="?controller=profile&action=showUser">
   <div class="mainprofile">
   </br></br><?= i18n("Profile") ?>
   </div>
  </a>
  <a class="linkgeneral" href="?controller=activities&action=statictics">
   <div class="mainprofile">
   </br></br><?= i18n("General Statictics") ?>
   </div>
  </a>
</div>
