<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


if($_SESSION["type"] == 0)  {
    $view->redirect("index", "unauthorized");
}
$table_statictics = $view->getVariable("table_statictics");
$assitance_statictics = $view->getVariable("assitance_statictics");
$age_statictics = $view->getVariable("age_statictics");
$errors = $view->getVariable("errors");
?>
<p class="tittletext"><?= i18n("Assistance Statictics") ?></p>
<div class="datagrid">
<table>
    <tr class="topTable">
        <th><?= i18n("Activities")?></th>
        <th><?= i18n("Women Percentage")?></th>
		    <th><?= i18n("Men Percentage")?></th>
    </tr>
    <?php foreach ($assitance_statictics as $activity):?>
      <tr class="mainTable">
        <td><?= $activity->getActivityName() ?></td>
        <td><?= $activity->getWomenPercent() ?></td>
        <td><?= $activity->getMenPercent() ?></td>
      </tr>
      <?php endforeach; ?>
</table>
</div>

<p class="tittletext"><?= i18n("Age Statictics") ?></p>
<div class="datagrid">
<table>
    <tr class="topTable">
        <th><?= i18n("Activities")?></th>
        <th><?= i18n("Women Average Age")?></th>
		    <th><?= i18n("Men Average Age")?></th>
    </tr>
    <?php foreach ($age_statictics as $act):?>
      <tr class="mainTable">
        <td><?= $act->getActivityName() ?></td>
        <td><?= $act->getAvgWomenAge() ?></td>
        <td><?= $act->getAvgMenAge() ?></td>
      </tr>
      <?php endforeach; ?>
</table>
</div>

<p class="tittletext"><?= i18n("Percentage Used Tables") ?></p>
<div class="datagrid">
<table>
    <tr class="topTable">
        <th><?= i18n("Tables")?></th>
        <th><?= i18n("Use Percentage")?></th>
    </tr>
    <?php foreach ($table_statictics as $table):?>
      <tr class="mainTable">
        <td><?= $table->getTableName() ?></td>
        <td><?= $table->getTablePercent() ?></td>
      </tr>
      <?php endforeach; ?>
</table>
</div>
