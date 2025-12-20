<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
try {
    $pdo = get_db();
    $stmt = $pdo->query('SELECT COUNT(*) AS c FROM users');
    $row = $stmt->fetch();
    $count = $row['c'] ?? 0;
    echo json_encode(['donors_count' => (int)$count]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Could not fetch stats']);
}
