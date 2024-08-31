<?php
// Start the session
session_start();
include '../functions/main_function.php'; // Adjust the path based on your directory structure
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_login'])) {
    // Get form input
    $math_number = $_POST['math_number'];
    $access_code = $_POST['access_code'];

    // SQL query to fetch the student based on Math Number and E-Library Access Code
    $query = "SELECT * FROM students WHERE math_number = :math_number AND access_code = :access_code";
    $stmt = $conn->prepare($query);

    // Execute the statement with the form inputs
    $stmt->execute([
        ':math_number' => $math_number,
        ':access_code' => $access_code
    ]);

    // Fetch the result
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        // Login successful
        // Assign student ID to session variable
        $_SESSION['student_id'] = $student['id']; // Assuming 'id' is the column name for student ID in your table
        header(Location : 'student/dashboard');

//        echo "Login successful! Welcome, " . $student['name'] . ".";
        // Redirect to a protected page or dashboard (example: dashboard.php)
        // header("Location: dashboard.php");
        // exit;
    } else {
        // Login failed
        header(Location : 'student/dashboard?=invalid_credentials')
        echo "Invalid Math Number or E-Library Access Code.";
    }
}