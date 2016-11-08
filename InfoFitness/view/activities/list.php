<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activities = $view->getVariable("activities");
$newActivity = $view->getVariable("newActivity");
?>

    <table>
        <tr class="topTable">
            <th><?= i18n("Name")?></th>
            <th><?= i18n("Max. Assistents")?></th>
            <th><?= i18n("Description")?></th>
            <th><?= i18n("Price")?></th>
            <th><?= i18n("Place")?></th>
            <th><?= i18n("Monitor")?></th>
        </tr>
        <?php foreach($activities as $activity): ?>
            <tr clas="mainTable">
                <form action="?controller=activities&action=modify" method="POST">
                    <th> <input name="activityName" value="<?= $activity->getActivityName() ?>"> </th>
                    <th> <input name="activityMaxAssis" value="<?= $activity->getMaxAssistants() ?>"> </th>
                    <th> <input name="activityDes" value="<?= $activity->getDescription() ?>"> </th>
                    <th> <input name="activityPrice" value="<?= $activity->getPrice() ?>"> </th>
                    <th> <input name="activityPlace" value="<?= $activity->getPlace() ?>"> </th>
                    <th>
                        <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                        <button type="submit"><?= i18n("Modify")?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=activities&action=delete" method="POST">
                        <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                        <button><?= i18n("Delete")?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>
        <tr>
            <form action="?controller=activities&action=add" method="POST">
                <th> <input name="activityName" value="<?= $newActivity->getActivityName() ?>"> </th>
                <th> <input name="activityMaxAssis" value="<?= $newActivity->getMaxAssistants() ?>"> </th>
                <th> <input name="activityDes" value="<?= $newActivity->getDescription() ?>"> </th>
                <th> <input name="activityPrice" value="<?= $newActivity->getPrice() ?>"> </th>
                <th> <input name="activityPlace" value="<?= $newActivity->getPlace() ?>"> </th>
                <th>
                    <button type="submit"><?= i18n("Add")?></button>
                </th>
            </form>
        </tr>
    </table>
