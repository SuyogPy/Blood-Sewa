<?php
// =============================================
// insert.php - Add a New Donor (Simple Form Page)
// =============================================
// This page shows a simple HTML form to add
// a new donor directly. When the form is
// submitted, the data is inserted into the
// database using INSERT query.
// =============================================

// Include database connection
require_once 'db.php';

// Variable to store messages
$message = "";

// ---- Check if form was submitted ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data using $_POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $blood_group = $_POST['blood_group'];

    // ---- Basic Validation ----
    if (empty($name)) {
        $message = "Name is required";
    } elseif (empty($email)) {
        $message = "Email is required";
    } elseif (empty($password)) {
        $message = "Password is required";
    } else {
        // ---- Check if email already exists ----
        $check_sql = "SELECT * FROM users WHERE email='$email'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "Error: Email already exists!";
        } else {
            // ---- Insert into database ----
            $sql = "INSERT INTO users (name, email, password, phone, city, blood_group)
                    VALUES ('$name', '$email', '$password', '$phone', '$city', '$blood_group')";

            if (mysqli_query($conn, $sql)) {
                $message = "Donor added successfully!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Add Donor - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="container">
        <h2>Add New Donor</h2>

        <!-- Show success or error message -->
        <?php if (!empty($message)) { ?>
            <p style="color: green; font-weight: bold;">
                <?php echo $message; ?>
            </p>
        <?php } ?>

        <!-- Donor Registration Form -->
        <form method="POST" action="insert.php">
            <label>Name
                <input type="text" name="name" required>
            </label>

            <label>Email
                <input type="email" name="email" required>
            </label>

            <label>Password
                <input type="password" name="password" required>
            </label>

            <label>Phone
                <input type="text" name="phone">
            </label>

            <label>City
                <input type="text" name="city">
            </label>

            <label>Blood Group
                <input type="text" name="blood_group" placeholder="e.g. A+, B-, O+">
            </label>

            <button class="btn btn-primary" type="submit">Add Donor</button>
        </form>

        <br>
        <a href="fetch.php" class="btn btn-outline">View All Donors</a>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>
