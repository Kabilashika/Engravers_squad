<?php
$pageTitle = "Our Services - Growth Grid";
include('includes/header.php');
?>

<main class="page-wrapper">

    <!-- Intro Section -->
    <section style="text-align:center; padding: 40px 20px;">
        <h1 style="color: #f0c330; font-size: 30px;">Our Services</h1>
        <p style="max-width: 800px; margin: 20px auto; font-size: 18px;">
            Growth Grid offers a powerful suite of services designed to empower learners, support startups, and scale enterprises in the digital marketing world.
        </p>
    </section>

    <!-- Services for Students -->
    <section style="background-color: #f1f9ff; padding: 40px 20px; border-radius: 10px; margin: 30px auto; max-width: 1200px;">
        <img src="assets/images/student.jpeg" alt="Student Services" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 30px;">
        <h2 style="color: #003366; text-align: center; margin-bottom: 30px;">Services for Students</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">
            <?php
            $studentServices = [
                ["Structured Learning Paths", "Step-by-step digital marketing courses including SEO, Social Media, and Analytics."],
                ["AI-Based Skill Recommendations", "Receive custom learning suggestions based on your interests and goals."],
                ["Practice Projects", "Get hands-on experience with real-world projects and receive feedback."],
                ["Portfolio Builder", "Create a digital profile with your achievements and completed projects."],
                ["Internship Matching", "Get matched with startups for internships and freelance gigs."]
            ];
            foreach ($studentServices as $service) {
                echo "
                <div style='flex: 1 1 250px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;'>
                    <h3 style='font-size: 22px; color: #003366;'>{$service[0]}</h3>
                    <p style='margin-top: 10px;'>{$service[1]}</p>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- Services for Startups -->
    <section style="background-color: #f1f9ff; padding: 40px 20px; border-radius: 10px; margin: 30px auto; max-width: 1200px;">
        <img src="assets/images/digital2.webp" alt="Startup Services" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 30px;">
        <h2 style="color: #f0c330; text-align: center; margin-bottom: 30px;">Services for Startups</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">
            <?php
            $startupServices = [
                ["Freelancer Matchmaking", "Find affordable digital marketing help from rising talent."],
                ["Marketing Plan Generator", "Use our AI tool to generate custom strategies for your startup."],
                ["Low-Cost Digital Services", "Order social media kits, branding designs, and more."],
                ["Basic Analytics Dashboard", "Track and measure your campaign impact."]
            ];
            foreach ($startupServices as $service) {
                echo "
                <div style='flex: 1 1 250px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;'>
                    <h3 style='font-size: 22px; color: #f0c330;'>{$service[0]}</h3>
                    <p style='margin-top: 10px;'>{$service[1]}</p>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- Services for Enterprises -->
    <section style="background-color: #f1f9ff; padding: 40px 20px; border-radius: 10px; margin: 30px auto; max-width: 1200px;">
        <img src="assets/images/enterprise.webp" alt="Enterprise Services" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 30px;">
        <h2 style="color: #003366; text-align: center; margin-bottom: 30px;">Services for Enterprises</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">
            <?php
            $enterpriseServices = [
                ["Strategy Consulting", "Access top-tier marketing advisors for audit and guidance."],
                ["Service Marketplace", "Hire freelancers and agencies directly from our platform."],
                ["Workshops & Trainings", "On-demand team workshops on marketing and AI tools."],
                ["Advanced Reports", "Get in-depth marketing insights with monthly reporting."]
            ];
            foreach ($enterpriseServices as $service) {
                echo "
                <div style='flex: 1 1 250px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc;'>
                    <h3 style='font-size: 22px; color: #003366;'>{$service[0]}</h3>
                    <p style='margin-top: 10px;'>{$service[1]}</p>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- Call to Action -->
    <section style="text-align: center; margin: 60px auto;">
        <h3 style="color: #003366;">Ready to start your growth journey?</h3>
        <a href="register.php" style="margin-top: 20px; display: inline-block; background: #003366; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none;">Get Started</a>
    </section>

</main>

<?php include('includes/footer.php'); ?>
