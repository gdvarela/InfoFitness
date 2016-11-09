<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activities = $view->getVariable("activities");
$newActivity = $view->getVariable("newActivity");
$monitors = $view->getVariable("monitors");
?>

<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$activities = $view->getVariable("activities");
$newActivity = $view->getVariable("newActivity");
$monitors = $view->getVariable("monitors");
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
                <th> <input type="number" min="1" name="activityMaxAssis" value="<?= $activity->getMaxAssistants() ?>"> </th>
                <th> <input name="activityDes" value="<?= $activity->getDescription() ?>"> </th>
                <th> <input type="number" min="0" name="activityPrice" value="<?= $activity->getPrice() ?>">&euro;</th>
                <th> <input name="activityPlace" value="<?= $activity->getPlace() ?>"> </th>
                <th> <select name="monitor">
                        <?php foreach($monitors as $monitor): ?>
                            <option <?php if($monitor["id_entrenador"]==$activity->getMonitor()){echo "selected";} ?>
                                value="<?= $monitor["id_entrenador"] ?>"><?= $monitor["nombre"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
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
        <?= isset($errors["activityName"])?$errors["activityName"]:"" ?><br>
    <?php endforeach; ?>
    <tr>
        <form action="?controller=activities&action=add" method="POST">
            <th> <input name="activityName" value="<?= $newActivity->getActivityName() ?>"> </th>
            <th> <input type="number" min="1" name="activityMaxAssis" value="<?= $newActivity->getMaxAssistants() ?>"> </th>
            <th> <input name="activityDes" value="<?= $newActivity->getDescription() ?>"> </th>
            <th> <input type="number" name="activityPrice" value="<?= $newActivity->getPrice() ?>">&euro;</th>
            <th> <input name="activityPlace" value="<?= $newActivity->getPlace() ?>"> </th>
            <th> <select name="monitor">
                    <?php foreach($monitors as $monitor): ?>
                        <option value="<?= $monitor["id_entrenador"] ?>"><?= $monitor["nombre"] ?></option>
                    <?php endforeach; ?>
                </select> </th>
            <th>
                <button type="submit"><?= i18n("Add")?></button>
            </th>
        </form>
    </tr>
</table>

