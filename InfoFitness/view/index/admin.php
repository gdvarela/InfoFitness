<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<div id=admin>
  <a href="?controller=users&action=alta">
    <div class=users>
      </br></br><?=i18n("Users Management")?>
    </div>
  </a>
  <a href="?controller=activities&action=listActivities">
    <div class=activities>
    </br></br><?=i18n("Activities Management")?>
    </div>
  </a>
</div>
