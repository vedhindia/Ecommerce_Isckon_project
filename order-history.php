<?php
include 'admin/dbconnection.php';
include 'check-auth.php';

// Require login for this page
requireLogin();
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
            <?php include('header.php')?>

			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			<!-- =========================== Breadcrumbs =================================== -->
			<div class="breadcrumbs_wrap dark">
				<div class="container">
					<div class="row align-items-center">
						
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="text-center">
								<h2 class="breadcrumbs_title">My All Orders</h2>
								<nav aria-label="breadcrumb">
								  <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#">My Account</a></li>
									<li class="breadcrumb-item active" aria-current="page">My Orders</li>
								  </ol>
								</nav>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!-- =========================== Breadcrumbs =================================== -->
			
			
			<!-- =========================== My All Orders =================================== -->
<section class="gray">
    <div class="container">
        <div class="row">
        
            <div class="col-lg-4 col-md-3">
                <nav class="dashboard-nav mb-10 mb-md-0">
                  <div class="list-group list-group-sm list-group-strong list-group-flush-x">
                    <a class="list-group-item list-group-item-action dropright-toggle" href="order.php">
                      My Order
                    </a>
                    <a class="list-group-item list-group-item-action dropright-toggle active" href="order-history.php">
                      Order History
                    </a>
                    <a class="list-group-item list-group-item-action dropright-toggle" href="order-tracking.html">
                      Order Tracking
                    </a>
                    <a class="list-group-item list-group-item-action dropright-toggle" href="wishlist.php">
                      Wishlist
                    </a>
                    <a class="list-group-item list-group-item-action dropright-toggle" href="account-info.php">
                      Account Settings
                    </a>
                    <a class="list-group-item list-group-item-action dropright-toggle" href="payment-methode.html">
                      Payment Methods
                    </a>
                    <a class="list-group-item list-group-item-action dropright-toggle" href="logout.php">
                      Logout
                    </a>
                  </div>
                </nav>
            </div>
            
            <div class="col-lg-8 col-md-9">
            
                <!-- Order Items -->
                <div class="card style-2">
                    <div class="card-header">
                        <h4 class="mb-0">Total Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Order No.</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $user_id = $_SESSION['user_id'];
                                
                                // Query to fetch order history
                                $sql = "SELECT orders.id as order_id, orders.created_at, orders.total, orders.payment_status, 
                                        products.id as product_id, products.product_name 
                                        FROM orders 
                                        LEFT JOIN products ON products.id = orders.product_id 
                                        WHERE orders.user_id = $user_id 
                                        ORDER BY orders.created_at DESC";
                                        
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        // Format date
                                        $orderDate = date('d M Y', strtotime($row['created_at']));
                                        
                                        // Get product image
                                        $product_id = $row['product_id'];
                                        $imgQuery = "SELECT image_path FROM product_images WHERE product_id = $product_id LIMIT 1";
                                        $imgResult = $conn->query($imgQuery);
                                        $imgPath = ($imgResult->num_rows > 0) ? $imgResult->fetch_assoc()['image_path'] : 'assets/img/vegetables/1.png';
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="tbl_cart_product">
                                                <div class="tbl_cart_product_thumb m-0">
                                                    <img src="admin/<?php echo $imgPath; ?>" class="img-fluid" alt="<?php echo $row['product_name']; ?>">
                                                </div>
                                            </div>
                                        </th>
                                        <td><?php echo $row['order_id']; ?></td>
                                        <td><?php echo $orderDate; ?></td>
                                        <td>₹<?php echo $row['total']; ?></td>
                                        <td><?php echo $row['payment_status']; ?></td>
                                        <td>
                                            <?php if($row['payment_status'] == 'Delivered'): ?>
                                                <a href="order-details.php?id=<?php echo $row['order_id']; ?>" class="btn btn-sm btn-theme">View Order</a>
                                            <?php else: ?>
                                                <a href="order-tracking.php?id=<?php echo $row['order_id']; ?>" class="btn btn-sm btn-theme">Track Order</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">No order history found</td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>                        
            
        </div>
    </div>
