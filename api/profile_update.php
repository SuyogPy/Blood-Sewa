<?php
// =============================================
// profile_update.php (API) - Update User Profile
// =============================================
// This file updates the logged-in user's profile
// information (name, phone, city, blood group).
// Email and password cannot be changed here.
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

// ---- Step 2: Get the data sent from the form ----
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$name = $input['name'];
$phone = $input['phone'];
$city = $input['city'];
$blood_group = $input['blood_group'];
$user_id = $_SESSION['user_id'];

// ---- Step 3: Validate required fields ----
if (empty($name)) {
    echo json_encode(['error' => 'Name is required']);
    exit;
}

// ---- Step 4: Update the user in the database ----
$sql = "UPDATE users 
        SET name='$name', phone='$phone', city='$city', blood_group='$blood_group' 
        WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // ---- Step 5: Fetch updated user data to send back ----
    $sql2 = "SELECT id, name, email, phone, city, blood_group, created_at 
             FROM users WHERE id='$user_id' LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);
    $user = mysqli_fetch_assoc($result2);

    echo json_encode(['ok' => true, 'user' => $user]);
} else {
    echo json_encode(['error' => 'Update failed']);
}

// Close database connection
mysqli_close($conn);
?>
