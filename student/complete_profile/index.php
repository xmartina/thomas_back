<?php
$ROOT_DIR = '/home/multistream6/domains/thomas-back.matagram.com/public_html/';
include_once($ROOT_DIR . 'student/partials/header.php');

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