<?php
session_start();

require_once("../../config.php");
require_once(root_path . "/resources/functions/database.php");

if (!empty($_POST)) {
    $firstName = trim($_POST["first-name"]);
    $lastName = trim($_POST["last-name"]);

    if (!empty($firstName) && !empty($lastName)) {
        addCustomer($firstName, $lastName);
    } else {
        throw new Exception("First name or last name field is empty");
    }
}

# If the user is not logged in, then open login page
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== True){
    header("location: /");
    exit();
}

# Load HTML/CSS
require_once(root_path . "/resources/templates/header.php");
require_once(root_path . "/resources/templates/navbar.php");
require_once(root_path . "/resources/templates/forms/new-customer.php");
require_once(root_path . "/resources/templates/footer.php");
?>
