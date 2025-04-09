<?php
session_start();
include_once 'dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image_title = mysqli_real_escape_string($conn, $_POST['image_title']);
    
    // File upload handling
    if(isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['gallery_image']['name'];
        $file_tmp = $_FILES['gallery_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Check if file type is allowed
        if(in_array($file_ext, $allowed_types)) {
            // Generate unique filename
            $new_file_name = uniqid() . '.' . $file_ext;
            $upload_path = 'uploads/gallery/' . $new_file_name;
            
            // Create directory if it doesn't exist
            if (!file_exists('uploads/gallery/')) {
                mkdir('uploads/gallery/', 0777, true);
            }
            
            // Move uploaded file
            if(move_uploaded_file($file_tmp, $upload_path)) {
                // Insert into database
                $sql = "INSERT INTO gallery (image_title, image_path) VALUES ('$image_title', '$new_file_name')";
                if(mysqli_query($conn, $sql)) {
                    // Show JavaScript alert then redirect
                    echo "<script>
                        alert('Image added successfully!');
                        window.location.href = 'gallery.php?success=1';
                    </script>";
                    exit();
                } else {
                    $error = "Database error: " . mysqli_error($conn);
                }
            } else {
                $error = "Error uploading file";
            }
        } else {
            $error = "Invalid file type. Allowed types: jpg, jpeg, png, gif";
        }
    } else if(isset($_FILES['gallery_image'])) {
        $error = "Error with file upload. Error code: " . $_FILES['gallery_image']['error'];
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Iskcon Ravet</title>

    <!-- Theme Styles -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/animation.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Font and Icons -->
    <link rel="stylesheet" href="font/fonts.css">
    <link rel="stylesheet" href="icon/style.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
</head>

<body class="body">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Page -->
        <div id="page">
            <!-- Layout Wrap -->
            <div class="layout-wrap">
                
                <!-- Preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /Preload -->

                <!-- Sidebar -->
                <?php include('sidebar.php'); ?>
                <!-- /Sidebar -->

                <!-- Main Content -->
                <div class="section-content-right">

                    <!-- Topbar -->
                    <?php include('topbar.php'); ?>
                    <!-- /Topbar -->

                    <!-- Main Content -->
                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Add Gallery Image</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.php">
                                                <div class="text-tiny">Dashboard</div>
                                            </a>
                                        </li>
                                        <li><i class="icon-chevron-right"></i></li>
                                        <li>
                                            <a href="gallery.php"><div class="text-tiny">Gallery</div></a>
                                        </li>
                                        <li><i class="icon-chevron-right"></i></li>
                                        <li>
                                            <div class="text-tiny">Add Gallery Image</div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- New Gallery Form -->
                                <div class="wg-box">
                                    <?php if(isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <form class="form-new-product form-style-1" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                                        
                                        <!-- Image Title -->
                                        <fieldset class="name">
                                            <div class="body-title">Image Title<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" name="image_title" placeholder="Enter image title" required>
                                        </fieldset>
                                        
                                        <!-- Gallery Image -->
                                        <fieldset class="name">
                                            <div class="body-title">Gallery Image<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="file" name="gallery_image" required>
                                            <div class="text-tiny">Allowed file types: JPG, JPEG, PNG, GIF</div>
                                        </fieldset>

                                        <!-- Submit Button -->
                                        <div class="bot">
                                            <button class="tf-button w208" type="submit">Save</button>
                                        </div>
                                        
                                    </form>
                                </div>
                                <!-- /New Gallery Form -->

                            </div>
                        </div>

                        <!-- Bottom Page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2025 Iskcon Ravet. Design</div>
                          
                            <div class="body-text">by <a href="https://designzfactory.in/">designzfactory</a> All rights reserved.</div>
                        </div>
                        <!-- /Bottom Page -->

                    </div>
                    <!-- /Main Content -->
                </div>
                <!-- /Main Content -->
            </div>
            <!-- /Layout Wrap -->
        </div>
        <!-- /Page -->
    </div>
    <!-- /Wrapper -->

    <!-- JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/zoom.js"></script>
    <script src="js/switcher.js"></script>
    <script src="js/theme-settings.js"></script>
    <script src="js/main.js"></script>

</body>

</html>