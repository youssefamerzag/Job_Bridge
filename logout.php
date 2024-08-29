<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header('Location: login.php'); // Change 'login.php' to your login page or home page
exit();
