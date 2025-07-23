<?php
session_start();

// Redirect if not logged in or not a startup
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

include('../../includes/db.php');
include('../../includes/startup_header.php');

$userId = $_SESSION['user_id'];
$pageTitle = "Connect with Creators - Growth Grid";

// Handle connect request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['creator_id'])) {
    $creatorId = (int) $_POST['creator_id'];

    // Check if already requested
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM startup_creators WHERE startup_id = ? AND creator_id = ?");
    $checkStmt->execute([$userId, $creatorId]);

    if ($checkStmt->fetchColumn() == 0) {
        $insert = $pdo->prepare("INSERT INTO startup_creators (startup_id, creator_id, status, requested_at) VALUES (?, ?, 'Pending', NOW())");
        $insert->execute([$userId, $creatorId]);
        $successMessage = "Request sent successfully!";
    } else {
        $errorMessage = "You’ve already requested this creator.";
    }
}

// Fetch all creators
$creators = $pdo->query("SELECT * FROM creators ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch already requested creators
$requestedStmt = $pdo->prepare("SELECT creator_id FROM startup_creators WHERE startup_id = ?");
$requestedStmt->execute([$userId]);
$requestedIds = array_column($requestedStmt->fetchAll(PDO::FETCH_ASSOC), 'creator_id');
?>

<main class="page-wrapper">
    <section style="max-width: 1200px; margin: auto; padding: 40px 20px; line-height: 1.7;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px; padding-bottom:10px;">Digital Marketing Creators</h2>

        <div style="text-align: center;">
            <img src="assets/images/creator.webp" alt="Collaboration" style="width: 1100px; height: 420px; border-radius: 12px;">
        </div>
        <?php if (!empty($successMessage)): ?>
            <p style="text-align:center; color: green; font-size: 16px;"><?php echo $successMessage; ?></p>
        <?php elseif (!empty($errorMessage)): ?>
            <p style="text-align:center; color: red; font-size: 16px;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin-top: 30px;">
            <?php foreach ($creators as $creator): ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; width: 280px; background: #fff; box-shadow: 0 0 10px #eee; overflow: hidden; display: flex; flex-direction: column; line-height: 1.6;">
                    <img src="/assets/images/creators/<?php echo htmlspecialchars($creator['profile_picture'] ?? 'default.jpg'); ?>" alt="Profile Picture" style="width: 100%; height: 180px; object-fit: cover;">
                    <div style="padding: 18px; flex-grow: 1;">
                        <h3 style="color: #003366; font-size: 20px; margin-bottom: 8px;"><?php echo htmlspecialchars($creator['name']); ?></h3>
                        <p style="font-size: 14px; margin-bottom: 8px;"><strong>Skills:</strong> <?php echo htmlspecialchars($creator['skills']); ?></p>
                        <p style="font-size: 14px;"><?php echo nl2br(htmlspecialchars($creator['bio'])); ?></p>
                    </div>
                    <div style="padding: 15px; text-align: center;">
                        <?php if (in_array($creator['id'], $requestedIds)): ?>
                            <span style="color: green; font-weight: bold;">Requested</span>
                        <?php else: ?>
                            <form method="POST">
                                <input type="hidden" name="creator_id" value="<?php echo $creator['id']; ?>">
                                <button type="submit" style="background: #003366; color: #fff; padding: 10px 20px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer;">Connect</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
