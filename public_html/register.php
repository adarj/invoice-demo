<?php
require_once("config.php");
require_once(root_path . "/resources/functions/database.php");

if (!empty($_POST)) {
    createAccount();
}

# Load HTML/CSS
require_once(root_path . "/resources/templates/header.php");
require_once(root_path . "/resources/templates/forms/register.php");
require_once(root_path . "/resources/templates/footer.php");
?>
