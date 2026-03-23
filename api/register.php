<?php
// =============================================
// register.php (API) - Handles User Registration
// =============================================
// This file receives registration data from the
// register form and inserts a new user into the
// database. No password hashing is used (simple
// plain text storage for school project).
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Start session
session_start();

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Get the data sent from the form ----
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

// Store form values in variables
$name = $input['name'];
$email = $input['email'];
$password = $input['password'];       // Stored as plain text (no hashing)
$phone = $input['phone'];
$city = $input['city'];
$blood_group = $input['blood_group'];

// ---- Step 2: Basic Validation ----
// Check if required fields are empty
if (empty($name)) {
    echo json_encode(['error' => 'Name is required']);
    exit;
}
if (empty($email)) {
    echo json_encode(['error' => 'Email is required']);
    exit;
}
if (empty($password)) {
    echo json_encode(['error' => 'Password is required']);
    exit;
}

// ---- Step 3: Check if email already exists ----
$check_sql = "SELECT * FROM users WHERE email='$email'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Email already registered
    echo json_encode(['error' => 'Email already exists']);
    exit;
}

// ---- Step 4: Insert new user into database ----
$sql = "INSERT INTO users (name, email, password, phone, city, blood_group) 
        VALUES ('$name', '$email', '$password', '$phone', '$city', '$blood_group')";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Get the ID of the newly inserted user
    $new_id = mysqli_insert_id($conn);
    // Send success response
    echo json_encode(['ok' => true, 'id' => $new_id]);
} else {
    // Something went wrong
    echo json_encode(['error' => 'Registration failed. Please try again.']);
}

// Close database connection
mysqli_close($conn);
?>
