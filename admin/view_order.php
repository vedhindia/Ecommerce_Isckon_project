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
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Order Details - Iskcon Ravet</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/animation.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Font -->
    <link rel="stylesheet" href="font/fonts.css">

    <!-- Icon -->
    <link rel="stylesheet" href="icon/style.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
</head>

<body class="body">
    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->
                
                <!-- section-menu-left -->
                <?php include('sidebar.php'); ?>
                <!-- /section-menu-left -->
                
                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard -->
                    <?php include('topbar.php'); ?>
                    <!-- /header-dashboard -->
                    
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Order Details</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.php"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="order-list.php"><div class="text-tiny">Orders</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Order #<?php echo $order_id; ?></div>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- order-details -->
                                <div class="wg-box mb-30">
                                    <div class="flex items-center justify-between mb-20">
                                        <h4>Order #<?php echo $order_id; ?></h4>
                                        <div>
                                            <a href="edit_order.php?id=<?php echo $order_id; ?>" class="tf-button style-1">Edit Order</a>
                                            <a href="print_order.php?id=<?php echo $order_id; ?>" class="tf-button style-1 ml-10" target="_blank">Print</a>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel-box mb-30">
                                                <h5 class="mb-20">Order Information</h5>
                                                <table class="table-info">
                                                    <tr>
                                                        <th>Order Date:</th>
                                                        <td><?php echo date('d M Y H:i', strtotime($order['created_at'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Status:</th>
                                                        <td><span class="<?php echo ($order['payment_status'] == 'Complete' || $order['payment_status'] == 'complete') ? 'status-success' : 'status-pending'; ?>"><?php echo $order['payment_status']; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment ID:</th>
                                                        <td><?php echo isset($payment['payment_id']) ? $payment['payment_id'] : 'N/A'; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="panel-box mb-30">
                                                <h5 class="mb-20">Customer Information</h5>
                                                <table class="table-info">
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
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel-box mb-30">
                                                <h5 class="mb-20">Shipping Address</h5>
                                                <p>
                                                    <?php echo htmlspecialchars($order['address1']); ?><br>
                                                    <?php if (!empty($order['address2'])): ?>
                                                        <?php echo htmlspecialchars($order['address2']); ?><br>
                                                    <?php endif; ?>
                                                    <?php echo htmlspecialchars($order['city']); ?>, <?php echo htmlspecialchars($order['zip']); ?><br>
                                                    <?php echo htmlspecialchars($order['country']); ?>
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($order['company']) || !empty($order['order_notes'])): ?>
                                        <div class="col-md-6">
                                            <div class="panel-box mb-30">
                                                <h5 class="mb-20">Additional Information</h5>
                                                <?php if (!empty($order['company'])): ?>
                                                <p><strong>Company:</strong> <?php echo htmlspecialchars($order['company']); ?></p>
                                                <?php endif; ?>
                                                
                                                <?php if (!empty($order['order_notes'])): ?>
                                                <p><strong>Order Notes:</strong> <?php echo htmlspecialchars($order['order_notes']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="panel-box">
                                        <h5 class="mb-20">Order Items</h5>
                                        <table class="table table-bordered">
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
                                                    <td>
                                                        <div class="product-info flex items-center">
                                                            <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="Product" width="50">
                                                            <span class="ml-10"><?php echo htmlspecialchars($order['product_name']); ?></span>
                                                        </div>
                                                    </td>
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
                                </div>
                                <!-- /order-details -->
                                
                                <div class="flex items-center justify-between gap10">
                                    <a href="order-list.php" class="tf-button style-2">Back to Orders</a>
                                    <div>
                                        <a href="edit_order.php?id=<?php echo $order_id; ?>" class="tf-button style-1 mr-10">Edit Order</a>
                                        <a href="delete_order.php?id=<?php echo $order_id; ?>" class="tf-button style-3" onclick="return confirm('Are you sure you want to delete this order?');">Delete Order</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        
                        <!-- bottom-page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2025 Iskcon Ravet . Design with</div>
                            <div class="body-text">by <a href="https://designzfactory.in/">designzfactory </a> All rights reserved.</div>
                        </div>
                        <!-- /bottom-page -->
                    </div>
                    <!-- /main-content -->
                </div>
                <!-- /section-content-right -->
            </div>
            <!-- /layout-wrap -->
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/zoom.js"></script>
    <script src="js/switcher.js"></script>
    <script src="js/theme-settings.js"></script>
    <script src="js/main.js"></script>
</body>
</html>