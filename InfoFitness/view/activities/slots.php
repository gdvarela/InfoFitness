<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$unreservedActivities = $view->getVariable("unreservedActivities");
$reservedActivity = $view->getVariable("reservedActivities");
$errors = $view->getVariable("errors");
?>
<div class="datagrid">
  <p class="tittletext"><?= i18n("Activities") ?></p>

<table>
    <tr>
      <?= $view->popFlash() ?>
    </tr>
    <tr class="topTable">
        <th><?= i18n("Activities")?></th>
        <th><?= i18n("Place")?></th>
        <th><?= i18n("Start Time")?></th>
        <th><?= i18n("End Time")?></th>
        <th><?= i18n("Day")?></th>
    </tr>
    <?php foreach($unreservedActivities as $activity): ?>
    <tr class="mainTable">
        <th><?= $activity->getActivityName() ?></th>
        <th><?= $activity->getPlace() ?></th>
        <th><?= $activity->getStartTime() ?></th>
        <th><?= $activity->getEndTime() ?></th>
        <th><?= $activity->getDay() ?></th>
        <th><form action="?controller=activities&amp;action=reserve" method="POST">
                <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                <input name="activityName" value="<?= $activity->getActivityName() ?>" hidden="true">
                <button class="button" type="submit"><?= i18n("Reserve")?></button>
            </form>
        </th>
    </tr>
    <?php endforeach; ?>
  </table>
  </br></br>
  <p class="tittletext"><?= i18n("Reserved activities") ?></p>
  <table>
    <tr class="topTable">
        <th><?= i18n("Activities")?></th>
        <th><?= i18n("Place")?></th>
        <th><?= i18n("Start Time")?></th>
        <th><?= i18n("End Time")?></th>
        <th><?= i18n("Day")?></th>
    </tr>
    <?php foreach($reservedActivity as $activity): ?>
    <tr class="mainTable">
        <th><?= $activity->getActivityName() ?></th>
        <th><?= $activity->getPlace() ?></th>
        <th><?= $activity->getStartTime() ?></th>
        <th><?= $activity->getEndTime() ?></th>
        <th><?= $activity->getDay() ?></th>
        <th><form action="?controller=activities&amp;action=unreserve" method="POST">
            <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
            <input name="activityName" value="<?= $activity->getActivityName() ?>" hidden="true">
            <button class="button" type="submit"><?= i18n("Unreserve")?></button>
        </form>
        </th>
    </tr>
    <?php endforeach; ?>
</table>
</div>
