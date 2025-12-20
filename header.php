<?php session_start(); ?>
<header class="site-header">
  <div class="container header-inner">
    <div class="brand">
      <img src="assets/logo.jpeg" alt="BloodSewa logo" class="logo" onerror="this.style.display='none'" />
      <a href="index.php" class="brand-title">BloodSewa</a>
      <span class="brand-sub">Life-Saving & Medical</span>
    </div>
    <nav class="main-nav" aria-label="Main nav">
      <a href="index.php" class="nav-link">Home</a>
      <a href="search.php" class="nav-link">Find Donors</a>
      <a href="about.php" class="nav-link">About Us</a>
      <a href="contact.php" class="nav-link">Contact</a>
    </nav>

    <div style="margin-left:auto; display:flex; gap:12px; align-items:center;">
      <a href="register.php" class="btn btn-primary">Donate Now</a>
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="profile.php" class="nav-link" style="font-weight:800">My Profile</a>
      <?php else: ?>
        <a href="login.php" class="nav-link" style="font-weight:800">Login</a>
      <?php endif; ?>
      <button id="emergencyBtn" class="emergency-btn" aria-label="Emergency contacts">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span style="font-weight:700; margin-left:8px">Emergency</span>
      </button>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', ()=>{
      const btn = document.getElementById('emergencyBtn');
      if (!btn) return;
      btn.addEventListener('click', ()=>{
        const confirmMsg = 'In case of emergency call local services immediately.\nDo you want to view quick emergency numbers?';
        if (!confirm(confirmMsg)) return;
        alert('Emergency contacts:\n• Local Hospital: 102\n• Ambulance: 108\n• Blood Bank: Contact donors from search results');
      });
    });
  </script>
</header>
