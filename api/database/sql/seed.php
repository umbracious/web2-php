<?php
require_once __DIR__ . '/../database.php';
// Path to the definitions file
$file_path = __DIR__ . '/def.txt';

// Check if the file exists
if (!file_exists($file_path)) {
    die("Error: Definition file not found at $file_path");
}

// Read the file content
$definitions = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if ($definitions === false) {
    die("Error: Unable to read the file");
}

// Counter for tracking the number of records inserted
$count = 0;

// Process each line
foreach ($definitions as $line) {
    // Split the line by tabs
    $parts = explode("\t", trim($line));
    
    // Check if we have the expected number of parts
    if (count($parts) >= 4) {
        $stmt = $pdo->prepare("INSERT INTO definitions (lang, src, word, def) VALUES (:lang, :src, :word, :def)");
        $stmt->bindParam(':lang', $parts[0]);
        $stmt->bindParam(':src', $parts[1]);
        $stmt->bindParam(':word', $parts[2]);
        $stmt->bindParam(':def', $parts[3]); // Optional lang parameter
        $stmt->execute();
        $count++;

    } else {
        echo "Invalid line format: $line" . PHP_EOL;
    }
}

echo "Successfully inserted $count records into the definitions table." . PHP_EOL;