<?php
$ROOT_DIR = '/home/multistream6/domains/thomas-back.matagram.com/public_html/';
include_once($ROOT_DIR . 'student/partials/header.php');
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form - Geex Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->
    <link rel="stylesheet" href="<?= $site_link ?>assets/vendor/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="<?= $site_link ?>assets/css/style.css">
    <!-- endinject -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $site_link ?>assets/img/favicon.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css">

    <script>
        // Render localStorage JS:
        if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
        if (localStorage.layout) document.documentElement.setAttribute("data-nav", localStorage.navbar);
        if (localStorage.layout) document.documentElement.setAttribute("dir", localStorage.layout);
    </script>
</head>

<body class="geex-dashboard">
<header class="geex-header">
    <!-- Header content as per your original code -->
</header>

<main class="geex-main-content">
    <div class="geex-sidebar">
        <!-- Sidebar content as per your original code -->
    </div>

    <div class="geex-customizer">
        <!-- Customizer content as per your original code -->
    </div>

    <div class="geex-content">
        <div class="geex-content__header">
            <div class="geex-content__header__content">
                <h2 class="geex-content__header__title">Complete Profile Form</h2>
                <p class="geex-content__header__subtitle">Please fill out the form below to complete your profile.</p>
            </div>
        </div>

        <div class="geex-content__body">
            <form action="/functions/process_form.php" method="POST" class="geex-form">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="department_id" class="form-label">Department:</label>
                    <select id="department_id" name="department_id" class="form-select" required>
                        <option value="1">Electrical/Electronics Engineering</option>
                        <option value="2">Computer Engineering</option>
                        <option value="3">Computer Science</option>
                        <option value="4">Statistics</option>
                        <option value="5">Health Information Management</option>
                        <option value="6">Pharmaceutical Technology</option>
                        <option value="7">Community/Public Health</option>
                        <option value="8">Medical Laboratory Science</option>
                        <option value="9">Accountancy</option>
                        <option value="10">Business Administration</option>
                        <option value="11">Public Administration</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Complete Profile</button>
            </form>
        </div>
    </div>
</main>

<script src="<?= $site_link ?>assets/vendor/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?= $site_link ?>assets/js/script.js"></script>
</body>
</html>
