<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if ($_SESSION["type"] != 0) {
    $view->redirect("index", "unauthorized");
}

$activity = $view->getVariable("activity");
$errors = $view->getVariable("errors");
?>

<span><?= $activity ?> Days:</span>

<form action="?controller=activities&action=reserve" method="POST">
    <input type="checkbox" value="1"></br>
    <input type="checkbox" value="2"></br>
    <input type="checkbox" value="3"></br>
    <input type="checkbox" value="4"></br>
    <input type="checkbox" value="5"></br>
    <input type="checkbox" value="6"></br>
</form>
