<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Include the shared database connection
$ROOT_DIR = '/home/multistream6/domains/thomas-back.matagram.com/public_html/';
include($ROOT_DIR . 'functions/main_function.php'); // Adjust the path based on your directory structure

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) { ?>
    <script>
        // Redirect to the login page
        window.location.href = '<?= $site_link ?>auth/login'; // Replace with your target URL
    </script>
    <?php
    exit; // Prevent further execution
}

$student_id = $_SESSION['student_id'];

// Fetch student data from the database
$query = "SELECT * FROM students WHERE id = :student_id";
$stmt = $conn->prepare($query);
$stmt->execute([':student_id' => $student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student) {
    $stu_fname = $student['fname'];
    $stu_lname = $student['lname'];
    $stu_email = $student['email'];
    $stu_phone = $student['phone_number'];
    $stu_department = $student['department_id'];

    // Convert department ID to department name
    switch ($stu_department) {
        case 1:
            $stu_department = 'Electrical/Electronics Engineering';
            break;
        case 2:
            $stu_department = 'Computer Engineering';
            break;
        case 3:
            $stu_department = 'Computer Science';
            break;
        case 4:
            $stu_department = 'Statistics';
            break;
        case 5:
            $stu_department = 'Health Information Management';
            break;
        case 6:
            $stu_department = 'Pharmaceutical Technology';
            break;
        case 7:
            $stu_department = 'Community/Public Health';
            break;
        case 8:
            $stu_department = 'Medical Laboratory Science';
            break;
        case 9:
            $stu_department = 'Accountancy';
            break;
        case 10:
            $stu_department = 'Business Administration';
            break;
        case 11:
            $stu_department = 'Public Administration';
            break;
        default:
            $stu_department = 'Unknown Department'; // Handle unexpected values
            break;
    }
}

// Function to check if all fields are not null
function isProfileComplete($fname, $lname, $email, $phone, $department) {
    return !is_null($fname) && !is_null($lname) && !is_null($email) && !is_null($phone) && !is_null($department);
}

// Determine if the profile is complete
$profile_complete = isProfileComplete($stu_fname, $stu_lname, $stu_email, $stu_phone, $stu_department);

// Get the current URI
$currentUri = $_SERVER['REQUEST_URI'];

// Redirect logic based on profile completeness and current page
if ($profile_complete && strpos($currentUri, 'student/dashboard') === false) {
    // If profile is complete, redirect to the dashboard
    ?>
    <script>
        window.location.href = '<?= $site_link ?>student/dashboard'; // Redirect to the dashboard
    </script>
    <?php
    exit; // Prevent further execution
} elseif (!$profile_complete && strpos($currentUri, 'student/complete_profile') === false) {
    // If profile is incomplete, redirect to the complete profile page
    ?>
    <script>
        window.location.href = '<?= $site_link ?>student/complete_profile'; // Redirect to the complete profile page
    </script>
    <?php
    exit; // Prevent further execution
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profile_complete'])) {
    // Retrieve form inputs
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $department_id = trim($_POST['department_id']);

    // Validate inputs (add more validation as needed)
    if (empty($full_name) || empty($email) || empty($phone_number) || empty($department_id)) {
        echo "All fields are required.";
        exit;
    }

    // Get the student ID from the session
    if (!isset($_SESSION['student_id'])) {
        echo "You must be logged in to complete your profile.";
        exit;
    }

    $student_id = $_SESSION['student_id'];

    // Update the student's profile in the database
    try {
        $query = "UPDATE students SET full_name = :full_name, email = :email, phone_number = :phone_number, department_id = :department_id WHERE id = :student_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':full_name' => $full_name,
            ':email' => $email,
            ':phone_number' => $phone_number,
            ':department_id' => $department_id,
            ':student_id' => $student_id
        ]);

        // Redirect to the dashboard after successful update
        header("Location: {$site_link}student/dashboard.php");
        exit;
    } catch (PDOException $e) {
        echo "Error updating profile: " . $e->getMessage();
        exit;
    }
} else {
    echo "Invalid request method.";
}
?>
