<?php session_start(); ?>
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="brand brand-link">
      <img src="assets/logo.jpg" alt="BloodSewa logo" class="logo" onerror="this.style.display='none'" />
      <div class="brand-text">
        <span class="brand-title">BloodSewa</span>
      </div>
    </a>
    <nav class="main-nav" aria-label="Main nav">
      <a href="index.php" class="nav-link">Home</a>
      <a href="search.php" class="nav-link">Find Donors</a>
      <a href="about.php" class="nav-link">About Us</a>
      <a href="contact.php" class="nav-link">Contact</a>
    </nav>

    <div class="nav-actions">
      <a href="register.php" class="btn btn-primary">Donate Now</a>
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="profile.php" class="nav-link">My Profile</a>
      <?php else: ?>
        <a href="login.php" class="nav-link">Login</a>
      <?php endif; ?>
    </div>
  </div>
</header>
