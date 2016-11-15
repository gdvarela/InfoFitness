<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$activities = $view->getVariable("activities");
$errors = $view->getVariable("errors");
?>

<table>
    <tr class="topTable">
        <th><?= i18n("Activities");
            i18n("Unreserved") ?></th>
    </tr>
    <?php foreach($activities as $activity): ?>
    <tr clas="mainTable">
        <th><?= $activity->getActivityName() ?></th>
        <th><?= $activity->getPlace() ?></th>
        <th><form action="?controller=activities&action=reserve" method="POST">
                <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                <input name="activityName" value="<?= $activity->getActivityName() ?>" hidden="true">
                <button type="submit"><?= i18n("Reserve")?></button>
            </form>
        </th>

    </tr>
    <?php endforeach; ?>
    <tr class="topTable">
        <th><?= i18n("Activities");
            i18n("Reserved") ?></th>
    </tr>
    <tr clas="mainTable">

    </tr>
</table>