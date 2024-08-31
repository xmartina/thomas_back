<?php
// Start the session
session_start();

// Include the shared database connection
include '../functions/main_function.php'; // Adjust the path based on your directory structure

// Check if form is submitted and 'student_login' is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_login'])) {
    // Get form input
    $math_number = trim($_POST['math_number']);
    $access_code = trim($_POST['access_code']);

    // SQL query to fetch the student based on Math Number and E-Library Access Code
    $query = "SELECT * FROM students WHERE math_number = :math_number AND e_library_access_code = :access_code";
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
        $_SESSION['student_id'] = $student['id']; // Storing student ID in session

        // Redirect to the student dashboard
        header('Location: ../student/dashboard.php'); // Update path based on your directory structure
        exit; // Stop further script execution
    } else {
        // Login failed
        // Redirect back to login with an error message
        header('Location: ../auth/login/index.php?error=invalid_credentials'); // Update path based on your directory structure
        exit; // Stop further script execution
    }
} else {
    // Redirect to login page if accessed directly
    header('Location: ../auth/login/index.php');
    exit; // Stop further script execution
}
?>
