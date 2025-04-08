<?php
require_once __DIR__ . '/../../database/database.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

try {

    // Delete the specified definition from the 'definitions' table
    $stmt = $pdo->prepare("DELETE FROM definitions WHERE id = :id LIMIT 1");
    $stmt->execute([$id]);

    // Return the deleted definition's id
    echo json_encode(['deleted_id' => $id]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit;
}