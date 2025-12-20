<?php
// Lightweight DB setup script — run once in development to create DB and tables.
require_once __DIR__ . '/config.php';
header('Content-Type: application/json');

$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbName = DB_NAME;

try {
    // Connect without database to create it if missing
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    // connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

    // create users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(150) NOT NULL,
      email VARCHAR(255) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL,
      phone VARCHAR(50) DEFAULT NULL,
      city VARCHAR(100) DEFAULT NULL,
      blood_group VARCHAR(10) DEFAULT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // optional seed: create a demo user if none exist
    $stmt = $pdo->query("SELECT COUNT(*) AS c FROM users");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (intval($row['c']) === 0) {
        $pw = password_hash('password', PASSWORD_DEFAULT);
        $ins = $pdo->prepare('INSERT INTO users (name,email,password,phone,city,blood_group) VALUES (?, ?, ?, ?, ?, ?)');
        $ins->execute(['Demo Donor','demo@bloodsewa.test',$pw,'+977-000000000','Lainchour','A+']);
    }

    echo json_encode(['ok'=>true, 'msg'=>'Database and tables created (if missing)']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error'=>'DB setup failed', 'detail'=> $e->getMessage()]);
}
