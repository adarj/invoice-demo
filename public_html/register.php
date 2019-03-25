<?php
session_start();

require_once("resources/templates/header.php");

require_once("resources/functions/database.php");
if (!empty($_POST)) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $db = initDatabase();

        if (usernameIsUnique($username, $db)) {
            createAccount($username, $password, $db);
            $db->close();
            header("location: /");
            exit();
        } else {
            echo "Username not unique";
        }
    } else {
        echo "Username or password is empty";
    }
}

require_once("resources/forms/register.php");
require_once("resources/templates/footer.php");
?>
