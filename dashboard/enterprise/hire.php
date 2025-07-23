<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

include('../../includes/db.php');
include('../../includes/enterprise_header.php');

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
$pageTitle = "Post Jobs & View Applications - Growth Grid";

// === Handle Job Post Submission ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_post'], $_POST['title'], $_POST['description'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = 'Open';
    $isInternship = isset($_POST['is_internship']) ? 1 : 0;

    if ($title && $description) {
        $stmt = $pdo->prepare("INSERT INTO job_postings (enterprise_id, title, description, status, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$userId, $title, $description, $status]);

        if ($isInternship) {
            $checkExist = $pdo->prepare("SELECT COUNT(*) FROM internships WHERE title = ? AND company_name = ?");
            $checkExist->execute([$title, $username]);
            if ($checkExist->fetchColumn() == 0) {
                $pdo->prepare("INSERT INTO internships (title, company_name, description, status, created_at) VALUES (?, ?, ?, ?, NOW())")
                    ->execute([$title, $username, $description, $status]);
            }
        }

        echo "<script>alert('Job posted successfully!'); window.location.href = '{$_SERVER['PHP_SELF']}';</script>";
        exit;
    }
}

// === Handle Delete Job ===
if (isset($_POST['delete_job_id'])) {
    $jobId = (int) $_POST['delete_job_id'];

    // Optionally delete internship entry if exists
    $stmt = $pdo->prepare("SELECT title FROM job_postings WHERE id = ? AND enterprise_id = ?");
    $stmt->execute([$jobId, $userId]);
    $jobTitle = $stmt->fetchColumn();

    if ($jobTitle) {
        $pdo->prepare("DELETE FROM internships WHERE title = ? AND company_name = ?")->execute([$jobTitle, $username]);
        $pdo->prepare("DELETE FROM job_postings WHERE id = ? AND enterprise_id = ?")->execute([$jobId, $userId]);
        echo "<script>alert('Job deleted successfully.'); window.location.href = '{$_SERVER['PHP_SELF']}';</script>";
        exit;
    }
}

// === Fetch Jobs and Applications ===
$jobs = $pdo->prepare("SELECT * FROM job_postings WHERE enterprise_id = ? ORDER BY created_at DESC");
$jobs->execute([$userId]);
$jobList = $jobs->fetchAll(PDO::FETCH_ASSOC);

