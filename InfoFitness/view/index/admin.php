<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<a href="?controller=users&action=alta"><?=i18n("Users Management")?> </a> </br>
<a href="?controller=activities&action=listActivities"><?=i18n("Activities Management")?> </a></br>