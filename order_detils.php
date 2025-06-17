<?php

include_once './conn.php';
$pro_id = $_GET["id"];
$query = "SELECT * FROM products WHERE pro_id=$pro_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
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

    <link rel="stylesheet" href="assets/css/cus_registration.css">
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

</head>

<body>


    <div class="">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item px-4">
                        <a class="nav-link" href="#" style="font-size:35px; color:white;">Product details</a>
                    </li>
                    <li class="nav-item ms-auto p-2">
                        <a class="btn btn-danger" href="index.php" style="font-size: 20px;">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="card shadow-lg p-4 rounded">

            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" name="update_members">

                

                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Product Name</label>
                        <input type="text" name="product_name" value="<?= $row["product_name"]; ?>" id="product_name"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Product Description</label>
                        <input type="text" name="description" value="<?= $row["product_description"]; ?>" id="description"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                    <label class="form-label m-0 fw-normal" style="font-size:17px;">Product Barcode</label>
                    <input type="text" name="barcode" id="barcode" value="<?= $row["barcode"]; ?>"
                        class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
                </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Quantity</label>
                        <input type="text" name="quantity" value="<?= $row["quantity"]; ?>" id="quantity"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Sale Method</label>
                        <input type="text" name="sale_method" value="<?= $row["product_method"]; ?>" id="sale_method"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Discount</label>
                        <input type="text" name="discount" value="<?= $row["discount"]; ?>" id="discount"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Wholesale Price</label>
                        <input type="text" name="wallsall_price" value="<?= $row["wallsall_price"]; ?>"
                            id="wholesale_price" class="form-control pt-1 pb-1 bg-dark-subtle"
                            style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Dealer Price</label>
                        <input type="text" name="dealer_price" value="<?= $row["dealer_price"]; ?>" id="dealer_price"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Unit Price</label>
                        <input type="text" name="unit_price" value="<?= $row["unit_price"]; ?>" id="unit_price"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Expiry Date</label>
                        <input type="text" name="exp_date" value="<?= $row["exp_date"]; ?>" id="exp_date"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Status</label>
                        <input type="text" name="status" value="<?= $row["status"]; ?>" id="exp_date"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Max Discount</label>
                        <input type="text" name="max_discount" value="<?= $row["max_discount"]; ?>" id="max_discount"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="form-label m-0 fw-normal" style="font-size:17px;">Model</label>
                        <input type="text" name="model" value="<?= $row["model"]; ?>" id="model"
                            class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;"
                            readonly>
                    </div>
                </div>
    </form>
    </div>
    </div>
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