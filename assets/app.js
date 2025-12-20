// Minimal client helpers
async function apiFetch(path, opts = {}) {
  opts.credentials = opts.credentials || 'include';
  // allow a global API root when index.html is served from parent folder
  const root = (typeof window !== 'undefined' && window.API_ROOT) ? window.API_ROOT : '';
  const url = path.startsWith('http') || path.startsWith('/') ? path : (root + path);
  const res = await fetch(url, opts);
  try { return await res.json(); } catch(e) { return null; }
}

// Expose simple helpers for console testing
window.apiFetch = apiFetch;

// Logout helper
async function logout() {
  await fetch('api/logout.php', { method: 'POST', credentials: 'include' });
  window.location.href = 'index.php';
}
window.logout = logout;

// CSRF helper: fetch and cache token
let _csrf = null;
async function getCsrfToken() {
  if (_csrf) return _csrf;
  try {
    const res = await fetch('api/csrf.php', { credentials: 'include' });
    const j = await res.json();
    _csrf = j.token;
    return _csrf;
  } catch (e) { return null; }
}
window.getCsrfToken = getCsrfToken;

// Fetch live stats and update any .live-stats elements
async function fetchLiveStats() {
  try {
    const res = await fetch('api/stats.php', { credentials: 'include' });
    const j = await res.json();
    if (j && typeof j.donors_count === 'number') {
      document.querySelectorAll('.live-stats').forEach(el=>{
        el.textContent = `+${j.donors_count.toLocaleString()} Donors Registered`;
      });
    }
  } catch (e) { /* ignore */ }
}

document.addEventListener('DOMContentLoaded', ()=>{ fetchLiveStats(); });
