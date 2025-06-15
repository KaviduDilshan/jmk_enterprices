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

    <link rel="stylesheet" href="assets/css/dashboad.css">
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

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100">
                <li class="nav-item px-4">
                    <a class="nav-link" href="#" style="font-size:35px; color:white;">JMK ENTERPRISES</a>
                </li>
                <li class="nav-item ms-auto p-2">
                    <a class="btn btn-danger" href="index.php" style="font-size: 20px;">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- ✅ Card with Buttons -->
    <div class="container mt-4">
        <div class="card shadow-lg p-4 rounded">
            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <a class="btns btn-primary btn-block" href="cus_registration.php">Customer Ragistration</a>
                </div>
                <div class="col-md-6 mb-4">
                    <a class="btns btn-primary btn-block" href="cus_view.php">Customer<br>View</a>
                </div>
            </div>
            +
            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <a class="btns btn-primary btn-block" href="order.php"> Make Order</a>
                </div>
                <div class="col-md-6 mb-4">
                    <a class="btns btn-primary btn-block" href="order_view.php">Oder view</a>
                </div>
            </div>

        </div>
    </div>


    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> JMK Enterprises. Developed by
                            <a href="www.tritcal.com">Tritcal International (Pvt.) Ltd</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->




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