<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid id']);
    exit;
}

$pdo = get_db();
$stmt = $pdo->prepare('SELECT id, name, email, phone, city, blood_group, created_at FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'Donor not found']);
    exit;
}

echo json_encode(['ok' => true, 'donor' => $user]);
