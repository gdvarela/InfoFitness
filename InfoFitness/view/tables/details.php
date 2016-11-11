<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$exercisesTable = $view->getVariable("exercisesTable");
$exercises = $view->getVariable("exercises");
$exercisesNotAsigned = $view->getVariable("exercisesNotAsigned");
$newTable = $view->getVariable("newTable");
?>

<table>
    <tr class="topTable">
        <th><?= i18n("Name")?></th>
        <th><?= i18n("Description")?></th>
    </tr>
        <tr clas="mainTable">
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
            <th><?= i18n("Ejercicios Tabla")?></th>
        </tr>
        <?php
          if($exercisesTable != null){
            foreach($exercisesTable as $exercise):
           ?>
        <tr>
            <form action="?controller=tables&amp;action=detailsDelete" method="POST">
              <th> <input name="deleteExercise" value="<?= $exercise["nombre"]?>"> </th>
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
            <th> <input name="addExercise" value="<?= $exercise["nombre"]?>"> </th>
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
