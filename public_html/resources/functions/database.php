<?php
function initDatabase() {
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
    return $db;
}

function isUsernameUnique($paremUsername, $db) {
    $sql = "SELECT id FROM USERS WHERE username = :u";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $paremUsername);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        return False;
    }

    return True;
}

function createAccount() {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $db = initDatabase();

        if (isUsernameUnique($username, $db)) {
            $sql = "INSERT INTO USERS (username, password) VALUES (:u, :p)";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":u", $username);
            $stmt->bindValue(":p", $password);
            $stmt->execute();
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

function loginToAccount() {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $db = initDatabase();
        $sql = "SELECT id, username, password FROM USERS WHERE username = :u";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":u", $username);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if ($result) {
            if ($password == $result['password']) {
                $_SESSION["loggedIn"] = True;
                $_SESSION["id"] = $result["id"];
                $_SESSION["username"] = $result["username"];

                header("location: /");
                exit();
            }
        }
    }
}
?>
