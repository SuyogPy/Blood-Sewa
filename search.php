<?php
// =============================================
// search.php - Search Donors Page
// =============================================
// This page shows a search form where users
// can search donors by blood group and/or city.
// Results are displayed in an HTML table below
// the form.
// =============================================

// Include database connection
require_once 'db.php';

// Variables to store search parameters
$blood_group = "";
$city = "";
$results = null;
$searched = false;  // Track if user searched

// ---- Check if form was submitted (using GET method) ----
if (isset($_GET['blood_group']) || isset($_GET['city'])) {
    $searched = true;

    // Get search values from URL
    $blood_group = isset($_GET['blood_group']) ? $_GET['blood_group'] : '';
    $city = isset($_GET['city']) ? $_GET['city'] : '';

    // ---- Build the SQL query ----
    $sql = "SELECT id, name, email, phone, city, blood_group, created_at FROM users WHERE 1=1";

    // Add blood group filter if provided
    if (!empty($blood_group)) {
        $sql = $sql . " AND blood_group='$blood_group'";
    }

    // Add city filter if provided (using LIKE for partial match)
    if (!empty($city)) {
        $sql = $sql . " AND city LIKE '%$city%'";
    }

    // Order by newest first
    $sql = $sql . " ORDER BY created_at DESC LIMIT 100";

    // ---- Run the query ----
    $results = mysqli_query($conn, $sql);
}
?>
<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Search Donors - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <section class="hero-outer">
        <div class="container">
            <section class="hero" aria-labelledby="hero-heading">
                <div class="hero-card">
                    <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
                        <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
                        <h1 id="hero-heading" class="shimmer">Find Local Donors</h1>
                        <p class="lead">Search verified donors by blood group and city. Quick results to help in urgent situations.</p>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <main class="container">
        <h2>Search Donors</h2>

        <!-- Search Form — uses GET method so search values appear in URL -->
        <form method="GET" action="search.php">
            <label>Blood Group
                <input name="blood_group" type="text" value="<?php echo $blood_group; ?>" placeholder="e.g. A+, B-, O+">
            </label>
            <label>City
                <input name="city" type="text" value="<?php echo $city; ?>" placeholder="e.g. Kathmandu">
            </label>
            <button class="btn btn-outline" type="submit">Search</button>
        </form>

        <!-- ---- Display Search Results ---- -->
        <?php if ($searched) { ?>
            <h3 style="margin-top:20px;">Search Results</h3>

            <?php if ($results && mysqli_num_rows($results) > 0) { ?>

                <!-- Display results in a table -->
                <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; margin-top:10px;">
                    <tr style="background-color: var(--primary); color: white;">
                        <th>Name</th>
                        <th>Blood Group</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($results)) { ?>
                        <tr>
                            <td><strong><?php echo $row['name']; ?></strong></td>
                            <td><strong><?php echo $row['blood_group']; ?></strong></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <a href="donor.php?id=<?php echo $row['id']; ?>" class="btn btn-outline">View Details</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            <?php } else { ?>
                <p>No donors found matching your search criteria.</p>
            <?php } ?>

        <?php } ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>
