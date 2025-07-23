<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

include('../../includes/db.php');
include('../../includes/startup_header.php');

$userId = $_SESSION['user_id'];
$pageTitle = "Startup Forum - Growth Grid";

// Handle new post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_post'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO startup_forum_posts (startup_id, title, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$userId, $title, $content]);
    }
}

// Handle new comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_comment'])) {
    $postId = (int)$_POST['post_id'];
    $comment = trim($_POST['comment']);

    if ($comment) {
        $stmt = $pdo->prepare("INSERT INTO startup_forum_comments (post_id, startup_id, comment, commented_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$postId, $userId, $comment]);
    }
}

// Fetch posts
$posts = $pdo->query("
    SELECT p.*, u.username 
    FROM startup_forum_posts p
    JOIN users u ON p.startup_id = u.id
    ORDER BY p.created_at DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Fetch comments
$comments = $pdo->query("
    SELECT c.*, u.username 
    FROM startup_forum_comments c
    JOIN users u ON c.startup_id = u.id
    ORDER BY c.commented_at ASC
")->fetchAll(PDO::FETCH_ASSOC);

$commentsByPost = [];
foreach ($comments as $c) {
    $commentsByPost[$c['post_id']][] = $c;
}
?>

<main class="page-wrapper">
    <section style="max-width: 1000px; margin: auto; padding: 40px 20px; line-height: 1.6;">

        <h2 style="text-align: center; color: #f0c330;">Startup Forum</h2>

        <!-- Post Form -->
        <div style="margin-bottom: 40px; background: #f4f4f4; padding: 20px; border-radius: 10px;">
            <h3 style="color: #003366;">Join the Forum: Create a New Post</h3>
            <form method="POST">
                <input type="hidden" name="new_post" value="1">
                <input type="text" name="title" placeholder="Post Title" required style="width: 100%; margin-bottom: 10px; padding: 10px; border-radius: 6px;">
                <textarea name="content" placeholder="Share your thoughts..." rows="4" required style="width: 100%; padding: 10px; border-radius: 6px;"></textarea>
                <button type="submit" style="margin-top: 10px; background: #003366; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">Publish Post</button>
            </form>
        </div>

        <?php if (empty($posts)): ?>
            <p style="text-align: center; color: #000000ff;">No forum posts available.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div style="background: #f9f9f9; border-radius: 10px; padding: 20px; margin-bottom: 30px; border: 1px solid #ccc;">
                    <h3 style="color: #003366;"><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                    <small>Posted by <strong><?php echo htmlspecialchars($post['username']); ?></strong> on <?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></small>

                    <!-- Comments -->
                    <div style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 10px;">
                        <h4 style="color: #003366;">Comments</h4>

                        <?php if (!empty($commentsByPost[$post['id']])): ?>
                            <?php foreach ($commentsByPost[$post['id']] as $comment): ?>
                                <div style="background: #fff; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
                                    <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                                    <p style="margin: 5px 0;"><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                    <small><?php echo date("F j, Y, g:i a", strtotime($comment['commented_at'])); ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color: #777;">No comments yet.</p>
                        <?php endif; ?>

                        <!-- Add Comment -->
                        <form method="POST" style="margin-top: 15px;">
                            <input type="hidden" name="new_comment" value="1">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <textarea name="comment" placeholder="Write a comment..." rows="3" required style="width: 100%; padding: 10px; border-radius: 6px;"></textarea>
                            <button type="submit" style="margin-top: 8px; background: #003366; color: white; padding: 8px 16px; border: none; border-radius: 5px;">Comment</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
