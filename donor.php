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
    <div id="donor">Loading...</div>
  </main>
  <script src="assets/app.js"></script>
  <script>
  (async ()=>{
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    if (!id) return document.getElementById('donor').textContent = 'Missing id';
    const res = await fetch('api/donor.php?id=' + encodeURIComponent(id));
    const json = await res.json();
    if (json.donor) {
      const d = json.donor;
      const mount = document.getElementById('donor');
      function esc(s){ return (s||'').toString().replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c])); }
      mount.innerHTML = `
        <div class="card donor-card">
          <div class="donor-meta">
            <div>
              <div class="donor-name">${esc(d.name)} <span class="donor-badge">${esc(d.blood_group||'')}</span></div>
              <div class="donor-sub">${esc(d.city||'-')}</div>
            </div>
            <div style="text-align:right">
              <a class="btn btn-outline" href="tel:${esc(d.phone||'')}">Call</a>
              <a class="btn btn-primary" href="mailto:${esc(d.email||'')}">Email</a>
            </div>
          </div>
          <div style="margin-top:10px;"> 
            <strong>Phone:</strong> ${esc(d.phone||'-')}<br>
            <strong>Email:</strong> <a href="mailto:${esc(d.email||'')}">${esc(d.email||'-')}</a>
          </div>
        </div>
      `;
    } else {
      document.getElementById('donor').textContent = JSON.stringify(json);
    }
  })();
  </script>
<?php include 'footer.php'; ?>
</body>
</html>
