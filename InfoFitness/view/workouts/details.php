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

<table>
        <tr class="topTable">
            <th><?= i18n("Ejercicios Tabla")?></th>
            <th><?= i18n("Descripcion")?></th>
            <th><?= i18n("Grupo_muscular")?></th>
            <th><?= i18n("Maquina")?></th>
        </tr>
        <?php
          if($exercises != null){
            foreach($exercisesTable as $exercise):
           ?>
            <tr>
              <th><?= $exercise["nombre"] ?></th>
              <th><?= $exercise["descripcion"] ?></th>
              <th><?= $exercise["grupo_muscular"] ?></th>
                            <th><?= $exercise["maquina"] ?></th>
            </tr>
            <?php endforeach;
        }?>
</table>
<form action="?controller=session&amp;action=newSession" method="POST">
    <textarea name="anotacion"></textarea></br>
    <input name="tableId" value="<?= $tables->getId() ?>" hidden="true">
    <button><?= i18n("Register Session")?></button></form>
