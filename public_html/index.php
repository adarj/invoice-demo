<?php
session_start();

require_once("../resources/config.php");
require_once(TEMPLATES_PATH . "/header.php");

# If the user is not logged in, then open login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
} else {
    require_once("login.php");
}

require_once(TEMPLATES_PATH . "/footer.php");
