<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register - Blood Sewa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
            <div class="hero-logo"><img src="assets/logo.jpeg" alt="BloodSewa logo"></div>
            <h1 id="hero-heading" class="shimmer">Register as a Donor</h1>
            <p class="lead">Join BloodSewa to help patients in urgent need. Your contribution can save lives.</p>
          </div>
        </div>
      </section>
    </div>
  </section>

  <main class="container">
    <h2>Register</h2>
    <form id="registerForm">
      <label>Name <input name="name" required></label>
      <label>Email <input name="email" type="email" required></label>
      <label>Password <input name="password" type="password" required></label>
      <label>Phone <input name="phone"></label>
      <label>City <input name="city"></label>
      <label>Blood Group <input name="blood_group"></label>
      <button class="btn btn-primary" type="submit">Register</button>
    </form>
    <div id="msg" style="margin-top:12px"></div>
  </main>
  <script src="assets/app.js"></script>
  <script>
  document.getElementById('registerForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const fd = new FormData(e.target);
    const data = Object.fromEntries(fd.entries());
    const token = await window.getCsrfToken();
    data.csrf_token = token;
    const res = await fetch('api/register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
      credentials: 'include'
    });
    const json = await res.json();
    document.getElementById('msg').textContent = json.error ? json.error : (json.ok ? 'Registered — redirecting...' : JSON.stringify(json));
    if (json.ok) setTimeout(()=> location.href = 'login.php', 800);
  });
  </script>
<?php include 'footer.php'; ?>
</body>
</html>
