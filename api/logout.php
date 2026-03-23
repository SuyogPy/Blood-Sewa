<?php
// =============================================
// logout.php (API) - Log Out User
// =============================================
// This file destroys the user's session,
// effectively logging them out.
// =============================================

// Tell the browser we are sending JSON data
header('Content-Type: application/json');

// Start session so we can destroy it
session_start();

// ---- Step 1: Destroy the session ----
// This removes all session data
session_destroy();

// ---- Step 2: Send success response ----
echo json_encode(['ok' => true]);
?>
