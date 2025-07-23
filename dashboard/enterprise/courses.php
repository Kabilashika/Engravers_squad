<?php
session_start();

// Redirect if not logged in or not a enterprise
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Courses - Growth Grid";
include('../../includes/db.php');
include('../../includes/enterprise_header.php');

$userId = $_SESSION['user_id'];

// Handle course enrollment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['course_id'])) {
    $courseId = (int) $_POST['course_id'];

    if ($_POST['action'] === 'enroll') {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM enterprise_enrollments WHERE enterprise_id = ? AND course_id = ?");
        $stmt->execute([$userId, $courseId]);
        $alreadyEnrolled = $stmt->fetchColumn();

        if (!$alreadyEnrolled) {
            $enroll = $pdo->prepare("INSERT INTO enterprise_enrollments (enterprise_id, course_id, progress) VALUES (?, ?, 0)");
            $enroll->execute([$userId, $courseId]);
            echo "<script>alert('You have successfully enrolled in the course!');</script>";
        } else {
            echo "<script>alert('You are already enrolled in this course.');</script>";
        }

    } elseif ($_POST['action'] === 'unenroll') {
        $unenroll = $pdo->prepare("DELETE FROM enterprise_enrollments WHERE enterprise_id = ? AND course_id = ?");
        $unenroll->execute([$userId, $courseId]);
        echo "<script>alert('You have successfully unenrolled from the course.');</script>";
    }
}

// Fetch all courses
$courses = $pdo->query("SELECT * FROM courses ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch enrolled course IDs
$enrolledStmt = $pdo->prepare("SELECT course_id FROM enterprise_enrollments WHERE enterprise_id = ?");
$enrolledStmt->execute([$userId]);
$enrolledCourses = array_column($enrolledStmt->fetchAll(), 'course_id');
?>

<main class="page-wrapper">
    <section style="max-width: 1000px; margin: auto; padding: 40px 20px; line-height: 1.6;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px;padding:10px;">Available Courses</h2>
    
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px;">
            <?php foreach ($courses as $course): ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px; width: 280px; box-shadow: 0 0 10px #eee; background: #fff; display: flex; flex-direction: column; align-items: center; line-height: 1.6;">
                    <?php
                        $img = !empty($course['course_image']) 
                            ? '/digital_platform/uploads/course_images/' . $course['course_image'] 
                            : '/digital_platform/uploads/course_images/tools.webp';
                    ?>
                    <img src="<?php echo $img; ?>" alt="Course Image" style="width: 220px; height: 130px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
                    <h3 style="color: #003366; text-align: center; margin-bottom: 8px;"><?php echo htmlspecialchars($course['title']); ?></h3>
                    <p style="font-size: 14px; margin-bottom: 8px; text-align: center;"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
                    <p style="font-size: 13px; text-align: center;"><strong>Category:</strong> <?php echo htmlspecialchars($course['category']); ?></p>

                    <?php if (in_array($course['id'], $enrolledCourses)): ?>
                        <!-- Unenroll -->
                        <button onclick="confirmUnenroll(<?php echo $course['id']; ?>)" 
                                style="color: #fff; background-color: #d9534f; border-radius: 5px; margin-top: 10px; padding: 8px 16px; cursor: pointer;">
                            Unenroll
                        </button>
                    <?php else: ?>
                        <!-- Enroll -->
                        <button onclick="confirmEnrollment(<?php echo $course['id']; ?>)" 
                                style="color: #fff; background-color: #003366; border-radius: 5px; margin-top: 10px; padding: 8px 16px; cursor: pointer;">
                            Enroll
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Enroll Modal -->
    <div id="enrollModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center; line-height: 1.6;">
            <h3 style="color:#003366;">Confirm Enrollment</h3>
            <p>Are you sure you want to enroll in this course?</p>
            <form method="POST">
                <input type="hidden" name="course_id" id="enroll_course_id">
                <input type="hidden" name="action" value="enroll">
                <button type="submit" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;">Yes, Enroll</button>
                <button type="button" onclick="closeModal('enrollModal')" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Unenroll Modal -->
    <div id="unenrollModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center; line-height: 1.6;">
            <h3 style="color:#d9534f;">Confirm Unenrollment</h3>
            <p>Are you sure you want to unenroll from this course?</p>
            <form method="POST">
                <input type="hidden" name="course_id" id="unenroll_course_id">
                <input type="hidden" name="action" value="unenroll">
                <button type="submit" style="background:#d9534f; color:#fff; padding:10px 20px; border:none; border-radius:5px;">Yes, Unenroll</button>
                <button type="button" onclick="closeModal('unenrollModal')" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmEnrollment(courseId) {
        document.getElementById('enroll_course_id').value = courseId;
        document.getElementById('enrollModal').style.display = 'flex';
    }

    function confirmUnenroll(courseId) {
        document.getElementById('unenroll_course_id').value = courseId;
        document.getElementById('unenrollModal').style.display = 'flex';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
