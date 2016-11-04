<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


?>

<form action="index.php?controller=users&amp;action=alta" method="POST">
    <?= i18n("Username")?>: <input type="text" name="username" value=""><br>
    <?= i18n("Password")?>: <input type="password" name="passwd" value=""><br>
    <input type="submit" value="<?= i18n("Register")?>">
</form>