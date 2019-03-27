<?php
session_start();

require_once("../../config.php");
require_once(root_path . "/resources/functions/database.php");

if (!empty($_POST)) {
    $customer = $_POST["customer"];
    $invoiceNumber = trim($_POST["invoice-number"]);
    $invoiceDate = $_POST["invoice-date"];
    $invoiceAmount = trim($_POST["invoice-amount"]);
    $invoiceStatus = $_POST["invoice-status"];

    addInvoice($customer, $invoiceNumber, $invoiceDate, $invoiceAmount, $invoiceStatus);
}

# If the user is not logged in, then open login page
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== True){
    header("location: /");
    exit();
}

$customers = getCustomers();

# Load HTML/CSS
require_once(root_path . "/resources/templates/header.php");
require_once(root_path . "/resources/templates/navbar.php");
require_once(root_path . "/resources/templates/forms/new-invoice.php");
require_once(root_path . "/resources/templates/footer.php");
?>
