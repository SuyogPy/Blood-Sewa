<?php
// =============================================
// profile_delete.php (API) - Delete User Account
// =============================================
// This file deletes the logged-in user's account
// from the database and destroys their session.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Start session
session_start();

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Check if user is logged in ----
if (empty($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

// ---- Step 2: Delete the user from database ----
$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // ---- Step 3: Destroy the session (log out) ----
    session_destroy();

    // Send success response
    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['error' => 'Failed to delete account']);
}

// Close database connection
mysqli_close($conn);
?>
