<?php
header('Content-Type: application/json');
session_start();
// Optional CSRF protection for logout: accept JSON body token
$body = json_decode(file_get_contents('php://input'), true);
if (!empty($body)) {
    if (empty($body['csrf_token']) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $body['csrf_token'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid CSRF token']);
        exit;
    }
}
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}
session_destroy();
echo json_encode(['ok' => true]);
