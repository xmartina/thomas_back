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
