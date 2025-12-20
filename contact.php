<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact — BloodSewa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
            <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
            <h1 id="hero-heading" class="shimmer">Contact Us</h1>
            <p class="lead">Questions or feedback? Reach out and we'll get back to you.</p>
          </div>
        </div>
      </section>
    </div>
  </section>

  <main class="container">
    <section>
      <h2>Contact Us</h2>
      <div class="contact-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:24px; align-items:start">
        <div>
          <h4>Contact Information</h4>
          <p><strong>Address:</strong><br> Lainchour, NIST</p>
          <p><strong>Section:</strong> M11</p>
          <p><strong>Phone:</strong> +977-01-xxxxxxx</p>
          <p><strong>Email:</strong> support@bloodsewa.example</p>
          <div style="margin-top:12px"><span class="badge">Office Hours:</span> Mon–Fri 9:00–17:00</div>
        </div>

        <div>
          <h4>Send a Message</h4>
          <form id="contactForm" method="post" action="#">
            <label>Name <input name="name" required></label>
            <label>Email <input name="email" type="email" required></label>
            <label>Message <textarea name="message" rows="5" required></textarea></label>
            <button class="btn btn-primary" type="submit">Send Message</button>
            <div id="contactMsg" style="margin-top:10px;color:var(--ink);"></div>
          </form>
        </div>
      </div>
    </section>
  </main>
  <script src="assets/app.js"></script>
  <script>
    document.getElementById('contactForm').addEventListener('submit', async (e)=>{
      e.preventDefault();
      document.getElementById('contactMsg').textContent = 'Message sent (demo). We will contact you soon.';
      e.target.reset();
    });
  </script>
<?php include 'footer.php'; ?>
</body>
</html>
