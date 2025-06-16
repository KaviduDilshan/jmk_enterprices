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

                <div class="col-lg-6 mb-3">
                    <label for="deb_amount" class="form-label m-0 fw-normal" style="font-size:17px;">Product Barcode </label>
                    <input type="text" name="nic" id="cus_image" class="form-control pt-1 pb-1 bg-dark-subtle "
                        style="height: 50px; font-size: 17px;" readonly>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="customer_name" class="form-label m-0 fw-normal" style="font-size:17px;">Product
                            Name </label>
                        <input type="text" name="customer_name" id="customer_name"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_city" class="form-label m-0 fw-normal" style="font-size:17px;">Product
                            Discription</label>
                        <input type="text" name="customer_city" id="customer_city"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="customer_address" class="form-label m-0 fw-normal"
                            style="font-size:17px;">Quantity</label>
                        <input type="text" name="customer_address" id="customer_address"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_mobile" class="form-label m-0 fw-normal" style="font-size:17px;">sale_method </label>
                        <input type="number" name="customer_mobile" id="customer_mobile"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="inputName2" class="form-label m-0 fw-normal" style="font-size:17px;">discount</label>
                        <input name="customer_gender" id="customer_gender"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_birthdate" class="form-label m-0 fw-normal" style="font-size:17px;">wallsall_price</label>
                        <input type="text" name="customer_birthdate" id="customer_birthdate"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size:17px;">dealer_price</label>
                        <input type="text" name="customer_status" id="customer_status"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size:17px;">unit_price</label>
                        <input type="text" name="customer_status" id="customer_status"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size:17px;">exp_date</label>
                        <input type="text" name="customer_status" id="customer_status"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size:17px;">status</label>
                        <input type="text" name="customer_status" id="customer_status"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size:17px;">max_discount</label>
                        <input type="text" name="customer_status" id="customer_status"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size:17px;">model</label>
                        <input type="text" name="customer_status" id="customer_status"
                            class="form-control pt-1 pb-1 bg-dark-subtle " style="height: 50px; font-size: 17px;" readonly>
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