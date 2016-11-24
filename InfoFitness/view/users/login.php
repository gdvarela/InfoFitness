<?php
 //file: view/users/login.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $view->setVariable("title", "Login");
 $errors = $view->getVariable("errors");
?>
<div id=login>
  <h1><?= i18n("Login") ?></h1>
  <?= isset($errors["general"])?$errors["general"]:"" ?>

  <form action="index.php?controller=users&amp;action=login" method="POST">
  <?= i18n("Username")?>: </br><input type="text" name="username"></br></br>
  <?= i18n("Password")?>: </br><input type="password" name="passwd"></br></br>
  <input class="button" type="submit" value="<?= i18n("Login") ?>">
  <a href="index.php?controller=users&amp;action=register"><input class="button" type="button" value="<?= i18n("Register") ?>"></a>
  </form>
</div>

<?php $view->moveToFragment("css");?>
    <link rel="stylesheet" type="text/css" src="css/style2.css">
<?php $view->moveToDefaultFragment(); ?>
