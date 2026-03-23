<?php
// =============================================
// db.php - Database Connection File
// =============================================
// This file connects to the MySQL database
// using mysqli (MySQL Improved Extension).
// We include this file in other PHP files
// whenever we need to access the database.
// =============================================

// Database connection details (for XAMPP)
$server = "localhost";     // Server name (localhost for XAMPP)
$username = "root";        // Default XAMPP username
$password = "";            // Default XAMPP password (empty)
$database = "blood_sewa";  // Our database name

// Create connection using mysqli
$conn = new mysqli($server, $username, $password, $database);

// Check if connection was successful
if ($conn->connect_error) {
    // If connection fails, show error and stop
    die("Connection failed: " . $conn->connect_error);
}

// If we reach here, connection is successful
?>
