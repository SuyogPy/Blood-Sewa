<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
session_start();

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

if (empty($input['csrf_token']) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $input['csrf_token'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid CSRF token']);
    exit;
}

$name = substr(trim($input['name'] ?? ''), 0, 150);
$phone = substr(trim($input['phone'] ?? ''), 0, 50);
$city = substr(trim($input['city'] ?? ''), 0, 100);
$blood = substr(trim($input['blood_group'] ?? ''), 0, 10);

if (!$name) {
    http_response_code(400);
    echo json_encode(['error' => 'Name required']);
    exit;
}

$pdo = get_db();
try {
    $stmt = $pdo->prepare('UPDATE users SET name = ?, phone = ?, city = ?, blood_group = ? WHERE id = ?');
    $stmt->execute([$name, $phone, $city, $blood, $_SESSION['user_id']]);
    $stmt = $pdo->prepare('SELECT id, name, email, phone, city, blood_group, created_at FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    echo json_encode(['ok' => true, 'user' => $user]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}

