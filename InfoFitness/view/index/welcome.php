<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>

<a href="?controller=users&action=alta">Alta Usuario </a> </br>
<a href="?controller=activities&action=listActivities">Gestion Actividades </a></br>
<a href="?controller=exercises&action=listExercises">Gestión ejercicios </a>
