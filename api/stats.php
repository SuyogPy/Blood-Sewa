<?php
// =============================================
// stats.php (API) - Get Donor Count
// =============================================
// This file counts the total number of donors
// (users) in the database and returns the count.
// Used by the homepage to show live stats.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Count all users in the database ----
$sql = "SELECT COUNT(*) AS total FROM users";
$result = mysqli_query($conn, $sql);

// ---- Step 2: Get the count value ----
$row = mysqli_fetch_assoc($result);
$count = $row['total'];

// ---- Step 3: Send the count as JSON ----
echo json_encode(['donors_count' => (int)$count]);

// Close database connection
mysqli_close($conn);
?>
