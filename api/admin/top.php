<?php
require_once __DIR__ . '/../database/database.php';
header("Content-Type: application/json");

try {
    $stmt = $pdo->prepare("SELECT * FROM users ORDER BY total_score DESC LIMIT :limit");
    $stmt->bindValue(':limit', $nb, PDO::PARAM_INT);
    $stmt->execute();
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($players);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}