<?php
// Database configuration
$host = 'localhost'; // Hostname
$dbname = 'go_serendip'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password
$charset = 'utf8mb4'; // Character set

// DSN (Data Source Name) string
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors handling
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch associative arrays by default
    PDO::ATTR_EMULATE_PREPARES => false, // Disable emulation of prepared statements
];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Handle database connection error
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
