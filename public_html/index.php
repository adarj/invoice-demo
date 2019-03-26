<?php
session_start();

require_once("config.php");

# If the user is not logged in, then open login page
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === True){
    require_once(root_path . "/home.php");
} else {
    require_once(root_path . "/login.php");
}
?>
