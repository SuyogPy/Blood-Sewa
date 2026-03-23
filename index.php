<?php
// =============================================
// index.php - Home Page
// =============================================
// Main landing page for Blood Sewa.
// Shows hero section with donor count from
// database (using PHP, not JavaScript).
// =============================================

// Include database connection
require_once 'db.php';

// ---- Get total number of donors from database ----
$donor_count = 0;
$sql = "SELECT COUNT(*) AS total FROM users";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $donor_count = $row['total'];
}

// Close connection
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>BloodSewa — Donate Blood. Save Lives.</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div style="display:flex; align-items:center; gap:10px; justify-content:center; flex-direction:column;">
            <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
            <!-- Show live donor count from database using PHP -->
            <div class="live-stats">
              <span class="live-pulse" aria-hidden="true"></span>
              +<?php echo number_format($donor_count); ?> Donors Registered
            </div>
            <h1 id="hero-heading" class="shimmer">Your Blood Can Save Three Lives</h1>
            <p class="lead">BloodSewa connects verified donors with patients in urgent need. Fast, secure, and community-powered — register now and be a lifesaver.</p>

            <div style="margin-top:26px; display:flex; gap:14px; align-items:center; justify-content:center; flex-wrap:wrap">
              <a class="cta-large btn btn-primary" href="register.php">Register as Donor</a>
              <a class="cta-outline btn btn-outline" href="search.php">🔍 Search Donors</a>
            </div>
          </div>

          <div class="features-grid" style="margin-top:34px; justify-content:center">
            <div class="feature-card">
              <div class="feature-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l7 4v5c0 5-3.5 9-7 11-3.5-2-7-6-7-11V6l7-4z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </div>
              <div>
                <div class="feature-title">Safe & Verified</div>
                <div class="feature-desc">Verification reduces risk and increases trust between donors and recipients.</div>
              </div>
            </div>

            <div class="feature-card">
              <div class="feature-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.2"/><path d="M12 7v6l4 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </div>
              <div>
                <div class="feature-title">Fast Response</div>
                <div class="feature-desc">Search and contact donors quickly during urgent needs.</div>
              </div>
            </div>

            <div class="feature-card">
              <div class="feature-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 1l8 4v6c0 6-4 10-8 12-4-2-8-6-8-12V5l8-4z" stroke="currentColor" stroke-width="1.2"/></svg>
              </div>
              <div>
                <div class="feature-title">Private Profiles</div>
                <div class="feature-desc">Profiles share only the information needed to connect safely.</div>
              </div>
            </div>

            <div class="feature-card">
              <div class="feature-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 3l8 4-8 4-8-4 8-4z" stroke="currentColor" stroke-width="1.2"/><path d="M3 11v6c0 1.2.8 2 2 2h14" stroke="currentColor" stroke-width="1.2"/></svg>
              </div>
              <div>
                <div class="feature-title">Community Education</div>
                <div class="feature-desc">Resources and guidance for safe donation practices.</div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <main class="container" style="margin-top:0;">
    <section style="margin-top:28px; display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:18px">
      <div class="hero-card">
        <h4>Safe & Verified</h4>
        <p style="color:rgba(44,62,80,0.75)">We encourage accurate profiles and verification to keep donors and recipients safe.</p>
      </div>
      <div class="hero-card">
        <h4>Community Focused</h4>
        <p style="color:rgba(44,62,80,0.75)">Student-run initiative with transparent, community-driven operations.</p>
      </div>
      <div class="hero-card">
        <h4>Fast Response</h4>
        <p style="color:rgba(44,62,80,0.75)">Search and contact donors quickly during urgent needs.</p>
      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
</body>
</html>
