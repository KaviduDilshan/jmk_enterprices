<?php

include_once './conn.php';
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

    <link rel="stylesheet" href="assets/css/order.css">
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


    <div class="">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item px-4">
                        <a class="nav-link" href="#" style="font-size:35px; color:white;">Order</a>
                    </li>
                    <li class="nav-item ms-auto p-2">
                        <a class="btn btn-danger" href="dashboad.php" style="font-size: 20px;">back</a>
                        <a class="btn btn-danger" href="index.php" style="font-size: 20px;">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="card shadow-lg p-4 rounded">
            <div class="input-group input-group-lg  mb-4">
                <input type="text" class="form-control " placeholder="Search items ">
                <button class="btn btn-primary p-3" type="submit"><i class="fa fa-search"></i></button>
            </div>


            <div class=" card shadow-lg p-3 rounded m-1 cardsmall">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p>item</p>
                        <p>item</p>
                        <p>item</p>
                        <p>item</p>
                        <p>item</p>
                        <input type="text" name="left_input" class="form-control bg-dark-subtle" placeholder="0.00"
                            readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <p>item</p>
                        <p>item</p>
                        <p>item</p>
                        <p>item</p>
                        <p>item</p>
                        <button type="submit" class="ml-1 btn btn-primary bg-gradient waves-effect waves-light w-100"
                            style="background-color:green;">add</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6  mt-4">
                <h2>Customer type</h2>
                <select name="customer_type" id="customer_status" class="form-select pt-3 pb-3 select"
                    style="font-size: 20px;">
                    <option>Credit Not Accept</option>
                </select>
            </div>

            <div class="card shadow-lg p-3 rounded m-1 cardsmall mt-4">
                <div class="row">
                    <div class="col-md-6 mb-2 text-center">
                        <h2>Total Quantity</h2>
                        <input type="text" name="left_input" class="form-control bg-dark-subtle" placeholder="0.00"
                            readonly>
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <h2>View Today</h2>
                        <a class="ml-1 btn btn-primary bg-gradient waves-effect waves-light w-100" style="background-color:green;"
                            href="today_oder.php">save</a>


                    </div>
                </div>
            </div>

            <div class="row justify-content-end mt-5 mb-3 ">
                <div class="col-md-6 mt-1 text-end">
                    <button type="reset"
                        class="ml-1 btn btn-warning bg-gradient waves-effect waves-light w-100">cacel</button>
                </div>
                <div class="col-md-6 mt-1 text-end">
                    <button type="submit"
                        class="ml-1 btn btn-primary bg-gradient waves-effect waves-light w-100">save</button>
                </div>

            </div>
        </div>
        <!-- footer -->
        <footer class="footer ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> JMK Enterprises.
                                Developed by
                                <a href="www.tritcal.com">Tritcal International (Pvt.) Ltd</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
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