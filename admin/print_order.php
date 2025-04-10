<?php
session_start();
include_once 'dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: order-list.php');
    exit;
}

$order_id = (int)$_GET['id'];

// Get order details
$sql = "SELECT orders.*, products.product_name, users.email as user_email, users.phone as user_phone 
        FROM orders 
        LEFT JOIN products ON products.id = orders.product_id 
        LEFT JOIN users ON users.id = orders.user_id 
        WHERE orders.id = $order_id";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header('Location: order-list.php');
    exit;
}

$order = $result->fetch_assoc();

// Get payment details
$payment_sql = "SELECT * FROM payment WHERE user_id = '{$order['user_id']}' ORDER BY added_on DESC LIMIT 1";
$payment_result = $conn->query($payment_sql);
$payment = $payment_result->fetch_assoc();

// Get product image
$imgQuery = "SELECT image_path FROM product_images WHERE product_id = {$order['product_id']} LIMIT 1";
$imgResult = $conn->query($imgQuery);
$imgPath = ($imgResult->num_rows > 0) ? $imgResult->fetch_assoc()['image_path'] : 'images/products/default.png';

// Get quantity from checkout
$quantityQuery = "SELECT SUM(quantity) as total_quantity FROM checkout WHERE user_id = {$order['user_id']} AND product_id = {$order['product_id']}";
$quantityResult = $conn->query($quantityQuery);
$quantity = ($quantityResult->num_rows > 0) ? $quantityResult->fetch_assoc()['total_quantity'] : 1;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Invoice - Iskcon Ravet</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .invoice { width: 100%; max-width: 800px; margin: 0 auto; }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-header img { max-width: 150px; }
        .invoice-header h1 { margin: 0; }
        .invoice-header p { margin: 5px 0; }
        .invoice-section { margin-bottom: 20px; }
        .invoice-section h3 { border-bottom: 1px solid #ddd; padding-bottom: 5px; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .invoice-table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <img src="images/logo.png" alt="Company Logo">
            <h1>Iskcon Ravet</h1>
            <p>123 Temple Street, City, Country</p>
            <p>Phone: +123 456 7890 | Email: info@iskconravet.com</p>
        </div>

        <div class="invoice-section">
            <h3>Order Information</h3>
            <table class="invoice-table">
                <tr>
                    <th>Order Date:</th>
                    <td><?php echo date('d M Y H:i', strtotime($order['created_at'])); ?></td>
                </tr>
                <tr>
                    <th>Order Status:</th>
                    <td><?php echo $order['payment_status']; ?></td>
                </tr>
                <tr>
                    <th>Payment ID:</th>
                    <td><?php echo isset($payment['payment_id']) ? $payment['payment_id'] : 'N/A'; ?></td>
                </tr>
            </table>
        </div>

        <div class="invoice-section">
            <h3>Customer Information</h3>
            <table class="invoice-table">
                <tr>
                    <th>Name:</th>
                    <td><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?php echo htmlspecialchars($order['phone']); ?></td>
                </tr>
            </table>
        </div>

        <div class="invoice-section">
            <h3>Shipping Address</h3>
            <p>
                <?php echo htmlspecialchars($order['address1']); ?><br>
                <?php if (!empty($order['address2'])): ?>
                    <?php echo htmlspecialchars($order['address2']); ?><br>
                <?php endif; ?>
                <?php echo htmlspecialchars($order['city']); ?>, <?php echo htmlspecialchars($order['zip']); ?><br>
                <?php echo htmlspecialchars($order['country']); ?>
            </p>
        </div>

        <div class="invoice-section">
            <h3>Order Items</h3>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td>₹<?php echo number_format($order['total'] / $quantity, 2); ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>₹<?php echo number_format($order['total'], 2); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Subtotal</th>
                        <td>₹<?php echo number_format($order['subtotal'], 2); ?></td>
                    </tr>
                    <?php if ($order['tax'] > 0): ?>
                    <tr>
                        <th colspan="3" class="text-right">Tax</th>
                        <td>₹<?php echo number_format($order['tax'], 2); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($order['shipping'] > 0): ?>
                    <tr>
                        <th colspan="3" class="text-right">Shipping</th>
                        <td>₹<?php echo number_format($order['shipping'], 2); ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                        <td>₹<?php echo number_format($order['total'], 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for your order!</p>
            <p>For any inquiries, please contact us at info@iskconravet.com</p>
        </div>
    </div>
</body>
</html>
