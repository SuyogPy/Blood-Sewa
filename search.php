<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Search Donors - Blood Sewa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
            <div class="hero-logo"><img src="assets/logo.jpeg" alt="BloodSewa logo"></div>
            <h1 id="hero-heading" class="shimmer">Find Local Donors</h1>
            <p class="lead">Search verified donors by blood group and city. Quick results to help in urgent situations.</p>
          </div>
        </div>
      </section>
    </div>
  </section>

  <main class="container">
    <h2>Search Donors</h2>
    <form id="searchForm">
      <label>Blood Group <input name="blood_group"></label>
      <label>City <input name="city"></label>
      <button class="btn btn-outline" type="submit">Search</button>
    </form>
    <ul id="results"></ul>
  </main>
  <script src="assets/app.js"></script>
  <script>
  document.getElementById('searchForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const fd = new FormData(e.target);
    const params = new URLSearchParams(Object.fromEntries(fd.entries()));
    const res = await fetch('api/search.php?' + params.toString());
    const json = await res.json();
    const ul = document.getElementById('results');
    ul.innerHTML = '';
    if (json.results) {
      json.results.forEach(r => {
        const li = document.createElement('li');
        li.innerHTML = `
          <div style="display:flex;align-items:center;gap:12px;width:100%;">
            <div style="flex:1">
              <div style="display:flex;gap:8px;align-items:center;">
                <div style="font-weight:800;font-size:1.05rem;color:var(--primary);">${escapeHtml(r.name)}</div>
                <div class="badge">${escapeHtml(r.blood_group || '')}</div>
              </div>
              <div style="color:rgba(44,62,80,0.7);margin-top:6px">${escapeHtml(r.city || '-')}&nbsp;•&nbsp;${escapeHtml(r.phone || '-')}</div>
            </div>
            <div style="flex:0 0 auto;">
              <a class="btn btn-outline" href="donor.php?id=${encodeURIComponent(r.id)}">View</a>
            </div>
          </div>
        `;
        ul.appendChild(li);
      });
    }
    function escapeHtml(s){ return (s||'').toString().replace(/[&<>"]/g, c=> ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c])); }
  });
  </script>
<?php include 'footer.php'; ?>
</body>
</html>
