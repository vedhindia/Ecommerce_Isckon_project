<?php
include 'admin/dbconnection.php';
include 'check-auth.php';

// Require login for this page
requireLogin();


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = '';
$order_details = null;

// Check if order ID is provided in URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} else if (isset($_GET['tracking'])) {
    $tracking_id = $_GET['tracking'];
    
    // Query to get order by tracking ID
    $sql = "SELECT * FROM orders WHERE order_tracking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tracking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order_details = $result->fetch_assoc();
        $order_id = $order_details['id'];
    }
}

// If we have an order ID, fetch the order details
if (!empty($order_id)) {
    // Query to get order details
    $sql = "SELECT o.*, p.product_name, u.first_name, u.last_name, u.email, u.phone 
            FROM orders o 
            JOIN products p ON o.product_id = p.id 
            JOIN users u ON o.user_id = u.id 
            WHERE o.id = ? AND o.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order_details = $result->fetch_assoc();
    }
}

// Get order status from the database
$order_status = !empty($order_details) ? $order_details['payment_status'] : '';

// Map payment_status to tracking stages
// 'Pending' -> Order Placed
// 'Processing' -> Order Confirmed
// 'Shipped' -> Order Processed
// 'Delivered' -> Ready to Pickup/Delivered
$tracking_stage = 0;
switch($order_status) {
    case 'Pending':
        $tracking_stage = 1; // Only Order Placed is complete
        break;
    case 'Processing':
        $tracking_stage = 2; // Order Placed & Order Confirmed are complete
        break;
    case 'Shipped':
        $tracking_stage = 3; // Order Placed, Order Confirmed, & Order Processed are complete
        break;
    case 'Delivered':
        $tracking_stage = 4; // All stages are complete
        break;
    default:
        $tracking_stage = 0;
}

// Get shipping details if available
$shipping_method = !empty($order_details) ? 'Standard Shipping' : 'UPS'; // Default or from DB if you add this field
$delivery_date = !empty($order_details) ? date('d F Y', strtotime($order_details['created_at'] . ' + 5 days')) : '20 August 2025'; // Example calculation
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="utf-8" />
    <meta name="author" content="www.frebsite.nl" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Odex - Organic Food & Grocery Market HTML Template</title>
     
    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
    
</head>

