<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?? 'Growth Grid'; ?></title>
    <base href="/digital_platform/">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* ...existing styles... */
    </style>
    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
        window.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const icon = document.querySelector('.user-icon');
            if (!dropdown.contains(event.target) && !icon.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    </script>
</head>
<body>
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
            if (isset($_SESSION['profile_picture']) && $_SESSION['profile_picture']) {
                $profilePic = 'assets/images/profiles/' . htmlspecialchars($_SESSION['profile_picture']);
            }
            ?>
            <img src="<?php echo $profilePic; ?>" class="user-icon" onclick="toggleUserDropdown()" alt="User">
            <div class="user-dropdown" id="userDropdown">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard/profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Sign In</a>
                    <a href="register.php">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="features.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="terms.php">Terms And Conditions</a></li>
        </ul>
    </nav>
</header>
<main>
