<?php
// =============================================
// search.php (API) - Search Donors
// =============================================
// This file searches for donors based on
// blood group and/or city. The frontend sends
// these values as GET parameters in the URL.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Include database connection
require_once __DIR__ . '/db.php';

// ---- Step 1: Get search parameters from URL ----
$blood_group = isset($_GET['blood_group']) ? $_GET['blood_group'] : '';
$city = isset($_GET['city']) ? $_GET['city'] : '';

// ---- Step 2: Build the SQL query ----
// Start with a basic SELECT query
$sql = "SELECT id, name, email, phone, city, blood_group, created_at FROM users WHERE 1=1";

// Add blood group filter if provided
if (!empty($blood_group)) {
    $sql = $sql . " AND blood_group='$blood_group'";
}

// Add city filter if provided (using LIKE for partial match)
if (!empty($city)) {
    $sql = $sql . " AND city LIKE '%$city%'";
}

// Order by newest first and limit to 100 results
$sql = $sql . " ORDER BY created_at DESC LIMIT 100";

// ---- Step 3: Run the query ----
$result = mysqli_query($conn, $sql);

// ---- Step 4: Collect all results into an array ----
$donors = [];  // Empty array to store results

while ($row = mysqli_fetch_assoc($result)) {
    // Add each row to our array
    $donors[] = $row;
}

// ---- Step 5: Send results back as JSON ----
echo json_encode(['ok' => true, 'results' => $donors]);

// Close database connection
mysqli_close($conn);
?>
