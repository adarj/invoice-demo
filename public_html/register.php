<?php
session_start();

function usernameIsUnique($paremUsername, $db) {
    $sql = "SELECT id FROM USERS WHERE username = :u";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $paremUsername);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        return False;
    }

    return True;
}

function createAccount($paremUsername, $paremPassword, $db) {
    $sql = "INSERT INTO USERS (username, password) VALUES (:u, :p)";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $paremUsername);
    $stmt->bindValue(":p", $paremPassword);
    $stmt->execute();
}

require_once("resources/templates/header.php");

$db = new SQLite3("resources/app.db");
$sql = <<<EOD
CREATE TABLE IF NOT EXISTS USERS (
    id INTEGER PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
EOD;
$db->exec($sql);

if (!empty($_POST)) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
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
