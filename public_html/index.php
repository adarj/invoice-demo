<?php

# If the user is not logged in, then open login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
} else {
    require_once("login.php");
}
