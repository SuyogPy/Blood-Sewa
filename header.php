<?php
// =============================================
// header.php - Common Header (Navigation Bar)
// =============================================
// This file is included at the top of every page
// to show the navigation bar. It also starts the
// session to check if the user is logged in.
// =============================================

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="brand brand-link">
      <img src="assets/logo.jpg" alt="BloodSewa" class="logo" onerror="this.style.display='none' " />
      <div class="brand-text">
        <span class="brand-title">BloodSewa</span>
        <span class="brand-sub">Life-Saving & Medical</span>
      </div>
    </a>

    <nav class="main-nav" aria-label="Primary navigation">
      <a href="index.php" class="nav-link">Home</a>
      <a href="search.php" class="nav-link">Find Donors</a>
      <a href="about.php" class="nav-link">About</a>
      <a href="contact.php" class="nav-link">Contact</a>
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="profile.php" class="nav-link">My Profile</a>
      <?php else: ?>
        <a href="login.php" class="nav-link">Login</a>
      <?php endif; ?>
    </nav>

    <div style="margin-left:auto; display:flex; gap:10px; align-items:center;">
      <a href="register.php" class="btn btn-primary">Donate Now</a>
      <button id="emergencyBtn" class="btn" aria-label="Emergency contacts">
        <!-- phone / alert icon -->
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 7v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="17" r="0.6" fill="currentColor"/></svg>
        <span style="font-weight:700; color:var(--primary); margin-left:4px">Emergency</span>
      </button>
    </div>
  </div>
</header>
