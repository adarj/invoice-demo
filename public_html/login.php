<?php
require_once("resources/functions/database.php");

if (!empty($_POST)) {
    loginToAccount();
}

require_once("resources/templates/header.php");
require_once("resources/forms/login.php");
require_once("resources/templates/footer.php");
?>
