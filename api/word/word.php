<?php
require_once __DIR__ . '/../database/database.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

// nb = 10 by default
if (!isset($nb)){
    $nb = 10;
} else {
    $nb = max(1, $nb); // Ensure nb is at least 1
}

// from = 1 by default
if (!isset($from)){
    $from = 1;
} else {
    $from = max(1, $from); // Ensure from is at least 1
}

try {
    // Calculate OFFSET for SQL query (convert from 1-based to 0-based indexing)
    $offset = max(0, $from - 1);
    
    // Query to get words with their definitions
    $query = "SELECT * 
              FROM definitions
              ORDER BY id
              LIMIT :limit 
              OFFSET :offset";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $nb, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    // Process results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        http_response_code(200);
        echo json_encode($results);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'No words found.']);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}