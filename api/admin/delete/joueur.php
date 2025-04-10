<?php
require_once __DIR__ . '/../../database/database.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

try {
    // First get the user's ID
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $joueur);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);
        echo json_encode(['error' => 'User not found.']);
        exit;
    }

    $userId = $user['id'];

    // Delete the specified user from the 'joueurs' table
    $stmt2 = $pdo->prepare("DELETE FROM users WHERE username = :username");
    $stmt2->bindParam(':username', $joueur);
    $stmt2->execute();

    // Return the deleted user's id
    echo json_encode(['deleted_id' => $userId]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit;
}