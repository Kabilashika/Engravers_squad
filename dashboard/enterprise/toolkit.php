<?php
session_start();

// Redirect if not logged in or not an enterprise
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Enterprise Toolkit - Growth Grid";
include('../../includes/db.php');
include('../../includes/enterprise_header.php');

// Fetch all toolkit categories
$categoryStmt = $pdo->query("SELECT DISTINCT category FROM enterprise_toolkit ORDER BY category ASC");
$categories = $categoryStmt->fetchAll(PDO::FETCH_COLUMN);
?>

<main class="page-wrapper">
    <section style="max-width: 1500px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px;">Enterprise Toolkit</h2>
        <p style="text-align:center; color: #000000ff; padding: 10px 0;">Essential tools and templates to power your enterprise journey</p>

        <div style="text-align: center;">
            <img src="assets/images/tools.webp" alt="Enterprise Toolkit" style="width: 1100px; height: 420px; border-radius: 12px; max-width: 100%;">
        </div>

        <?php foreach ($categories as $category): ?>
            <div style="margin-top: 30px;">
                <h3 onclick="toggleSection('<?php echo md5($category); ?>')" style="text-align: center; cursor: pointer; background: #003366; color: #fff; padding: 10px 15px; border-radius: 5px;">
                    <?php echo htmlspecialchars($category); ?>
                </h3>

                <div id="<?php echo md5($category); ?>" style="display: none; padding: 15px; border: 1px solid #ddd; border-radius: 5px; background: #f9f9f9; margin-top: 10px;">
                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM enterprise_toolkit WHERE category = ? ORDER BY created_at DESC LIMIT 5");
                        $stmt->execute([$category]);
                        $tools = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php if ($tools): ?>
                        <?php foreach ($tools as $tool): ?>
                            <div style="margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 0 8px #eee;">
                                <h4 style="color: #003366;"><?php echo htmlspecialchars($tool['title']); ?></h4>
                                <p style="font-size: 14px; line-height: 1.6;"><?php echo htmlspecialchars($tool['description']); ?></p>
                                <?php if (!empty($tool['tool_url'])): ?>
                                    <a href="<?php echo htmlspecialchars($tool['tool_url']); ?>" target="_blank" style="color: #f0c330;">Visit Resource</a>
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
