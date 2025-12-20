<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

$blood = $_GET['blood_group'] ?? null;
$city = $_GET['city'] ?? null;

$pdo = get_db();
$params = [];
$sql = 'SELECT id, name, email, phone, city, blood_group, created_at FROM users WHERE 1=1';
if ($blood) {
    $sql .= ' AND blood_group = ?';
    $params[] = $blood;
}
if ($city) {
    $sql .= ' AND city LIKE ?';
    $params[] = "%$city%";
}

$sql .= ' ORDER BY created_at DESC LIMIT 100';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();
echo json_encode(['ok' => true, 'results' => $rows]);
