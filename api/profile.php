<?php
// =============================================
// profile.php (API) - Get Logged-in User Profile
// =============================================
// This file returns the profile data of the
// currently logged-in user. It checks if the
// user is logged in by looking at the session.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Start session to access session variables
session_start();

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Check if user is logged in ----
if (empty($_SESSION['user_id'])) {
    // User is not logged in
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

// ---- Step 2: Get user data from database ----
$user_id = $_SESSION['user_id'];
$sql = "SELECT id, name, email, phone, city, blood_group, created_at 
        FROM users WHERE id='$user_id' LIMIT 1";
$result = mysqli_query($conn, $sql);

// ---- Step 3: Check if user was found ----
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    echo json_encode(['ok' => true, 'user' => $user]);
} else {
    echo json_encode(['error' => 'User not found']);
}

// Close database connection
mysqli_close($conn);
?>
