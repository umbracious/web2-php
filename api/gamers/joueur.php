<?php
require_once __DIR__ . '/../database/database.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $joueur]);

    $user = $stmt->fetch();

    if ($user) {
        http_response_code(200);
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode([
            'error' => 'User not found'
        ]);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['exists' => false, 'error' => $e->getMessage()]);
}