<?php
session_start();
include_once 'dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}

// Initialize search parameter
$search = '';
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
}

// Query to fetch orders - with search functionality
$query = "SELECT o.*, p.product_name, u.first_name, u.last_name, py.payment_status 
          FROM orders o
          INNER JOIN products p ON o.product_id = p.id
          INNER JOIN users u ON o.user_id = u.id
          LEFT JOIN payment py ON o.user_id = py.user_id AND py.amount = o.total
          WHERE 1=1";

// Add search condition if search parameter exists
if(!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $query .= " AND (o.id LIKE '%$search%' OR p.product_name LIKE '%$search%' 
                OR u.first_name LIKE '%$search%' OR u.last_name LIKE '%$search%'
                OR o.email LIKE '%$search%' OR o.phone LIKE '%$search%')";
}

$query .= " ORDER BY o.created_at DESC";

// Pagination
$results_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure page is at least 1
$offset = ($page - 1) * $results_per_page;

// Count total records for pagination
$count_query = "SELECT COUNT(*) as total FROM ($query) as subquery";
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total'];
$total_pages = ceil($total_records / $results_per_page);

// Add limit for pagination
$query .= " LIMIT $offset, $results_per_page";

// Execute the final query
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Iskcon Ravet - Order List</title>

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
                                    <h3>Order List</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.php"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Order</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Order List</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- order-list -->
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search" method="GET" action="">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search here..." class="" name="search" tabindex="2" value="<?php echo htmlspecialchars($search); ?>" aria-required="true">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <a class="tf-button style-1 w208" href="#" onclick="exportOrdersToCSV()"><i class="icon-file-text"></i>Export all orders</a>
                                    </div>
                                    <div class="wg-table table-all-category">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Product</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Order ID</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Price</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Customer</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Payment</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Status</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Date</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            <?php
                                            // Check if there are any orders
                                            if (mysqli_num_rows($result) > 0) {
                                                // Loop through all orders
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Get first product image
                                                    $product_id = $row['product_id'];
                                                    $img_query = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
                                                    $img_result = mysqli_query($conn, $img_query);
                                                    $img_path = "images/products/default.png"; // Default image
                                                    
                                                    if (mysqli_num_rows($img_result) > 0) {
                                                        $img_row = mysqli_fetch_assoc($img_result);
                                                        $img_path = $img_row['image_path'];
                                                    }
                                                    
                                                    // Format the payment status
                                                    $paymentStatus = $row['payment_status'];
                                                    $statusClass = ($paymentStatus == 'complete') ? 'block-available' : 'block-pending';
                                                    $statusText = ($paymentStatus == 'complete') ? 'Success' : 'Pending';
                                            ?>
                                            <li class="product-item gap14">
                                                <div class="image no-bg">
                                                    <img src="<?php echo $img_path; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                                                </div>
                                                <div class="flex items-center justify-between gap20 flex-grow">
                                                    <div class="name">
                                                        <a href="product-detail.php?id=<?php echo $row['product_id']; ?>" class="body-title-2"><?php echo htmlspecialchars($row['product_name']); ?></a>
                                                    </div>
                                                    <div class="body-text">#<?php echo $row['id']; ?></div>
                                                    <div class="body-text">₹<?php echo number_format($row['total'], 2); ?></div>
                                                    <div class="body-text"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></div>
                                                    <div class="body-text"><?php echo htmlspecialchars($row['payment_status']); ?></div>
                                                    <div>
                                                        <div class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></div>
                                                    </div>
                                                    <div class="body-text">
                                                        <?php echo date('d M Y', strtotime($row['created_at'])); ?>
                                                    </div>
                                                    <div class="list-icon-function">
                                                        <div class="item eye">
                                                            <a href="view-order.php?id=<?php echo $row['id']; ?>"><i class="icon-eye"></i></a>
                                                        </div>
                                                        <div class="item edit">
                                                            <a href="edit-order.php?id=<?php echo $row['id']; ?>"><i class="icon-edit-3"></i></a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a href="#" onclick="deleteOrder(<?php echo $row['id']; ?>)"><i class="icon-trash-2"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                }
                                            } else {
                                                // No orders found
                                                echo '<li class="product-item gap14"><div class="w-100 text-center p-4">No orders found</div></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10">
                                        <div class="text-tiny">Showing <?php echo min($total_records, $results_per_page); ?> of <?php echo $total_records; ?> entries</div>
                                        <?php if ($total_pages > 1): ?>
                                        <ul class="wg-pagination">
                                            <li <?php if($page <= 1) echo 'class="disabled"'; ?>>
                                                <a href="<?php if($page <= 1) echo '#'; else echo '?page='.($page-1).((!empty($search)) ? '&search='.$search : ''); ?>">
                                                    <i class="icon-chevron-left"></i>
                                                </a>
                                            </li>
                                            
                                            <?php
                                            $start_page = max(1, $page - 2);
                                            $end_page = min($start_page + 4, $total_pages);
                                            
                                            for ($i = $start_page; $i <= $end_page; $i++): 
                                            ?>
                                                <li <?php if($page == $i) echo 'class="active"'; ?>>
                                                    <a href="?page=<?php echo $i; ?><?php echo (!empty($search)) ? '&search='.$search : ''; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            
                                            <li <?php if($page >= $total_pages) echo 'class="disabled"'; ?>>
                                                <a href="<?php if($page >= $total_pages) echo '#'; else echo '?page='.($page+1).((!empty($search)) ? '&search='.$search : ''); ?>">
                                                    <i class="icon-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- /order-list -->
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
    
    <script>
    // Function to delete an order
    function deleteOrder(orderId) {
        if (confirm("Are you sure you want to delete this order?")) {
            window.location.href = "delete-order.php?id=" + orderId;
        }
    }
    
    // Function to export orders to CSV
    function exportOrdersToCSV() {
        window.location.href = "export-orders.php";
    }
    </script>

</body>

</html>