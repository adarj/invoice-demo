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

    $sql = <<<EOD
CREATE TABLE IF NOT EXISTS INVOICES (
    id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    customer_id INTEGER NOT NULL,
    number INTEGER NOT NULL,
    date DATETIME NOT NULL,
    amount INTEGER NOT NULL,
    status VARCHAR(10) NOT NULL,
    file BLOB
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

function getCustomer($customer_id) {
    $db = initDatabase();
    $sql = "SELECT * FROM CUSTOMERS where id = :c";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":c", $customer_id);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    $db->close();
    return $result;
}

# Returns an array of all customers in the database
function getCustomers() {
    $db = initDatabase();
    $sql = "SELECT id, first_name, last_name FROM CUSTOMERS";

    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $customers = array();

    while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
        array_push($customers, $res);
    }

    $result->finalize();
    $db->close();

    return $customers;
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

# Removes all data and invoices that are related to the inputted customer id
function deleteCustomer($customer_id) {
    $db = initDatabase();
    $sql = "DELETE FROM INVOICES WHERE customer_id = :c";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":c", $customer_id);
    $stmt->execute();

    $sql = "DELETE FROM CUSTOMERS WHERE id = :c";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":c", $customer_id);
    $stmt->execute();
}

function getInvoices() {
    $db = initDatabase();
    $sql = "SELECT * FROM INVOICES WHERE user_id = :u";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $_SESSION["id"]);
    $result = $stmt->execute();
    $invoices = array();

    while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
        array_push($invoices, $res);
    }

    $result->finalize();
    $db->close();

    return $invoices;
}

# Adds an invoice to the INVOICES table in the database
function addInvoice($customer, $number, $date, $amount, $status) {
    $db = initDatabase();
    $sql = "INSERT INTO INVOICES (user_id, customer_id, number, date, amount, status, file) VALUES (:u, :c, :n, :d, :a, :s, :f)";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":u", $_SESSION["id"]);
    $stmt->bindValue(":c", $customer);
    $stmt->bindValue(":n", $number);
    $stmt->bindValue(":d", $date);
    $stmt->bindValue(":a", $amount);
    $stmt->bindValue(":s", $status);
    $stmt->bindValue(":f", NULL);

    $destPath = NULL;

    # If the user uploaded a document, add it to the INSERT statement
    if (isset($_FILES["invoice-file"]) && $_FILES["invoice-file"]["error"] === UPLOAD_ERR_OK) {
        $tmpPath = $_FILES['invoice-file']['tmp_name'];
        $filename = $_FILES['invoice-file']['name'];
        $exp = explode(".", $filename);
        $extension = strtolower(end($exp));

        $newFilename = md5(time() . $filename) . '.' . $extension;
        $destPath = root_path . "/resources/" . $newFilename;

        if ($extension == "pdf") {
            move_uploaded_file($tmpPath, $destPath);
            $fh = fopen($destPath, 'rb');
            $stmt->bindValue(":f", $fh, SQLITE3_BLOB);
        }
    }

    $stmt->execute();
    fclose($fh);
    $db->close();

    if ($destPath) {
        unlink($destPath);
    }

    header("location: /");
    exit();
}

# Removes the inputted invoice from the database
function deleteInvoice($invoice_id) {
    $db = initDatabase();
    $sql = "DELETE FROM INVOICES WHERE id = :i";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":i", $invoice_id);
    $stmt->execute();
    $db->close();
}

function getPDF($invoice_id) {
    $db = initDatabase();
    $sql = "SELECT file FROM INVOICES WHERE id = :i";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":i", $invoice_id);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    $rawFile = $result["file"];

    $db->close();

    $file = tmpfile();
    fwrite($file, $rawFile);
    $metadata = stream_get_meta_data($file);
    $filename = $metadata["uri"];

    header("Content-disposition: attachment; filename=invoice.pdf");
    header("Content-type: application/pdf");

    readfile($filename);
}
?>
