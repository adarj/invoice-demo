<?php
require_once(root_path . "/resources/functions/database.php");

if (!empty($_POST)) {
    loginToAccount();
}

# Load HTML/CSS
require_once(root_path . "/resources/templates/header.php");
require_once(root_path . "/resources/templates/forms/login.php");
require_once(root_path . "/resources/templates/footer.php");
?>
