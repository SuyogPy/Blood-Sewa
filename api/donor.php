<?php
// =============================================
// donor.php (API) - Get Single Donor Details
// =============================================
// This file receives a donor ID via GET parameter
// and fetches that donor's details from the database.
// Returns JSON for the frontend to display.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Get the donor ID from URL ----
$id = $_GET['id'];

// ---- Step 2: Validate the ID ----
if (empty($id)) {
    echo json_encode(['error' => 'Invalid id']);
    exit;
}

// ---- Step 3: Query the database for this donor ----
$sql = "SELECT id, name, email, phone, city, blood_group, created_at 
        FROM users WHERE id='$id' LIMIT 1";
$result = mysqli_query($conn, $sql);

// ---- Step 4: Check if donor was found ----
if (mysqli_num_rows($result) > 0) {
    // Donor found - get the data
    $donor = mysqli_fetch_assoc($result);
    echo json_encode(['ok' => true, 'donor' => $donor]);
} else {
    // No donor found with this ID
    echo json_encode(['error' => 'Donor not found']);
}

// Close database connection
mysqli_close($conn);
?>
