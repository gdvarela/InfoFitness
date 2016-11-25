<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$exercises = $view->getVariable("exercises");
 ?>
 <p class="tittletext"><?= i18n("Exercises List") ?></p>
<div class="datagrid">
 <table class="table">
     <tr class="topTable">
         <th><?= i18n("Name")?></th>
         <th><?= i18n("Description")?></th>
         <th><?= i18n("Dificulty")?></th>
         <th><?= i18n("Muscle group")?></th>
         <th><?= i18n("Machine")?></th>
     </tr>
     <?php foreach($exercises as $exercise): ?>
         <tr class="mainTable">
                 <th><?= $exercise->getExerciseName() ?></th>
                 <th><?= $exercise->getDescription() ?></th>
                 <th><?= $exercise->getDificulty() ?></th>
                 <th><?= $exercise->getMuscleGroup() ?></th>
                 <th><?= $exercise->getMachine() ?></th>
         </tr>
     <?php endforeach; ?>
 </table>
</div>
