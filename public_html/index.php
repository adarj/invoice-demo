<?php
session_start();

# If the user is not logged in, then open login page
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === True){
    require_once("home.php");
} else {
    require_once("login.php");
}
?>
