<?php
//file: controller/LanguageController.php

require_once(__DIR__."/../core/I18n.php");

class LanguageController {
    const LANGUAGE_SETTING = "__language__";

    public function change() {
      if(!isset($_GET["lang"])) {
	throw new Exception("no lang parameter was provided");
      }
      if (session_status() == PHP_SESSION_NONE) {      
	session_start();
      }
      I18n::getInstance()->setLanguage($_GET["lang"]);
      
      //go back to previous page
      header("Location: ".$_SERVER["HTTP_REFERER"]);
      die();
    }
}