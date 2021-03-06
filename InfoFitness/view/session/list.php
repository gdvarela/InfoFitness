<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


if($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$sessions = $view->getVariable("sessions");

$long = count($sessions);

?>
<p class="tittletext"><?= i18n("Session History") ?></p>
<div class="datagrid">
<table>
    <tr class="topTable">
        <th><?= i18n("Date")?></th>
        <th><?= i18n("Comment")?></th>
        <th><?= i18n("Description")?></th>
    </tr>
    <?php for($i=0; $i<$long; $i++){ ?>
      <tr class="mainTable">
          <th><?= $sessions[$i]->getFecha() ?></th>
          <th><?= $sessions[$i]->getComentario() ?></th>
          <th><?= $sessions[$i]->getDescripcion() ?></th>
      </tr>
      <?php } ?>
</table>
</div>
