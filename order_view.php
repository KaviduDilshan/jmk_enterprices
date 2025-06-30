<?php

include_once './conn.php';
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>JMK Enterprises</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="stylesheet" href="assets/css/cus_view.css">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 25px; color: white; flex-grow:1;">
                Oder View
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <!-- <div class="card shadow-lg p-4 rounded">
        <div class="input-group input-group-lg  mb-4">
            <input type="text" class="form-control " placeholder="Search oder by name " id="productsearch"
                autocomplete="off">
            <button class="btn btn-primary p-3" type="submit"><i class="fa fa-search"></i></button>
        </div> -->


    <div class="card row m-0 p-3" style="font-size:20px;">
        <?php
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");

        // Step 1: Get all today's orders
        $orderQuery = "SELECT * FROM order_save WHERE order_date = '$today' ORDER BY order_time DESC";
        $orderResult = mysqli_query($con, $orderQuery);
        if (mysqli_num_rows($orderResult) > 0) {
            while ($row = mysqli_fetch_array($orderResult)) {
                $order_id = $row["order_id"];
                $c_id = $row['c_id'];
                $customer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `customer` WHERE `c_id`=$c_id"));
                ?>

                <div <?= $row['c_id'] ?> class="product_get text-decoration-none text-dark">
                    <h2 class="customer_name"><strong><?= $customer['customer_name'] ?></strong></h2>
                    <h3 class="bill"><strong>Bill number : </strong><?= $row['os_id'] ?></h3>
                    <h3 class="products"><strong>Products : </strong> <?php
                    $view_order = "SELECT * FROM `hp_sales_order` WHERE `invoice`='$order_id'";
                    $view_result = mysqli_query($con, $view_order);
                    while ($view_row = mysqli_fetch_array($view_result)) {
                        $pro_id = $view_row["pro_id"];
                        $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `products` WHERE `pro_id`='$pro_id'"));
                        echo $product["product_name"] . " (qty-" . (int)$view_row["quantity"] . ") / ";
                    }
                    ?> </h3>
                    <h2 class="total"><strong>Total Price : Rs. </strong> <?= number_format($row["total_price"], 2, '.', ',') ?></h2>
                    <hr>
                </div>
            <?php }
        } else { ?>

            <p>No orders found for today.</p>

        <?php } ?>
    </div>
    <!-- <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('productsearch');
                const customerItems = document.querySelectorAll('.product_get');
 
                searchInput.addEventListener('keyup', function () {
                    const searchTerm = searchInput.value.toLowerCase().trim();

                    customerItems.forEach(function (item) {
                        const name = item.querySelector('.product_name').textContent.toLowerCase();
                        if (name.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        </script> -->



    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>

</body>

</html>