<?php
// =============================================
// fetch.php - Display All Donors in HTML Table
// =============================================
// This page fetches all users/donors from the
// database and displays them in a simple HTML
// table using echo and a while loop.
// =============================================

// Include database connection
require_once 'db.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>All Donors - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="container">
        <h2>All Registered Donors</h2>

        <?php
        // ---- Step 1: Query all users from database ----
        $sql = "SELECT id, name, email, phone, city, blood_group, created_at FROM users ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        // ---- Step 2: Check if there are any results ----
        if (mysqli_num_rows($result) > 0) {

            // ---- Step 3: Display data in HTML table ----
            echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%; border-collapse:collapse; margin-top:16px;'>";

            // Table header row
            echo "<tr style='background-color: var(--primary); color: white;'>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Phone</th>";
            echo "<th>City</th>";
            echo "<th>Blood Group</th>";
            echo "<th>Registered On</th>";
            echo "</tr>";

            // ---- Step 4: Loop through each row and display ----
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td><strong>" . $row['blood_group'] . "</strong></td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            // No donors found
            echo "<p>No donors registered yet.</p>";
        }
        ?>

        <br>
        <a href="insert.php" class="btn btn-primary">Add New Donor</a>
        <a href="index.php" class="btn btn-outline">Back to Home</a>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>
