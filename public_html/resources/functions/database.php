<?php
# Initializes the database file for this application and returns a SQLite3
# object
function initDatabase() {
    $db = new SQLite3(root_path . "/resources/app.db");

    $sql = <<<EOD
CREATE TABLE IF NOT EXISTS USERS (
    id INTEGER PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
EOD;
    $db->exec($sql);

    $sql = <<<EOD
CREATE TABLE IF NOT EXISTS CUSTOMERS (
    id INTEGER PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL
);
EOD;
    $db->exec($sql);

    return $db;
}

# Returns true if the inputted username has not been taken by another user
function isUsernameUnique($db, $username) {
    $sql = "SELECT id FROM USERS WHERE username = :u";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $username);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        return False;
    }

    return True;
}

# Adds a new user to the database
function createAccount($username, $password) {
    $db = initDatabase();

    if (isUsernameUnique($db, $username)) {
        $sql = "INSERT INTO USERS (username, password_hash) VALUES (:u, :p)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":u", $username);
        $stmt->bindValue(":p", password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();
        $db->close();

        header("location: /");
        exit();
    }
}

# Creates session for user if the inputted credentials matches an account in
# the database
function loginToAccount($username, $password) {
    $db = initDatabase();
    $sql = "SELECT id, username, password_hash FROM USERS WHERE username = :u";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $username);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    $db->close();

    if ($result) {
        if (password_verify($password, $result["password_hash"])) {
            $_SESSION["loggedIn"] = True;
            $_SESSION["id"] = $result["id"];
            $_SESSION["username"] = $result["username"];

            header("location: /");
            exit();
        }
    }
}

function addCustomer($firstName, $lastName) {
    $db = initDatabase();
    $sql = "INSERT INTO CUSTOMERS (first_name, last_name) VALUES (:f, :l)";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":f", $firstName);
    $stmt->bindValue(":l", $lastName);
    $stmt->execute();
    $db->close();

    header("location: /");
    exit();
}
?>
