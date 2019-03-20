<?php

# Set error reporting on
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);

# Initialize database
class InvoiceAppDB extends SQLite3 {
    function __construct() {
        $this->open("invoice_app.db");
    }

    function init_tables() {
        $sql = <<<EOD
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
EOD;

        $this->exec($sql);
    }
}

$new_db_file = True;
if (file_exists("invoice_app.db")) {
    $new_db_file= False;
}

$db = new InvoiceAppDB();

if ($new_db_file) {
    $db->init_tables();
}

?>
