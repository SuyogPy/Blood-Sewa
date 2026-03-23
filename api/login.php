<?php
// =============================================
// login.php (API) - Handles User Login
// =============================================
// This file receives login data (email & password)
// from the login form. It checks the database
// to see if the user exists with matching credentials.
// It returns JSON so the frontend JavaScript can
// understand the response.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Start a session to remember logged-in user
session_start();

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Get the data sent from the form ----
// The frontend sends data as JSON, so we read it
$input = json_decode(file_get_contents('php://input'), true);

// If JSON didn't work, try regular POST data
if (!$input) {
    $input = $_POST;
}

// Store email and password in variables
$email = $input['email'];
$password = $input['password'];

// ---- Step 2: Basic Validation ----
// Check if email or password is empty
if (empty($email) || empty($password)) {
    echo json_encode(['error' => 'Email and password are required']);
    exit;
}

// ---- Step 3: Check database for matching user ----
// Simple SQL query to find user with matching email AND password
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
$result = mysqli_query($conn, $sql);

// ---- Step 4: Check if we found a matching user ----
if (mysqli_num_rows($result) > 0) {
    // User found! Get the user data
    $user = mysqli_fetch_assoc($result);

    // Save user ID in session (to remember they are logged in)
    $_SESSION['user_id'] = $user['id'];

    // Send success response
    echo json_encode(['ok' => true, 'id' => $user['id']]);
} else {
    // No matching user found
    echo json_encode(['error' => 'Invalid email or password']);
}

// Close the database connection
mysqli_close($conn);
?>
