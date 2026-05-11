<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASS', '');   
define('DB_NAME', 'auction_db'); 
define('DB_PORT', 3306);

function get_db(): mysqli {
    static $conn = null;

    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

        if ($conn->connect_error) {
            error_log('Database connection failed: ' . $conn->connect_error);
            http_response_code(500);
            die(json_encode(['error' => 'Database connection failed.']));
        }

        $conn->set_charset('utf8mb4');
    }

    return $conn;
}