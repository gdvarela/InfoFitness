<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


if($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$workouts = $view->getVariable("workouts");
?>
<table>
    <tr class="topTable">
        <th><?= i18n("Name")?></th>
        <th><?= i18n("Description")?></th>
    </tr>
    <?php foreach($workouts as $workout): ?>
      <tr class="mainTable">
          <th><a href=?controller=workout&action=listExercises><?= $workout->getWorkoutName() ?></a></th>
          <th><?= $workout->getWorkoutDes() ?></th>

      </tr>
      <?php endforeach; ?>
</table>
