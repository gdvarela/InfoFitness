<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 2) {
    $view->redirect("index", "unauthorized");
}

$machines = $view->getVariable("machines");
$newMachine = $view->getVariable("newMachine");
$errors = $view->getVariable("errors");
?>
<?= isset($errors["activityName"]) ? $errors["activityName"] : "" ?><br>
<div class=datagrid>
    <p class="tittletext"><?= i18n("Machines") ?></p>
    <table>
        <tr class="topTable">
            <th><?= i18n("Name") ?></th>
            <th><?= i18n("Description") ?></th>
            <?php foreach ($machines as $machine): ?>
        <tr class="mainTable">
            <form action="?controller=machines&action=modify" method="POST">
                <th><input name="machineName" value="<?= $machine->getName() ?>"></th>
                <th><input name="description" value="<?= $machine->getDescription() ?>"></th>
                <th>
                    <input name="machineId" value="<?= $machine->getId() ?>" hidden="true">
                    <button class="button" type="submit"><?= i18n("Modify") ?></button>
                </th>
            </form>
            <th>
                <form action="?controller=machines&action=delete" method="POST">
                    <input name="machineId" value="<?= $machine->getId() ?>" hidden="true">
                    <button class="button"><?= i18n("Delete") ?></button>
                </form>
            </th>
        </tr>
        <?php endforeach; ?>
        <tr>
            <form action="?controller=machines&action=add" method="POST">
                <th><input name="machineName" value="<?= $newMachine->getName() ?>"></th>
                <th><input name="description" value="<?= $newMachine->getDescription() ?>">
                <th>
                    <button class="button" type="submit"><?= i18n("Add") ?></button>
                </th>
            </form>
        </tr>
    </table>
</div>