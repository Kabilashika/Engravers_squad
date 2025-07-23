<?php
session_start();

// Redirect if not logged in or not an enterprise
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Advisors - Growth Grid";
include('../../includes/db.php');
include('../../includes/enterprise_header.php');

$userId = $_SESSION['user_id'];

// Handle connect/disconnect
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['advisor_id'])) {
    $advisorId = (int) $_POST['advisor_id'];

    if ($_POST['action'] === 'connect') {
        $check = $pdo->prepare("SELECT COUNT(*) FROM enterprise_advisors WHERE enterprise_id = ? AND advisor_id = ?");
        $check->execute([$userId, $advisorId]);
        $alreadyConnected = $check->fetchColumn();

        if (!$alreadyConnected) {
            $connect = $pdo->prepare("INSERT INTO enterprise_advisors (enterprise_id, advisor_id) VALUES (?, ?)");
            $connect->execute([$userId, $advisorId]);
            echo "<script>alert('Successfully connected with the advisor!');</script>";
        } else {
            echo "<script>alert('You are already connected with this advisor.');</script>";
        }
    } elseif ($_POST['action'] === 'disconnect') {
        $delete = $pdo->prepare("DELETE FROM enterprise_advisors WHERE enterprise_id = ? AND advisor_id = ?");
        $delete->execute([$userId, $advisorId]);
        echo "<script>alert('Connection removed successfully.');</script>";
    }
}

// Fetch advisors
$advisors = $pdo->query("SELECT * FROM advisors ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Connected advisor IDs
$stmt = $pdo->prepare("SELECT advisor_id FROM enterprise_advisors WHERE enterprise_id = ?");
$stmt->execute([$userId]);
$connectedAdvisors = array_column($stmt->fetchAll(), 'advisor_id');
?>

<main class="page-wrapper">
    <section style="max-width: 1000px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center;  color: #f0c330; font-size: 30px; padding:10px;">Meet Your Advisors</h2>
        
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px;">
            <?php foreach ($advisors as $advisor): ?>
                <?php
                    $imgPath = !empty($advisor['profile_picture']) 
                        ? '/digital_platform/uploads/advisor_profiles/' . $advisor['profile_picture'] 
                        : '/digital_platform/assets/images/default_profile.png';
                ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px; width: 260px; box-shadow: 0 0 10px #eee; background: #fff; text-align: center;">
                    <img src="<?php echo $imgPath; ?>" alt="Advisor Picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    <h3 style="color: #003366; margin-top: 10px;"><?php echo htmlspecialchars($advisor['name']); ?></h3>
                    <p style="font-size: 14px; margin: 5px 0;"><strong>Expertise:</strong> <?php echo htmlspecialchars($advisor['expertise']); ?></p>
                    <p style="font-size: 13px; color: #555;"><?php echo htmlspecialchars($advisor['email']); ?></p>

                    <?php if (in_array($advisor['id'], $connectedAdvisors)): ?>
                        <button onclick="confirmDisconnect(<?php echo $advisor['id']; ?>)" 
                                style="color: #fff; background-color: #d9534f; border-radius: 5px; margin-top: 10px; padding: 8px 16px;">Disconnect</button>
                    <?php else: ?>
                        <button onclick="confirmConnect(<?php echo $advisor['id']; ?>)" 
                                style="color: #fff; background-color: #003366; border-radius: 5px; margin-top: 10px; padding: 8px 16px;">Connect</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Confirmation Modal -->
    <div id="advisorModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center;">
            <h3 id="modalTitle" style="color:#003366;">Confirm Action</h3>
            <p id="modalMessage">Do you want to connect with this advisor?</p>
            <form method="POST">
                <input type="hidden" name="advisor_id" id="advisor_id_input">
                <input type="hidden" name="action" id="action_input">
                <button type="submit" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;" id="confirmButton">Yes</button>
                <button type="button" onclick="closeAdvisorModal()" style="margin-left: 10px; padding:10px 20px; background:#ccc; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmConnect(advisorId) {
        document.getElementById('advisor_id_input').value = advisorId;
        document.getElementById('action_input').value = 'connect';
        document.getElementById('modalTitle').innerText = 'Connect Advisor';
        document.getElementById('modalMessage').innerText = 'Are you sure you want to connect with this advisor?';
        document.getElementById('confirmButton').style.background = '#003366';
        document.getElementById('advisorModal').style.display = 'flex';
    }

    function confirmDisconnect(advisorId) {
        document.getElementById('advisor_id_input').value = advisorId;
        document.getElementById('action_input').value = 'disconnect';
        document.getElementById('modalTitle').innerText = 'Disconnect Advisor';
        document.getElementById('modalMessage').innerText = 'Are you sure you want to disconnect from this advisor?';
        document.getElementById('confirmButton').style.background = '#d9534f';
        document.getElementById('advisorModal').style.display = 'flex';
    }

    function closeAdvisorModal() {
        document.getElementById('advisorModal').style.display = 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
