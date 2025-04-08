<?php
require_once __DIR__ . '/../database/database.php';
session_start();
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passwordHash = password_hash($pwd, PASSWORD_BCRYPT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
        $stmt->bindParam(':username', $joueur);
        $stmt->bindParam(':password_hash', $passwordHash);
        $stmt->execute();

        $userId = $pdo->lastInsertId();

        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $joueur;
        $_SESSION['logged_in'] = true;

        $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
        $updateStmt->bindParam(':id', $userId);
        $updateStmt->execute();
        
        http_response_code(201);
        echo json_encode(['id' => $userId]);
    } catch (PDOException $e) {
        // Check if error is due to duplicate username
        if ($e->errorInfo[1] == 1062) {
            http_response_code(409); // Conflict
            echo json_encode(['success' => false, 'error' => 'Username already exists']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}