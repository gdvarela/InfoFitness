<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$exercises = $view->getVariable("exercises");
$newExercise = $view->getVariable("newExercise");
 ?>

 <div class="datagrid">
 <table>
     <tr class="topTable">
         <th><?= i18n("Name")?></th>
         <th><?= i18n("Description")?></th>
         <th><?= i18n("Dificulty")?></th>
         <th><?= i18n("Muscle group")?></th>
          <th><?= i18n("Media")?></th>
         <th><?= i18n("Machine")?></th>
     </tr>
     <?php foreach($exercises as $exercise): ?>
         <tr class="mainTable">
             <form action="?controller=exercises&action=modify" method="POST" enctype=”multipart/form-data”>
                 <th> <input name="exerciseName" value="<?= $exercise->getExerciseName() ?>"> </th>
                 <th> <input name="exerciseDes" value="<?= $exercise->getDescription() ?>"> </th>
                 <th> <input name="exerciseDificulty" value="<?= $exercise->getDificulty() ?>"> </th>
                 <th> <input name="exerciseMuscleGroup" value="<?= $exercise->getMuscleGroup() ?>"> </th>
                 <th> <input type="file" name="exerciseMedia" value="<?= $exercise->getMedia() ?>"> </th>
                 <th> <input name="exerciseMachine" value="<?= $exercise->getMachine() ?>"> </th>
                 <th>
                     <input name="exerciseId" value="<?= $exercise->getId() ?>" hidden="true">
                     <button type="submit"><?= i18n("Modify")?></button>
                 </th>
             </form>
             <th>
                 <form action="?controller=exercises&action=delete" method="POST">
                     <input name="exerciseId" value="<?= $exercise->getId() ?>" hidden="true">
                     <button><?= i18n("Delete")?></button>
                 </form>
             </th>
         </tr>
     <?php endforeach; ?>
     <tr>
         <form action="?controller=exercises&action=add" method="POST" enctype=”multipart/form-data”>
           <th> <input name="exerciseName" value="<?= $newExercise->getExerciseName() ?>"> </th>
           <th> <input name="exerciseDes" value="<?= $newExercise->getDescription() ?>"> </th>
           <th> <input name="exerciseDificulty" value="<?= $newExercise->getDificulty() ?>"> </th>
           <th> <input name="exerciseMuscleGroup" value="<?= $newExercise->getMuscleGroup() ?>"> </th>
           <th> <input type="file" name="exerciseMedia" value="<?= $newExercise->getMedia() ?>"> </th>
           <th> <input name="exerciseMachine" value="<?= $newExercise->getMachine() ?>"> </th>
           <th>
               <button type="submit"><?= i18n("Add")?></button>
           </th>
         </form>
     </tr>
 </table>
</div>
