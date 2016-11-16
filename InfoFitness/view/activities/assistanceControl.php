<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$activities = $view->getVariable("activities");
$monitors = $view->getVariable("monitors");
date_default_timezone_set('Europe/Madrid');
$date = date('Y/m/d', time());
?>
<span><?= $date ?></span>
<table>
    <tr class="topTable">
        <th><?= i18n("Activity") ?></th>
        <th><?= i18n("Place") ?></th>
        <th><?= i18n("Monitor") ?></th>
    </tr>
    <?php foreach($activities as $activity): ?>
    <tr clas="mainTable">
        <th><?= $activity->getActivityName() ?></th>
        <th><?= $activity->getPlace() ?></th>
        <th><?= $monitors[0]["nombre"] ?></th>
        <th><form action="?controller=activities&action=assistanceControl" method="POST">
                <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                <input name="activityName" value="<?= $activity->getActivityName() ?>" hidden="true">
                <input name="place" value="<?= $activity->getPlace() ?>" hidden="true">
                <input name="date" value="<?= $date ?>" hidden="true">
                <button type="submit"><?= i18n("Check Assistance")?></button>
            </form>
        </th>
    </tr>
    <?php endforeach; ?>
</table>