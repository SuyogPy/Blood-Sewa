<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profile - Blood Sewa</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <section class="hero-outer">
    <div class="container">
      <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-card">
          <div style="display:flex; align-items:center; gap:8px; flex-direction:column;">
            <div class="hero-logo"><img src="assets/logo.jpg" alt="BloodSewa logo"></div>
            <h1 id="hero-heading" class="shimmer">Your Profile</h1>
            <p class="lead">Manage your donor profile and availability preferences.</p>
          </div>
        </div>
      </section>
    </div>
  </section>

  <main class="container">
    <h2>My Profile</h2>
    <div style="display:flex; gap:12px; justify-content:space-between; align-items:center;">
      <div></div>
      <div>
        <button id="logoutBtn" class="btn btn-outline">Logout</button>
      </div>
    </div>

    <div id="profile-card">Loading...</div>
  </main>
  <script src="assets/app.js"></script>
  <script>
  (async ()=>{
    document.getElementById('logoutBtn').addEventListener('click', async ()=>{
      const token = await window.getCsrfToken();
      await fetch('api/logout.php', { method: 'POST', credentials: 'include', headers: { 'Content-Type':'application/json' }, body: JSON.stringify({ csrf_token: token }) });
      window.location.href = 'index.php';
    });
    const res = await fetch('api/profile.php', { credentials: 'include' });
    if (res.status === 401) {
      document.getElementById('profile-card').textContent = 'Not logged in. Go to login.';
      return;
    }
    const json = await res.json();
    const mount = document.getElementById('profile-card');
    if (!json.user) return mount.textContent = 'Unable to load profile';
    const user = json.user;

    function renderView() {
      mount.innerHTML = `
        <div class="profile-card-inner">
          <div class="profile-row"><strong>Name</strong><div class="profile-value">${escapeHtml(user.name)}</div></div>
          <div class="profile-row"><strong>Email</strong><div class="profile-value">${escapeHtml(user.email)}</div></div>
          <div class="profile-row"><strong>Phone</strong><div class="profile-value">${escapeHtml(user.phone || '-')}</div></div>
          <div class="profile-row"><strong>City</strong><div class="profile-value">${escapeHtml(user.city || '-')}</div></div>
          <div class="profile-row"><strong>Blood Group</strong><div class="profile-value badge">${escapeHtml(user.blood_group || '-')}</div></div>
          <div class="profile-actions"><button id="editBtn" class="btn btn-outline">Edit</button> <button id="delBtn" class="btn" style="background:#fff;color:var(--primary);border:1px solid rgba(211,47,47,0.08);">Remove Account</button></div>
        </div>
      `;
      document.getElementById('editBtn').addEventListener('click', renderEdit);
      document.getElementById('delBtn').addEventListener('click', async ()=>{
        if (!confirm('Remove your account? This cannot be undone.')) return;
        const token = await window.getCsrfToken();
        const r = await fetch('api/profile_delete.php', { method: 'POST', credentials: 'include', headers:{'Content-Type':'application/json'}, body: JSON.stringify({ csrf_token: token }) });
        const j = await r.json();
        if (j && j.ok) window.location.href = 'index.php';
        else alert('Failed to delete account');
      });
    }

    function renderEdit() {
      mount.innerHTML = `
        <form id="profileEdit" class="profile-edit-form">
          <label>Name <input name="name" value="${escapeHtml(user.name)}"></label>
          <label>Phone <input name="phone" value="${escapeHtml(user.phone || '')}"></label>
          <label>City <input name="city" value="${escapeHtml(user.city || '')}"></label>
          <label>Blood Group <input name="blood_group" value="${escapeHtml(user.blood_group || '')}"></label>
          <div style="display:flex;gap:10px;margin-top:10px;"><button class="btn" type="submit">Save</button><button id="cancelEdit" type="button" class="btn btn-outline">Cancel</button></div>
        </form>
      `;
      document.getElementById('cancelEdit').addEventListener('click', renderView);
      document.getElementById('profileEdit').addEventListener('submit', async (e)=>{
        e.preventDefault();
        const fd = new FormData(e.target);
        const body = Object.fromEntries(fd.entries());
        body.csrf_token = await window.getCsrfToken();
        const r = await fetch('api/profile_update.php', { method: 'POST', credentials:'include', headers:{'Content-Type':'application/json'}, body: JSON.stringify(body) });
        const j = await r.json();
        if (j && j.ok) {
          user.name = j.user.name; user.phone = j.user.phone; user.city = j.user.city; user.blood_group = j.user.blood_group;
          renderView();
        } else {
          alert((j && j.error) || 'Update failed');
        }
      });
    }

    function escapeHtml(s){ return (s+'').replace(/[&<>"]/g, c=> ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c])); }

    renderView();
  })();
  </script>
<?php include 'footer.php'; ?>
</body>
</html>
