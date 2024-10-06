<?php
// Start the session
session_start();

// Reset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the homepage
header('Location: index.php');
exit;
?>