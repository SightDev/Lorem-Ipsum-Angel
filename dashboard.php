<?php
// dashboard.php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Get the user's browser information
$browser = $_SERVER['HTTP_USER_AGENT'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">  <!-- Link to your stylesheet -->
</head>
<body>

<div class="dashboard-container">
    <!-- Welcome message at the top left -->
    <h2>Welcome to your dashboard, you are logged in!</h2>

    <!-- Information display for IP and browser -->
    <div class="info-display">
        <div class="ip-display">Your IP: <?php echo $_SESSION['ip']; ?></div>
        <div class="browser-display">Your Browser: <?php echo $browser; ?></div>
    </div>
</div>

</body>
</html>
