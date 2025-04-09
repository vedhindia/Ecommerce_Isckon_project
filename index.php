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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <title>Iskcon Ravet</title>

    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">

</head>

<style>

</style>

<body class="grocery-theme">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>


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


        <!-- ======================== Banner Start ==================== -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/img/banner-4.png" alt="First slide">
                    <div class="carousel-caption banner_caption light">
                        <h4>Get <span class="theme-cl">Free Deliver</span> Your Order At Home</h4>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores.</p>
                        <a href="search-sidebar.html" class="btn btn-theme">Order Now</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/img/banner-5.png" alt="First slide">
                    <div class="carousel-caption banner_caption light">
                        <h4>Get <span class="theme-cl">Fresh</span> Fruits & Vegetables </h4>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores.</p>
                        <a href="search-sidebar.html" class="btn btn-theme">Order Now</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/img/banner-6.png" alt="First slide">
                    <div class="carousel-caption banner_caption">
                        <h4>Fresh Fruits in <span class="theme-cl">Your City</span> with Free Deliver</h4>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores.</p>
                        <a href="search-sidebar.html" class="btn btn-theme">Order Now</a>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- ======================== Banner End ==================== -->







        <!-- ======================== Choose Category Start ==================== -->
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="owl-carousel category-slider owl-theme">

                            <!-- Category: Festivals -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-calendar3 text-primary" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Festivals</h6>
                                </div>
                            </div>

                            <!-- Category: Donate -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-heart-fill text-danger" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Donate</h6>
                                </div>
                            </div>

                            <!-- Category: Sale -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-tags-fill text-success" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Sale</h6>
                                </div>
                            </div>

                            <!-- Category: Clothing -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-shop text-info" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Clothing</h6>
                                </div>
                            </div>

                            <!-- Category: Gifts -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-gift-fill text-warning" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Gifts</h6>
                                </div>
                            </div>

                            <!-- Category: Festivals -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-calendar3 text-primary" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Festivals</h6>
                                </div>
                            </div>

                            <!-- Category: Donate -->
                            <div class="item">
                                <div class="woo_category_box border text-center p-4 rounded shadow-sm">
                                    <i class="bi bi-heart-fill text-danger" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-0">Donate</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================== Choose Category End ==================== -->


        <!-- ======================== ALL PRODUCTS ==================== -->
        <section class="pt-0">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="sec-heading-flex pl-2 pr-2">
                            <div class="sec-heading-flex-one">
                                <h2>Added new Products</h2>
                            </div>
                            <div class="sec-heading-flex-last">
                                <a href="product_all.php" class="btn btn-theme">View More<i
                                        class="ti-arrow-right ml-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="owl-carousel products-slider owl-theme">
                            <?php
                include 'admin/dbconnection.php';

                $sql = "SELECT 
                            p.*, 
                            GROUP_CONCAT(DISTINCT pi.image_path) AS images,
                            COALESCE(MIN(pu.price), 0) AS product_price,
                            sc.category_name AS main_category_name,
                            sc.subcategory_name AS sub_category_name
                        FROM 
                            products p
                        LEFT JOIN 
                            product_images pi ON p.id = pi.product_id
                        LEFT JOIN 
                            product_units pu ON p.id = pu.product_id
                        LEFT JOIN 
                            subcategories sc ON (p.main_category = sc.category_name AND p.subcategory = sc.subcategory_name)
                        GROUP BY 
                            p.id";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $images = explode(',', $row['images']);
                        $image_path = !empty($images[0]) ? 'admin/' . $images[0] : 'assets/img/product/1.jpg';
                ?>
                            <!-- Single Item -->
                            <div class="item">
                                <div class="woo_product_grid">
                                    <span class="woo_pr_tag hot"><?php echo $row["availability"]; ?></span>
                                    <div class="woo_product_thumb">
                                        <img src="<?php echo $image_path; ?>" class="img-fluid"
                                            alt="<?php echo $row['product_name']; ?>"
                                            onerror="this.onerror=null; this.src='assets/img/product/1.jpg';">
                                    </div>
                                    <div class="woo_product_caption center">
                                        <div class="woo_rate">
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="woo_title">
                                            <h4 class="woo_pro_title">
                                                <a href="detail-1.html"><?php echo $row['product_name']; ?></a>
                                            </h4>
                                        </div>
                                        <div class="woo_price">
                                            <h6>₹<?php echo number_format($row['product_price'], 2); ?>
                                                <span class="less_price"><?php echo $row['id']; ?></span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="woo_product_cart hover">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#viewproduct-over" class="woo_cart_btn btn_cart"
                                                    data-product-id="<?php echo $row['id']; ?>">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="add-to-cart.php?id=<?php echo $row['id']; ?>"
                                                    class="woo_cart_btn btn_view">
                                                    <i class="ti-shopping-cart"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="woo_cart_btn btn_save wishlist-btn"
                                                    data-product-id="<?php echo $row['id']; ?>">
                                                    <i class="ti-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">Data Not Found!</div>';
                }
                ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- ======================== ALL PRODUCTS End ==================== -->




        <!-- Product View -->
        <div class="modal fade" id="viewproduct-over" tabindex="-1" role="dialog" aria-labelledby="add-payment"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" id="view-product">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <!-- Product Gallery -->
                                <div class="product-gallery-wrap">
                                    <!-- Loading State -->
                                    <div class="sp-loading">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <p class="mt-2">Loading Images...</p>
                                    </div>

                                    <!-- Main Gallery -->
                                    <div class="product-gallery">
                                        <div class="swiper-container gallery-main">
                                            <div class="swiper-wrapper">
                                                <!-- Main images will be loaded here -->
                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>

                                        <!-- Thumbnails -->
                                        <div class="swiper-container gallery-thumbs">
                                            <div class="swiper-wrapper">
                                                <!-- Thumbnail images will be loaded here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="woo_pr_detail">
                                    <div class="woo_cats_wrps">
                                        <a href="#" class="woo_pr_cats" id="quick-view-category">Category</a>
                                        <span class="woo_pr_trending" id="quick-view-availability">In Stock</span>
                                    </div>
                                    <h2 class="woo_pr_title" id="quick-view-title">Product Title</h2>

                                    <div class="woo_pr_reviews">
                                        <div class="woo_pr_rating">
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star filled"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>

                                    <div class="woo_pr_price">
                                        <div class="woo_pr_offer_price">
                                            <h3>₹<span id="quick-view-discount-price">0.00</span>
                                                <span class="org_price">₹<span id="quick-view-price">0.00</span></span>
                                            </h3>
                                        </div>
                                    </div>

                                    <div class="woo_pr_short_desc">
                                        <p id="quick-view-description">Loading...</p>
                                    </div>

                                    <div id="product-units-container">
                                        <!-- Units will be loaded here -->
                                    </div>

                                    <div class="woo_pr_color flex_inline_center mb-3">
                                        <div class="woo_pr_varient">
                                            <h6>Weight:</h6>
                                        </div>
                                        <div class="woo_colors_list pl-3">
                                            <span id="quick-view-weight">Loading...</span>
                                        </div>
                                    </div>

                                    <div class="woo_pr_color flex_inline_center mb-3">
                                        <div class="woo_pr_varient">
                                            <h6>Dimensions:</h6>
                                        </div>
                                        <div class="woo_colors_list pl-3">
                                            <span id="quick-view-dimensions">Loading...</span>
                                        </div>
                                    </div>

                                    <div class="woo_pr_color flex_inline_center mb-3">
                                        <div class="woo_pr_varient">
                                            <h6>Country of Origin:</h6>
                                        </div>
                                        <div class="woo_colors_list pl-3">
                                            <span id="quick-view-origin">Loading...</span>
                                        </div>
                                    </div>

                                    <div class="woo_btn_action">
                                        <div class="col-12 col-lg-auto">
                                            <input type="number" id="quick-view-quantity"
                                                class="form-control mb-2 full-width" value="1" min="1" />
                                        </div>
                                    </div>

                                    <div class="woo_btn_action">
                                        <div class="col-12 col-lg-auto">
                                            <button type="button" class="btn btn-block btn-dark mb-2 add-to-cart-btn">
                                                Add to Cart <i class="ti-shopping-cart-full ml-2"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 col-lg-auto">
                                            <button type="button"
                                                class="btn btn-gray btn-block mb-2 add-to-wishlist-btn wishlist-btn"
                                                data-product-id="<?php echo $row['id']; ?>">
                                                Wishlist <i class="ti-heart ml-2"></i>
                                            </button>
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

        <!-- ======================== Tag & Explore End ==================== -->
        <section class="image-bg" style="background:url(assets/img/middle-banner.jpg) no-repeat;">
            <div class="ht-60"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="tags_explore text-center">
                            <h2 class="mb-0">Best Deal of The Month</h2>
                            <p>Explore Your Offers with Odex
                            <p>
                                <a href="search-sidebar.html" class="btn btn-light">Explore Your Order</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ht-60"></div>
        </section>
        <!-- ======================== Tag & Explore End ==================== -->



        <!-- ======================== Offer Banner Start ==================== -->
        <section class="offer-banner-wrap gray">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="owl-carousel banner-offers owl-theme">

                            <!-- Single Item -->
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="assets/img/offer-1.jpg" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <p>10% Off</p>
                                            <div class="offer_title">Good Deals in Your City</div>
                                            <span>Save 10% on All Fruits</span>
                                        </div>
                                        <a href="search-sidebar.html" class="btn offer_box_btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="assets/img/offer-2.jpg" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <p>25% Off</p>
                                            <div class="offer_title">Good Offer on First Time</div>
                                            <span>Save 25% on Fresh Vegetables</span>
                                        </div>
                                        <a href="search-sidebar.html" class="btn offer_box_btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="assets/img/offer-3.jpg" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <p>30% Off</p>
                                            <div class="offer_title">Super Market Deals</div>
                                            <span>Save 30% on Eggs & Dairy</span>
                                        </div>
                                        <a href="search-sidebar.html" class="btn offer_box_btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="assets/img/offer-4.jpg" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <p>15% Off</p>
                                            <div class="offer_title">Better Offer for You</div>
                                            <span>Save More Thank 15%</span>
                                        </div>
                                        <a href="search-sidebar.html" class="btn offer_box_btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="assets/img/offer-5.jpg" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <p>40% Off</p>
                                            <div class="offer_title">Super Market Deals</div>
                                            <span>40% Off on All Dry Foods</span>
                                        </div>
                                        <a href="search-sidebar.html" class="btn offer_box_btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Item -->
                            <div class="item">
                                <div class="offer_item">
                                    <div class="offer_item_thumb">
                                        <div class="offer-overlay"></div>
                                        <img src="assets/img/offer-6.jpg" alt="">
                                    </div>
                                    <div class="offer_caption">
                                        <div class="offer_bottom_caption">
                                            <p>15% Off</p>
                                            <div class="offer_title">Better Offer for You</div>
                                            <span>Drinking is Goodness for Health</span>
                                        </div>
                                        <a href="search-sidebar.html" class="btn offer_box_btn">Explore Now</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <!-- ======================== Offer Banner End ==================== -->







        
