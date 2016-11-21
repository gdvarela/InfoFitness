<?php
// file: view/layouts/language_select_element.php
?>
<ul id="languagechooser">
	<li><a class ="languagelink" href="index.php?controller=language&amp;action=change&amp;lang=es">
	<img class="headerimg" src="./img/spain.png">
	<?= i18n("Spanish") ?>
	</a></li>
	<li><a class="languagelink" href="index.php?controller=language&amp;action=change&amp;lang=en">
	<img class="headerimg" src="./img/england.png">
	<?= i18n("English") ?>
	</a></li>
</ul>
