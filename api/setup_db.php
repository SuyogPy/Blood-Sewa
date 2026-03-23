<?php
// =============================================
// setup_db.php - Database Setup Script
// =============================================
// Run this file ONCE in your browser to create
// the database and the users table.
// URL: http://localhost/Blood-Sewa/api/setup_db.php
// =============================================

// Database connection details
$server = "localhost";
$username = "root";
$password = "";
$database = "blood_sewa";

// ---- Step 1: Connect to MySQL (without selecting a database) ----
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL server successfully.<br>";

// ---- Step 2: Create the database if it doesn't exist ----
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $sql)) {
    echo "Database '$database' created successfully (or already exists).<br>";
} else {
    die("Error creating database: " . mysqli_error($conn));
}

// ---- Step 3: Select the database ----
mysqli_select_db($conn, $database);

// ---- Step 4: Create the users table ----
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    city VARCHAR(100),
    blood_group VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'users' created successfully (or already exists).<br>";
} else {
    die("Error creating table: " . mysqli_error($conn));
}

// ---- Step 5: Insert sample data (only if table is empty) ----
$check = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$row = mysqli_fetch_assoc($check);

if ($row['total'] == 0) {
    // Insert demo users with plain text passwords
    $sql = "INSERT INTO users (name, email, password, phone, city, blood_group) VALUES
        ('Demo Donor', 'demo@bloodsewa.test', 'password', '+977-000000000', 'Lainchour', 'A+'),
        ('Alice Singh', 'alice@example.com', 'password123', '9876543210', 'Mumbai', 'A+'),
        ('Ravi Kumar', 'ravi@example.com', 'password123', '9123456780', 'Delhi', 'B+')";

    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted successfully.<br>";
    } else {
        echo "Error inserting sample data: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Table already has data. Skipping sample data.<br>";
}

echo "<br><strong>Setup complete!</strong> You can now use the application.";
echo "<br><a href='../index.php'>Go to Homepage</a>";

// Close connection
mysqli_close($conn);
?>
