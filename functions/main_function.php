<?php
$ROOT_DIR = '/home/multistream6/domains/thomas-back.matagram.com/public_html/';// Include the shared database connection
include ($ROOT_DIR . 'include/db_connection.php'); // Adjust the path based on your directory structure
$query = "SELECT * FROM settings WHERE id = :settings_id";
$stmt = $conn->prepare($query);

// Execute the statement with the form inputs
$stmt->execute([
    ':settings_id' => 1
]);

// Fetch the result
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

if ($settings) {
    // Login successful
    // Assign student ID to session variable
    $site_link = $settings['site_link'];
}