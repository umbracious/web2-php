<?php
require_once __DIR__ . '/../database/database.php';
session_start();
header('Content-Type: application/json');

// Only allow PUT requests for login
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'User already logged in']);
    exit;
}

// Prepare and execute the SQL statement to fetch the user
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $joueur);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    exit;
}

// Check if the user exists and verify the password
if ($user) {
    if (password_verify($pwd, $user['password_hash'])){
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        $_SESSION['password_hash'] = $user['password_hash'];
        
        try {
            // Update the last login time
            $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $user['id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
            exit;
        }

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        // Password is incorrect
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid password']);
    }
} else {
    // User not found
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'User not found']);
}
?>