<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
session_start();

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;

// CSRF check
if (empty($input['csrf_token']) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $input['csrf_token'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid CSRF token']);
    exit;
}

$name = substr(trim($input['name'] ?? ''), 0, 150);
$email = strtolower(trim($input['email'] ?? ''));
$password = $input['password'] ?? '';
$blood = substr(trim($input['blood_group'] ?? ''), 0, 10);
$phone = substr(trim($input['phone'] ?? ''), 0, 50);
$city = substr(trim($input['city'] ?? ''), 0, 100);

if (!$name || !$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$pdo = get_db();
try {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password, phone, city, blood_group) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$name, $email, $hash, $phone, $city, $blood]);
    echo json_encode(['ok' => true, 'id' => $pdo->lastInsertId()]);
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        http_response_code(409);
        echo json_encode(['error' => 'Email already exists']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}
