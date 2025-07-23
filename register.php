<?php
session_start();
$pageTitle = "Register - Growth Grid";
include('includes/db.php');
?>

<div class="page-wrapper">
<?php include('includes/header.php'); ?>

<main>
    <div class="form-container">
        <form method="post" class="register-form" autocomplete="off">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <select name="role" required>
                <option value="">-- Select Role --</option>
                <option value="student">Student (Learn Digital Marketing)</option>
                <option value="startup">Startup (Find Marketing Services)</option>
                <option value="enterprise">Enterprise (Digital Marketing Solutions)</option>
                <option value="admin">Admin (Platform Management)</option>
            </select>

            <button type="submit" name="register">Register</button>

            <?php
            if (isset($_POST['register'])) {
                $username = htmlspecialchars(trim($_POST['username']));
                $email = htmlspecialchars(trim($_POST['email']));
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                $role = $_POST['role'];

                if ($password !== $confirm_password) {
                    echo "<p class='error' style='color:red;'>Passwords do not match.</p>";
                } else {
                    // Check if email already exists
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
                    $stmt->execute([$email]);
                    $emailExists = $stmt->fetchColumn();

                    if ($emailExists) {
                        echo "<p class='error' style='color:red;'>Email is already registered. <a href='login.php'>Login instead?</a></p>";
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $insert = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");

                        try {
                            $insert->execute([$username, $email, $hashedPassword, $role]);
                            echo "<p class='success' style='color:green;'>Registration successful! <a href='login.php'>Login here</a></p>";
                        } catch (PDOException $e) {
                            echo "<p class='error' style='color:red;'>An error occurred. Please try again later.</p>";
                            error_log("Registration Error: " . $e->getMessage());
                        }
                    }
                }
            }
            ?>

            <p style="text-align: center; margin-top: 10px;">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</main>

<?php include('includes/footer.php'); ?>
</div>
