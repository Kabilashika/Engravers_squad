<?php
session_start();

// Redirect if not logged in or not a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Student Dashboard - Growth Grid";
include('../../includes/db.php');
include('../../includes/student_header.php');

$userId = $_SESSION['user_id'];

// Courses
$courseCount = $pdo->query("SELECT COUNT(*) FROM enrollments WHERE user_id = $userId")->fetchColumn();
$avgProgress = $pdo->query("SELECT AVG(progress) FROM enrollments WHERE user_id = $userId")->fetchColumn();
$avgProgress = $avgProgress ? round($avgProgress) : 0;

// Projects
$projectCount = $pdo->query("SELECT COUNT(*) FROM student_projects WHERE student_id = $userId")->fetchColumn();

// Mentors
$mentorCount = $pdo->query("SELECT COUNT(*) FROM student_mentors WHERE user_id = $userId")->fetchColumn();

// Internships
$internCount = $pdo->query("SELECT COUNT(*) FROM student_internships WHERE user_id = $userId")->fetchColumn();

// Ongoing internship
$activeInternStmt = $pdo->prepare("
    SELECT i.title 
    FROM student_internships si
    JOIN internships i ON si.internship_id = i.id
    WHERE si.user_id = ? AND si.status = 'Ongoing'
    LIMIT 1
");
$activeInternStmt->execute([$userId]);
$activeIntern = $activeInternStmt->fetchColumn();

// Reviews
$reviewCount = $pdo->query("SELECT COUNT(*) FROM reviews WHERE user_id = $userId")->fetchColumn();
?>

<main class="page-wrapper">
    <section style="padding: 40px 20px; max-width: 1000px; margin: auto;">
        <h2 style="text-align: center; color: #f0c330; font-size: 30px;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Explore and manage your digital marketing journey below.</p>
        <div style="text-align: center;">
            <img src="assets/images/student.webp" alt="Student" style="width: 1100px; height: 420px; object-fit: cover; border-radius: 12px; max-width: 100%;">
        </div>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 40px;">
            <!-- Courses -->
            <a href="courses.php" style="text-decoration: none;">
                <div style="background: #e3f2fd; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 250px;">
                    <h3 style="color: #003366;">Courses</h3>
                    <p>Enrolled: <?php echo $courseCount; ?></p>
                    <p>Avg. Progress: <?php echo $avgProgress; ?>%</p>
                </div>
            </a>

            <!-- Projects -->
            <a href="projects.php" style="text-decoration: none;">
                <div style="background: #f0f4c3; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 250px;">
                    <h3 style="color: #558b2f;">Projects</h3>
                    <p>Involved: <?php echo $projectCount; ?></p>
                </div>
            </a>

            <!-- Mentors -->
            <a href="mentors.php" style="text-decoration: none;">
                <div style="background: #e1f5fe; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 250px;">
                    <h3 style="color: #0288d1;">Mentors</h3>
                    <p>Connected: <?php echo $mentorCount; ?></p>
                </div>
            </a>

            <!-- Internships -->
            <a href="internships.php" style="text-decoration: none;">
                <div style="background: #ffe0b2; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 250px;">
                    <h3 style="color: #ef6c00;">Internships</h3>
                    <p>Selected: <?php echo $internCount; ?></p>
                    <p>Current: <?php echo $activeIntern ? htmlspecialchars($activeIntern) : 'None'; ?></p>
                </div>
            </a>

            <!-- Reviews -->
            <a href="reviews.php" style="text-decoration: none;">
                <div style="background: #ede7f6; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 250px;">
                    <h3 style="color: #512da8;">Reviews</h3>
                    <p>Total Submitted: <?php echo $reviewCount; ?></p>
                </div>
            </a>
        </div>
    </section>

    <!-- Optional: Add your detailed info section here if needed -->

</main>

<!-- Floating Chatbot Button (with animation) -->
<a href="dashboard/student/recommend.php" title="Get AI Recommendation"
   style="position: fixed; bottom: 25px; right: 25px; z-index: 999;
          width: 65px; height: 65px; border-radius: 50%;
          background-color: #fff; border: 2px solid #003366;
          box-shadow: 0 4px 12px rgba(0,0,0,0.25);
          animation: bounce 2s infinite ease-in-out;
          display: flex; align-items: center; justify-content: center;">
    <img src="https://www.shutterstock.com/image-vector/happy-robot-3d-ai-character-600nw-2464455965.jpg" alt="Chatbot"
         style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
</a>


<!-- Bounce animation -->
<style>
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-8px);
    }
}
</style>

<?php include('../../includes/footer.php'); ?>
