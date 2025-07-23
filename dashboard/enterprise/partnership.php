<?php
session_start();

// Redirect if not logged in or not an enterprise
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Partnership Opportunities - Growth Grid";
include('../../includes/db.php');
include('../../includes/enterprise_header.php');

$enterpriseId = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch users by role
$startups = $pdo->query("SELECT id, username, email FROM users WHERE role = 'startup' ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$enterprises = $pdo->query("SELECT id, username, email FROM users WHERE role = 'enterprise' AND id != $enterpriseId ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$students = $pdo->query("SELECT id, username, email FROM users WHERE role = 'student' ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="page-wrapper">
    <section style="max-width: 1100px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center;  margin-bottom: 30px;color: #f0c330; font-size: 30px; padding:10px;">Find Partners for Growth</h2>

        <!-- STARTUPS -->
        <h3 style="color:#003366; text-align:center;padding-bottom:20px;">Partnership with Startups</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; margin-bottom: 40px;">
            <?php foreach ($startups as $startup): ?>
                <div style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; width: 280px; box-shadow: 0 0 10px #eee; background: #fff;">
                    <h4 style="color: #003366;"><?php echo htmlspecialchars($startup['username']); ?></h4>
                    <p>Email: <?php echo htmlspecialchars($startup['email']); ?></p>
                    <button 
                        onclick="openEmailModal('<?php echo $startup['email']; ?>', '<?php echo htmlspecialchars($startup['username']); ?>')" 
                        style="margin-top: 10px; background: #f0c330; color: #fff; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer;">
                        Request Partnership
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- ENTERPRISES -->
        <h3 style="color:#003366; text-align:center;padding-bottom:20px;">Partnership with Enterprises</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; margin-bottom: 40px;">
            <?php foreach ($enterprises as $ent): ?>
                <div style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; width: 280px; box-shadow: 0 0 10px #eee; background: #fff;">
                    <h4 style="color: #003366;"><?php echo htmlspecialchars($ent['username']); ?></h4>
                    <p>Email: <?php echo htmlspecialchars($ent['email']); ?></p>
                    <button 
                        onclick="openEmailModal('<?php echo $ent['email']; ?>', '<?php echo htmlspecialchars($ent['username']); ?>')" 
                        style="margin-top: 10px; background: #f0c330; color: #003366; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer;">
                        Request Partnership
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- STUDENTS -->
        <h3 style="color:#003366; text-align:center; padding-bottom:20px;">Partnership with Students</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">
            <?php foreach ($students as $student): ?>
                <div style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; width: 280px; box-shadow: 0 0 10px #eee; background: #fff;">
                    <h4 style="color: #003366;"><?php echo htmlspecialchars($student['username']); ?></h4>
                    <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
                    <button 
                        onclick="openEmailModal('<?php echo $student['email']; ?>', '<?php echo htmlspecialchars($student['username']); ?>')" 
                        style="margin-top: 10px; background: #f0c330; color: #003366; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer;">
                        Request Partnership
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<!-- Custom Modal -->
<div id="emailModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000;">
    <div style="background:#fff; padding:30px; border-radius:8px; width: 450px; line-height:1.6; box-shadow: 0 0 15px #000;">
        <h3 style="color:#003366; margin-bottom: 15px;">Confirm Partnership Email</h3>
        <p id="emailMessage" style="margin-bottom: 20px;"></p>
        <div style="text-align: right;">
            <button onclick="sendEmail()" style="background:#003366; color:#ccc; padding:10px 20px; border:none; border-radius:5px;">Send Email</button>
            <button onclick="closeEmailModal()" style="margin-left: 10px; background:#ccc; padding:10px 20px; border:none; border-radius:5px;">Cancel</button>
        </div>
    </div>
</div>

<script>
let selectedEmail = "";
let selectedUsername = "";

function openEmailModal(email, username) {
    selectedEmail = email;
    selectedUsername = username;
    document.getElementById('emailMessage').textContent = `Are you sure you want to send a partnership request to ${username}?`;
    document.getElementById('emailModal').style.display = 'flex';
}

function closeEmailModal() {
    document.getElementById('emailModal').style.display = 'none';
}

function sendEmail() {
    const subject = encodeURIComponent("Partnership Opportunity from Growth Grid");
    const body = encodeURIComponent(`Dear ${selectedUsername},\n\nI am reaching out from Growth Grid as an enterprise interested in a potential partnership. Let's explore collaboration opportunities!\n\nBest regards,\n<?php echo $username; ?>`);
    window.location.href = `mailto:${selectedEmail}?subject=${subject}&body=${body}`;
    closeEmailModal();
}
</script>

<?php include('../../includes/footer.php'); ?>
