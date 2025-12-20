<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login - Blood Sewa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
            <div class="hero-logo"><img src="assets/logo.jpeg" alt="BloodSewa logo"></div>
            <h1 id="hero-heading" class="shimmer">Welcome Back</h1>
            <p class="lead">Sign in to manage your profile and view matches.</p>
          </div>
        </div>
      </section>
    </div>
  </section>

  <main class="container">
    <h2>Login</h2>
    <form id="loginForm">
      <label>Email <input name="email" type="email" required></label>
      <label>Password <input name="password" type="password" required></label>
      <button class="btn btn-primary" type="submit">Login</button>
    </form>
    <div id="msg"></div>
  </main>
  <script src="assets/app.js"></script>
  <script>
  document.getElementById('loginForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const fd = new FormData(e.target);
    const data = Object.fromEntries(fd.entries());
    const token = await window.getCsrfToken();
    data.csrf_token = token;
    const res = await fetch('api/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
      credentials: 'include'
    });
    const json = await res.json();
    document.getElementById('msg').textContent = json.error || (json.ok ? 'Logged in' : JSON.stringify(json));
    if (json.ok) setTimeout(()=> location.href = 'profile.php', 600);
  });
  </script>
<?php include 'footer.php'; ?>
</body>
</html>
