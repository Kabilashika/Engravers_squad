<?php
session_start();

// Redirect if not logged in or not a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Projects - Growth Grid";
include('../../includes/db.php');
include('../../includes/student_header.php');

$userId = $_SESSION['user_id'];

// Handle project start/unsubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['project_id'])) {
    $projectId = (int) $_POST['project_id'];

    if ($_POST['action'] === 'start') {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM student_projects WHERE student_id = ? AND project_id = ?");
        $stmt->execute([$userId, $projectId]);
        $alreadySubmitted = $stmt->fetchColumn();

        if (!$alreadySubmitted) {
            $insert = $pdo->prepare("INSERT INTO student_projects (student_id, project_id, status) VALUES (?, ?, 'In Progress')");
            $insert->execute([$userId, $projectId]);
            echo "<script>alert('Project marked as In Progress!');</script>";
        } else {
            echo "<script>alert('You have already engaged with this project.');</script>";
        }

    } elseif ($_POST['action'] === 'unsubmit') {
        $delete = $pdo->prepare("DELETE FROM student_projects WHERE student_id = ? AND project_id = ?");
        $delete->execute([$userId, $projectId]);
        echo "<script>alert('Project successfully removed.');</script>";
    }
}

// Fetch all projects
$projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch student project status
$studentProjects = $pdo->prepare("SELECT project_id, status FROM student_projects WHERE student_id = ?");
$studentProjects->execute([$userId]);
$projectStatus = [];
foreach ($studentProjects->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $projectStatus[$row['project_id']] = $row['status'];
}
?>


<main class="page-wrapper">
    <section style="max-width: 1000px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px;padding-bottom: 20px;">Available Projects</h2>

<div style="text-align: center;">
            <img src="assets/images/projects.png" alt="Startup" style="width: 1100px; height: 420px; object-fit: cover; border-radius: 12px; max-width: 100%;">
        </div>


        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px;">
            <?php foreach ($projects as $project): ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px; width: 280px; box-shadow: 0 0 10px #eee; background: #fff; display: flex; flex-direction: column; align-items: center;">
                    <h3 style="color: #003366; text-align: center; margin-bottom: 8px;"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p style="font-size: 14px; margin-bottom: 8px; text-align: center;"><?php echo htmlspecialchars($project['description']); ?></p>
                    <p style="font-size: 13px; text-align: center;"><strong>Category:</strong> <?php echo htmlspecialchars($project['category']); ?></p>
                    <p style="font-size: 13px; text-align: center;"><strong>Added on:</strong> <?php echo date('Y-m-d', strtotime($project['created_at'])); ?></p>

                    <?php if (array_key_exists($project['id'], $projectStatus)): ?>
                        <p style="color: green; font-weight: bold; text-align: center;">Status: <?php echo $projectStatus[$project['id']]; ?></p>
                        <button onclick="confirmUnsubmit(<?php echo $project['id']; ?>)" 
                            style="background-color: #d9534f; color: #fff; border-radius: 5px; margin-top: 10px; padding: 8px 16px; cursor: pointer;">
                            Unsubmit
                        </button>
                    <?php else: ?>
                        <button onclick="confirmStart(<?php echo $project['id']; ?>)" 
                            style="background-color: #003366; color: #fff; border-radius: 5px; margin-top: 10px; padding: 8px 16px; cursor: pointer;">
                            Start Project
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Start Confirmation Modal -->
    <div id="startModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center;">
            <h3 style="color:#003366;">Confirm Project Start</h3>
            <p>Do you want to start this project?</p>
            <form method="POST">
                <input type="hidden" name="project_id" id="start_project_id">
                <input type="hidden" name="action" value="start">
                <button type="submit" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;">Yes, Start</button>
                <button type="button" onclick="closeModal('startModal')" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Unsubmit Confirmation Modal -->
    <div id="unsubmitModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center;">
            <h3 style="color:#d9534f;">Confirm Unsubmit</h3>
            <p>Are you sure you want to remove this project?</p>
            <form method="POST">
                <input type="hidden" name="project_id" id="unsubmit_project_id">
                <input type="hidden" name="action" value="unsubmit">
                <button type="submit" style="background:#d9534f; color:#fff; padding:10px 20px; border:none; border-radius:5px;">Yes, Remove</button>
                <button type="button" onclick="closeModal('unsubmitModal')" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmStart(projectId) {
        document.getElementById('start_project_id').value = projectId;
        document.getElementById('startModal').style.display = 'flex';
    }

    function confirmUnsubmit(projectId) {
        document.getElementById('unsubmit_project_id').value = projectId;
        document.getElementById('unsubmitModal').style.display = 'flex';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
