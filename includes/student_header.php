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
        <div class="site-title">
            <h1>Growth Grid</h1>
            <p class="tagline">Your ultimate digital marketing partner.</p>
        </div>

        <img src="assets/images/logo.jpg" class="logo big-logo" alt="Logo">

        <div class="user-container">
            <?php
            $profilePic = 'assets/images/user.png';
            if (!empty($_SESSION['profile_picture'])) {
                $customPic = 'assets/images/profiles/' . htmlspecialchars($_SESSION['profile_picture']);
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/digital_platform/' . $customPic)) {
                    $profilePic = $customPic;
                }
            }
            ?>
            <img src="<?= $profilePic ?>" class="user-icon" onclick="toggleUserDropdown()" alt="User" style="border-radius:50%; width:40px; height:40px; object-fit:cover;">
            <div class="user-dropdown" id="userDropdown">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard/student/profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Sign In</a>
                    <a href="register.php">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'student'): ?>
        <nav class="main-nav">
            <ul>
                <li><a href="dashboard/student/index.php">Home</a></li>
                <li><a href="dashboard/student/courses.php">Courses</a></li>
                <li><a href="dashboard/student/projects.php">Projects</a></li>
                <li><a href="dashboard/student/mentors.php">Mentors</a></li>
                <li><a href="dashboard/student/internships.php">Internships</a></li>
                <li><a href="dashboard/student/reviews.php">Reviews</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</header>

<main>
<!-- Main content should follow here -->
