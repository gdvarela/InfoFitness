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
        </tr>
        <?php
          if($exercises != null){
            foreach($exercisesTable as $exercise):
           ?>
            <tr>
              <th><?= $exercise["nombre"] ?></th>
              <th><?= $exercise["descripcion"] ?></th>
            </tr>
            <?php endforeach;
        }?>
</table>
