<?php
// =============================================
// csrf.php (API) - CSRF Token (Simplified)
// =============================================
// This file returns a simple token for forms.
// In this simplified school project, we still
// provide the token endpoint so the frontend
// JavaScript does not break, but the backend
// no longer validates it.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Start session
session_start();

// Generate a simple token and store in session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = md5(time());  // Simple token using md5
}

// Send the token back
echo json_encode(['token' => $_SESSION['csrf_token']]);
?>
