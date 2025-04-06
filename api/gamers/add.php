<?php
require_once __DIR__ . '/../database/database.php';
header("Content-Type: application/json; charset=UTF-8");
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