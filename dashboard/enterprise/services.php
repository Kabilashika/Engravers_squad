<?php
session_start();

// Redirect if not logged in or not an enterprise
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enterprise') {
    header("Location: ../../login.php");
    exit;
}

$pageTitle = "Services - Growth Grid";
include('../../includes/db.php');
include('../../includes/enterprise_header.php');

$userId = $_SESSION['user_id'];

// Handle subscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'], $_POST['card_number'])) {
    $serviceId = (int)$_POST['service_id'];
    $cardNumber = trim($_POST['card_number']);
    $cardLast4 = substr($cardNumber, -4);
    $role = 'enterprise';

    // Check if already subscribed
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM enterprise_services WHERE enterprise_id = ? AND service_id = ?");
    $stmt->execute([$userId, $serviceId]);
    $alreadySubscribed = $stmt->fetchColumn();

    if (!$alreadySubscribed) {
        // Get price from services table
        $priceStmt = $pdo->prepare("SELECT price FROM services WHERE id = ?");
        $priceStmt->execute([$serviceId]);
        $price = $priceStmt->fetchColumn();

        // Insert into enterprise_services
        $insertService = $pdo->prepare("INSERT INTO enterprise_services (enterprise_id, service_id) VALUES (?, ?)");
        $insertService->execute([$userId, $serviceId]);

        // Insert payment info
        $insertPayment = $pdo->prepare("INSERT INTO service_payments (user_id, service_id, role, amount, card_last4) VALUES (?, ?, ?, ?, ?)");
        $insertPayment->execute([$userId, $serviceId, $role, $price, $cardLast4]);

        $subscriptionSuccess = true;
    } else {
        $warning = "You are already subscribed to this service.";
    }
}

// Fetch all services
$services = $pdo->query("SELECT * FROM services ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch subscribed service IDs for this enterprise
$stmt = $pdo->prepare("SELECT service_id FROM enterprise_services WHERE enterprise_id = ?");
$stmt->execute([$userId]);
$subscribedServices = array_column($stmt->fetchAll(), 'service_id');
?>

<main class="page-wrapper">
    <section style="max-width: 1100px; margin: auto; padding: 40px 20px; line-height: 1.6;">
        <h2 style="text-align:center; color: #f0c330; font-size: 30px; padding:10px;">Digital Marketing Services</h2>

        <?php if (!empty($warning)): ?>
            <p style="color: red; text-align:center;"><?php echo $warning; ?></p>
        <?php elseif (!empty($subscriptionSuccess)): ?>
            <p style="color: green; text-align:center;">Successfully Subscribed & Payment Recorded!</p>
        <?php endif; ?>

        <div style="text-align: center;">
            <img src="assets/images/services.jpg" alt="Services" style="width: 1100px; height: 420px; object-fit: cover; border-radius: 12px; max-width: 100%;">
        </div>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 30px;">
            <?php foreach ($services as $service): ?>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 20px; width: 300px; box-shadow: 0 0 10px #eee; background: #fff; display: flex; flex-direction: column; justify-content: space-between; line-height: 1.6;">
                    <div>
                        <h3 style="color: #003366;"><?php echo htmlspecialchars($service['title']); ?></h3>
                        <p style="font-size: 14px; margin: 8px 0;"><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($service['category']); ?></p>
                        <p><strong>Price:</strong> Rs. <?php echo htmlspecialchars($service['price']); ?></p>
                    </div>
                    <div style="margin-top: 15px; text-align: center;">
                        <?php if (in_array($service['id'], $subscribedServices)): ?>
                            <p style="color: green; font-weight: bold;">Subscribed</p>
                        <?php else: ?>
                            <button onclick="confirmSubscribe(<?php echo $service['id']; ?>)" style="background: #003366; color: #fff; padding: 10px 20px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer;">Subscribe</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Confirmation Modal -->
    <div id="confirmModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index: 1000;">
        <div style="background:#fff; padding:30px; border-radius:8px; width: 400px; line-height: 1.6;">
            <h3 style="color:#003366; margin-bottom: 15px;">Confirm Subscription</h3>
            <form method="POST">
                <input type="hidden" name="service_id" id="service_id_input">
                <input type="text" name="card_number" placeholder="Card Number" required style="margin-bottom:10px; padding:10px; width:100%;">
                <input type="text" name="card_name" placeholder="Name on Card" required style="margin-bottom:10px; padding:10px; width:100%;">
                <input type="text" name="expiry" placeholder="MM/YY" required style="margin-bottom:10px; padding:10px; width:100%;">
                <input type="text" name="cvv" placeholder="CVV" required style="margin-bottom:20px; padding:10px; width:100%;">
                <button type="submit" style="background:#003366; color:#fff; padding:10px 20px; border:none; border-radius:5px;">Confirm & Subscribe</button>
                <button type="button" onclick="closeModal()" style="margin-left: 10px; background:#ccc; padding:10px 20px; border:none; border-radius:5px;">Cancel</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmSubscribe(serviceId) {
        document.getElementById('service_id_input').value = serviceId;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }
</script>

<?php include('../../includes/footer.php'); ?>
