<?php
include_once 'admin/dbconnection.php';

// Cart count
function getInitialCartCount($conn) {
    if (!isset($_SESSION['user_id'])) return 0;
    $user_id = $_SESSION['user_id'];
    $stmt = mysqli_prepare($conn, "SELECT COUNT(DISTINCT product_id) as count FROM cart WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] ?? 0;
}

// Wishlist count
function getWishlistCount($conn) {
    if (!isset($_SESSION['user_id'])) return 0;
    $user_id = $_SESSION['user_id'];
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] ?? 0;
}

$initial_cart_count = getInitialCartCount($conn);
$initial_wishlist_count = getWishlistCount($conn);
?>

<style>
.wishlist-icon {
    position: relative;
    color: #333;
    transition: color 0.3s ease;
}
.wishlist-icon.active {
    color: #ff0000 !important;
}
.wishlist-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #ff0000;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
}
.cart_counter {
    background: #28a745;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    position: absolute;
    top: -5px;
    right: -10px;
}
</style>

<!-- HEADER -->
<div class="header">
    <!-- Topbar -->
    <div class="header_topbar dark">
        <div class="container">
            <div class="row">
                <!-- Left -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                    <ul class="tp-list nbr ml-2">
                        <li class="dropdown dropdown-currency">
                            <a href="#" data-toggle="dropdown">Eng <i class="ml-1 fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">Spanish</a></li>
                                <li><a href="#">Italian</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-currency">
                            <a href="#" data-toggle="dropdown">USD <i class="ml-1 fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">EUR</a></li>
                                <li><a href="#">AUD</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Right -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-8">
                    <div class="topbar_menu">
                        <ul>
                            <li><a href="order.php"><i class="ti-bag"></i> My Account</a></li>
                            <li><a href="order-tracking.html"><i class="ti-location-pin"></i> Track Order</a></li>
                            <li>
                                <a href="wishlist.php" class="wishlist-icon <?php echo $initial_wishlist_count > 0 ? 'active' : ''; ?>">
                                    <i class="ti-heart"></i>
                                    <?php if ($initial_wishlist_count > 0): ?>
                                        <span class="wishlist-count"><?php echo $initial_wishlist_count; ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="general_header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                    <a class="nav-brand" href="index.php">
                        <img src="admin/images/ISKCON_Logo.png" class="logo" alt="Logo" />
                    </a>
                </div>

                <!-- Navigation -->
                <div class="col-lg-7 col-md-7 col-sm-4 col-3">
                    <nav id="navigation" class="navigation navigation-landscape">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div>
                        <div class="nav-menus-wrapper">
                            <ul class="nav-menu">
                                <li class="active"><a href="index.php">Home</a></li>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM categories");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $main_category = $row["main_category"];
                                    $main_category_id = $row["id"];
                                    echo '<li><a href="product.php?main_category=' . urlencode($main_category) . '">' . $main_category . '</a>';

                                    $sub_result = mysqli_query($conn, "SELECT * FROM subcategories WHERE category_id = $main_category_id");
                                    if (mysqli_num_rows($sub_result) > 0) {
                                        echo '<ul class="nav-dropdown nav-submenu">';
                                        while ($sub = mysqli_fetch_assoc($sub_result)) {
                                            echo '<li><a href="product.php?main_category=' . urlencode($main_category) . '&subcategory=' . urlencode($sub["subcategory_name"]) . '">' . $sub["subcategory_name"] . '</a></li>';
                                        }
                                        echo '</ul>';
                                    }

                                    echo '</li>';
                                }
                                ?>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- Right Header Icons -->
                <div class="col-lg-3 col-md-3 col-sm-5 col-5">
                    <div class="general_head_right">
                        <ul>
                            <li><a data-toggle="collapse" href="#mySearch" role="button"><i class="ti-search"></i></a></li>
                            <li><a href="login-signup.php"><i class="ti-user"></i></a></li>
                            <li style="position: relative;">
                                <a href="my-cart.php">
                                    <i class="ti-shopping-cart"></i>
                                    <span class="cart_counter"><?php echo $initial_cart_count; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse" id="mySearch">
                        <div class="blocks search_blocks">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search entire store here...">
                                <div class="input-group-append">
                                    <button class="btn search_btn" type="button"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JS to update cart and wishlist counts dynamically -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function updateCartCount() {
        $.get('get-cart-count.php', function (response) {
            if (response.success) {
                $('.cart_counter').text(response.cart_count);
            }
        }, 'json');
    }

    function updateWishlistCount() {
        $.get('get-wishlist-count.php', function (response) {
            if (response.success) {
                const wishlistIcon = $('.wishlist-icon');
                if (response.wishlist_count > 0) {
                    wishlistIcon.addClass('active');
                    if (!wishlistIcon.find('.wishlist-count').length) {
                        wishlistIcon.append(`<span class="wishlist-count">${response.wishlist_count}</span>`);
                    } else {
                        wishlistIcon.find('.wishlist-count').text(response.wishlist_count);
                    }
                } else {
                    wishlistIcon.removeClass('active');
                    wishlistIcon.find('.wishlist-count').remove();
                }
            }
        }, 'json');
    }

    // Initial load
    updateCartCount();
    updateWishlistCount();

    // Repeat every 5 seconds
    setInterval(updateCartCount, 5000);
    setInterval(updateWishlistCount, 5000);
});
</script>
