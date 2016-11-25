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
    <p class="tittletext"><?= $table->getTableName() ?></p>

    <table class="halftable">
      <tr class="topTable"><th colspan="2"><?=i18n("Athletes")?></th><th></th></tr>
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
    <div class="floatbuttonstables">
        <button class="button" form="formTableAddUser" type="submit"><?= i18n("Assign") ?>►</button></br></br>
        <button class="button" form="formTableDeleteUser" type="submit">◄<?= i18n("Unassign") ?></button>
    </div>
    <table class="halftable2">
      <tr class="topTable"><th colspan="2"><?=i18n("Assigned")?></th><th></th></tr>
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
