<?php
# If the user is not logged in, then open login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    require_once("home.php");
} else {
    require_once("login.php");
}
?>
