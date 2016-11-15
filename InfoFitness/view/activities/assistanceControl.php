<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

if($_SESSION["type"] != 1) {
    $view->redirect("index", "unauthorized");
}
?>