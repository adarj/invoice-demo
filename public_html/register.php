<?php
require_once("resources/functions/database.php");

if (!empty($_POST)) {
    createAccount();
}

# Load HTML/CSS
require_once("resources/templates/header.php");
require_once("resources/templates/forms/register.php");
require_once("resources/templates/footer.php");
?>
