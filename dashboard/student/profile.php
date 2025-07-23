<?php
session_start();
include('../../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$uploadSuccess = false;
$updateSuccess = false;
$error = '';

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $image = $_FILES['profile_picture'];
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (in_array($ext, $allowed)) {
        if ($image['size'] < 5 * 1024 * 1024) {
            $filename = "profile_" . $userId . "_" . time() . "." . $ext;
            $uploadDir = "../../assets/images/profiles/";
            $relativePath = "assets/images/profiles/" . $filename;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $uploadDir . $filename)) {
                $stmt = $pdo->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
                $stmt->execute([$filename, $userId]);
                $_SESSION['profile_picture'] = $filename;
                $uploadSuccess = true;
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "File size too large. Max allowed is 5MB.";
        }
    } else {
        $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}

// Handle profile info update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_info'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if (!empty($username) && !empty($email)) {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $userId]);
        $_SESSION['username'] = $username;
        $updateSuccess = true;
    } else {
        $error = "Username and email cannot be empty.";
    }
}

// Fetch user info
$stmt = $pdo->prepare("SELECT username, email, role, profile_picture FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>

<?php include('../../includes/student_header.php'); ?>

<main class="page-wrapper">
    <section style="max-width: 950px; margin: 50px auto; background-color: #f1f9ff; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #f0c330; font-size: 30px; text-align: center; margin-bottom: 30px;">My Profile</h2>

        <div style="display: flex; flex-wrap: wrap; gap: 30px;">
            <!-- Profile Picture Area -->
            <div style="flex: 1; min-width: 250px; text-align: center;">
                <?php if ($user['profile_picture']): ?>
                    <img src="../../assets/images/profiles/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture"
                         style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 20px;">
                <?php else: ?>
                    <img src="../../assets/images/user.png" alt="Default Profile Picture"
                         style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_picture" required style="margin-top: 10px;">
                    <br><br>
                    <button type="submit" style="padding: 10px 20px;">Upload Picture</button>
                </form>

                <?php if ($uploadSuccess): ?>
                    <p style="color: green; margin-top: 10px;">Profile picture updated successfully.</p>
                <?php endif; ?>
            </div>

            <!-- Profile Info Area -->
            <div style="flex: 2; min-width: 300px;">
                <form method="post">
                    <label><strong>Username:</strong></label><br>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required
                           style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><br>

                    <label><strong>Email:</strong></label><br>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required
                           style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><br>

                    <label><strong>Role:</strong></label><br>
                    <input type="text" value="<?php echo htmlspecialchars($user['role']); ?>" disabled
                           style="width: 100%; padding: 10px; margin-bottom: 20px; background-color: #eee; border-radius: 5px;"><br>

                    <button type="submit" name="update_info" style="color: #f1f9ff; border-radius: 10px; background-color: #003366; padding: 10px 20px;">Update Profile</button>
                </form>

                <?php if ($updateSuccess): ?>
                    <p style="color: green; margin-top: 10px;">Profile updated successfully.</p>
                <?php elseif ($error && !$uploadSuccess): ?>
                    <p style="color: red; margin-top: 10px;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
