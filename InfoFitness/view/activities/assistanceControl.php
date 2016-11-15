<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}
?>

<table>
    <tr class="topTable">
        <th><?= i18n("Activity") ?></th>
        <th><?= i18n("Place") ?></th>
        <th><?= i18n("Monitor") ?></th>
        <th><?= i18n("Place") ?></th>
    </tr>
</table>