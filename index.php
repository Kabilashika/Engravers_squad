<?php
$pageTitle = "Home - Growth Grid";
include('includes/header.php');
?>

<!-- SECTION 1: Banner and Welcome Text -->
<!-- SECTION 1: Banner and Welcome Text (Overlay Style) -->
<section class="banner-section" style="position: relative; height: 500px; overflow: hidden; border-radius: 10px; margin-bottom: 30px;">
    <!-- Background Image -->
    <img src="assets/images/digital1.jpg" alt="Digital Marketing Banner"
         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1;">

    <!-- Overlay Content -->
    <div style="
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
        padding: 60px 20px;
        max-width: 900px;
        margin: auto;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.69);
        border-radius: 15px;
    ">
        <h1 style="font-size: 40px;">Welcome to <span style="color: #f0c330;">Growth Grid</span></h1>
        <p style="font-size: 18px; margin-top: 15px;">
            Your one-stop platform to <strong>learn</strong>, <strong>collaborate</strong>, and <strong>thrive</strong> in the world of digital marketing.
        </p>

        <h2 style="margin-top: 30px;">Who we are?</h2>
        <p style="margin-top: 10px;">
            Growth Grid is designed to empower aspiring marketers, startups, and enterprises with tools, talent, and training.
            From structured learning paths to strategic marketing services, we help you unlock growth at every stage.
        </p>
    </div>
</section>


<!-- SECTION 2: User Role Boxes -->
<section style="padding: 40px 20px; background-color: #f5f8fc; border-radius: 10px";>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; max-width: 1100px; margin: auto;">
        <!-- Student Box -->
        <a href="dashboard/learning.php" style="flex: 1 1 250px; text-decoration: none;">
            <div style="background-color: #e3f2fd; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
                <h3 style="color: #003366;text-align: center;">Students</h3>
                <p>Follow expert-led digital marketing paths, gain hands-on skills, and prepare for real-world projects or freelancing.</p>
            </div>
        </a>

        <!-- Startup Box -->
        <a href="dashboard/matchmaking.php" style="flex: 1 1 250px; text-decoration: none;">
            <div style="background-color: #fff3e05a; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
                <h3 style="color:#f0c330; text-align: center;"> Startups</h3>
                <p>Connect with upcoming marketers and affordable digital service providers to elevate your brand presence.</p>
            </div>
        </a>

        <!-- Enterprise Box -->
        <a href="dashboard/marketplace.php" style="flex: 1 1 250px; text-decoration: none;">
            <div style="background-color: #e3f2fd; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
                <h3 style="color: #003366; text-align: center;"> Enterprises</h3>
                <p>Access a curated marketplace of digital solutions, industry experts, and growth analytics tailored to your scale.</p>
            </div>
        </a>
    </div>

    <!-- CTA Buttons -->
    <div style="margin-top: 40px; text-align: center;">
        <a href="login.php" class="cta-button" style="background-color: #003366; color: white; padding: 12px 24px; margin: 10px; display: inline-block; border-radius: 5px; text-decoration: none;">Login</a>
        <a href="register.php" class="cta-button" style="background-color: #f0c330; color: white; padding: 12px 24px; margin: 10px; display: inline-block; border-radius: 5px; text-decoration: none;">Get Started</a>
    </div>
</section>

<!-- SECTION 3: Statistics Dashboard -->
<section class="stats-dashboard" style="margin-top: 60px; margin-bottom: 50px; background-color: #ffffffd9; padding: 40px 20px; border-radius: 10px;">
    <h2 style="color: #f0c330; text-align: center; margin-bottom: 30px;">Our Growth Impact</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; max-width: 1000px; margin: auto;">
        <div class="stat-box">
            <h3 id="years">0+</h3>
            <p>Years of Experience</p>
        </div>
        <div class="stat-box">
            <h3 id="awards">0</h3>
            <p>Award Wins</p>
        </div>
        <div class="stat-box">
            <h3 id="clients">0+</h3>
            <p>Clients Worldwide</p>
        </div>
        <div class="stat-box">
            <h3 id="projects">0</h3>
            <p>Projects Completed</p>
        </div>
        <div class="stat-box">
            <h3 id="students">0+</h3>
            <p>Students Enrolled</p>
        </div>
    </div>
</section>

<!-- Stats Script -->
<script>
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerText = Math.floor(progress * (end - start) + start) + (id !== "awards" && id !== "projects" ? "+" : "");
            if (progress < 1) window.requestAnimationFrame(step);
        };
        window.requestAnimationFrame(step);
    }

    animateValue("years", 0, 8, 1500);
    animateValue("awards", 0, 12, 1300);
    animateValue("clients", 0, 120, 1800);
    animateValue("projects", 0, 250, 2000);
    animateValue("students", 0, 450, 2000);
</script>

<?php include('includes/footer.php'); ?>
