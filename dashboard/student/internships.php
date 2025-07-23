<?php
session_start();

// Redirect if not logged in or not a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Internships - Growth Grid";
include('../../includes/db.php');
include('../../includes/student_header.php');

$userId = $_SESSION['user_id'];

// Handle internship apply/withdraw
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['internship_id'])) {
    $internshipId = (int) $_POST['internship_id'];

    if ($_POST['action'] === 'apply') {
        $check = $pdo->prepare("SELECT COUNT(*) FROM student_internships WHERE user_id = ? AND internship_id = ?");
        $check->execute([$userId, $internshipId]);
        $alreadyApplied = $check->fetchColumn();

        if (!$alreadyApplied) {
            $apply = $pdo->prepare("INSERT INTO student_internships (user_id, internship_id, status, applied_at) VALUES (?, ?, 'Applied', NOW())");
            $apply->execute([$userId, $internshipId]);
            echo "<script>alert('Successfully applied to the internship!');</script>";
        } else {
            echo "<script>alert('You have already applied for this internship.');</script>";
        }
    } elseif ($_POST['action'] === 'withdraw') {
        $delete = $pdo->prepare("DELETE FROM student_internships WHERE user_id = ? AND internship_id = ?");
        $delete->execute([$userId, $internshipId]);
        echo "<script>alert('Application withdrawn successfully.');</script>";
    }
}

// Fetch internships
$internships = $pdo->query("SELECT * FROM internships ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch applied internship IDs
$stmt = $pdo->prepare("SELECT internship_id FROM student_internships WHERE user_id = ?");
$stmt->execute([$userId]);
$appliedInternships = array_column($stmt->fetchAll(), 'internship_id');
?>

<main class="page-wrapper">
    <section style="max-width: 1000px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px; padding-bottom: 20px;">Available Internships</h2>

        <div style="text-align: center;">
            <img src="assets/images/internship.jpg" alt="Startup" style="width: 1100px; height: 420px; object-fit: cover; border-radius: 12px; max-width: 100%;">
        </div>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px;">
            <?php foreach ($internships as $internship): ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px; width: 300px; box-shadow: 0 0 10px #eee; background: #fff;">
                    <h3 style="color: #003366;"><?php echo htmlspecialchars($internship['title']); ?></h3>
                    <p><strong>Company:</strong> <?php echo htmlspecialchars($internship['company_name']); ?></p>
                    <p style="font-size: 14px;"><?php echo htmlspecialchars($internship['description']); ?></p>
                    <p style="font-size: 13px;"><strong>Status:</strong> <?php echo htmlspecialchars($internship['status']); ?></p>

                    <?php if (in_array($internship['id'], $appliedInternships)): ?>
                        <button onclick="confirmWithdraw(<?php echo $internship['id']; ?>)"
                                style="color: #fff; background-color: #d9534f; border: none; padding: 8px 16px; border-radius: 5px; margin-top: 10px;">
                            Withdraw
                        </button>
                    <?php else: ?>
                        <button onclick="confirmApply(<?php echo $internship['id']; ?>)"
                                style="color: #fff; background-color: #003366; border: none; padding: 8px 16px; border-radius: 5px; margin-top: 10px;">
                            Apply
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Confirmation Modal -->
    <div id="internshipModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center;">
            <h3 id="modalTitle" style="color:#003366;">Confirm Action</h3>
            <p id="modalMessage">Do you want to apply for this internship?</p>
            <form method="POST">
                <input type="hidden" name="internship_id" id="internship_id_input">
                <input type="hidden" name="action" id="action_input">
                <button type="submit" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;" id="confirmButton">Yes</button>
                <button type="button" onclick="closeInternshipModal()" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmApply(internshipId) {
        document.getElementById('internship_id_input').value = internshipId;
        document.getElementById('action_input').value = 'apply';
        document.getElementById('modalTitle').innerText = 'Apply for Internship';
        document.getElementById('modalMessage').innerText = 'Are you sure you want to apply for this internship?';
        document.getElementById('confirmButton').style.background = '#003366';
        document.getElementById('internshipModal').style.display = 'flex';
    }

    function confirmWithdraw(internshipId) {
        document.getElementById('internship_id_input').value = internshipId;
        document.getElementById('action_input').value = 'withdraw';
        document.getElementById('modalTitle').innerText = 'Withdraw Application';
        document.getElementById('modalMessage').innerText = 'Are you sure you want to withdraw your application?';
        document.getElementById('confirmButton').style.background = '#d9534f';
        document.getElementById('internshipModal').style.display = 'flex';
    }

    function closeInternshipModal() {
        document.getElementById('internshipModal').style.display = 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
