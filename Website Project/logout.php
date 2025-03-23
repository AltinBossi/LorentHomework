<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If desired, clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: login.php"); // Change 'login.php' to your desired destination
exit();
?>