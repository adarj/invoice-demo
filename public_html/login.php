<?php
require_once("resources/functions/database.php");

if (!empty($_POST)) {
    loginToAccount();
}

# Load HTML/CSS
require_once("resources/templates/header.php");
require_once("resources/templates/forms/login.php");
require_once("resources/templates/footer.php");
?>