</section>
<!-- =========================== My All Orders =================================== -->

			
		<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call_action_wrap-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="call_action_wrap">
                    <div class="call_action_wrap-head">
                        <h3>Stay Connected With Our Temple</h3>
                        <span>Receive updates about upcoming events, festivals, and special offerings</span>
                    </div>
                    <div class="newsletter_box">
                        <form action="subscribe.php" method="post">
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                                <div class="input-group-append">
                                    <button class="btn search_btn" type="submit"><i class="fas fa-arrow-alt-circle-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Call To Action End ================================== -->	


            <!-- ============================ Footer Start ================================== -->
			<?php include('footer.php')?>
			<!-- ============================ Footer End ================================== -->




			
			<!-- cart -->
			<!-- Switcher Start -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="rightMenu">
				<div class="rightMenu-scroll">
					<h4 class="cart_heading">Your cart</h4>
					<button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
					<div class="right-ch-sideBar" id="side-scroll">
						
						<div class="cart_select_items">
							<!-- Single Item -->
							<div class="cart_selected_single">
								<div class="cart_selected_single_thumb">
									<a href="#"><img src="assets/img/product.jpg" class="img-fluid" alt="" /></a>
								</div>
								<div class="cart_selected_single_caption">
									<h4 class="product_title">Mahik Book pro</h4>
									<span class="numberof_item">$15x2</span>
									<a href="#" class="text-danger">Remove</a>
								</div>
							</div>
							<!-- Single Item -->
							<div class="cart_selected_single">
								<div class="cart_selected_single_thumb">
									<a href="#"><img src="assets/img/product.jpg" class="img-fluid" alt="" /></a>
								</div>
								<div class="cart_selected_single_caption">
									<h4 class="product_title">Mahik Book pro</h4>
									<span class="numberof_item">$15x2</span>
									<a href="#" class="text-danger">Remove</a>
								</div>
							</div>
							<!-- Single Item -->
							<div class="cart_selected_single">
								<div class="cart_selected_single_thumb">
									<a href="#"><img src="assets/img/product.jpg" class="img-fluid" alt="" /></a>
								</div>
								<div class="cart_selected_single_caption">
									<h4 class="product_title">Mahik Book pro</h4>
									<span class="numberof_item">$15x2</span>
									<a href="#" class="text-danger">Remove</a>
								</div>
							</div>
						</div>
						
						<div class="cart_subtotal">
							<h6>Subtotal<span class="theme-cl">$120.47</span></h6>
						</div>
						
						<div class="cart_action">
							<ul>
								<li><a href="#" class="btn btn-go-cart btn-theme">View/Edit Cart</a></li>
								<li><a href="#" class="btn btn-checkout">Checkout Now</a></li>
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
											<li><a href="#">Grocery</a></li>
											<li><a href="#">Organic</a></li>
											<li><a href="#">Electronics</a></li>
											<li><a href="#">Fashion</a></li>
											<li><a href="#">Education</a></li>
											<li><a href="#">Beauty</a></li>
											
											<li class="dropdown">
												<a href="#">Digital<span class="ti-angle-left"></span></a>
												<ul class="nav nav-second-level">
													<li><a href="#">Sub Product</a></li>
													<li><a href="#">Sub Product</a></li>
													<li><a href="#">Sub Product</a></li>
													<li><a href="#">Sub Product</a></li>
												</ul>
											</li>
										</ul>
									</li>
									
									<li class="dropdown">
										<a href="#">Brands<span class="ti-angle-left"></span></a>
										<ul class="nav nav-second-level">
											<li><a href="#">Nike</a></li>
											<li><a href="#">Apple</a></li>
											<li><a href="#">Hackerl</a></li>
											<li><a href="#">Tuffan</a></li>
											<li><a href="#">Orio</a></li>
											<li><a href="#">Kite</a></li>
										</ul>
									</li>
									
									<li class="dropdown">
										<a href="#">Products<span class="ti-angle-left"></span></a>
										<ul class="nav nav-second-level">
											<li><a href="#">3 Columns products</a></li>
											<li><a href="#">4 Columns products</a></li>
											<li><a href="#">5 Columns products</a></li>
											<li><a href="#">6 Columns products</a></li>
											<li><a href="#">7 Columns products</a></li>
											<li><a href="#">8 Columns products</a></li>
										</ul>
									</li>
									
									<li><a href="#">About Us</a></li>
									<li><a href="#">Blogs</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Buy Odex</a></li>
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
									<h2 class="woo_pr_title">Profeshional Casual Shirt</h2>
									
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

		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->

	</body>

</html>