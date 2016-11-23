<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$users = $view->getVariable("users");
$activityId = $view->getVariable("activityId");
$activityName = $view->getVariable("activityName");
$activityPlace = $view->getVariable("activityPlace");
$date = $view->getVariable("date");
?>
<div class="datagrid">
<table>
    <tr>
        <th><?= i18n("Activity") ?>:</th>
        <th><?= $activityName ?></th>
    </tr>
    <tr>
        <th><?= i18n("Place") ?>:</th>
        <th><?= $activityPlace ?></th>
    </tr>
</table>
<table>
    <tr class="topTable">
        <th><?= i18n("User") ?></th>
        <th><?= i18n("Name") ?></th>
        <th><?= i18n("Last name") ?></th>
        <th><?= i18n("DNI") ?></th>
    </tr>
    <form action="?controller=activities&action=checkAssistance" method="POST">
        <?php foreach ($users as $user): ?>
            <tr class="mainTable">
                <th><?= $user->getUsername() ?></th>
                <th><?= $user->getNombre() ?></th>
                <th><?= $user->getApellidos() ?></th>
                <th><?= $user->getDni() ?></th>
                <th><input type="checkbox" name="users[]" value="<?= $user->getIdUsr() ?>"></th>
            </tr>
        <?php endforeach; ?>
        <input name="activityId" value="<?= $activityId ?>" hidden="true">
        <input name="activityName" value="<?= $activityName ?>" hidden="true">
        <input name="date" value="<?= $date ?>" hidden="true">
        <button type="submit"><?= i18n("Save") ?></button>
    </form>
</table>
</div>
