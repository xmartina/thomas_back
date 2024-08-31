<?php
// Database configuration
$servername = "localhost"; // MySQL server name or IP address
$username = "multistream6_thomas_back"; // MySQL username
$password = "thomas_back"; // MySQL password
$database = "multistream6_thomas_back";    // MySQL database name

// Create a PDO connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
// Set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL query to fetch username based on user ID or another parameter
$viesConn = "SELECT username FROM users WHERE id = :id";
$stmt = $conn->prepare($viesConn);

// Execute the statement with the appropriate parameter
$stmt->execute([
    ':id' => $_SESSION['user_id'] // Replace with your session variable or parameter
]);

// Fetch the result as an associative array
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $username = $row['username'];
    echo "Username: " . $username;
} else {
    echo "No user found.";
}
