<?php

// Database configuration
$host = 'localhost:3306';
$dbname = 'tp2';
$username = 'root';
$password = 'root';
$charset = 'utf8mb4';

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password, $options);

} catch (PDOException $e) {
    // Handle any connection errors
    die("Database connection failed: " . $e->getMessage());
}

?>