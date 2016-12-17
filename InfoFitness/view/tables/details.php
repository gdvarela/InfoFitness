<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$tables = $view->getVariable("tables");
$exercisesTable = $view->getVariable("exercisesTable");
$exercises = $view->getVariable("exercises");
$exercisesNotAsigned = $view->getVariable("exercisesNotAsigned");
$newTable = $view->getVariable("newTable");
?>

<div class="datagrid">
  <p class="tittletext"><?= i18n("Name and Description")?></p>
<table>
    <tr class="topTable">
        <th><?= i18n("Name")?></th>
        <th><?= i18n("Description")?></th>
    </tr>
        <tr class="mainTable">
            <form action="?controller=tables&amp;action=modify" method="POST">
                <th> <input name="tableName" value="<?= $tables->getTableName() ?>"> </th>
                <th> <textarea name="tableDes" ><?= $tables->getTableDes() ?> </textarea></th>
                <th>
                    <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
                    <button class="button" type="submit"><?= i18n("Modify")?></button>
                </th>
            </form>
        </tr>
      </table>
      <p class="tittletext"><?= i18n("Table Exercises")?></p>
      <table>
        <tr class="topTable">
          <th><?= i18n("Name")?></th>
          <th><?= i18n("Description")?></th>
          <th><?= i18n("Dificulty")?></th>
          <th><?= i18n("Muscle group")?></th>
          <th><?= i18n("Machine")?></th>
          <th><?= i18n("Charge(Kg)")?></th>
          <th><?= i18n("Repetitions")?></th>
        </tr>
        <?php
          if($exercisesTable != null){
            foreach($exercisesTable as $exercise):
           ?>
        <tr>
            <form action="?controller=tables&amp;action=detailsDelete" method="POST">
              <th> <?= $exercise["nombre"]?> </th>
              <th> <?= $exercise["descripcion"]?></th>
              <th> <?= $exercise["dificultad"]?></th>
              <th> <?= $exercise["grupo_muscular"]?></th>
              <th> <?= $exercise["maquina"]?></th>
              <th> <?= $exercise["carga"]?></th>
              <th> <?= $exercise["repeticiones"]?></th>
              <input name="exerciseId" value="<?= $exercise["id_ejercicio"] ?>" hidden="true">
              <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
              <th>
                  <button class="button" type="submit"><?= i18n("Delete")?></button>
              </th>
            </form>
      </tr>
    <?php endforeach;
    }?>
  </table>
  <p class="tittletext"><?= i18n("Add Exercises")?></p>
  <table>
      <tr class="topTable">
        <th><?= i18n("Name")?></th>
        <th><?= i18n("Charge(Kg)")?></th>
        <th><?= i18n("Repetitions")?></th>
      </tr>
      <?php
        if($exercises != null){
          foreach($exercises as $exercise):
         ?>
      <tr>
          <form action="?controller=tables&amp;action=detailsAdd" method="POST">
            <th><?= $exercise["nombre"]?></th>
            <td><input name="charge" value="0"></td>
            <td><input name="repetitions" value="0"></td>
            <input name="exerciseId" value="<?= $exercise["id_ejercicio"] ?>" hidden="true">
            <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
            <th>
                <button class="button" type="submit"><?= i18n("Add")?></button>
            </th>
          </form>
    </tr>
  <?php endforeach;
  }?>
</table>
</div>
