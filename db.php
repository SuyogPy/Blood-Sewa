<?php

// Database connection details (for XAMPP)
$server = "localhost";     // Server name (localhost for XAMPP)
$username = "root";        // Default XAMPP username
$password = "";            // Default XAMPP password (empty)
$database = "blood_sewa";  // Our database name


$conn = new mysqli($server, $username, $password, $database);


if ($conn->connect_error) {
    
    die("Connection failed: " . $conn->connect_error);
}

?>
