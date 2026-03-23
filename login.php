<?php
// =============================================
// login.php - User Login Page
// =============================================
// This page shows a login form. When the user
// submits the form, it checks the database for
// a matching email and password. If found, the
// user is logged in and redirected to profile.
// =============================================

// Start session to store login info
session_start();

// Include database connection
require_once 'db.php';

// Variable to store error messages
$error = "";

// ---- Check if form was submitted ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data using $_POST
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ---- Basic Validation ----
    if (empty($email)) {
        $error = "Email is required";
    } elseif (empty($password)) {
        $error = "Password is required";
    } else {
        // ---- Check database for matching user ----
        // Simple SQL query to find user with matching email AND password
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        // ---- Check if we found a matching user ----
        if (mysqli_num_rows($result) > 0) {
            // User found! Get the user data
            $user = mysqli_fetch_assoc($result);

            // Save user ID in session (to remember they are logged in)
            $_SESSION['user_id'] = $user['id'];

            // Redirect to profile page
            header("Location: profile.php");
            exit;
        } else {
            // No matching user found
            $error = "Invalid email or password";
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
    <title>Login - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <section class="hero-outer">
        <div class="container">
            <section class="hero" aria-labelledby="hero-heading">
                <div class="hero-card">
                    <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
                        <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
                        <h1 id="hero-heading" class="shimmer">Welcome Back</h1>
                        <p class="lead">Sign in to manage your profile and view matches.</p>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <main class="container">
        <h2>Login</h2>

        <!-- Show error message if any -->
        <?php if (!empty($error)) { ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php } ?>

        <!-- Login Form — submits to itself using POST -->
        <form method="POST" action="login.php">
            <label>Email
                <input name="email" type="email" required>
            </label>
            <label>Password
                <input name="password" type="password" required>
            </label>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>

        <p style="margin-top:12px;">Don't have an account? <a href="register.php">Register here</a></p>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
