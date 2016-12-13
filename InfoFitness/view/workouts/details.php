<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$tables = $view->getVariable("tables");
$exercisesTable = $view->getVariable("exercisesTable");
$exercises = $view->getVariable("exercises");
$exercisesNotAsigned = $view->getVariable("exercisesNotAsigned");
$newTable = $view->getVariable("newTable");

?>
<script src="./../../js/print.js" type="text/javascript"></script>
<div class="datagrid">
<table>
        <tr class="topTable">
            <th><?= i18n("Table Exercises")?></th>
            <th><?= i18n("Description")?></th>
            <th><?= i18n("Muscular Group")?></th>
            <th><?= i18n("Machine")?></th>
        </tr>
        <?php
          if($exercises != null){
            foreach($exercisesTable as $exercise):
           ?>
            <tr class="mainTable">
              <th><?= $exercise["nombre"] ?></th>
              <th><?= $exercise["descripcion"] ?></th>
              <th><?= $exercise["grupo_muscular"] ?></th>
              <th><?= $exercise["maquina"] ?></th>
            </tr>
            <?php endforeach;
        }?>
</table>
</div>
</br>
<div id="noprint">
<form action="?controller=session&amp;action=newSession" method="POST">
    <textarea name="anotacion" placeholder="<?=i18n("Add comment")?>" cols="40" rows="10"></textarea></br>
    <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
    <button class="button" type="submit"><?= i18n("Register Session")?></button>
</form>
<input class="button" type="button" onclick="window.print()" value="<?= i18n("Print")?> " />
</div>
