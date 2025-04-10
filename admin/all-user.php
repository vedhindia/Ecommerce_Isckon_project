<?php
session_start();
include_once 'dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}

// Initialize search parameter
$search = '';
if(isset($_GET['name']) && !empty($_GET['name'])) {
    $search = $_GET['name'];
}

// Pagination setup
$limit = 10; // number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Get total records for pagination
$countQuery = "SELECT COUNT(*) as total FROM users";
if(!empty($search)) {
    $countQuery .= " WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
}
$countResult = mysqli_query($conn, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRecords / $limit);

// Query to fetch users
$query = "SELECT * FROM users";
if(!empty($search)) {
    $query .= " WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
}
$query .= " ORDER BY id DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Iskcon Ravet</title>

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

    <style>
        .wg-table.table-all-user .user-item > .flex > div:first-child {
          width: 192px;
          flex-shrink: 0;
}
    </style>
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
                                    <h3>All User</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="dashboard.php"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">User</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">All User</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- all-user -->
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search" method="GET" action="">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="<?php echo htmlspecialchars($search); ?>" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="wg-table table-all-user">
    <ul class="table-title flex gap20 mb-14">
        <li><div class="body-title">User Name</div></li>    
        <li><div class="body-title">Phone</div></li>
        <li><div class="body-title">Email</div></li>
        <li><div class="body-title">Address</div></li>
        <li><div class="body-title">City/State</div></li>
        <li><div class="body-title">Pincode</div></li>
        <!-- <li><div class="body-title">Action</div></li> -->
    </ul>
    <ul class="flex flex-column">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fullName = $row['first_name'] . ' ' . $row['last_name'];
                $city = !empty($row['city']) ? $row['city'] : 'N/A';
                $state = !empty($row['state']) ? $row['state'] : 'N/A';
                $cityState = $city . ' / ' . $state;
        ?>
        <li class="user-item gap14">
            <div class="image">
                <img src="images/avatar/user-6.png" alt="<?php echo htmlspecialchars($fullName); ?>">
            </div>
            <div class="flex items-center justify-between gap20 flex-grow">
                <div class="name">
                    <a href="user-detail.php?id=<?php echo $row['id']; ?>" class="body-title-2"><?php echo htmlspecialchars($fullName); ?></a>
                    <div class="text-tiny mt-3">ID: <?php echo $row['id']; ?></div>
                </div>
                <div class="body-text"><?php echo !empty($row['phone']) ? htmlspecialchars($row['phone']) : 'N/A'; ?></div>
                <div class="body-text"><?php echo !empty($row['email']) ? htmlspecialchars($row['email']) : 'N/A'; ?></div>
                <div class="body-text"><?php echo !empty($row['address']) ? htmlspecialchars($row['address']) : 'N/A'; ?></div>
                <div class="body-text"><?php echo $cityState; ?></div>
                <div class="body-text"><?php echo !empty($row['pincode']) ? htmlspecialchars($row['pincode']) : 'N/A'; ?></div>
            </div>
        </li>
        <?php 
            }
        } else {
        ?>
        <li class="user-item gap14">
            <div class="flex items-center justify-center gap20 flex-grow">
                <div class="body-text">No users found</div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<div class="divider"></div>
<div class="flex items-center justify-between flex-wrap gap10">
    <div class="text-tiny">Showing <?php echo min($limit * $page, $totalRecords); ?> of <?php echo $totalRecords; ?> entries</div>
    <ul class="wg-pagination">
        <li>
            <a href="?page=<?php echo max(1, $page - 1); ?><?php echo !empty($search) ? '&name=' . urlencode($search) : ''; ?>"><i class="icon-chevron-left"></i></a>
        </li>
        <?php
        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $startPage + 4);
        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($i == $page) ? 'class="active"' : '';
        ?>
        <li <?php echo $activeClass; ?>>
            <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&name=' . urlencode($search) : ''; ?>"><?php echo $i; ?></a>
        </li>
        <?php } ?>
        <li>
            <a href="?page=<?php echo min($totalPages, $page + 1); ?><?php echo !empty($search) ? '&name=' . urlencode($search) : ''; ?>"><i class="icon-chevron-right"></i></a>
        </li>
    </ul>
</div>

                                </div>
                                <!-- /all-user -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        <!-- bottom-page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2025 Iskcon Ravet. Design</div>
                           
                            <div class="body-text">by <a href="https://designzfactory.in/">designzfactory</a> All rights reserved.</div>
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