<!-- ======================== Gallery ==================== -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="sec-heading-flex pl-2 pr-2">
                    <div class="sec-heading-flex-one">
                        <h2>Gallery</h2>
                    </div>
                    <div class="sec-heading-flex-last">
                        <a href="Gallery.php" class="btn btn-theme">View More<i class="ti-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="owl-carousel products-slider owl-theme">
                    <?php include 'admin/dbconnection.php';
                    $sql = "SELECT * FROM gallery";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <!-- Single Item -->
                    <div class="item">
                        <div class="woo_product_grid">
                            <!-- <span class="woo_pr_tag hot">Hot</span> -->
                            <div class="woo_product_thumb">
                                <img src="admin/uploads/gallery/<?php echo $row['image_path']; ?>" class="img-fluid"
                                    alt="<?php echo $row['image_title']; ?>" />
                            </div>
                            
                            <div class="woo_product_cart hover">
                                <ul>
                                    <li><a href="javascript:void(0);" class="woo_cart_btn btn_cart galleryShowFullImage" 
                                           data-image="admin/uploads/gallery/<?php echo $row['image_path']; ?>"
                                           data-title="<?php echo $row['image_title']; ?>"><i class="ti-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "No images found in gallery";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Image Enlarged View Modal -->
<div class="modal" id="galleryFullImagePopup" tabindex="-1" role="dialog" aria-labelledby="galleryFullImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryFullImageLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="galleryFullSizeImage" class="img-fluid" alt="Gallery Image">
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<!-- ======================== Gallery ==================== -->

