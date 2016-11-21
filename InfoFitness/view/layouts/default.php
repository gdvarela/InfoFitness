<?php
 //file: view/layouts/default.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

?><!DOCTYPE html>
<html>
  <head>
    <title><?= $view->getVariable("title", "no title") ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
  </head>
  <body>
    <!-- header -->
    <header id="header">
      <div>
        <a class="indexlink" href="?controller=index&action=welcome">InfoFitness</a>
      </div>
      <div class="headercontent">
          <?php
          include(__DIR__."/language_select_element.php");
          ?>
      </div>
      <div class="headercontent">
  	      <ul class="nav">
  	         <?php if (isset($_SESSION["currentuser"])): ?>
  	        <li><?= $_SESSION["currentuser"] ?>
              <ul>
  	            <li><a class="indexlink"	href="index.php?controller=users&amp;action=logout"><?=i18n("Logout")?></a></li>
              </ul>
  	        </li>
  	        <?php else: ?>
  	        <li><a href="index.php?controller=users&amp;action=login"><?= i18n("Login") ?></a></li>
  	        <?php endif ?>
  	      </ul>
      </div>
    </header>

    <main>
      <div id="flash">
	       <?= $view->popFlash() ?>
      </div>
        <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </main>

    <footer id="footer">
        <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        © InfoFitness 2016
                    </li>
                    <li>
                        Empresa
                    </li>
                    <li>
                        Contacto
                    </li>
                    <li>
                        Colaboradores
                    </li>
                    <li>
                        Expansión
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        Sobre Infofitness
                    </li>
                    <li>
                        Condiciones Generales
                    </li>
                    <li>
                        Protección de datos
                    </li>
                    <li>
                        Información legal
                    </li>
                    <li>
                        Plotica de cookies
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        Staff
                    </li>
                    <li>
                        Miembros
                    </li>
                    <li>
                        Secciones
                    </li>
                    <li>
                       Instalaciones
                    </li>
                    <li>
                        Horario
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        <?= i18n("Social networks") ?>
                    </li>
                    <li>
                        <img class="footerimg" src="./img/facebook_icon.svg"> Facebook
                    </li>
                    <li>
                        <img class="footerimg" src="./img/twitter_icon.svg"> Twitter
                    </li>
                    <li>
                        <img class="footerimg" src="./img/youtube_icon.svg"> Youtube
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        <?= i18n("Users") ?>
                    </li>
                    <li>
                        <img class="footerimg" src="./img/users_blue_icon.svg">198539 <?= i18n("members") ?>
                    </li>
                    <li>
                        <img class="footerimg" src="./img/users_green_icon.svg">11984 <?= i18n("online") ?>
                    </li>
                </ul>
            </div>
    </footer>

  </body>
</html>