$applicationsByJob = [];
foreach ($jobList as $job) {
    $isIntern = $pdo->prepare("SELECT COUNT(*) FROM internships WHERE title = ? AND company_name = ?");
    $isIntern->execute([$job['title'], $username]);
    $isInternFlag = $isIntern->fetchColumn();

    if ($isInternFlag) {
        $stmt = $pdo->prepare("SELECT si.*, u.username, u.email FROM student_internships si 
                               JOIN internships i ON si.internship_id = i.id 
                               JOIN users u ON si.user_id = u.id 
                               WHERE i.title = ? AND i.company_name = ?");
        $stmt->execute([$job['title'], $username]);
        $applicationsByJob[$job['id']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $pdo->prepare("SELECT ja.*, u.username, u.email FROM job_applications ja 
                               JOIN users u ON ja.user_id = u.id 
                               WHERE ja.job_id = ?");
        $stmt->execute([$job['id']]);
        $applicationsByJob[$job['id']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<main class="page-wrapper">
    <section style="max-width: 1100px; margin: auto; padding: 40px 20px; line-height: 1.7;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px;padding:10px;">Hire Talent</h2>

        <div style="text-align: center;">
            <img src="assets/images/hire.png" alt="Enterprise" style="width: 1100px; height: 420px; object-fit: cover; border-radius: 12px; max-width: 100%; padding-bottom: 20px;">
        </div>

        <!-- Job Form -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 40px;">
            <h3 style="color: #003366;">Post a New Job</h3>
            <form id="jobForm" method="POST">
                <input type="hidden" name="confirm_post" value="1">
                <input type="text" name="title" placeholder="Job Title" required style="width: 100%; margin-bottom: 10px; padding: 10px;">
                <textarea name="description" placeholder="Job Description" rows="4" required style="width: 100%; padding: 10px; margin-bottom: 10px;"></textarea>
                <label><input type="checkbox" name="is_internship"> Mark as Internship</label><br><br>
                <button type="button" onclick="openPostConfirm()" style="background: #003366; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Post Job</button>
            </form>
        </div>

        <!-- Job Listings -->
        <?php if (empty($jobList)): ?>
            <p style="text-align: center; color: #777;">You haven't posted any jobs yet.</p>
        <?php else: ?>
            <?php foreach ($jobList as $job): ?>
                <div style="border: 1px solid #ccc; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
                    <h3 style="color: #003366;"><?= htmlspecialchars($job['title']); ?></h3>
                    <p><?= nl2br(htmlspecialchars($job['description'])); ?></p>
                    <small>Status: <strong><?= htmlspecialchars($job['status']); ?></strong> | Posted on <?= date("F j, Y", strtotime($job['created_at'])); ?></small><br>
                    <strong>Applications Received: <?= count($applicationsByJob[$job['id']] ?? []); ?></strong>

                    <div style="margin-top: 15px; border-top: 1px solid #ddd; padding-top: 15px;">
                        <?php foreach ($applicationsByJob[$job['id']] ?? [] as $app): ?>
                            <div style="background: #f1f1f1; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
                                <strong>Applicant:</strong> <?= htmlspecialchars($app['username']); ?><br>
                                <button onclick="viewDetails('<?= htmlspecialchars($app['username'], ENT_QUOTES); ?>', '<?= htmlspecialchars($app['email'], ENT_QUOTES); ?>')" style="margin-top: 10px; background: #003366; color: #fff; padding: 5px 10px; border: none; border-radius: 4px;">View Applicant Info</button>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Delete Button -->
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');" style="margin-top: 10px;">
                        <input type="hidden" name="delete_job_id" value="<?= $job['id']; ?>">
                        <button type="submit" style="background: #dc3545; color: #fff; padding: 8px 16px; border: none; border-radius: 5px;">Delete Job</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<!-- Applicant Info Modal -->
<div id="popupModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000;">
    <div style="background:#fff; padding:30px; border-radius:10px; width:400px;">
        <h3 style="margin-bottom: 15px;">Applicant Information</h3>
        <p><strong>Name:</strong> <span id="modalName"></span></p>
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <button onclick="closeModal()" style="margin-top: 20px; background:#003366; color:#fff; padding: 8px 16px; border: none; border-radius: 5px;">Close</button>
    </div>
</div>

<!-- Post Job Confirmation Modal -->
<div id="postConfirmModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000;">
    <div style="background:#fff; padding:30px; border-radius:10px; width:400px;">
        <h3 style="margin-bottom: 15px;">Confirm Job Posting</h3>
        <p>Are you sure you want to post this job?</p>
        <div style="text-align:right;">
            <button onclick="submitJobForm()" style="background:#28a745; color:#fff; padding: 8px 16px; border:none; border-radius: 5px; margin-right: 10px;">Yes</button>
            <button onclick="closePostConfirm()" style="background:#dc3545; color:#fff; padding: 8px 16px; border:none; border-radius: 5px;">No</button>
        </div>
    </div>
</div>

<script>
function viewDetails(name, email) {
    document.getElementById("modalName").innerText = name;
    document.getElementById("modalEmail").innerText = email;
    document.getElementById("popupModal").style.display = 'flex';
}
function closeModal() {
    document.getElementById("popupModal").style.display = 'none';
}
function openPostConfirm() {
    document.getElementById("postConfirmModal").style.display = 'flex';
}
function closePostConfirm() {
    document.getElementById("postConfirmModal").style.display = 'none';
}
function submitJobForm() {
    document.getElementById("jobForm").submit();
}
</script>

<?php include('../../includes/footer.php'); ?>
