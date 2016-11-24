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
<table>
    <tr class="topTable">
        <th><?= i18n("Table name")?></th>
        <th><?= i18n("Description")?></th>

    </tr>
        <tr class="mainTable">
            <form action="?controller=tables&amp;action=modify" method="POST">
                <th> <input name="tableName" value="<?= $tables->getTableName() ?>"> </th>
                <th> <textarea name="tableDes" ><?= $tables->getTableDes() ?> </textarea></th>
                <th>
                    <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
                    <button type="submit"><?= i18n("Modify")?></button>
                </th>
            </form>
        </tr>
        <tr class="topTable">
            <th><?= i18n("Table Exercises")?></th>
        </tr>
        <tr class="topTable">
          <th><?= i18n("Name")?></th>
          <th><?= i18n("Description")?></th>
          <th><?= i18n("Dificulty")?></th>
          <th><?= i18n("Muscle group")?></th>
          <th><?= i18n("Media")?></th>
          <th><?= i18n("Machine")?></th>
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
              <th> <?= $exercise["multimedia"]?></th>
              <th> <?= $exercise["maquina"]?></th>
              <input name="exerciseId" value="<?= $exercise["id_ejercicio"] ?>" hidden="true">
              <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
              <th>
                  <button type="submit"><?= i18n("Delete")?></button>
              </th>
            </form>
      </tr>
    <?php endforeach;
    }?>
      <tr class="topTable">
          <th><?= i18n("Añadir Ejercicios")?></th>
      </tr>
      <?php
        if($exercises != null){
          foreach($exercises as $exercise):
         ?>
      <tr>
          <form action="?controller=tables&amp;action=detailsAdd" method="POST">
            <th><?= $exercise["nombre"]?></th>
            <input name="exerciseId" value="<?= $exercise["id_ejercicio"] ?>" hidden="true">
            <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
            <th>
                <button type="submit"><?= i18n("Add")?></button>
            </th>
          </form>
    </tr>
  <?php endforeach;
  }?>
</table>
</div>
