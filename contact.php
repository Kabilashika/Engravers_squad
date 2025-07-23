<?php
$pageTitle = "Contact Us - Growth Grid";
include('includes/db.php');
include('includes/header.php');

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);
            $success = true;
        } catch (PDOException $e) {
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<div class="page-wrapper">
    <main>
        <section class="contact">
            <h2>Contact Us</h2>
            <p>We'd love to hear from you! Reach out with any questions or feedback.</p>

            <form method="post" class="contact-form" id="contactForm">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>
        <!-- FAQ Link -->
    <div style="margin-top: 30px; text-align: center;">
        <p style="margin-bottom: 10px; font-size: 16px; padding:10px;">Need quick answers?</p>
        <a href="faq.php" style="background-color: #003366; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Browse our FAQs</a>
    </div>
    </main>
</div>

<?php include('includes/footer.php'); ?>

<?php if ($success): ?>
<script>
    alert("Your message has been sent successfully!");
    window.location.href = "contact.php"; // Optional: refresh page after alert
</script>
<?php endif; ?>
