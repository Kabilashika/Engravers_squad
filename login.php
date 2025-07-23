<?php
session_start();
$pageTitle = "Login - Growth Grid";
include('includes/db.php');
?>

<div class="page-wrapper">

<?php include('includes/header.php'); ?>

<main>
    <div class="form-container">
        <!-- LOGIN FORM -->
        <form method="post" class="register-form" autocomplete="off">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>

            <?php
            if (isset($_POST['login'])) {
                $username = htmlspecialchars(trim($_POST['username']));
                $password = $_POST['password'];

                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'default.png';

                    switch ($_SESSION['role']) {
                        case 'student':
                            header("Location: dashboard/student/index.php");
                            break;
                        case 'startup':
                            header("Location: dashboard/startup/index.php");
                            break;
                        case 'enterprise':
                            header("Location: dashboard/enterprise/index.php");
                            break;
                        default:
                            header("Location: dashboard/index.php");
                    }
                    exit;
                } else {
                    echo "<p class='error'>Invalid username or password.</p>";
                }
            }
            ?>

            <p style="text-align:center; margin-top:10px;">
                Don't have an account? <a href="register.php">Register here</a><br>
                <a href="login.php?reset=1" style="color:#003366;">Forgot Password?</a>
            </p>
        </form>

        <!-- RESET PASSWORD FORM -->
        <?php if (isset($_GET['reset'])): ?>
            <form method="post" class="register-form" autocomplete="off" style="margin-top: 40px;">
                <h2>Reset Password</h2>
                <input type="text" name="reset_username" placeholder="Enter your username" required>
                <input type="password" name="new_password" placeholder="Enter new password" required>
                <button type="submit" name="reset_password">Reset Password</button>

                <?php
                if (isset($_POST['reset_password'])) {
                    $resetUsername = htmlspecialchars(trim($_POST['reset_username']));
                    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

                    // Check if user exists
                    $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
                    $check->execute([$resetUsername]);
                    if ($check->fetch()) {
                        $update = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
                        $update->execute([$newPassword, $resetUsername]);
                        echo "<p style='color:green;'>Password successfully updated. You can now <a href='login.php'>log in</a>.</p>";
                    } else {
                        echo "<p class='error'>Username not found.</p>";
                    }
                }
                ?>
            </form>
        <?php endif; ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>

</div>
