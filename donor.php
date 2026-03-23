<?php
// =============================================
// donor.php - Donor Details Page
// =============================================
// This page displays the full details of a
// single donor. The donor ID is passed in the
// URL as ?id=1 using $_GET.
// =============================================

// Include database connection
require_once 'db.php';

// Variable to store donor data
$donor = null;
$error = "";

// ---- Get the donor ID from URL ----
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ---- Query the database for this donor ----
    $sql = "SELECT id, name, email, phone, city, blood_group, created_at
            FROM users WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    // ---- Check if donor was found ----
    if (mysqli_num_rows($result) > 0) {
        $donor = mysqli_fetch_assoc($result);
    } else {
        $error = "Donor not found";
    }
} else {
    $error = "No donor ID provided";
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
    <title>Donor Details - Blood Sewa</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <section class="hero-outer">
        <div class="container">
            <section class="hero" aria-labelledby="hero-heading">
                <div class="hero-card">
                    <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
                        <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
                        <h1 id="hero-heading" class="shimmer">Donor Details</h1>
                        <p class="lead">Contact details and basic profile information for the selected donor.</p>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <main class="container">
        <h2>Donor Details</h2>

        <?php if (!empty($error)) { ?>
            <!-- Show error -->
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php } ?>

        <?php if ($donor != null) { ?>
            <!-- Display donor details in a card -->
            <div class="card donor-card">
                <div class="donor-meta">
                    <div>
                        <div class="donor-name">
                            <?php echo $donor['name']; ?>
                            <span class="donor-badge"><?php echo $donor['blood_group']; ?></span>
                        </div>
                        <div class="donor-sub"><?php echo $donor['city']; ?></div>
                    </div>
                    <div style="text-align:right">
                        <a class="btn btn-outline" href="tel:<?php echo $donor['phone']; ?>">Call</a>
                        <a class="btn btn-primary" href="mailto:<?php echo $donor['email']; ?>">Email</a>
                    </div>
                </div>

                <!-- Donor Information Table -->
                <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; margin-top:16px;">
                    <tr>
                        <th style="text-align:left; width:30%;">Field</th>
                        <th style="text-align:left;">Details</th>
                    </tr>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><?php echo $donor['name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td><a href="mailto:<?php echo $donor['email']; ?>"><?php echo $donor['email']; ?></a></td>
                    </tr>
                    <tr>
                        <td><strong>Phone</strong></td>
                        <td><?php echo $donor['phone']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><?php echo $donor['city']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Blood Group</strong></td>
                        <td><strong><?php echo $donor['blood_group']; ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Registered On</strong></td>
                        <td><?php echo $donor['created_at']; ?></td>
                    </tr>
                </table>
            </div>
        <?php } ?>

        <br>
        <a href="search.php" class="btn btn-outline">← Back to Search</a>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
