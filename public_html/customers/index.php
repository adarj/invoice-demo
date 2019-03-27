<?php
session_start();

require_once("../config.php");
require_once(root_path . "/resources/functions/database.php");

# If the user is not logged in, then open login page
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== True){
    header("location: /");
    exit();
}

# Load HTML/CSS
require_once(root_path . "/resources/templates/header.php");
require_once(root_path . "/resources/templates/navbar.php");
require_once(root_path . "/resources/templates/footer.php");
?>