<?php
// =============================================
// contact.php - Contact Us Page
// =============================================
// This page shows contact info and a simple
// contact form. When submitted, it shows a
// success message (demo — does not actually
// send an email).
// =============================================

// Variable to store message
$message_sent = false;

// ---- Check if form was submitted ----
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        // In a real project, you would send an email here
        // For now, we just show a success message
        $message_sent = true;
    }
}
?>
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

          <!-- Show success message -->
          <?php if ($message_sent) { ?>
              <p style="color: green; font-weight: bold;">Message sent successfully! We will contact you soon.</p>
          <?php } ?>

          <!-- Contact Form — submits to itself using POST -->
          <form method="POST" action="contact.php">
            <label>Name <input name="name" required></label>
            <label>Email <input name="email" type="email" required></label>
            <label>Message <textarea name="message" rows="5" required></textarea></label>
            <button class="btn btn-primary" type="submit">Send Message</button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
</body>
</html>
