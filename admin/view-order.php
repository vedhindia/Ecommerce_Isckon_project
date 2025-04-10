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
    
    <!-- Font Awesome (added for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                                    <h3>Invoice Details</h3>
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
                                            <div class="text-tiny">Invoice #<?php echo $order_id; ?></div>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- order-details / invoice -->
                                <div class="wg-box mb-30 card">
                                    <!-- Invoice Header -->
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center p-3">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-0">INVOICE #<?php echo str_pad($order_id, 5, '0', STR_PAD_LEFT); ?></h4>
                                        </div>
                                        <div>
                                            <span class="badge <?php echo ($order['payment_status'] == 'Complete' || $order['payment_status'] == 'complete') ? 'bg-success' : 'bg-warning text-dark'; ?> rounded-pill px-3 py-2">
                                                <?php echo $order['payment_status']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Invoice Content -->
                                    <div class="card-body p-4">
                                        <!-- Organization & Customer Info -->
                                        <div class="row mb-4">
                                            <!-- Organization Info -->
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="mb-0"><i class="fas fa-building me-2"></i>From</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="fw-bold mb-1">Iskcon Ravet</h6>
                                                        <p class="mb-1">123 Temple Road</p>
                                                        <p class="mb-1">Ravet, Pune, 412101</p>
                                                        <p class="mb-1">Maharashtra, India</p>
                                                        <p class="mb-0">info@iskconravet.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Customer Info -->
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Bill To</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></h6>
                                                        <p class="mb-1"><?php echo htmlspecialchars($order['address1']); ?></p>
                                                        <?php if (!empty($order['address2'])): ?>
                                                            <p class="mb-1"><?php echo htmlspecialchars($order['address2']); ?></p>
                                                        <?php endif; ?>
                                                        <p class="mb-1"><?php echo htmlspecialchars($order['city']); ?>, <?php echo htmlspecialchars($order['zip']); ?></p>
                                                        <p class="mb-1"><?php echo htmlspecialchars($order['country']); ?></p>
                                                        <p class="mb-0"><?php echo htmlspecialchars($order['email']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Invoice Details -->
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <div class="card-header bg-info text-white">
                                                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Invoice Details</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-borderless mb-0">
                                                            <tr>
                                                                <th>Invoice Number:</th>
                                                                <td>#INV-<?php echo str_pad($order_id, 5, '0', STR_PAD_LEFT); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Invoice Date:</th>
                                                                <td><?php echo date('d M Y', strtotime($order['created_at'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Payment ID:</th>
                                                                <td><?php echo isset($payment['payment_id']) ? $payment['payment_id'] : 'N/A'; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Payment Time:</th>
                                                                <td><?php echo date('H:i:s', strtotime($order['created_at'])); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php if (!empty($order['company']) || !empty($order['order_notes'])): ?>
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    <div class="card-header bg-info text-white">
                                                        <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Additional Information</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php if (!empty($order['company'])): ?>
                                                        <div class="mb-3">
                                                            <h6 class="fw-bold">Company</h6>
                                                            <p><?php echo htmlspecialchars($order['company']); ?></p>
                                                        </div>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (!empty($order['order_notes'])): ?>
                                                        <div>
                                                            <h6 class="fw-bold">Order Notes</h6>
                                                            <p class="mb-0"><?php echo htmlspecialchars($order['order_notes']); ?></p>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Order Items -->
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Order Items</h5>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Product</th>
                                                                <th class="text-end">Price</th>
                                                                <th class="text-center">Quantity</th>
                                                                <th class="text-end">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="Product" width="60" height="60" class="me-3">
                                                                        <h6 class="mb-0"><?php echo htmlspecialchars($order['product_name']); ?></h6>
                                                                    </div>
                                                                </td>
                                                                <td class="text-end">₹<?php echo number_format($order['total'] / $quantity, 2); ?></td>
                                                                <td class="text-center"><?php echo $quantity; ?></td>
                                                                <td class="text-end">₹<?php echo number_format($order['total'], 2); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Order Total -->
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <table class="table table-borderless mb-0">
                                                            <tr>
                                                                <th>Subtotal:</th>
                                                                <td class="text-end">₹<?php echo number_format($order['subtotal'], 2); ?></td>
                                                            </tr>
                                                            <?php if ($order['tax'] > 0): ?>
                                                            <tr>
                                                                <th>Tax:</th>
                                                                <td class="text-end">₹<?php echo number_format($order['tax'], 2); ?></td>
                                                            </tr>
                                                            <?php endif; ?>
                                                            <?php if ($order['shipping'] > 0): ?>
                                                            <tr>
                                                                <th>Shipping:</th>
                                                                <td class="text-end">₹<?php echo number_format($order['shipping'], 2); ?></td>
                                                            </tr>
                                                            <?php endif; ?>
                                                            <tr class="border-top">
                                                                <th class="text-primary h5">Total:</th>
                                                                <td class="text-end text-primary h5">₹<?php echo number_format($order['total'], 2); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Invoice Footer -->
                                    <div class="card-footer bg-light p-3">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <a href="oder-list.php" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Back to Orders
                                            </a>
                                            <div>
                                                <a href="print_order.php?id=<?php echo $order_id; ?>" class="btn btn-info me-2" target="_blank">
                                                    <i class="fas fa-print me-2"></i>Print
                                                </a>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /order-details / invoice -->
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