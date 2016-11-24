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
      <div class="headercontent">
        <a  href="?controller=index&action=welcome"><img class="logo" src="./img/logo.svg"></a>
      </div>
      <div class="headercontent">
        <a class="indexlink" href="?controller=index&action=welcome">infoFitness</a>
      </div>
      <div class="headercontent">
          <?php
          include(__DIR__."/language_select_element.php");
          ?>
      </div>
      <div class="headercontent">
  	      <ul class="nav">
            <?php if (isset($_SESSION["currentuser"])): ?>
            <img class="userimg" src="./img/profile_img.svg"></a>
            <?php endif ?>
  	         <?php if (isset($_SESSION["currentuser"])): ?>
  	        <li class="menu"><?= $_SESSION["currentuser"]?></br>▼
              <ul>
                <?php if ($_SESSION["type"]==0): ?>
                <li class="menu"><a href="index.php?controller=tables&amp;action=listWorkouts"><?=i18n("My workouts")?></a></li>
                <?php endif ?>
                <?php if ($_SESSION["type"]==0): ?>
                <li class="menu"><a href="index.php?controller=activities&amp;action=slotsControl"><?=i18n("My activities")?></a></li>
                <?php endif ?>
                <?php if ($_SESSION["type"]==0): ?>
                <li class="menu"><a href="index.php?controller=session&amp;action=listSessions"><?=i18n("History")?></a></li>
                <?php endif ?>
  	            <li class="menu"><a href="index.php?controller=users&amp;action=logout"><?=i18n("Logout")?></a></li>
              </ul>
  	        </li>
  	        <?php endif ?>
  	      </ul>
      </div>
    </header>
<div id="container">
    <main>
      <div id="flash">
	       <?= $view->popFlash() ?>
      </div>
        <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </main>
</div>
    <footer id="footer">
        <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        © InfoFitness 2016
                    </li>
                    <li>
                        <a class="footerlink" href="http://www.deportes.uvigo.es/inicio/">Empresa</a>
                    </li>
                    <li>
                        <a class="footerlink" href="http://www.deportes.uvigo.es/instalacions/campus-de-ourense/">Contacto</a>
                    </li>
                    <li>
                        <a class="footerlink" href="https://deporxest.uvigo.es/WebDeportesUVigo/informacion/index.jsp?tipo=CONF.INFO_AVISO_LEGAL">
                          Aviso legal</a>
                    </li>
                    <li>
                        <a class="footerlink" href="https://deporxest.uvigo.es/WebDeportesUVigo/informacion/index.jsp?tipo=CONF.INFO_CONDICIONES_USO">
                          Política de privacidad</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        Staff
                    </li>
                    <li>
                        <a class="footerlink" href="http://www.deportes.uvigo.es/A-area-de-deportes/quen-somos/">Miembros</a>
                    </li>
                    <li>
                        <a class="footerlink" href="http://www.deportes.uvigo.es/instalacions/">Instalaciones</a>
                    </li>
                    <li>
                       <a class="footerlink" href="http://www.deportes.uvigo.es/seccions-deportivas/">Secciones deportivas</a>
                    </li>
                    <li>
                        <a class="footerlink" href="http://www.deportes.uvigo.es/instalacions/campus-de-ourense/">Horario</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                        <?= i18n("Social networks") ?>
                    </li>
                    <li>
                        <a class="footerlink" href="https://www.facebook.com/uvigo/">
                        <img class="footerimg" src="./img/facebook_icon.svg"> Facebook</a>
                    </li>
                    <li>
                        <a class="footerlink" href="https://twitter.com/uvigo/">
                          <img class="footerimg" src="./img/twitter_icon.svg"> Twitter</a>
                    </li>
                    <li>
                        <a class="footerlink" href="https://www.youtube.com/user/uvigo">
                          <img class="footerimg" src="./img/youtube_icon.svg"> Youtube</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="footercontent">
                    <li class="footertitle">
                      Area de Deporte de la Universidade de Vigo
                    </li>
                    <li>
                      <a class="footerlink" href="https://goo.gl/maps/bsMcAGFnbyQ2">Campus As Lagoas(Ourense)</a>
                    </li>
                    <li>
                      988 387 198
                    </li>
                    <li>
                      depor-ou@uvigo.es
                    </li>
                </ul>
            </div>
    </footer>

  </body>
</html>
