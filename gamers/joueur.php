<?php
header('Content-Type: application/json');

try {
    // Your data - could be from database or other source
    $userData = [
        'id' => 123,
        'username' => 'johndoe',
        'games_played' => 45,
        'games_won' => 20,
        'total_score' => 1500,
        'last_login' => '2023-10-01 12:00:00'
    ];
    
    // Set headers
    http_response_code(200); // OK status
    
    // Output JSON
    echo json_encode($userData, JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    // Error handling
    http_response_code(500); // Internal Server Error
    
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>