<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Include the shared database connection
$ROOT_DIR = '/home/multistream6/domains/thomas-back.matagram.com/public_html/';
include ($ROOT_DIR . 'functions/main_function.php'); // Adjust the path based on your directory structure

if(!isset($_SESSION['student_id'])){ ?>
<script>// Redirect to a specific URL
    window.location.href = '<?=$site_link ?>auth/login'; // Replace with your target URL
</script>
<?php }

$student_id = $_SESSION['student_id'];

$query = "SELECT * FROM students WHERE id = :student_id";
$stmt = $conn->prepare($query);
$stmt->execute([
    ':student_id' => $student_id
]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student) {
    $stu_fname = $student['fname'];
    $stu_lname = $student['lname'];
    $stu_email = $student['email'];
    $stu_phone = $student['phone_number'];
    $stu_department = $student['department_id'];
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

switch (true) { // Using switch(true) to evaluate conditions
    case is_null($stu_fname):
    case is_null($stu_lname):
    case is_null($stu_email):
    case is_null($stu_phone):
    case is_null($stu_department):
        ?>
        <script>
            // Redirect to a specific URL
            window.location.href = '<?=$site_link ?>student/complete_profile'; // Replace with your target URL
        </script>
        <?php
        break;
    // You can add more cases here if needed for other specific checks
}

// Function to check if all fields are not null
function isProfileComplete($fname, $lname, $email, $phone, $department) {
    return !is_null($fname) && !is_null($lname) && !is_null($email) && !is_null($phone) && !is_null($department);
}

// Check if the profile is complete and set session flag accordingly
if (isProfileComplete($stu_fname, $stu_lname, $stu_email, $stu_phone, $stu_department)) {
    $_SESSION['profile_complete'] = true;
} else {
    $_SESSION['profile_complete'] = false;
}

// Get the current URI
$currentUri = $_SERVER['REQUEST_URI'];

// Check if we are on the complete profile page
if (strpos($currentUri, 'student/complete_profile') !== false) {
    // If profile is complete, redirect to the dashboard
    if ($_SESSION['profile_complete']) {
        if (strpos($currentUri, 'student/dashboard') === false) { // Only redirect if not already on the dashboard
            ?>
            <script>
                window.location.href = '<?= $site_link ?>student/dashboard'; // Redirect to the dashboard
            </script>
            <?php
        }
    } else {
        // If profile is incomplete, remain on or redirect to the complete profile page
        if (strpos($currentUri, 'student/complete_profile') === false) { // Only redirect if not already on complete profile
            ?>
            <script>
                window.location.href = '<?= $site_link ?>student/complete_profile'; // Redirect to the complete profile page
            </script>
            <?php
        }
    }
}
?>