<!-- Add this JavaScript at the end of your file, before closing body tag -->
<script>
$(document).ready(function() {
    // When the view icon is clicked
    $('.galleryShowFullImage').on('click', function() {
        // Get image path and title from data attributes
        var imagePath = $(this).data('image');
        var imageTitle = $(this).data('title');
        
        // Set the image source and title in the modal
        $('#galleryFullSizeImage').attr('src', imagePath);
        $('#galleryFullImageLabel').text(imageTitle);
        
        // Show the modal
        $('#galleryFullImagePopup').modal({
            show: true,
            backdrop: true,
            keyboard: true
        });
    });
});
</script>









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
                                        <button class="btn search_btn" type="button"><i
                                                class="fas fa-arrow-alt-circle-right"></i></button>
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
        <?php include('footer.php')?>
        <!-- ============================ Footer End ================================== -->

        <!-- cart -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
            <div class="rightMenu-scroll">
                <h4 class="cart_heading">Your cart</h4>
                <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large"><i
                        class="ti-close"></i></button>
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
        <!-- cart -->

        <!-- Product View -->
        <div class="modal fade" id="viewproduct-over" tabindex="-1" role="dialog" aria-labelledby="add-payment"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="view-product">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <div class="row align-items-center">

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="sp-wrap">
                                    <img src="assets/img/detail/detail-6.png" class="img-fluid rounded" alt="">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="woo_pr_detail">

                                    <div class="woo_cats_wrps">
                                        <a href="#" class="woo_pr_cats">Casual Shirt</a>
                                        <span class="woo_pr_trending">Trending</span>
                                    </div>
                                    <h2 class="woo_pr_title">Fresh Green Pineapple</h2>

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
                                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                                            sed quia consequuntur magni dolores voluptatem quia voluptas sit aspernatur.
                                        </p>
                                    </div>

                                    <div class="woo_pr_color flex_inline_center mb-3">
                                        <div class="woo_pr_varient">
                                            <h6>Size:</h6>
                                        </div>
                                        <div class="woo_colors_list pl-3">
                                            <div class="custom-varient custom-size">
                                                <input type="radio" class="custom-control-input" name="sizeRadio"
                                                    id="sizeRadioOne" value="5" data-toggle="form-caption"
                                                    data-target="#sizeCaption">
                                                <label class="custom-control-label" for="sizeRadioOne">SM</label>
                                            </div>
                                            <div class="custom-varient custom-size">
                                                <input type="radio" class="custom-control-input" name="sizeRadio"
                                                    id="sizeRadioTwo" value="6" data-toggle="form-caption"
                                                    data-target="#sizeCaption">
                                                <label class="custom-control-label" for="sizeRadioTwo">M</label>
                                            </div>
                                            <div class="custom-varient custom-size">
                                                <input type="radio" class="custom-control-input" name="sizeRadio"
                                                    id="sizeRadioThree" value="6.6" data-toggle="form-caption"
                                                    data-target="#sizeCaption">
                                                <label class="custom-control-label" for="sizeRadioThree">L</label>
                                            </div>
                                            <div class="custom-varient custom-size">
                                                <input type="radio" class="custom-control-input" name="sizeRadio"
                                                    id="sizeRadioFour" value="7" data-toggle="form-caption"
                                                    data-target="#sizeCaption" checked>
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
                                                <input type="radio" class="custom-control-input" name="colorRadio"
                                                    id="red" value="5" data-toggle="form-caption"
                                                    data-target="#colorCaption">
                                                <label class="custom-control-label" for="red">5</label>
                                            </div>
                                            <div class="custom-varient custom-color green">
                                                <input type="radio" class="custom-control-input" name="colorRadio"
                                                    id="green" value="6" data-toggle="form-caption"
                                                    data-target="#colorCaption">
                                                <label class="custom-control-label" for="green">6</label>
                                            </div>
                                            <div class="custom-varient custom-color purple">
                                                <input type="radio" class="custom-control-input" name="colorRadio"
                                                    id="purple" value="6.6" data-toggle="form-caption"
                                                    data-target="#colorCaption" checked>
                                                <label class="custom-control-label" for="purple">6.5</label>
                                            </div>
                                            <div class="custom-varient custom-color yellow">
                                                <input type="radio" class="custom-control-input" name="colorRadio"
                                                    id="yellow" value="7" data-toggle="form-caption"
                                                    data-target="#colorCaption">
                                                <label class="custom-control-label" for="yellow">7</label>
                                            </div>
                                            <div class="custom-varient custom-color blue">
                                                <input type="radio" class="custom-control-input" name="colorRadio"
                                                    id="blue" value="6" data-toggle="form-caption"
                                                    data-target="#colorCaption">
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
                                            <button type="submit" class="btn btn-block btn-dark mb-2">Add to Cart <i
                                                    class="ti-shopping-cart-full ml-2"></i></button>
                                        </div>
                                        <div class="col-12 col-lg-auto">
                                            <button class="btn btn-gray btn-block mb-2" data-toggle="button">Wishlist <i
                                                    class="ti-heart ml-2"></i></button>
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
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <script>
    function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }

    function closeRightMenu() {
        document.getElementById("rightMenu").style.display = "none";
    }
    </script>

    <style>
    /* Modal Styles */
    .modal-lg {
        max-width: 900px;
    }

    .modal-content {
        border-radius: 8px;
        overflow: hidden;
    }

    /* Product Gallery Styles */
    .product-gallery-wrap {
        position: relative;
        margin-bottom: 30px;
    }

    .sp-loading {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .gallery-main {
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .gallery-main .swiper-slide {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .gallery-main img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .gallery-thumbs {
        height: 100px;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .gallery-thumbs .swiper-slide {
        height: 100%;
        opacity: 0.4;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .gallery-thumbs .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-thumbs .swiper-slide-thumb-active {
        opacity: 1;
        border-color: #007bff;
    }

    /* Navigation Buttons */
    .swiper-button-next,
    .swiper-button-prev {
        background-color: rgba(0, 0, 0, 0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: #fff;
        transition: all 0.3s ease;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Product Info Styles */
    .woo_pr_detail {
        padding: 20px 0;
    }

    .woo_pr_title {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .woo_pr_price {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .org_price {
        text-decoration: line-through;
        color: #999;
        font-size: 0.8em;
        margin-left: 10px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .modal-lg {
            max-width: 95%;
            margin: 10px;
        }

        .gallery-main .swiper-slide {
            height: 300px;
        }

        .gallery-thumbs {
            height: 80px;
        }

        .gallery-thumbs .swiper-slide {
            width: 80px;
        }
    }

    /* Add these new styles for the wishlist button */
    .woo_cart_btn.btn_save {
        background: #fff;
        transition: all 0.3s ease;
    }

    .woo_cart_btn.btn_save.active {
        background: #ff0000 !important;
        border-color: #ff0000 !important;
    }

    .woo_cart_btn.btn_save.active i {
        color: #ffffff !important;
    }

    .wishlist-btn {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .wishlist-btn.active {
        color: #ff0000;
    }
    </style>

    <script>
    $(document).ready(function() {
        let galleryThumbs = null;
        let galleryMain = null;

        // Clean up function for Swiper instances
        function cleanupSwipers() {
            if (galleryMain) {
                galleryMain.destroy();
                galleryMain = null;
            }
            if (galleryThumbs) {
                galleryThumbs.destroy();
                galleryThumbs = null;
            }
        }

        // Reset modal content
        function resetModal() {
            $('.gallery-main .swiper-wrapper').empty();
            $('.gallery-thumbs .swiper-wrapper').empty();
            $('#product-units-container').empty();
            $('#quick-view-title').text('Loading...');
            $('#quick-view-description').text('Loading...');
            $('#quick-view-price').text('0.00');
            $('#quick-view-discount-price').text('0.00');
            $('.sp-loading').show();
        }

        // Initialize Swiper sliders
        function initializeSliders() {
            return new Promise((resolve) => {
                setTimeout(() => {
                    try {
                        galleryThumbs = new Swiper('.gallery-thumbs', {
                            spaceBetween: 10,
                            slidesPerView: 4,
                            freeMode: true,
                            watchSlidesProgress: true,
                            breakpoints: {
                                320: {
                                    slidesPerView: 3,
                                },
                                480: {
                                    slidesPerView: 4,
                                }
                            }
                        });

                        galleryMain = new Swiper('.gallery-main', {
                            spaceBetween: 10,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            thumbs: {
                                swiper: galleryThumbs
                            },
                            zoom: {
                                maxRatio: 2,
                            }
                        });

                        resolve(true);
                    } catch (error) {
                        console.error('Error initializing Swiper:', error);
                        resolve(false);
                    }
                }, 300);
            });
        }

        // Quick view button click handler
        $('.btn_cart').on('click', async function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');

            // Store product ID in modal for later use
            $('#viewproduct-over').data('product-id', productId);

            // Reset modal state
            cleanupSwipers();
            resetModal();

            try {
                const response = await $.ajax({
                    url: 'get-product-details.php',
                    type: 'GET',
                    data: {
                        id: productId
                    },
                    dataType: 'json'
                });

                if (response.success && response.product) {
                    const product = response.product;
                    console.log('Product data:', product); // Debug log

                    // Update product details
                    $('#quick-view-title').text(product.name || 'No Name Available');
                    $('#quick-view-description').text(product.description ||
                        'No description available');
                    $('#quick-view-availability').text(product.availability || 'Status unknown');
                    $('#quick-view-price').text(product.price || '0.00');
                    $('#quick-view-discount-price').text(product.discount_price || '0.00');
                    $('#quick-view-weight').text(product.weight || 'N/A');
                    $('#quick-view-dimensions').text(product.dimensions || 'N/A');
                    $('#quick-view-origin').text(product.country_origin || 'N/A');

                    // Store product ID in add to cart button
                    $('.add-to-cart-btn').data('product-id', productId);

                    // Update units if available
                    if (product.has_multiple_units && product.units && product.units.length > 0) {
                        const unitsHtml = `
								<div class="woo_pr_color flex_inline_center mb-3">
									<div class="woo_pr_varient"><h6>Select Unit:</h6></div>
									<div class="woo_colors_list pl-3">
										${product.units.map((unit, index) => `
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" name="unitRadio" 
													id="unit${unit.id}" value="${unit.id}" 
													data-price="${unit.price}" ${index === 0 ? 'checked' : ''}>
												<label class="custom-control-label" for="unit${unit.id}">
													${unit.unit_value} ${unit.unit_type} - ₹${unit.price}
												</label>
											</div>
										`).join('')}
									</div>
								</div>`;
                        $('#product-units-container').html(unitsHtml);

                        // Store whether the product has units
                        $('.add-to-cart-btn').data('has-units', true);
                    } else {
                        $('#product-units-container').empty();
                        $('.add-to-cart-btn').data('has-units', false);
                    }

                    // Update images
                    if (product.images && product.images.length > 0) {
                        console.log('Processing images:', product.images); // Debug log

                        const mainHtml = product.images.map(image => {
                            // Check if the image path is already correct
                            const imagePath = image.includes('admin/') ? image :
                                `admin/${image}`;
                            console.log('Main image path:', imagePath); // Debug log

                            return `
									<div class="swiper-slide">
										<div class="gallery-image-wrapper">
											<img src="${imagePath}" class="img-fluid" alt="${product.name}"
												 onerror="this.onerror=null; this.src='assets/img/product/1.jpg'; console.log('Image failed to load:', this.src);">
										</div>
									</div>
								`;
                        }).join('');

                        const thumbsHtml = product.images.map(image => {
                            // Check if the image path is already correct
                            const imagePath = image.includes('admin/') ? image :
                                `admin/${image}`;
                            console.log('Thumbnail image path:', imagePath); // Debug log

                            return `
									<div class="swiper-slide">
										<div class="gallery-thumb-wrapper">
											<img src="${imagePath}" class="img-fluid" alt="${product.name}"
												 onerror="this.onerror=null; this.src='assets/img/product/1.jpg'; console.log('Thumbnail failed to load:', this.src);">
										</div>
									</div>
								`;
                        }).join('');

                        $('.gallery-main .swiper-wrapper').html(mainHtml);
                        $('.gallery-thumbs .swiper-wrapper').html(thumbsHtml);
                    } else {
                        console.log('No images found, using default'); // Debug log
                        const defaultHtml = `
								<div class="swiper-slide">
									<div class="gallery-image-wrapper">
										<img src="assets/img/product/1.jpg" class="img-fluid" alt="${product.name}">
									</div>
								</div>`;
                        $('.gallery-main .swiper-wrapper').html(defaultHtml);
                        $('.gallery-thumbs .swiper-wrapper').html(defaultHtml);
                    }

                    // Add CSS for image wrappers
                    const styleElement = document.createElement('style');
                    styleElement.textContent = `
							.gallery-image-wrapper {
								width: 100%;
								height: 100%;
								display: flex;
								align-items: center;
								justify-content: center;
								background: #fff;
							}
							.gallery-image-wrapper img {
								max-width: 100%;
								max-height: 100%;
								object-fit: contain;
							}
							.gallery-thumb-wrapper {
								width: 100%;
								height: 100%;
								display: flex;
								align-items: center;
								justify-content: center;
								background: #fff;
							}
							.gallery-thumb-wrapper img {
								width: 100%;
								height: 100%;
								object-fit: cover;
							}
						`;
                    document.head.appendChild(styleElement);

                    // Initialize sliders
                    await initializeSliders();

                    // Hide loading indicator
                    $('.sp-loading').hide();
                } else {
                    throw new Error(response.message || 'Error loading product details');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error loading product details. Please try again.');
                $('.sp-loading').hide();
            }
        });

        // Clean up when modal is closed
        $('#viewproduct-over').on('hidden.bs.modal', function() {
            cleanupSwipers();
            // Clear stored product ID
            $(this).removeData('product-id');
            $('.add-to-cart-btn').removeData('product-id');
        });

        // Update price when unit is selected
        $(document).on('change', 'input[name="unitRadio"]', function() {
            const price = $(this).data('price');
            if (price) {
                const discountPrice = price * 0.85; // 15% discount
                $('#quick-view-price').text(price.toFixed(2));
                $('#quick-view-discount-price').text(discountPrice.toFixed(2));
            }
        });

        // Function to check wishlist status
        function checkWishlistStatus(productId) {
            $.get('check-wishlist.php', {
                product_id: productId
            }, function(response) {
                if (response.success && response.in_wishlist) {
                    $(`.wishlist-btn[data-product-id="${productId}"]`).addClass('active');
                    $(`.woo_cart_btn.btn_save[data-product-id="${productId}"]`).addClass('active');
                }
            });
        }

        // Function to add to wishlist
        function addToWishlist(productId) {
            $.post('add-to-wishlist.php', {
                product_id: productId
            }, function(response) {
                if (response.success) {
                    $(`.wishlist-btn[data-product-id="${productId}"]`).addClass('active');
                    $(`.woo_cart_btn.btn_save[data-product-id="${productId}"]`).addClass('active');
                    showNotification(response.message, 'success');
                } else {
                    showNotification(response.message, 'error');
                }
            });
        }

        // Check wishlist status for all products on page load
        $('.wishlist-btn, .woo_cart_btn.btn_save').each(function() {
            const productId = $(this).data('product-id');
            checkWishlistStatus(productId);
        });

        // Handle wishlist button clicks
        $(document).on('click', '.wishlist-btn, .woo_cart_btn.btn_save', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            if (productId) {
                addToWishlist(productId);
            } else {
                showNotification('Invalid product ID', 'error');
            }
        });

        // Update modal's wishlist button when modal is shown
        $('#viewproduct-over').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            const productId = button.data('product-id');

            if (productId) {
                // Update the modal's wishlist button with the correct product ID
                $('.add-to-wishlist-btn').data('product-id', productId);
                // Check wishlist status for this product
                checkWishlistStatus(productId);
            }
        });

        // Function to show notifications
        function showNotification(message, type = 'error') {
            const bgColor = type === 'success' ? '#4CAF50' : '#f44336';
            const notification = $('<div>')
                .css({
                    'position': 'fixed',
                    'top': '20px',
                    'right': '20px',
                    'background-color': bgColor,
                    'color': 'white',
                    'padding': '15px',
                    'border-radius': '4px',
                    'z-index': '9999',
                    'max-width': '300px',
                    'box-shadow': '0 2px 5px rgba(0,0,0,0.2)'
                })
                .text(message);

            $('body').append(notification);
            setTimeout(() => notification.fadeOut('slow', function() {
                $(this).remove();
            }), 5000);
        }
    });
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

    <!-- Add to cart functionality -->
    <script>
    function showNotification(message, type = 'error') {
        // You can replace this with a more sophisticated notification system
        const bgColor = type === 'success' ? '#4CAF50' : '#f44336';
        const notification = $('<div>')
            .css({
                'position': 'fixed',
                'top': '20px',
                'right': '20px',
                'background-color': bgColor,
                'color': 'white',
                'padding': '15px',
                'border-radius': '4px',
                'z-index': '9999',
                'max-width': '300px',
                'box-shadow': '0 2px 5px rgba(0,0,0,0.2)'
            })
            .text(message);

        $('body').append(notification);
        setTimeout(() => notification.fadeOut('slow', function() {
            $(this).remove();
        }), 5000);
    }

    function addToCart(productId, quantity = 1, unitId = null) {
        if (!productId) {
            showNotification('Invalid product ID');
            return;
        }

        // Show loading state
        const loadingOverlay = $('<div>')
            .css({
                'position': 'fixed',
                'top': '0',
                'left': '0',
                'width': '100%',
                'height': '100%',
                'background': 'rgba(0,0,0,0.5)',
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center',
                'z-index': '9998'
            })
            .append(
                '<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>');

        $('body').append(loadingOverlay);

        $.ajax({
                url: 'add-to-cart.php',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity,
                    unit_id: unitId
                },
                dataType: 'json'
            })
            .done(function(response) {
                console.log('Cart response:', response); // Debug log

                if (response.success) {
                    // Update cart counter
                    $('.cart_counter').text(response.cart_count);

                    // Show success message
                    showNotification(response.message, 'success');

                    // Close modal if open
                    $('#viewproduct-over').modal('hide');
                } else {
                    // Show error message
                    let errorMessage = response.message;
                    if (response.debug_info) {
                        console.error('Debug info:', response.debug_info);
                        errorMessage += '\nPlease try again or contact support if the problem persists.';
                    }
                    showNotification(errorMessage);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    textStatus: textStatus,
                    errorThrown: errorThrown
                });

                let errorMessage = 'Error occurred while adding product to cart. ';
                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage += jqXHR.responseJSON.message;
                } else if (jqXHR.status === 404) {
                    errorMessage += 'Cart service not found.';
                } else if (jqXHR.status === 500) {
                    errorMessage += 'Internal server error.';
                } else {
                    errorMessage += 'Please try again later.';
                }

                showNotification(errorMessage);
            })
            .always(function() {
                // Remove loading overlay
                loadingOverlay.fadeOut('fast', function() {
                    $(this).remove();
                });
            });
    }

    // Add click handler for add to cart buttons in product list
    $(document).on('click', '.btn_view', function(e) {
        e.preventDefault();
        const productId = $(this).closest('a').attr('href').split('=')[1];
        if (!productId) {
            showNotification('Invalid product ID');
            return;
        }
        addToCart(productId);
    });

    // Add click handler for add to cart button in modal
    $(document).on('click', '.add-to-cart-btn', function() {
        const productId = $(this).data('product-id');
        const hasUnits = $(this).data('has-units');
        const quantity = parseInt($('#quick-view-quantity').val()) || 1;
        let unitId = null;

        if (!productId) {
            showNotification('Invalid product ID');
            return;
        }

        if (quantity < 1) {
            showNotification('Please enter a valid quantity');
            return;
        }

        // Check unit selection if product has units
        if (hasUnits) {
            unitId = $('input[name="unitRadio"]:checked').val();
            if (!unitId) {
                showNotification('Please select a unit for this product');
                return;
            }
        }

        addToCart(productId, quantity, unitId);
    });
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</body>

</html>

</body>

</html>