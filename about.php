<?php
$pageTitle = "About Us - Growth Grid";
include('includes/header.php');
?>

<div class="page-wrapper">
<main>
    <section class="about" style="padding: 40px 20px;">
        <div style="
            background-color: #f1f9ff;
            padding: 30px;
            max-width: 1000px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        ">

            <h2 style="text-align:center;">Welcome to Growth Grid!</h2>
            <img src="assets/images/logo.jpg" alt="Growth Grid Logo" class="about-image" style="max-width: 200px; display: block; margin: 20px auto; border-radius: 10px;">

            <!-- Section Switcher Buttons -->
            <div class="about-buttons" style="text-align:center; margin-bottom: 20px;">
                <button onclick="showSection('history')">Our History</button>
                <button onclick="showSection('vision')">Our Vision</button>
                <button onclick="showSection('mission')">Our Mission</button>
            </div>

            <!-- History Section -->
            <div id="history" class="about-text" style="display:none; text-align:center;">
                <h3>Our History</h3>
                <p>In early 2015, a small, ambitious team of university students united with a shared goal — to bridge the gap between digital marketing knowledge and those trying to start their journey. What sparked this mission was a growing frustration with fragmented platforms, unreliable services, and the overwhelming nature of online marketing for beginners.</p>
                <p>Growth Grid was born not from corporate funding or flashy launches, but from grassroots determination and community feedback.</p>
                <ul style="list-style-position: inside; display: inline-block; text-align: left;">
                    <li>Accessible learning tailored for beginners and non-marketers</li>
                    <li>AI-powered tools for strategy creation and service matchmaking</li>
                    <li>A trusted community offering services, mentorship, and real support</li>
                </ul>
                <p>By mid-2020, Growth Grid was gaining momentum. Word spread among small businesses, educational circles, and digital communities. The platform wasn’t just a tool—it was a lifeline for those often left behind in the marketing race.</p>
                <p>Today, Growth Grid stands as a symbol of what’s possible when innovation meets empathy: a living ecosystem that continues to grow, echoing its humble beginnings and bold commitment to making digital marketing a field anyone can conquer.</p>
            </div>

            <!-- Vision Section -->
            <div id="vision" class="about-text" style="display:none; text-align:center;">
                <h3>Our Vision</h3>
                <p>To become Sri Lanka’s leading digital marketing learning and collaboration platform—empowering individuals and small businesses to grow confidently in the digital world.</p>
            </div>

            <!-- Mission Section -->
            <div id="mission" class="about-text" style="display:none; text-align:center;">
                <h3>Our Mission</h3>
                <p>At Growth Grid, we are committed to empowering small businesses and freelancers to thrive in the digital age. Our mission is built on four key pillars:</p>
                <ul style="list-style-position: inside; display: inline-block; text-align: left;">
                    <li>Beginner-friendly learning modules that simplify digital marketing concepts</li>
                    <li>AI-driven marketing plans and intelligent service matchmaking tools</li>
                    <li>Secure, user-friendly platforms for collaboration and service hiring</li>
                    <li>A vibrant, peer-supported community to inspire and accelerate digital transformation</li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>
</div>

<script>
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.about-text').forEach(el => {
            el.style.display = 'none';
        });

        // Show the selected section
        const target = document.getElementById(sectionId);
        if (target) {
            target.style.display = 'block';
        }
    }
</script>
