<?php
session_start();

// Redirect if not logged in or not an enterprise
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Enterprise Collaboration Hub - Growth Grid";
include('../../includes/enterprise_header.php');
?>

<main class="page-wrapper">
    <section style="max-width: 1100px; margin: auto; padding: 40px 20px;">

        <!-- Introduction -->
        <h2 style="color: #f0c330; font-size: 30px; text-align: center; margin-top: 40px;">Enterprise Collaboration Hub</h2>
        <p style="text-align: center; color: #000000ff; max-width: 900px; margin: auto; margin-top: 10px; margin-bottom: 10px; font-size: 16px; line-height: 1.6;">
            Empower your enterprise by building strong partnerships. Use our collaboration tools to recruit expert talent, engage with creative professionals, and explore community insights through discussions. Whether you're launching national campaigns or innovating globally, collaboration accelerates your business goals.
        </p>

        <!-- Collaboration Banner -->
        <div style="text-align:center;">
            <img src="assets/images/collaboration.png" alt="Collaboration" style="max-width: 100%; height: auto; border-radius: 12px;">
        </div>

        <!-- Collaboration Tree Map -->
        <div style="display: flex; justify-content: center; align-items: center; margin-top: 60px; gap: 50px; flex-wrap: wrap;">
            <!-- Hire -->
            <a href="/digital_platform/dashboard/enterprise/hire.php" style="text-decoration: none;">
                <div style="width: 160px; height: 160px; background-color: #f0c330; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 15px #ddd; transition: transform 0.2s;">
                    <span style="color: #003366; font-weight: bold; text-align: center;">Hire<br>Experts</span>
                </div>
            </a>
            <!-- Creators -->
            <a href="/digital_platform/dashboard/enterprise/creators.php" style="text-decoration: none;">
                <div style="width: 160px; height: 160px; background-color: #003366; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 15px #ddd; transition: transform 0.2s;">
                    <span style="color: #fff; font-weight: bold; text-align: center;">Collaborate<br>with Creators</span>
                </div>
            </a>
            <!-- Forum -->
            <a href="/digital_platform/dashboard/enterprise/forum.php" style="text-decoration: none;">
                <div style="width: 160px; height: 160px; background-color: #d9534f; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 15px #ddd; transition: transform 0.2s;">
                    <span style="color: #fff; font-weight: bold; text-align: center;">Engage<br>in Forums</span>
                </div>
            </a>
        </div>

        <!-- Tips Section -->
        <div style="margin-top: 60px; text-align: center;">
            <h3 style="color: #003366;">Why Collaborate as an Enterprise?</h3>
            <ul style="list-style: disc; padding-left: 40px; text-align: left; max-width: 800px; margin: 10px; color: #000000ff; font-size: 16px; line-height: 1.6;">
                <li><strong>Hire Professionals:</strong> Gain access to a vetted pool of specialists ready to execute your marketing and tech initiatives.</li>
                <li><strong>Engage with Creators:</strong> Team up with influencers and designers to amplify your brand story across platforms.</li>
                <li><strong>Forum Collaboration:</strong> Share strategic insights, learn industry trends, and solve enterprise-scale challenges through peer exchange.</li>
            </ul>
        </div>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
