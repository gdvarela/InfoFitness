<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}

$users = $view->getVariable("users");
?>
<span><?= i18n("Activity") ?></span>
<span><?= i18n("Place") ?></span>
<table>
    <tr class="topTable">
        <th><?= i18n("User") ?></th>
        <th><?= i18n("Name") ?></th>
        <th><?= i18n("Last name") ?></th>
        <th><?= i18n("DNI") ?></th>
    </tr>
    <form action="?controller=activities&action=checkAssistance" method="POST">
        <?php foreach($users as $user): ?>
            <tr clas="mainTable">
                <td><?= $user->getUsername()?></td>
                <td><?= $user->getNombre()?></td>
                <td><?= $user->getApellidos()?></td>
                <td><?= $user->getDni() ?></td>
                <td> <input type="checkbox" name="<?= $user->getIdUsr() ?>"></td>
            </tr>
        <?php endforeach; ?>
        <button type="submit"><?= i18n("Save") ?></button>
    </form>
</table>
