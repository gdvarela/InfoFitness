<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$table = $view->getVariable("table");
$usersOnTable = $view->getVariable("usersTable");
$usersNotOnTable = $view->getVariable("usersNotOnTable");

?>

<div class="datagrid">
    <table>
        <tr>
            <th><?= i18n("Table name") ?>:&nbsp;</th>
            <th><?= $table->getTableName() ?></th>
        </tr>
        <tr>
            <th><?= i18n("Description") ?>:&nbsp;</th>
            <th><?= $table->getTableDes() ?></th>
        </tr>
    </table>

    <table>
        <form id="formTableAddUser" action="?controller=tables&action=addUser" method="POST">
            <?php foreach ($usersNotOnTable as $user): ?>
                <tr class="mainTable">
                    <th><?= $user->getNombre() ?></th>
                    <th><?= $user->getApellidos() ?></th>
                    <th><input type="checkbox" name="users[]" value="<?= $user->getIdUsr() ?>"></th>
                </tr>
            <?php endforeach; ?>
            <input name="tableId" value="<?= $table->getId()?>" hidden="true">
        </form>
    </table>
    <div>
        <button class="button" form="formTableAddUser" type="submit"><?= i18n("Assign") ?></button>
        <button class="button" form="formTableDeleteUser" type="submit"><?= i18n("Unassign") ?></button>
    </div>
    <table>
        <form id="formTableDeleteUser" action="?controller=tables&action=deleteUser" method="POST">
            <?php foreach ($usersOnTable as $user): ?>
                <tr class="mainTable">
                    <th><?= $user->getNombre() ?></th>
                    <th><?= $user->getApellidos() ?></th>
                    <th><input type="checkbox" name="users[]" value="<?= $user->getIdUsr() ?>"></th>
                </tr>
            <?php endforeach; ?>
            <input name="tableId" value="<?= $table->getId()?>" hidden="true">
        </form>
    </table>
</div>
