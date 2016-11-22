<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<div id=admin>
  <a href="?controller=users&action=alta">
    <div class=mainusers>
      </br></br><?=i18n("Users Management")?>
    </div>
  </a>
  <a href="?controller=activities&action=listActivities">
    <div class=mainactivities>
    </br></br><?=i18n("Activities Management")?>
    </div>
  </a>
  <a href="?controller=notifications&action=send">
    <div class=mainactivities>
    </br></br><?=i18n("Notifications")?>
    </div>
  </a>

</div>
