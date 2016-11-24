<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 2) {
    $view->redirect("index", "unauthorized");
}

$activities = $view->getVariable("activities");
$newActivity = $view->getVariable("newActivity");
$monitors = $view->getVariable("monitors");
$errors = $view->getVariable("errors");
?>
<?= isset($errors["activityName"]) ? $errors["activityName"] : "" ?><br>
<div id="activitiesview"
<div class=datagrid>
<table>
    <tr class="topTable">
        <th><?= i18n("Name") ?></th>
        <th><?= i18n("Max. Assistents") ?></th>
        <th><?= i18n("Description") ?></th>
        <th><?= i18n("Price") ?></th>
        <th><?= i18n("Place") ?></th>
        <th><?= i18n("Monitor") ?></th>
        <th><?= i18n("Start") ?></th>
        <th><?= i18n("End") ?></th>
        <th><?= i18n("Day") ?></th>
    </tr>
    <?php foreach ($activities as $activity): ?>
        <tr class="mainTable">
            <form action="?controller=activities&action=modify" method="POST">
                <th><input name="activityName" value="<?= $activity->getActivityName() ?>"></th>
                <th><input type="number" min="1" name="activityMaxAssis" value="<?= $activity->getMaxAssistants() ?>">
                </th>
                <th><input name="activityDes" value="<?= $activity->getDescription() ?>"></th>
                <th><input type="number" min="0" name="activityPrice" value="<?= $activity->getPrice() ?>"></th>
                <th><input name="activityPlace" value="<?= $activity->getPlace() ?>"></th>
                <th><select name="monitor">
                        <?php foreach ($monitors as $monitor): ?>
                            <option <?php if ($monitor["id_entrenador"] == $activity->getMonitor()) {
                                echo "selected";
                            } ?>
                                value="<?= $monitor["id_entrenador"] ?>"><?= $monitor["nombre"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
                <th><input type="time" min="0" name="startTime" value="<?= $activity->getStartTime() ?>"></th>
                <th><input type="time" min="0" name="endTime" value="<?= $activity->getEndTime() ?>"></th>
                <th><select name="day">
                        <option <?php if ($activity->getDay() == "Lunes") {echo "selected";} ?> value="Lunes"><?= i18n("Monday") ?></option>
                        <option <?php if ($activity->getDay() == "Martes") {echo "selected";} ?> value="Martes"><?= i18n("Tuesday") ?></option>
                        <option <?php if ($activity->getDay() == "Miercoles") {echo "selected";} ?> value="Miercoles"><?= i18n("Wenesday") ?></option>
                        <option <?php if ($activity->getDay() == "Jueves") {echo "selected";} ?> value="Jueves"><?= i18n("Thursday") ?></option>
                        <option <?php if ($activity->getDay() == "Viernes") {echo "selected";} ?> value="Viernes"><?= i18n("Friday") ?></option>
                </th>
                <th>
                    <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                    <button type="submit"><?= i18n("Modify") ?></button>
                </th>
            </form>
            <th>
                <form action="?controller=activities&action=delete" method="POST">
                    <input name="activityId" value="<?= $activity->getId() ?>" hidden="true">
                    <button><?= i18n("Delete") ?></button>
                </form>
            </th>
        </tr>
    <?php endforeach; ?>
    <tr>
        <form action="?controller=activities&action=add" method="POST">
            <th><input name="activityName" value="<?= $newActivity->getActivityName() ?>"></th>
            <th><input type="number" min="1" name="activityMaxAssis" value="<?= $newActivity->getMaxAssistants() ?>">
            </th>
            <th><input name="activityDes" value="<?= $newActivity->getDescription() ?>"></th>
            <th><input type="number" name="activityPrice" value="<?= $newActivity->getPrice() ?>"></th>
            <th><input name="activityPlace" value="<?= $newActivity->getPlace() ?>"></th>
            <th><select name="monitor">
                    <?php foreach ($monitors as $monitor): ?>
                        <option value="<?= $monitor["id_entrenador"] ?>"><?= $monitor["nombre"] ?></option>
                    <?php endforeach; ?>
                </select>
            </th>
            <th><input type="time" min="0" name="startTime" value="<?= $newActivity->getStartTime() ?>"></th>
            <th><input type="time" min="0" name="endTime" value="<?= $newActivity->getEndTime() ?>"></th>
            <th><select name="day">
                    <option <?php if ($newActivity->getDay() == "Lunes") {echo "selected";} ?> value="Lunes"><?= i18n("Monday") ?></option>
                    <option <?php if ($newActivity->getDay() == "Martes") {echo "selected";} ?> value="Martes"><?= i18n("Tuesday") ?></option>
                    <option <?php if ($newActivity->getDay() == "Miercoles") {echo "selected";} ?> value="Miercoles"><?= i18n("Wenesday") ?></option>
                    <option <?php if ($newActivity->getDay() == "Jueves") {echo "selected";} ?> value="Jueves"><?= i18n("Thursday") ?></option>
                    <option <?php if ($newActivity->getDay() == "Viernes") {echo "selected";} ?> value="Viernes"><?= i18n("Friday") ?></option>
            </th>
            <th>
                <button type="submit"><?= i18n("Add") ?></button>
            </th>
        </form>
    </tr>
</table>
</div>
</div>
