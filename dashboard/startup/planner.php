<?php
session_start();

// Redirect if not logged in or not a startup
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startup') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Business Planner - Growth Grid";
include('../../includes/db.php');
include('../../includes/startup_header.php');

$recommendation = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['business_type'] ?? '';
    $goal = $_POST['goal'] ?? '';
    $audience = $_POST['target_audience'] ?? '';

    if ($type && $goal && $audience) {
        if ($type == "Product" && $goal == "Brand Awareness" && $audience == "General Public") {
            $recommendation = "
                <strong>Strategy:</strong> Focus on <u>social media campaigns</u>, <u>influencer outreach</u>, and <u>community events</u>.<br><br>
                <strong>Why?</strong> Since you're selling to the general public, visual appeal and visibility are crucial. Platforms like Instagram, TikTok, and Facebook help build awareness quickly through reels, ads, and influencer promotions. Attending or organizing local events boosts credibility and trust.<br><br>
                <strong>Estimated Monthly Budget (LKR):</strong><br>
                • Social Media Ads: Rs. 20,000 – 40,000<br>
                • Influencer Promotions: Rs. 10,000 – 30,000<br>
                • Community Events: Rs. 15,000 – 50,000<br>
                <em>Total: Rs. 45,000 – 120,000</em>
            ";
        } elseif ($type == "Service" && $goal == "Lead Generation" && $audience == "Businesses") {
            $recommendation = "
                <strong>Strategy:</strong> Use <u>LinkedIn Ads</u>, <u>educational content marketing</u> (blogs, case studies), and <u>email outreach</u>.<br><br>
                <strong>Why?</strong> B2B audiences respond better to professional, value-based content. LinkedIn helps you reach decision-makers, while blogs and whitepapers build authority. Email outreach nurtures potential clients.<br><br>
                <strong>Estimated Monthly Budget (LKR):</strong><br>
                • LinkedIn Ads: Rs. 25,000 – 60,000<br>
                • Content Creation: Rs. 15,000 – 30,000<br>
                • Email Automation Tools: Rs. 5,000 – 10,000<br>
                <em>Total: Rs. 45,000 – 100,000</em>
            ";
        } elseif ($goal == "Customer Retention") {
            $recommendation = "
                <strong>Strategy:</strong> Implement <u>loyalty programs</u>, send <u>monthly newsletters</u>, and use <u>feedback forms</u> for improvement.<br><br>
                <strong>Why?</strong> It’s cheaper to retain an existing customer than acquire a new one. Loyalty points and personalized communication improve trust and repeat purchases. Feedback forms give valuable insights for refining your service/product.<br><br>
                <strong>Estimated Monthly Budget (LKR):</strong><br>
                • Loyalty Platform (or manual management): Rs. 5,000 – 15,000<br>
                • Newsletter Tools: Rs. 3,000 – 8,000<br>
                • Feedback Platform: Free – Rs. 5,000<br>
                <em>Total: Rs. 8,000 – 28,000</em>
            ";
        } else {
            $recommendation = "
                <strong>Strategy:</strong> Use a combination of <u>SEO</u>, <u>Google Ads</u>, and <u>targeted content</u> to reach your audience.<br><br>
                <strong>Why?</strong> When you are not certain of the exact target, a diverse approach helps test and identify what works. SEO builds organic traffic long-term, Google Ads give fast visibility, and tailored blog/video content attracts interest.<br><br>
                <strong>Estimated Monthly Budget (LKR):</strong><br>
                • Google Ads: Rs. 20,000 – 50,000<br>
                • SEO Tools/Outsourcing: Rs. 10,000 – 25,000<br>
                • Content Creation: Rs. 15,000 – 30,000<br>
                <em>Total: Rs. 45,000 – 105,000</em>
            ";
        }
    } else {
        $recommendation = "<span style='color:red;'>Please select all options to receive a personalized plan.</span>";
    }
}
?>

<main class="page-wrapper">
    <section style="max-width: 850px; margin: auto; padding: 40px 20px;">
        <h2 style="text-align: center; color: #f0c330; font-size: 30px;">Business Planner</h2>
        <p style="text-align: center; color: #000000ff; padding: 10px 0;">Select your startup details below to get a personalized strategy recommendation with a monthly budget plan.</p>

        <div style="text-align: center;">
            <img src="assets/images/plan.webp" alt="Startup" style="width: 1100px; height: 320px; object-fit: cover; border-radius: 12px; max-width: 100%;">
        </div>

        <form method="POST" style="background: #f9f9f9; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #eee; margin-top: 30px;">
            <label><strong>1. What type of business do you run?</strong></label><br>
            <select name="business_type" required style="width: 100%; padding: 10px; margin-bottom: 20px;">
                <option value="">--Select Type--</option>
                <option value="Product">Product-Based</option>
                <option value="Service">Service-Based</option>
            </select>

            <label><strong>2. What is your current goal?</strong></label><br>
            <select name="goal" required style="width: 100%; padding: 10px; margin-bottom: 20px;">
                <option value="">--Select Goal--</option>
                <option value="Brand Awareness">Brand Awareness</option>
                <option value="Lead Generation">Lead Generation</option>
                <option value="Customer Retention">Customer Retention</option>
                <option value="Sales Growth">Sales Growth</option>
            </select>

            <label><strong>3. Who is your target audience?</strong></label><br>
            <select name="target_audience" required style="width: 100%; padding: 10px; margin-bottom: 20px;">
                <option value="">--Select Audience--</option>
                <option value="General Public">General Public</option>
                <option value="Businesses">Businesses</option>
                <option value="Niche Market">Niche Market</option>
            </select>

            <button type="submit" style="background-color: #003366; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Get Plan</button>
        </form>

        <?php if (!empty($recommendation)): ?>
            <div style="margin-top: 30px; padding: 20px; background: #e8f5e9; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
                <h3 style="color: #2e7d32;">Recommended Strategy:</h3>
                <p><?php echo $recommendation; ?></p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
