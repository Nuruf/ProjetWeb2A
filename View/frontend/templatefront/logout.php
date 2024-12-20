<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destroy the session
session_destroy();

// Optional: Unset session variables
$_SESSION = array();

// Redirect to login page or home
header("Location: blogg.php");
exit();
?>
