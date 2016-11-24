<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


if($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$workouts = $view->getVariable("workouts");
?>

<div class="datagrid">
<table>
    <tr class="topTable">
        <th><?= i18n("Name")?></th>
        <th><?= i18n("Description")?></th>
        <th></th>
    </tr>
    <?php foreach($workouts as $workout): ?>
      <tr class="mainTable">
          <th><?= $workout->getTableName() ?></th>
          <th><?= $workout->getTableDes() ?></th>
          <th><form action="?controller=tables&amp;action=detailsPublic" method="POST">
              <input name="tableId" value="<?= $workout->getId() ?>" hidden="true">
              <button class="button"><?= i18n("Details")?></button></form>
          </th>
      </tr>
      <?php endforeach; ?>
</table>
</div>
