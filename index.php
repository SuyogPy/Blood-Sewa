<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Your Blood Can Save Three Lives — BloodSewa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
          <div style="display:flex; align-items:center; gap:10px; justify-content:center; flex-direction:column;">
            <div class="live-stats"><span class="live-pulse" aria-hidden="true"></span>+1,240 Donors Registered</div>
            <h1 id="hero-heading" class="shimmer">Your Blood Can Save Three Lives</h1>
            <p class="lead">Join BloodSewa — a student-led initiative connecting compassionate donors with people in urgent need. Register as a donor and make a real impact today.</p>

            <div style="margin-top:26px; display:flex; gap:14px; align-items:center; justify-content:center; flex-wrap:wrap">
              <a class="btn btn-primary" href="register.php">Register as Donor</a>
              <a class="btn btn-outline" href="search.php">🔍 Search Donors</a>
            </div>
          </div>

          <div class="features-grid" style="margin-top:34px; justify-content:center">
            <div class="feature-card">
              <div class="feature-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l7 4v5c0 5-3.5 9-7 11-3.5-2-7-6-7-11V6l7-4z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </div>
              <div>
                <div style="display:flex;align-items:center;gap:8px">
                  <div class="feature-title">Safe & Verified</div>
                  <div class="check-badge" aria-hidden="true">✔</div>
                </div>
                <div class="feature-desc feature-verify">We verify donor identities and contact details before listing — basic checks include email verification, phone confirmation, and profile review. This reduces risk and increases trust between donors and recipients.</div>
                <div class="mt-8"><a href="about.php" class="btn btn-outline">How we verify</a></div>
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

  <script src="assets/app.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
