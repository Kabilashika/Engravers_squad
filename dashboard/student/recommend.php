<?php
session_start();
$pageTitle = "AI Recommendation - Growth Grid";
include('../../includes/db.php');
include('../../includes/student_header.php');
?>

<main class="page-wrapper">
    <section style="max-width: 900px; margin: auto; padding: 40px 20px; line-height: 1.8;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px; margin-bottom: 20px;">
            Get Your Learning Recommendation
        </h2>

        <form method="POST" action="" style="margin-bottom: 30px;">
            <label for="interest"><strong>Describe your interests or career goals:</strong></label><br>
            <textarea name="interest" id="interest" rows="4" required 
                      style="width:100%; padding:10px; margin-top:10px; font-size:16px; border-radius:10px;"></textarea><br><br>
            <button type="submit" 
                    style="background: #003366; color: white; padding: 10px 20px; 
                           border: none; border-radius: 5px; font-size:16px;">
                Get Recommendation
            </button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['interest'])) {
            $interest = escapeshellarg($_POST['interest']);

            //  Full path to Python and Script
            $pythonPath = "C:\\Users\\kabil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
            $scriptPathRaw = realpath(__DIR__ . "/../../ai/recommend.py"); // Adjusted relative path
            if (!$scriptPathRaw || !file_exists($scriptPathRaw)) {
                echo "<p style='color:red;'>Error: recommend.py script not found.</p>";
            } else {
                $scriptPath = escapeshellarg($scriptPathRaw);
                $command = "\"$pythonPath\" $scriptPath $interest";

                // Debug (optional)
                // echo "<pre>Command: $command</pre>";

                $output = shell_exec($command . " 2>&1");

                if ($output && !str_contains($output, 'Error')) {
                    echo "<h3 style='color:green;'>Recommended Focus Area:</h3>";
                    echo "<p style='font-size:18px; font-weight:bold;'>" . nl2br(htmlspecialchars(trim($output))) . "</p>";
                } else {
                    echo "<p style='color:red;'>Something went wrong. Output:<br><pre>" . htmlspecialchars($output) . "</pre></p>";
                }
            }
        }
        ?>
    </section>
</main>

<?php include('../../includes/footer.php'); ?>
