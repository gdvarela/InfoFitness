<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$exercises = $view->getVariable("exercises");
$newExercise = $view->getVariable("newExercise");
$machines = $view->getVariable("machines");
?>
<div class="datagrid">
    <p class="tittletext"><?= i18n("Exercises List") ?></p>
    <table>
        <tr class="topTable">
            <th><?= i18n("Name") ?></th>
            <th><?= i18n("Description") ?></th>
            <th><?= i18n("Dificulty") ?></th>
            <th><?= i18n("Muscle group") ?></th>
            <th><?= i18n("Machine") ?></th>
        </tr>
        <?php foreach ($exercises as $exercise): ?>
            <tr class="mainTable">
                <form action="?controller=exercises&action=modify" method="POST" enctype=”multipart/form-data”>
                    <th><input name="exerciseName" value="<?= $exercise->getExerciseName() ?>"></th>
                    <th><input name="exerciseDes" value="<?= $exercise->getDescription() ?>"></th>
                    <th><input name="exerciseDificulty" value="<?= $exercise->getDificulty() ?>"></th>
                    <th><input name="exerciseMuscleGroup" value="<?= $exercise->getMuscleGroup() ?>"></th>
                    <th><select name="exerciseMachine">
                            <?php foreach ($machines as $machine): ?>
                                <option <?php if ($machine->getId() == $exercise->getMachine()) {
                                    echo "selected";
                                } ?>
                                    value="<?= $machine->getId() ?>"><?= $machine->getName() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </th>
                    <th>
                        <input name="exerciseId" value="<?= $exercise->getId() ?>" hidden="true">
                        <button class="button" type="submit"><?= i18n("Modify") ?></button>
                    </th>
                </form>
                <th>
                    <form action="?controller=exercises&action=delete" method="POST">
                        <input name="exerciseId" value="<?= $exercise->getId() ?>" hidden="true">
                        <button class="button"><?= i18n("Delete") ?></button>
                    </form>
                </th>
            </tr>
        <?php endforeach; ?>
        <tr>
            <form action="?controller=exercises&action=add" method="POST" enctype=”multipart/form-data”>
                <th><input name="exerciseName" value="<?= $newExercise->getExerciseName() ?>"></th>
                <th><input name="exerciseDes" value="<?= $newExercise->getDescription() ?>"></th>
                <th><input name="exerciseDificulty" value="<?= $newExercise->getDificulty() ?>"></th>
                <th><input name="exerciseMuscleGroup" value="<?= $newExercise->getMuscleGroup() ?>"></th>
                <th><select name="exerciseMachine">
                        <?php foreach ($machines as $machine): ?>
                            <option value="<?= $machine->getId() ?>"><?= $machine->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
                <th>
                    <button class="button" type="submit"><?= i18n("Add") ?></button>
                </th>
            </form>
        </tr>
    </table>
</div>
