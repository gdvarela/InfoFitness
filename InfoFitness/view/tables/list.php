<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$tables = $view->getVariable("tables");
$newTable = $view->getVariable("newTable");
?>
<div class="datagrid">
<table>
    <tr class="topTable">
        <th><?= i18n("Name")?></th>
        <th><?= i18n("Description")?></th>

    </tr>
    <?php foreach($tables as $table): ?>
        <tr class="mainTable">
            <form action="?controller=tables&amp;action=modify" method="POST">
                <th> <input name="tableName" value="<?= $table->getTableName() ?>"> </th>
                <th> <textarea name="tableDes" ><?= $table->getTableDes() ?> </textarea></th>
                <th>
                    <input name="tableId" value="<?= $table->getId() ?>" hidden="true">
                    <button type="submit"><?= i18n("Modify")?></button>
                </th>
            </form>
            <th>
                <form action="?controller=tables&amp;action=delete" method="POST">
                    <input name="tableId" value="<?= $table->getId() ?>" hidden="true">
                    <button><?= i18n("Delete")?></button>
                </form>
            </th>
            <th>
                <form action="?controller=tables&amp;action=details" method="POST">
                    <input name="tableId" value="<?= $table->getId() ?>" hidden="true">
                    <button><?= i18n("Details")?></button>
                </form>
            </th>
        </tr>
    <?php endforeach; ?>
    <tr>
        <form action="?controller=tables&amp;action=add" method="POST">
            <th> <input name="tableName" value="<?= $newTable->getTableName() ?>"> </th>
            <th> <textarea name="tableDes" ><?= $newTable->getTableDes() ?></textarea> </th>
            <th>
              <input name="tableId" value="<?= $table->getId() ?>" hidden="true">
              <button type="submit"><?= i18n("Add")?></button>
            </th>
        </form>
    </tr>
</table>
</div>
