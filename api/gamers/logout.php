<?php
require_once __DIR__ . '/../database/database.php';
session_start();
header("Content-Type: application/json");

// Only allow PUT requests for logout
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Check if the user is logged in
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        http_response_code(403); // Forbidden
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    if ($joueur !== $_SESSION['username']) {
        http_response_code(403); // Forbidden
        echo json_encode(['success' => false, 'message' => 'Invalid user']);
        exit;
    }

    
    if (!password_verify($pwd, $_SESSION['password_hash'])) {
        http_response_code(401); // Unauthorized
        echo json_encode(['success' => false, 'message' => 'Invalid password']);
        exit;
    }

    // Clear session variables
    session_unset();
    session_destroy();

    http_response_code(200); // OK
    echo json_encode(['success' => true, 'message' => 'Logout successful']);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}