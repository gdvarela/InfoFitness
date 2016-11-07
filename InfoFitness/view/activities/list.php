<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activities = $view->getVariable("activities");
?>

    <table>
        <tr class="topTable">
            <th>Nombre</th>
            <th>Max_Asistentes</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Lugar</th>
            <th>Monitor</th>
        </tr>
        <?php foreach($activities as $activity): ?>
            <tr clas="mainTable">
                <th> <?= $activity->getActivityName() ?> </th>
                <th> <?= $activity->getMaxAssistants() ?> </th>
                <th> <?= $activity->getDescription() ?> </th>
                <th> <?= $activity->getPrice() ?> </th>
                <th> <?= $activity->getPlace() ?> </th>
                <th> <?= $activity->getMonitor() ?> </th>
            </tr>
        <?php endforeach; ?>
    </table>
