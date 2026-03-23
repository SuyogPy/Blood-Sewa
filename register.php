<?php
// =============================================
// register.php - User Registration Page
// =============================================
// This page shows a registration form. When
// submitted, it inserts a new user into the
// database with plain text password. Then
// redirects to the login page.
// =============================================

// Start session
session_start();

// Include database connection
require_once 'db.php';

// Variables to store messages
$error = "";
$success = "";

// ---- Check if form was submitted ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data using $_POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];       // Stored as plain text (no hashing)
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $blood_group = $_POST['blood_group'];

    // ---- Basic Validation ----
    if (empty($name)) {
        $error = "Name is required";
    } elseif (empty($email)) {
        $error = "Email is required";
    } elseif (empty($password)) {
        $error = "Password is required";
    } else {
        // ---- Check if email already exists ----
        $check_sql = "SELECT * FROM users WHERE email='$email'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Email already registered
            $error = "Email already exists! Please use a different email.";
        } else {
            // ---- Insert new user into database ----
            $sql = "INSERT INTO users (name, email, password, phone, city, blood_group)
                    VALUES ('$name', '$email', '$password', '$phone', '$city', '$blood_group')";

            if (mysqli_query($conn, $sql)) {
                $success = "Registration successful! Redirecting to login...";
                // Redirect to login page after 2 seconds
                header("Refresh: 2; url=login.php");
            } else {
                $error = "Registration failed: " . mysqli_error($conn);
            }
        }
    }
}

// Close database connection
mysqli_close($conn);
?>
<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Register - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <section class="hero-outer">
        <div class="container">
            <section class="hero" aria-labelledby="hero-heading">
                <div class="hero-card">
                    <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
                        <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
                        <h1 id="hero-heading" class="shimmer">Register as a Donor</h1>
                        <p class="lead">Join BloodSewa to help patients in urgent need. Your contribution can save lives.</p>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <main class="container">
        <h2>Register</h2>

        <!-- Show error message -->
        <?php if (!empty($error)) { ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php } ?>

        <!-- Show success message -->
        <?php if (!empty($success)) { ?>
            <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
        <?php } ?>

        <!-- Registration Form — submits to itself using POST -->
        <form method="POST" action="register.php">
            <label>Name
                <input name="name" type="text" required>
            </label>
            <label>Email
                <input name="email" type="email" required>
            </label>
            <label>Password
                <input name="password" type="password" required>
            </label>
            <label>Phone
                <input name="phone" type="text">
            </label>
            <label>City
                <input name="city" type="text">
            </label>
            <label>Blood Group
                <input name="blood_group" type="text" placeholder="e.g. A+, B-, O+">
            </label>
            <button class="btn btn-primary" type="submit">Register</button>
        </form>

        <p style="margin-top:12px;">Already have an account? <a href="login.php">Login here</a></p>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
