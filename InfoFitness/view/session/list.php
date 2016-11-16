<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


if($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$sessions = $view->getVariable("sessions");

$long = count($sessions);

?>
<table>
    <tr class="topTable">
        <th><?= i18n("Fecha")?></th>
        <th><?= i18n("Comentario")?></th>
    </tr>
    <?php for($i=0; $i<$long; $i++){ ?>
      <tr class="mainTable">
          <th><?= $sessions[$i]->getFecha() ?></th>
          <th><?= $sessions[$i]->getComentario() ?></th>
      </tr>
      <?php } ?>
</table>
