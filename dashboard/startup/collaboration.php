<?php
session_start();

// Redirect if not logged in or not a startup
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Collaboration Hub - Growth Grid";
include('../../includes/startup_header.php');
?>

<main class="page-wrapper">
    <section style="max-width: 1100px; margin: auto; padding: 40px 20px;">

        <!-- Introduction -->
        <h2 style="color: #f0c330; font-size: 30px; text-align: center; margin-top: 40px;">Startup Collaboration Hub</h2>
        <p style="text-align: center; color: #000000ff; max-width: 900px; margin: auto; margin-top: 10px; margin-bottom: 10px; font-size: 16px; line-height: 1.6;">
            Great businesses are built on great partnerships. Use our collaboration tools to connect with talented freelancers, innovative content creators, and active discussion forums to accelerate your growth. Whether you're building a product, launching a campaign, or scaling your brand, collaboration fuels innovation.
        </p>

        <!-- Collaboration Banner -->
        <div style="text-align:center;">
            <img src="assets/images/collaboration.png" alt="Collaboration" style="max-width: 100%; height: auto; border-radius: 12px;">
        </div>

        <!-- Collaboration Tree Map -->
        
<div style="display: flex; justify-content: center; align-items: center; margin-top: 60px; gap: 50px; flex-wrap: wrap;">
    <!-- Hire -->
    <a href="/digital_platform/dashboard/startup/hire.php" style="text-decoration: none;">
        <div style="width: 160px; height: 160px; background-color: #f0c330; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 15px #ddd; transition: transform 0.2s;">
            <span style="color: #003366; font-weight: bold; text-align: center;">Hire<br>Talent</span>
        </div>
    </a>
    <!-- Creators -->
    <a href="/digital_platform/dashboard/startup/creators.php" style="text-decoration: none;">
        <div style="width: 160px; height: 160px; background-color: #003366; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 15px #ddd; transition: transform 0.2s;">
            <span style="color: #fff; font-weight: bold; text-align: center;">Connect<br>with Creators</span>
        </div>
    </a>
    <!-- Forum -->
    <a href="/digital_platform/dashboard/startup/forum.php" style="text-decoration: none;">
        <div style="width: 160px; height: 160px; background-color: #d9534f; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 15px #ddd; transition: transform 0.2s;">
            <span style="color: #fff; font-weight: bold; text-align: center;">Join<br>Discussions</span>
        </div>
    </a>
</div>

        <!-- Tips Section -->
        <div style="margin-top: 60px; text-align: center;">
            <h3 style="color: #003366;">Why Collaborate?</h3>
            <ul style="list-style: disc; padding-left: 40px; text-align: left; max-width: 800px; margin: 10px; color: #000000ff; font-size: 16px; line-height: 1.6;">
                <li><strong>Hire Freelancers:</strong> Access a pool of skilled individuals to help you build, market, and manage your startup.</li>
                <li><strong>Work with Creators:</strong> Partner with influencers and designers to boost your brand visibility and reach.</li>
                <li><strong>Join Discussions:</strong> Get advice, share experiences, and learn from the startup community.</li>
            </ul>
        </div>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
