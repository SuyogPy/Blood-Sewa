<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
session_start();

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$pdo = get_db();
$stmt = $pdo->prepare('SELECT id, name, email, phone, city, blood_group, created_at FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']);
    exit;
}

echo json_encode(['ok' => true, 'user' => $user]);
