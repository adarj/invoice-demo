<?php
require_once("config.php");
require_once(root_path . "/resources/functions/database.php");

if (!empty($_POST)) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        createAccount($username, $password);
    }
}

# Load HTML/CSS
require_once(root_path . "/resources/templates/header.php");
require_once(root_path . "/resources/templates/forms/register.php");
require_once(root_path . "/resources/templates/footer.php");
?>
