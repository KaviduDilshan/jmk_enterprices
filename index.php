<?php

include_once './conn.php';
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 06:11:16 GMT -->

<head>
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
    } else {
        $error = '';
    }
    ?>

<body>

    <meta charset="utf-8" />
    <title>JMK Enterprises</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="stylesheet" href="assets/css/index.css">
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

        
            <!-- auth page content -->
            <div class="auth-page-content" style="background-image: linear-gradient(to right, #1A2980 0%, #2955b4 51%, #298bdb 100%); height:100vh; " >
                <div class="container" >

                    <div class="row justify-content-center ">
                        <div class="col-md-10  col-lg-6 col-xl-7">
                            <div class="card login-card card-bg-fill " style="border-radius: 10px;">
                                <div class="card-body p-4 ">
                                    <div class="text-center mt-2">
                                        <h4 class="text-primary" style="font-size:50px">JMK Enterprises</h4>
                                        <p class="text-muted" style="font-size:20px">Sign in to continue</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form action="data/data_login.php" method="post">

                                            <?php if ($error != '') { ?>
                                                <div class="row">
                                                    <div id="error_display" class=" text-danger">
                                                        <?php
                                                        if ($error == '0') {

                                                            echo "Please fill-in the Username and Password";
                                                        } else if ($error == '1') {
                                                            echo '<script>  swal("Invalid Username/Password", "Account not Active", "error");</script>';
                                                            echo "Invalid Username /Password or Account not Active.";
                                                        } else if ($error == '5') {
                                                            echo '<script>  swal("Invalid Captha Code", "Please Try Agin", "warning");</script>';
                                                            echo "Invalid Captha Code";
                                                        } else if ($error == 6) {
                                                            echo '<script>  swal("Security Alert", "Multiple Login", "warning");</script>';
                                                            echo "Security Alert";
                                                        }
                                            }
                                            ?>

                                                    <div class="mb-3">
                                                        <label for="username" class="form-label"
                                                            style="font-size:20px">Username</label>
                                                        <input type="text" id="a_username" name="a_username"
                                                            class="form-control" placeholder="Enter username">
                                                    </div>

                                                    <div class="mb-3">
                                                        <!-- <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                            </div> -->
                                                        <label class="form-label" for="password-input"
                                                            style="font-size:20px">Password</label>
                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                            <input type="password" id="a_password" name="a_password"
                                                                class="form-control pe-5 password-input"
                                                                placeholder="Enter password">
                                                            <button
                                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                                type="button" id="password-addon"><i
                                                                    class="ri-eye-fill align-middle"></i></button>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div> -->

                                                    <div class="mt-4">
                                                        <button class="btn btn-success w-100"
                                                            type="submit" style="font-size:20px">LogIn</button>
                                                    </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->

            <!-- footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-0 text-muted">&copy;
                                    <script>document.write(new Date().getFullYear())</script> JMK Enterprises. Developed
                                    by
                                    <a href="www.tritcal.com">Tritcal International (Pvt.) Ltd</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->

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