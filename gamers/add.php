<?php
header("Content-Type: application/json");

// Database configuration
$host = 'localhost:3306';
$dbname = 'tp2';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}

$passwordHash = password_hash($pwd, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
    $stmt->bindParam(':username', $joueur);
    $stmt->bindParam(':password_hash', $passwordHash);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'User created successfully']);
} catch (PDOException $e) {
    // Check if error is due to duplicate username
    if ($e->errorInfo[1] == 1062) {
        echo json_encode(['success' => false, 'error' => 'Username already exists']);
    } else {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}