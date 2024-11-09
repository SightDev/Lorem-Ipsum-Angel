<?php
session_start();

// MySQL connection setup
$servername = "sql213.infinityfree.com"; // Database server
$username = "if0_37645826"; // Database username (adjust as needed)
$password = "475564Eh"; // Database password (adjust as needed)
$dbname = "if0_37645826_ip_login_db"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if the IP is already in the database
function is_ip_in_db($ip, $conn) {
    $sql = "SELECT * FROM allowed_ips WHERE ip_address = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ip); // Bind IP parameter
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0; // Return true if IP exists in the database
}

// Check if user is already logged in via session
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // If logged in, redirect to the dashboard
    header("Location: dashboard.php");
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_ip = $_POST['ip'];

    // Check if the IP is already in the database
    if (is_ip_in_db($user_ip, $conn)) {
        // IP is in the database, log the user in
        $_SESSION['logged_in'] = true;
        $_SESSION['ip'] = $user_ip;  // Store the user's IP in the session

        // Redirect to the dashboard page after successful login
        header("Location: dashboard.php");  // Redirect to the dashboard
        exit; // Always call exit after a header redirect
    } else {
        // IP is not allowed, redirect to accessdenied.php
        header("Location: accessdenied.php");  // Redirect to the access denied page
        exit; // Stop further script execution
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login by IP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Angels</h1>
<h2>Steal</h2>
<h3>Too</h3>

<form action="index.php" method="POST">
    <label for="ip"></label>
    <input type="text" id="ip" name="ip" placeholder="Your IP address" required>
    <button type="submit">Login</button>
</form>

</body>
</html>
