<?php
// =============================================
// logout.php - Log Out User
// =============================================
// This file destroys the session (logs out)
// and redirects the user to the home page.
// =============================================

// Start session so we can destroy it
session_start();

// Destroy the session — this logs the user out
session_destroy();

// Redirect to home page
header("Location: index.php");
exit;
?>
