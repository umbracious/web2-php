<?php
require_once __DIR__ . '/../database/database.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

if (isset($nb)){
    $nb = max(1, $nb); // Ensure $nb is at least 1
} else {
    $nb = 10; // Default number of records to fetch
}

if (isset($from)){
    $from = max(1, $from); // Ensure $offset is at least 1
} else {
    $from = 1; // Default offset
}

$offset = $from - 1; // Adjust for zero-based index

try {
    // Connect to database (assuming $pdo is available from database.php)
    $stmt = $pdo->prepare("SELECT id, word, def FROM definitions LIMIT :nb OFFSET :offset");
    $stmt->bindParam(':nb', $nb, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $definitions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($definitions);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}