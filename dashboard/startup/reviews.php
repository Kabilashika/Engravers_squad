<?php
session_start();

// Redirect if not logged in or not a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Student Reviews - Growth Grid";
include('../../includes/db.php');
include('../../includes/startup_header.php');

$userId = $_SESSION['user_id'];
$message = "";

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'], $_POST['rating'], $_POST['confirmed'])) {
    $content = trim($_POST['content']);
    $rating = (int) $_POST['rating'];

    if ($content && $rating >= 1 && $rating <= 5) {
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, content, rating, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$userId, $content, $rating]);
        $message = "<p style='color: green; text-align:center;'>Review submitted successfully!</p>";
    } else {
        $message = "<p style='color: red; text-align:center;'>Please enter valid content and rating.</p>";
    }
}

// Fetch all reviews
$reviewStmt = $pdo->query("
    SELECT r.content, r.rating, r.created_at, u.username 
    FROM reviews r 
    JOIN users u ON r.user_id = u.id 
    ORDER BY r.created_at DESC
");
$allReviews = $reviewStmt->fetchAll(PDO::FETCH_ASSOC);

// Star rendering
function renderStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= $i <= $rating ? '<span style="color: #f0c330;">★</span>' : '<span style="color: #ccc;">☆</span>';
    }
    return $stars;
}
?>

<main class="page-wrapper">
    <section style="max-width: 950px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center; color: #f0c330;">Share Your Experience</h2>

        <?php echo $message; ?>

        <!-- Review Form -->
        <form id="reviewForm" method="POST" style="margin-top: 20px; background: #fff8e1; padding: 25px; border-radius: 10px;">
            <label for="content"><strong>Your Review:</strong></label><br>
            <textarea name="content" id="content" rows="4" required style="width: 100%; padding: 10px; border-radius: 6px;"></textarea><br><br>

            <label for="rating"><strong>Rating:</strong></label>
            <select name="rating" id="rating" required style="margin-left: 10px; padding: 6px 12px;">
                <option value="">--Select--</option>
                <option value="5">★★★★★ - Excellent</option>
                <option value="4">★★★★☆ - Good</option>
                <option value="3">★★★☆☆ - Average</option>
                <option value="2">★★☆☆☆ - Below Average</option>
                <option value="1">★☆☆☆☆ - Poor</option>
            </select><br><br>

            <input type="hidden" name="confirmed" value="1">
            <button type="button" onclick="confirmReview()" style="background-color: #003366; color: white; padding: 10px 20px; border-radius: 5px;">Submit Review</button>
        </form>

        <!-- Confirmation Modal -->
        <div id="confirmModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
            <div style="background:#fff; padding:30px; border-radius:8px; width: 360px; text-align: center;">
                <h3 style="color:#003366;">Confirm Review Submission</h3>
                <p>Are you sure you want to submit this review?</p>
                <button onclick="submitReview()" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;">Yes, Submit</button>
                <button onclick="closeModal()" style="margin-left: 10px; background:#ccc; padding:10px 20px; border:none; border-radius:5px;">Cancel</button>
            </div>
        </div>

        <!-- Review Display -->
        <h3 style="margin-top: 50px; text-align:center; color: #003366;">All Reviews</h3>
        <?php if (empty($allReviews)): ?>
            <p style="text-align:center; color: #777;">No reviews yet.</p>
        <?php else: ?>
            <div style="margin-top: 25px;">
                <?php foreach ($allReviews as $review): ?>
                    <div style="background: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 0 10px #eee;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <strong><?php echo htmlspecialchars($review['username']); ?></strong>
                                <span style="margin-left: 10px;"><?php echo renderStars($review['rating']); ?></span>
                            </div>
                            <div style="font-size: 13px; color: #555;"><?php echo date('F j, Y', strtotime($review['created_at'])); ?></div>
                        </div>
                        <p style="margin-top: 10px;"><?php echo nl2br(htmlspecialchars($review['content'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    function confirmReview() {
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    function submitReview() {
        document.getElementById('reviewForm').submit();
    }
</script>

<?php include('../../includes/footer.php'); ?>
