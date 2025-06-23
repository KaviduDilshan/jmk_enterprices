<?php

include_once './conn.php';
$order_id = isset($_GET["order_id"]) ? base64_decode($_GET["order_id"]) : null;


?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 06:11:16 GMT -->

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
    <nav class="navbar navbar-dark bg-dark ">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 25px; color: white; flex-grow:1;">
                Today orders
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <div class=" card row justify-content-end p-4" style="font-size:20px;">
        <div class="row">
            <?php
            $view_order = "SELECT * FROM hp_sales_order WHERE invoice='$order_id'";
            $view_result = mysqli_query($con, $view_order);
            while ($view_row = mysqli_fetch_array($view_result)) {
                $pro_id = $view_row["pro_id"];
                $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE pro_id='$pro_id'"));
                ?>

                <div class="row align-items-center mb-3">

                    <div class="col-md-12">
                        <h4><?= $product["product_name"]; ?></h4>
                    </div>
                    
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Unit Price:</strong><br>
                                Rs. <?= number_format($view_row['unit_price'], 2) ?>
                            </div>
                            <div class="col-md-4">
                                <strong>Quantity:</strong><br>
                                <?= $view_row['quantity'] ?>
                            </div>
                            <div class="col-md-4">
                                <strong>Total Amount:</strong><br>
                                Rs. <?= number_format($view_row['unit_price'] * $view_row['quantity'], 2) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 d-flex justify-content-end">
                        <a class="btn btn-danger" style="height: 50px; width: 50px;"
                            href="data/remove_hp_item.php?hp_sales_id=<?= base64_encode($view_row["hp_sales_id"]) ?>&order_id=<?= $order_id ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <hr>
                <?php
            }
            ?>
        </div>

        <div class="col-md-12 mb-2">
            <a type="reset" class="btn btn-warning w-100" style="height: 70px; font-size: 25px;"
                href="order.php?order_id=<?= base64_encode($order_id) ?>">cancel</a>
        </div>
    </div>


    <script>
    </script>

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