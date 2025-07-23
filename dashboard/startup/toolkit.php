<?php
session_start();

// Redirect if not logged in or not a startup
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Startup Toolkit - Growth Grid";
include('../../includes/db.php');
include('../../includes/startup_header.php');

// Fetch all toolkit categories
$categoryStmt = $pdo->query("SELECT DISTINCT category FROM toolkit_resources ORDER BY category ASC");
$categories = $categoryStmt->fetchAll(PDO::FETCH_COLUMN);
?>

<main class="page-wrapper">
    <section style="max-width: 1500px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px;">Startup Toolkit</h2>
        <p style="text-align:center; color: #000000ff; padding: 10px 0;">Essential tools and templates to power your startup journey</p>

        <div style="text-align: center;">
            <img src="assets/images/tools.webp" alt="Collaboration" style="width: 1100px; height: 420px; border-radius: 12px;">
        </div>
        <?php foreach ($categories as $category): ?>
            <div style="margin-top: 30px;">
                <h3 onclick="toggleSection('<?php echo md5($category); ?>')" style="text-align: center; cursor: pointer; background: #003366; color: #fff; padding: 10px 15px; border-radius: 5px;">
                    <?php echo htmlspecialchars($category); ?>
                </h3>

                <div id="<?php echo md5($category); ?>" style="display: none; padding: 15px; border: 1px solid #ddd; border-radius: 5px; background: #f9f9f9; margin-top: 10px;">
                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM toolkit_resources WHERE category = ? ORDER BY created_at DESC LIMIT 5");
                        $stmt->execute([$category]);
                        $tools = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php if ($tools): ?>
                        <?php foreach ($tools as $tool): ?>
                            <div style="margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 0 8px #eee;">
                                <h4 style="color: #003366;"><?php echo htmlspecialchars($tool['title']); ?></h4>
                                <p style="font-size: 14px;"><?php echo htmlspecialchars($tool['description']); ?></p>
                                <?php if ($tool['link']): ?>
                                    <a href="<?php echo htmlspecialchars($tool['link']); ?>" target="_blank" style="color: #f0c330;">Visit Resource</a>
                                <?php elseif ($tool['file_path']): ?>
                                    <a href="/uploads/toolkit/<?php echo htmlspecialchars($tool['file_path']); ?>" download style="color: #f0c330;">Download File</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No resources found in this category.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>

<script>
    function toggleSection(id) {
        const el = document.getElementById(id);
        el.style.display = el.style.display === 'none' ? 'block' : 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
