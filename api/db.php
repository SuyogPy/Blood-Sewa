<?php
require_once __DIR__ . '/config.php';

function get_db() {
    static $pdo = null;
    if ($pdo) return $pdo;
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        // Log the detailed error for local debugging without exposing it to clients
        $msg = date('c') . " - DB connection error: " . $e->getMessage() . "\n";
        @file_put_contents(__DIR__ . '/db_error.log', $msg, FILE_APPEND | LOCK_EX);
        http_response_code(500);
        echo json_encode(['error' => 'DB connection failed']);
        exit;
    }
}
