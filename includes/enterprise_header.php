<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Growth Grid'; ?></title>
    <base href="/digital_platform/">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .page-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
        window.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const icon = document.querySelector('.user-icon');
            if (dropdown && icon && !dropdown.contains(event.target) && !icon.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    </script>
</head>
<body>
<div class="page-wrapper"><!-- wrapper START -->

<header class="site-header">
    <div class="header-inner centered-title">
        <img src="assets/images/logo.jpg" class="logo" alt="Logo">
        <div class="site-title">
            <h1>Growth Grid</h1>
            <p class="tagline" style="padding: 10px 0;">Your ultimate digital marketing partner.</p>
        </div>
        <div class="user-container">
            <?php
            $profileFile = isset($_SESSION['profile_picture']) && $_SESSION['profile_picture']
                ? "assets/images/profiles/" . $_SESSION['profile_picture']
                : "";
            $profilePathOnServer = $_SERVER['DOCUMENT_ROOT'] . '/digital_platform/' . $profileFile;
            $profileImg = (!empty($profileFile) && file_exists($profilePathOnServer))
                ? $profileFile
                : "assets/images/user.png";
            ?>
            <img src="<?= $profileImg ?>" class="user-icon" onclick="toggleUserDropdown()" alt="User"
                 style="border-radius: 50%; width: 40px; height: 40px; object-fit: cover;">

            <div class="user-dropdown" id="userDropdown">
                <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'enterprise'): ?>
                    <a href="dashboard/enterprise/profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Sign In</a>
                    <a href="register.php">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'enterprise'): ?>
    <nav class="main-nav">
        <ul>
            <li><a href="dashboard/enterprise/index.php">Home</a></li>
            <li><a href="dashboard/enterprise/services.php">Services</a></li>
            <li><a href="dashboard/enterprise/partnership.php">Partnerships</a></li>
            <li><a href="dashboard/enterprise/courses.php">Courses</a></li>
            <li><a href="dashboard/enterprise/toolkit.php">Toolkits</a></li>
            <li><a href="dashboard/enterprise/advisors.php">Advisors</a></li>
            <li><a href="dashboard/enterprise/collaboration.php">Collaboration</a></li>
            <li><a href="dashboard/enterprise/reviews.php">Reviews</a></li>
        </ul>
    </nav>
    <?php endif; ?>
</header>

<main>
<!-- Main page content starts here -->
