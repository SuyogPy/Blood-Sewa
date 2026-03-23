<?php
// =============================================
// profile.php - User Profile Page
// =============================================
// This page shows the logged-in user's profile.
// It also allows them to edit their profile or
// delete their account. All actions are handled
// using $_POST form submissions.
// =============================================

// Start session to check login status
session_start();

// Include database connection
require_once 'db.php';

// Variables
$user = null;
$error = "";
$success = "";

// ---- Check if user is logged in ----
if (empty($_SESSION['user_id'])) {
    // Not logged in — redirect to login page
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ---- Handle Profile Update (POST with action=update) ----
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] == 'update') {
        // Get form data
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $blood_group = $_POST['blood_group'];

        // Validate
        if (empty($name)) {
            $error = "Name is required";
        } else {
            // Update the user in database
            $sql = "UPDATE users
                    SET name='$name', phone='$phone', city='$city', blood_group='$blood_group'
                    WHERE id='$user_id'";

            if (mysqli_query($conn, $sql)) {
                $success = "Profile updated successfully!";
            } else {
                $error = "Update failed: " . mysqli_error($conn);
            }
        }
    }

    if ($_POST['action'] == 'delete') {
        // Delete the user account
        $sql = "DELETE FROM users WHERE id='$user_id'";

        if (mysqli_query($conn, $sql)) {
            // Destroy session and redirect to home
            session_destroy();
            header("Location: index.php");
            exit;
        } else {
            $error = "Failed to delete account";
        }
    }
}

// ---- Fetch current user data from database ----
$sql = "SELECT id, name, email, phone, city, blood_group, created_at
        FROM users WHERE id='$user_id' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    $error = "User not found";
}

// Check if user clicked "Edit" button
$editing = isset($_GET['edit']);

// Close database connection
mysqli_close($conn);
?>
<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Profile - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <section class="hero-outer">
        <div class="container">
            <section class="hero" aria-labelledby="hero-heading">
                <div class="hero-card">
                    <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
                        <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
                        <h1 id="hero-heading" class="shimmer">Your Profile</h1>
                        <p class="lead">Manage your donor profile and availability preferences.</p>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <main class="container">
        <h2>My Profile</h2>

        <!-- Logout button -->
        <div style="display:flex; gap:12px; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <div></div>
            <a href="logout.php" class="btn btn-outline">Logout</a>
        </div>

        <!-- Show messages -->
        <?php if (!empty($error)) { ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php } ?>
        <?php if (!empty($success)) { ?>
            <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
        <?php } ?>

        <?php if ($user != null) { ?>

            <?php if ($editing) { ?>
                <!-- ========== EDIT MODE ========== -->
                <form method="POST" action="profile.php">
                    <input type="hidden" name="action" value="update">

                    <label>Name
                        <input name="name" type="text" value="<?php echo $user['name']; ?>" required>
                    </label>
                    <label>Phone
                        <input name="phone" type="text" value="<?php echo $user['phone']; ?>">
                    </label>
                    <label>City
                        <input name="city" type="text" value="<?php echo $user['city']; ?>">
                    </label>
                    <label>Blood Group
                        <input name="blood_group" type="text" value="<?php echo $user['blood_group']; ?>">
                    </label>

                    <div style="display:flex; gap:10px; margin-top:12px;">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="profile.php" class="btn btn-outline">Cancel</a>
                    </div>
                </form>

            <?php } else { ?>
                <!-- ========== VIEW MODE ========== -->
                <div class="profile-card-inner">
                    <div class="profile-row">
                        <strong>Name</strong>
                        <div class="profile-value"><?php echo $user['name']; ?></div>
                    </div>
                    <div class="profile-row">
                        <strong>Email</strong>
                        <div class="profile-value"><?php echo $user['email']; ?></div>
                    </div>
                    <div class="profile-row">
                        <strong>Phone</strong>
                        <div class="profile-value"><?php echo $user['phone']; ?></div>
                    </div>
                    <div class="profile-row">
                        <strong>City</strong>
                        <div class="profile-value"><?php echo $user['city']; ?></div>
                    </div>
                    <div class="profile-row">
                        <strong>Blood Group</strong>
                        <div class="profile-value"><strong><?php echo $user['blood_group']; ?></strong></div>
                    </div>
                    <div class="profile-row">
                        <strong>Registered On</strong>
                        <div class="profile-value"><?php echo $user['created_at']; ?></div>
                    </div>

                    <!-- Action buttons -->
                    <div style="display:flex; gap:10px; margin-top:16px;">
                        <a href="profile.php?edit=1" class="btn btn-outline">Edit Profile</a>

                        <!-- Delete Account Form -->
                        <form method="POST" action="profile.php" style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn" style="background:#fff; color:var(--primary); border:1px solid rgba(211,47,47,0.08);">
                                Remove Account
                            </button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        <?php } ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
