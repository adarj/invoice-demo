<?php
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
?>