<body class="grocery-theme light">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
    
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
    
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- Start Navigation -->
        <?php include 'header.php' ?>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        
        <!-- =========================== Breadcrumbs =================================== -->
        <div class="breadcrumbs_wrap gray">
            <div class="container">
                <div class="row align-items-center">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-center">
                            <?php if (!empty($order_details)): ?>
                                <h2 class="breadcrumbs_title">Tracking order: <?php echo $order_details['order_tracking_id'] ?? 'ODEXORD'.str_pad($order_id, 3, '0', STR_PAD_LEFT); ?></h2>
                            <?php else: ?>
                                <h2 class="breadcrumbs_title">Order Tracking</h2>
                            <?php endif; ?>
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tracking Order</li>
                              </ol>
                            </nav>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- =========================== Breadcrumbs =================================== -->
        
        <!-- =========================== Add To Cart =================================== -->
        <section>
            <div class="container">
                <div class="row">
                
                    <div class="col-lg-4 col-md-3">
                        <nav class="dashboard-nav mb-10 mb-md-0">
                          <div class="list-group list-group-sm list-group-strong list-group-flush-x">
                            <a class="list-group-item list-group-item-action dropright-toggle" href="order.php">
                              My Order
                            </a>
                            <a class="list-group-item list-group-item-action dropright-toggle" href="order-history.php">
                              Order History
                            </a>
                            <a class="list-group-item list-group-item-action dropright-toggle active" href="order-tracking.php">
                              Order Tracking
                            </a>
                            <a class="list-group-item list-group-item-action dropright-toggle" href="wishlist.php">
                              Wishlist
                            </a>
                            <a class="list-group-item list-group-item-action dropright-toggle" href="account-info.php">
                              Account Settings
                            </a>
                            <a class="list-group-item list-group-item-action dropright-toggle" href="payment-methode.php">
                              Payment Methods
                            </a>
                            <a class="list-group-item list-group-item-action dropright-toggle" href="logout.php">
                              Logout
                            </a>
                          </div>
                        </nav>
                    </div>
                    
                    <div class="col-lg-8 col-md-9 col-sm-12 col-12">
                        <?php if (empty($order_details)): ?>
                            <!-- Form to search for an order -->
                            <div class="checked-shop mb-4">
                                <form method="GET" action="order-tracking.php">
                                    <div class="form-group">
                                        <label for="tracking">Enter Order Tracking ID:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tracking" name="tracking" placeholder="e.g., ODEXORD149" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-theme" type="submit">Track Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($order_details)): ?>
                            <div class="checked-shop">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="ship_status_box"><span class="text-bold mr-2">Shipped via:</span><?php echo $shipping_method; ?></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="ship_status_box"><span class="text-bold mr-2">Status:</span><?php echo $order_status; ?></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="ship_status_box"><span class="text-bold mr-2">Expected Delivery:</span><?php echo $delivery_date; ?></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <ul class="track_order_list mt-4">
                                        
                                            <!-- Single List -->
                                            <li class="<?php echo ($tracking_stage >= 1) ? 'complete' : ''; ?>">
                                                <div class="trach_single_list">
                                                    <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                    <div class="track_list_caption">
                                                        <h4 class="mb-0">Order Placed</h4>
                                                        <p>We have received your order</p>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <!-- Single List -->
                                            <li class="<?php echo ($tracking_stage >= 2) ? 'complete' : ($tracking_stage == 1 ? 'processing' : ''); ?>">
                                                <div class="trach_single_list">
                                                    <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                    <div class="track_list_caption">
                                                        <h4 class="mb-0">Order Confirmed</h4>
                                                        <p>Your Order has been confirmed.</p>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <!-- Single List -->
                                            <li class="<?php echo ($tracking_stage >= 3) ? 'complete' : ($tracking_stage == 2 ? 'processing' : ''); ?>">
                                                <div class="trach_single_list">
                                                    <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                    <div class="track_list_caption">
                                                        <h4 class="mb-0">Order Processed</h4>
                                                        <p>We are preparing your order.</p>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <!-- Single List -->
                                            <li class="<?php echo ($tracking_stage >= 4) ? 'complete' : ($tracking_stage == 3 ? 'processing' : ''); ?>">
                                                <div class="trach_single_list">
                                                    <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                    <div class="track_list_caption">
                                                        <h4 class="mb-0">Ready to Pickup</h4>
                                                        <p>Your order is ready for pickup.</p>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>

                                <?php if (!empty($order_details)): ?>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Order Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>Order ID:</strong> <?php echo $order_details['id']; ?></p>
                                                        <p><strong>Product:</strong> <?php echo $order_details['product_name']; ?></p>
                                                        <p><strong>Total Amount:</strong> $<?php echo number_format($order_details['total'], 2); ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>Customer:</strong> <?php echo $order_details['first_name'] . ' ' . $order_details['last_name']; ?></p>
                                                        <p><strong>Email:</strong> <?php echo $order_details['email']; ?></p>
                                                        <p><strong>Phone:</strong> <?php echo $order_details['phone']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            
                            </div>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- =========================== Add To Cart =================================== -->
        
        <!-- ============================ Call To Action ================================== --> 
        <section class="theme-bg call_action_wrap-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="call_action_wrap">
                            <div class="call_action_wrap-head">
                                <h3>Do You Have Questions ?</h3>
                                <span>We'll help you to grow your career and growth.</span>
                            </div>
                            <div class="newsletter_box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Subscribe here...">
                                    <div class="input-group-append">
                                    <button class="btn search_btn" type="button"><i class="fas fa-arrow-alt-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Call To Action End ================================== -->
        
        <!-- ============================ Footer Start ================================== -->
        <?php include 'footer.php' ?>
        <!-- ============================ Footer End ================================== -->
        
        <!-- cart -->
        <!-- Switcher Start -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="rightMenu">
            <div class="rightMenu-scroll">
                <h4 class="cart_heading">Your cart</h4>
                <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
                <div class="right-ch-sideBar" id="side-scroll">
                    
                    <div class="cart_select_items">
                        <?php
                        // Get cart items for the current user
                        if(isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                            $cart_query = "SELECT c.*, p.product_name, pu.price, pi.image_path 
                                        FROM cart c
                                        JOIN products p ON c.product_id = p.id
                                        JOIN product_units pu ON c.unit_id = pu.id
                                        LEFT JOIN (
                                            SELECT product_id, MIN(image_path) as image_path
                                            FROM product_images 
                                            GROUP BY product_id
                                        ) pi ON p.id = pi.product_id
                                        WHERE c.user_id = ?";
                            $stmt = $conn->prepare($cart_query);
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $cart_result = $stmt->get_result();
                            
                            $subtotal = 0;
                            
                            while($cart_item = $cart_result->fetch_assoc()) {
                                $item_total = $cart_item['price'] * $cart_item['quantity'];
                                $subtotal += $item_total;
                                ?>
                                <!-- Single Item -->
                                <div class="cart_selected_single">
                                    <div class="cart_selected_single_thumb">
                                        <a href="product-detail.php?id=<?php echo $cart_item['product_id']; ?>">
                                            <img src="<?php echo $cart_item['image_path']; ?>" class="img-fluid" alt="" />
                                        </a>
                                    </div>
                                    <div class="cart_selected_single_caption">
                                        <h4 class="product_title"><?php echo $cart_item['product_name']; ?></h4>
                                        <span class="numberof_item">$<?php echo $cart_item['price']; ?> x <?php echo $cart_item['quantity']; ?></span>
                                        <a href="cart-actions.php?action=remove&id=<?php echo $cart_item['id']; ?>" class="text-danger">Remove</a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    
                    <div class="cart_subtotal">
                        <h6>Subtotal<span class="theme-cl">$<?php echo isset($subtotal) ? number_format($subtotal, 2) : '0.00'; ?></span></h6>
                    </div>
                    
                    <div class="cart_action">
                        <ul>
                            <li><a href="cart.php" class="btn btn-go-cart btn-theme">View/Edit Cart</a></li>
                            <li><a href="checkout.php" class="btn btn-checkout">Checkout Now</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Left Collapse navigation -->
        <div class="w3-ch-sideBar-left w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="leftMenu">
            <div class="rightMenu-scroll">
                <div class="flixel">
                    <h4 class="cart_heading">Navigation</h4>
                    <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
                </div>
                
                <div class="right-ch-sideBar">
                    
                    <div class="side_navigation_collapse">
                        <div class="d-navigation">
                            <ul id="side-menu">
                                <li class="dropdown">
                                    <a href="#">Category<span class="ti-angle-left"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php
                                        // Fetch main categories
                                        $category_query = "SELECT * FROM categories";
                                        $category_result = $conn->query($category_query);
                                        
                                        while($cat = $category_result->fetch_assoc()) {
                                            echo '<li><a href="shop.php?category='.$cat['id'].'">'.$cat['main_category'].'</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </li>
                                
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="blog.php">Blogs</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Left Collapse navigation -->
        
        <!-- Product View -->
        <div class="modal fade" id="viewproduct-over" tabindex="-1" role="dialog" aria-labelledby="add-payment" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="view-product">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <div class="row align-items-center">
                
                    <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="sp-wrap">
                                <img src="assets/img/detail/detail-1.png" class="img-fluid rounded" alt="">
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="woo_pr_detail">
                                
                                <div class="woo_cats_wrps">
                                    <a href="#" class="woo_pr_cats">Casual Shirt</a>
                                    <span class="woo_pr_trending">Trending</span>
                                </div>
                                <h2 class="woo_pr_title">Professional Casual Shirt</h2>
                                
                                <div class="woo_pr_reviews">
                                    <div class="woo_pr_rating">
                                        <i class="fa fa-star filled"></i>
                                        <i class="fa fa-star filled"></i>
                                        <i class="fa fa-star filled"></i>
                                        <i class="fa fa-star filled"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="woo_ave_rat">4.8</span>
                                    </div>
                                    <div class="woo_pr_total_reviews">
                                        <a href="#">(124 Reviews)</a>
                                    </div>
                                </div>
                                
                                <div class="woo_pr_price">
                                    <div class="woo_pr_offer_price">
                                        <h3>$149<sup>.00</sup><span class="org_price">$199<sup>.99</sup></span></h3>
                                    </div>
                                </div>
                                
                                <div class="woo_pr_short_desc">
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores voluptatem quia voluptas sit aspernatur.</p>
                                </div>
                                
                                <div class="woo_pr_color flex_inline_center mb-3">
                                    <div class="woo_pr_varient">
                                        <h6>Size:</h6>
                                    </div>
                                    <div class="woo_colors_list pl-3">
                                        <div class="custom-varient custom-size">
                                            <input type="radio" class="custom-control-input" name="sizeRadio" id="sizeRadioOne" value="5" data-toggle="form-caption" data-target="#sizeCaption">
                                            <label class="custom-control-label" for="sizeRadioOne">SM</label>
                                        </div>
                                        <div class="custom-varient custom-size">
                                            <input type="radio" class="custom-control-input" name="sizeRadio" id="sizeRadioTwo" value="6" data-toggle="form-caption" data-target="#sizeCaption">
                                            <label class="custom-control-label" for="sizeRadioTwo">M</label>
                                        </div>
                                        <div class="custom-varient custom-size">
                                            <input type="radio" class="custom-control-input" name="sizeRadio" id="sizeRadioThree" value="6.6" data-toggle="form-caption" data-target="#sizeCaption">
                                            <label class="custom-control-label" for="sizeRadioThree">L</label>
                                        </div>
                                        <div class="custom-varient custom-size">
                                            <input type="radio" class="custom-control-input" name="sizeRadio" id="sizeRadioFour" value="7" data-toggle="form-caption" data-target="#sizeCaption" checked>
                                            <label class="custom-control-label" for="sizeRadioFour">XL</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="woo_pr_color flex_inline_center mb-3">
                                    <div class="woo_pr_varient">
                                        <h6>Color:</h6>
                                    </div>
                                    <div class="woo_colors_list pl-3">
                                        <div class="custom-varient custom-color red">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="red" value="5" data-toggle="form-caption" data-target="#colorCaption">
                                            <label class="custom-control-label" for="red">5</label>
                                        </div>
                                        <div class="custom-varient custom-color green">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="green" value="6" data-toggle="form-caption" data-target="#colorCaption">
                                            <label class="custom-control-label" for="green">6</label>
                                        </div>
                                        <div class="custom-varient custom-color purple">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="purple" value="6.6" data-toggle="form-caption" data-target="#colorCaption" checked>
                                            <label class="custom-control-label" for="purple">6.5</label>
                                        </div>
                                        <div class="custom-varient custom-color yellow">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="yellow" value="7" data-toggle="form-caption" data-target="#colorCaption">
                                            <label class="custom-control-label" for="yellow">7</label>
                                        </div>
                                        <div class="custom-varient custom-color blue">
                                            <input type="radio" class="custom-control-input" name="colorRadio" id="blue" value="6" data-toggle="form-caption" data-target="#colorCaption">
                                            <label class="custom-control-label" for="blue">7.5</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="woo_btn_action">
                                    <div class="col-12 col-lg-auto">
                                        <input type="number" class="form-control mb-2 full-width" value="1" />
                                    </div>
                                </div>
                                
                                <div class="woo_btn_action">
                                    <div class="col-12 col-lg-auto">
                                        <button type="submit" class="btn btn-block btn-dark mb-2">Add to Cart <i class="ti-shopping-cart-full ml-2"></i></button>
                                    </div>
                                    <div class="col-12 col-lg-auto">
                                        <button class="btn btn-gray btn-block mb-2" data-toggle="button">Wishlist <i class="ti-heart ml-2"></i></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/ion.rangeSlider.min.js"></script>
    <script src="assets/js/smoothproducts.js"></script>
    <script src="assets/js/jquery-rating.js"></script>
    <script src="assets/js/jQuery.style.switcher.js"></script>
    <script src="assets/js/custom.js"></script>
    
    <script>
        function openRightMenu() {
            document.getElementById("rightMenu").style.display = "block";
        }
        function closeRightMenu() {
            document.getElementById("rightMenu").style.display = "none";
        }
    </script>
    
    <script>
        function openLeftMenu() {
            document.getElementById("leftMenu").style.display = "block";
        }
        function closeLeftMenu() {
            document.getElementById("leftMenu").style.display = "none";
        }
    </script>
    
    <script>
        function openFilterSearch() {
            document.getElementById("filter_search").style.display = "block";
        }
        function closeFilterSearch() {
            document.getElementById("filter_search").style.display = "none";
        }
    </script>

</body>

</html>