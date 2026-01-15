<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());

    // --- Order Counts ---
    // Today's Orders
    $f1 = "00:00:00";
    $from = date('Y-m-d') . " " . $f1;
    $t1 = "23:59:59";
    $to = date('Y-m-d') . " " . $t1;
    $ret_today = mysqli_query($con, "SELECT count(id) as cnt FROM Orders where orderDate Between '$from' and '$to'");
    $row_today = mysqli_fetch_array($ret_today);
    $todays_orders_cnt = $row_today['cnt'];

    // Pending Orders
    $status = 'Delivered';
    $ret_pending = mysqli_query($con, "SELECT count(id) as cnt FROM Orders where orderStatus!='$status' || orderStatus is null ");
    $row_pending = mysqli_fetch_array($ret_pending);
    $pending_orders_cnt = $row_pending['cnt'];

    // Delivered Orders
    $status = 'Delivered';
    $ret_delivered = mysqli_query($con, "SELECT count(id) as cnt FROM Orders where orderStatus='$status'");
    $row_delivered = mysqli_fetch_array($ret_delivered);
    $delivered_orders_cnt = $row_delivered['cnt'];


    // --- Catalog Counts ---
    // Categories
    $ret_cat = mysqli_query($con, "select count(id) as cnt from category");
    $row_cat = mysqli_fetch_array($ret_cat);
    $category_cnt = $row_cat['cnt'];

    // SubCategories
    $ret_subcat = mysqli_query($con, "select count(id) as cnt from subcategory");
    $row_subcat = mysqli_fetch_array($ret_subcat);
    $subcategory_cnt = $row_subcat['cnt'];

    // Products
    $ret_prod = mysqli_query($con, "select count(id) as cnt from products");
    $row_prod = mysqli_fetch_array($ret_prod);
    $product_cnt = $row_prod['cnt'];


    // --- User Counts ---
    // Registered Users
    $ret_users = mysqli_query($con, "select count(id) as cnt from users");
    $row_users = mysqli_fetch_array($ret_users);
    $user_cnt = $row_users['cnt'];

    // User Logs
    $ret_logs = mysqli_query($con, "select count(id) as cnt from userlog");
    $row_logs = mysqli_fetch_array($ret_logs);
    $log_cnt = $row_logs['cnt'];

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Dashboard</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href="css/admin-premium.css" rel="stylesheet">
        <style>
            /* Local overrides if needed */
        </style>
        <!-- Animate.css for smooth animations -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </head>

    <body>
        <?php include('include/header.php'); ?>

        <div class="dashboard-wrapper full-width">

            <div class="premium-content">

                <div class="container" style="max-width: 1200px; margin: 0 auto; padding-top: 30px;">

                    <!-- Welcome Section with Animation -->
                    <div class="dashboard-welcome">
                        <h2>Welcome Back, Admin!</h2>
                        <p>Here's what's happening in your store today.</p>
                    </div>

                    <div class="premium-content-header animate__animated animate__fadeInLeft">
                        <h1 class="page-title">Store Overview</h1>
                    </div>

                    <!-- Order Management Section -->
                    <div class="section-header animate__animated animate__fadeInRight">Order Management</div>
                    <div class="stats-grid">
                        <a href="todays-orders.php" class="stat-card order animate__animated animate__popIn"
                            style="animation-delay: 0.1s;">
                            <div class="stat-icon"><i class="icon-tasks"></i></div>
                            <div class="stat-label-text">Today's Orders</div>
                            <div class="stat-number"><?php echo htmlentities($todays_orders_cnt); ?></div>
                        </a>
                        <a href="pending-orders.php" class="stat-card order animate__animated animate__popIn"
                            style="animation-delay: 0.2s;">
                            <div class="stat-icon"><i class="icon-tasks"></i></div>
                            <div class="stat-label-text">Pending Orders</div>
                            <div class="stat-number"><?php echo htmlentities($pending_orders_cnt); ?></div>
                        </a>
                        <a href="delivered-orders.php" class="stat-card order animate__animated animate__popIn"
                            style="animation-delay: 0.3s;">
                            <div class="stat-icon"><i class="icon-inbox"></i></div>
                            <div class="stat-label-text">Delivered Orders</div>
                            <div class="stat-number"><?php echo htmlentities($delivered_orders_cnt); ?></div>
                        </a>
                    </div>

                    <!-- Catalog Section -->
                    <div class="section-header animate__animated animate__fadeInRight" style="animation-delay: 0.4s;">
                        Catalog</div>
                    <div class="stats-grid">
                        <a href="category.php" class="stat-card catalog animate__animated animate__popIn"
                            style="animation-delay: 0.5s;">
                            <div class="stat-icon"><i class="icon-folder-close"></i></div>
                            <div class="stat-label-text">Categories</div>
                            <div class="stat-number"><?php echo htmlentities($category_cnt); ?></div>
                        </a>
                        <a href="subcategory.php" class="stat-card catalog animate__animated animate__popIn"
                            style="animation-delay: 0.6s;">
                            <div class="stat-icon"><i class="icon-sitemap"></i></div>
                            <div class="stat-label-text">Sub Categories</div>
                            <div class="stat-number"><?php echo htmlentities($subcategory_cnt); ?></div>
                        </a>
                        <a href="insert-product.php" class="stat-card catalog animate__animated animate__popIn"
                            style="animation-delay: 0.7s;">
                            <div class="stat-icon"><i class="icon-plus"></i></div>
                            <div class="stat-label-text">Insert Product</div>
                            <div class="stat-number"><i class="icon-arrow-right"></i></div>
                        </a>
                        <a href="manage-products.php" class="stat-card catalog animate__animated animate__popIn"
                            style="animation-delay: 0.8s;">
                            <div class="stat-icon"><i class="icon-table"></i></div>
                            <div class="stat-label-text">Products</div>
                            <div class="stat-number"><?php echo htmlentities($product_cnt); ?></div>
                        </a>
                    </div>

                    <!-- Users Section -->
                    <div class="section-header animate__animated animate__fadeInRight" style="animation-delay: 0.9s;">Users
                    </div>
                    <div class="stats-grid">
                        <a href="manage-users.php" class="stat-card user animate__animated animate__popIn"
                            style="animation-delay: 1.0s;">
                            <div class="stat-icon"><i class="icon-group"></i></div>
                            <div class="stat-label-text">Registered Users</div>
                            <div class="stat-number"><?php echo htmlentities($user_cnt); ?></div>
                        </a>
                        <a href="user-logs.php" class="stat-card user animate__animated animate__popIn"
                            style="animation-delay: 1.1s;">
                            <div class="stat-icon"><i class="icon-laptop"></i></div>
                            <div class="stat-label-text">User Logs</div>
                            <div class="stat-number"><?php echo htmlentities($log_cnt); ?></div>
                        </a>
                    </div>
                </div><!-- /.container -->

            </div><!--/.premium-content-->
        </div><!--/.dashboard-wrapper-->

        <?php include('include/footer.php'); ?>

        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    </body>

    </html>
<?php } ?>