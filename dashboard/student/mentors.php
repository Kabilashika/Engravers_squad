<?php
session_start();

// Redirect if not logged in or not a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Mentors - Growth Grid";
include('../../includes/db.php');
include('../../includes/student_header.php');

$userId = $_SESSION['user_id'];

// Handle connection/disconnection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['mentor_id'])) {
    $mentorId = (int) $_POST['mentor_id'];

    if ($_POST['action'] === 'connect') {
        $check = $pdo->prepare("SELECT COUNT(*) FROM student_mentors WHERE user_id = ? AND mentor_id = ?");
        $check->execute([$userId, $mentorId]);
        $alreadyConnected = $check->fetchColumn();

        if (!$alreadyConnected) {
            $connect = $pdo->prepare("INSERT INTO student_mentors (user_id, mentor_id) VALUES (?, ?)");
            $connect->execute([$userId, $mentorId]);
            echo "<script>alert('Successfully connected with the mentor!');</script>";
        } else {
            echo "<script>alert('You are already connected with this mentor.');</script>";
        }
    } elseif ($_POST['action'] === 'disconnect') {
        $delete = $pdo->prepare("DELETE FROM student_mentors WHERE user_id = ? AND mentor_id = ?");
        $delete->execute([$userId, $mentorId]);
        echo "<script>alert('Connection removed successfully.');</script>";
    }
}

// Fetch mentors
$mentors = $pdo->query("SELECT * FROM mentors ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Connected mentor IDs
$stmt = $pdo->prepare("SELECT mentor_id FROM student_mentors WHERE user_id = ?");
$stmt->execute([$userId]);
$connectedMentors = array_column($stmt->fetchAll(), 'mentor_id');
?>

<main class="page-wrapper">
    <section style="max-width: 1000px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px;">Meet Your Mentors</h2>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px;">
            <?php foreach ($mentors as $mentor): ?>
                <?php
                    $imgPath = !empty($mentor['profile_picture']) 
                        ? '/digital_platform/uploads/mentor_profiles/' . $mentor['profile_picture'] 
                        : '/digital_platform/assets/images/default_profile.png';
                ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px; width: 260px; box-shadow: 0 0 10px #eee; background: #fff; text-align: center;">
                    <img src="<?php echo $imgPath; ?>" alt="Mentor Picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    <h3 style="color: #003366; margin-top: 10px;"><?php echo htmlspecialchars($mentor['name']); ?></h3>
                    <p style="font-size: 14px; margin: 5px 0;"><strong>Expertise:</strong> <?php echo htmlspecialchars($mentor['expertise']); ?></p>
                    <p style="font-size: 13px; color: #555;"><?php echo htmlspecialchars($mentor['email']); ?></p>

                    <?php if (in_array($mentor['id'], $connectedMentors)): ?>
                        <button onclick="confirmDisconnect(<?php echo $mentor['id']; ?>)" 
                                style="color: #fff; background-color: #d9534f; border-radius: 5px; margin-top: 10px; padding: 8px 16px;">Disconnect</button>
                    <?php else: ?>
                        <button onclick="confirmConnect(<?php echo $mentor['id']; ?>)" 
                                style="color: #fff; background-color: #003366; border-radius: 5px; margin-top: 10px; padding: 8px 16px;">Connect</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Confirmation Modals -->
    <div id="mentorModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center;">
            <h3 id="modalTitle" style="color:#003366;">Confirm Action</h3>
            <p id="modalMessage">Do you want to connect with this mentor?</p>
            <form method="POST">
                <input type="hidden" name="mentor_id" id="mentor_id_input">
                <input type="hidden" name="action" id="action_input">
                <button type="submit" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;" id="confirmButton">Yes</button>
                <button type="button" onclick="closeMentorModal()" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmConnect(mentorId) {
        document.getElementById('mentor_id_input').value = mentorId;
        document.getElementById('action_input').value = 'connect';
        document.getElementById('modalTitle').innerText = 'Connect Mentor';
        document.getElementById('modalMessage').innerText = 'Are you sure you want to connect with this mentor?';
        document.getElementById('confirmButton').style.background = '#003366';
        document.getElementById('mentorModal').style.display = 'flex';
    }

    function confirmDisconnect(mentorId) {
        document.getElementById('mentor_id_input').value = mentorId;
        document.getElementById('action_input').value = 'disconnect';
        document.getElementById('modalTitle').innerText = 'Disconnect Mentor';
        document.getElementById('modalMessage').innerText = 'Are you sure you want to disconnect from this mentor?';
        document.getElementById('confirmButton').style.background = '#d9534f';
        document.getElementById('mentorModal').style.display = 'flex';
    }

    function closeMentorModal() {
        document.getElementById('mentorModal').style.display = 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
