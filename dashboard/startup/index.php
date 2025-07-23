<?php
session_start();

// Redirect if not logged in or not a startup user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Startup Dashboard - Growth Grid";
include('../../includes/db.php');
include('../../includes/startup_header.php');

$userId = $_SESSION['user_id'];

// Count of subscribed services
$serviceStmt = $pdo->prepare("SELECT COUNT(*) FROM startup_services WHERE startup_id = ?");
$serviceStmt->execute([$userId]);
$serviceCount = $serviceStmt->fetchColumn();

// Count of enrolled courses
$courseStmt = $pdo->prepare("SELECT COUNT(*) FROM startup_enrollments WHERE startup_id = ?");
$courseStmt->execute([$userId]);
$courseCount = $courseStmt->fetchColumn();

// Count of connected advisors
$advisorStmt = $pdo->prepare("SELECT COUNT(*) FROM startup_advisors WHERE startup_id = ?");
$advisorStmt->execute([$userId]);
$advisorCount = $advisorStmt->fetchColumn();

// Count of reviews made by the startup
$reviewStmt = $pdo->prepare("SELECT COUNT(*) FROM reviews WHERE user_id = ?");
$reviewStmt->execute([$userId]);
$reviewCount = $reviewStmt->fetchColumn();
?>

<main class="page-wrapper">
    <section style="padding: 40px 20px; max-width: 1000px; margin: auto;">
        <h2 style="text-align: center; color: #f0c330; font-size: 30px;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p style="text-align: center; margin-top: 10px; padding: 10px 0;">Here is a quick overview of your startup activity.</p>

        <div style="text-align: center;">
            <img src="assets/images/startup1.jpg" alt="Startup" style="width: 1100px; height: 420px; object-fit: cover; border-radius: 12px; max-width: 100%;">
        </div>

        <!-- Dashboard Summary -->
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 40px;">

            <!-- Subscribed Services -->
            <a href="services.php" style="text-decoration: none;">
                <div style="background: #d0f0c0; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 0 10px #ccc;">
                    <h3 style="color: #388e3c;">Subscribed Services</h3>
                    <p>Total: <?php echo $serviceCount; ?></p>
                </div>
            </a>

            <!-- Enrolled Courses -->
            <a href="courses.php" style="text-decoration: none;">
                <div style="background: #bbdefb; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 0 10px #ccc;">
                    <h3 style="color: #1565c0;">Courses</h3>
                    <p>Enrolled: <?php echo $courseCount; ?></p>
                </div>
            </a>

            <!-- Connected Advisors -->
            <a href="advisors.php" style="text-decoration: none;">
                <div style="background: #ffe0b2; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 0 10px #ccc;">
                    <h3 style="color: #ef6c00;">Advisors</h3>
                    <p>Connected: <?php echo $advisorCount; ?></p>
                </div>
            </a>

            <!-- Reviews -->
            <a href="reviews.php" style="text-decoration: none;">
                <div style="background: #ede7f6; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 0 10px #ccc;">
                    <h3 style="color: #512da8;">Reviews</h3>
                    <p>Submitted: <?php echo $reviewCount; ?></p>
                </div>
            </a>

        </div>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
