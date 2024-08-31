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

?>