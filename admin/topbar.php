<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}
$username = $_SESSION['admin_session']['username'];
$email = $_SESSION['admin_session']['email'];
$profile_image = $_SESSION['admin_session']['profile_image'];

?>

<!-- The header part -->
<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="index-2.html">
                <img class="" id="logo_header_mobile" alt="" src="images/logo/logo.png" data-light="images/logo/logo.png" data-dark="images/logo/logo-dark.png" data-width="154px" data-height="52px" data-retina="images/logo/logo@2x.png">
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>
            <form class="form-search flex-grow">
                <div class="box-content-search" id="box-content-search">
                    <!-- Content of the search box (can remain unchanged) -->
                </div>
            </form>
        </div>

        <div class="header-grid">
            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="">
                            </span>
                            <span class="flex flex-column">
                                <!-- Display session data here for username (email) -->
                                <?php if (isset($_SESSION['admin_email'])): ?>
                                    <span class="body-title mb-2"><?php echo htmlspecialchars($email); ?></span>
                                <?php else: ?>
                                    <span class="body-title mb-2"><?php echo htmlspecialchars($username); ?></span>
                                <?php endif; ?>
                                <span class="text-tiny"><?php echo htmlspecialchars($email); ?></span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="body-title-2">Inbox</div>
                                <div class="number">27</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-file-text"></i>
                                </div>
                                <div class="body-title-2">Taskboard</div>
                            </a>
                        </li> -->
                        <li>
                            <a href="setting.php" class="user-item">
                                <div class="icon">
                                    <i class="icon-settings"></i>
                                </div>
                                <div class="body-title-2">Change Password</div>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-headphones"></i>
                                </div>
                                <div class="body-title-2">Support</div>
                            </a>
                        </li> -->
                        <!-- Updated Logout link -->
                        <li>
                            <a href="logout.php" class="user-item">  <!-- Points to logout.php -->
                                <div class="icon">
                                    <i class="icon-log-out"></i>
                                </div>
                                <div class="body-title-2">Log out</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
