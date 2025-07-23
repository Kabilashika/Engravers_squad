<?php
$pageTitle = "FAQs - Growth Grid";
include('includes/header.php');
?>


<main class="page-wrapper">
    <section style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
        <h1 style="text-align: center; color: #f0c330; font-size: 30px;">Frequently Asked Questions</h1>
        <p style="text-align: center; margin-bottom: 40px;padding:10px;">
            Find answers to common questions about Growth Grid’s features and services.
        </p>

        <div class="faq-list">
    <?php
    $faqs = [
        ["What is Growth Grid?", "Growth Grid is a digital marketing learning and collaboration platform that connects students, startups, and enterprises."],
        ["Who can join the platform?", "Anyone interested in digital marketing – including students, freelancers, entrepreneurs, or companies – can register and benefit from Growth Grid."],
        ["Are the learning paths beginner friendly?", "Yes. Our learning paths are designed for complete beginners and gradually progress into intermediate and advanced topics."],
        ["How do startups find talent?", "Startups can use our AI-powered matchmaking tool to connect with students, freelancers, and agencies for digital marketing services."],
        ["Is there a cost to use Growth Grid?", "Most learning resources are free. Some premium features, like detailed analytics or consulting services, may require a subscription."],
        ["Can enterprises hire from the platform?", "Yes. Enterprises can browse our marketplace and hire verified freelancers or agencies directly."],
        ["What kind of support do I get as a student?", "You’ll get guided projects, peer support, internship opportunities, and a portfolio builder to showcase your skills."],
        ["How is my data secured?", "We use encrypted storage and strict privacy protocols to protect your personal and project information."],
    ];

    foreach ($faqs as $index => $faq) {
        echo "
        <div class='faq-item'>
            <button class='faq-question' onclick='toggleAnswer(this)'>Q: {$faq[0]}</button>
            <div class='faq-answer'>{$faq[1]}</div>
        </div>
        ";
    }
    ?>
</div>

    </section>
</main>

<?php include('includes/footer.php'); ?>

<script>
function toggleAnswer(button) {
    const answer = button.nextElementSibling;
    const allAnswers = document.querySelectorAll('.faq-answer');

    // Hide all other answers
    allAnswers.forEach(a => {
        if (a !== answer) a.style.display = 'none';
    });

    // Toggle clicked one
    answer.style.display = (answer.style.display === "block") ? "none" : "block";
}
</script>

