<?php
include_once './conn.php';
$error = isset($_GET['error']) ? $_GET['error'] : '';
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
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />
    <link href="assets/css/custom.min.css" rel="stylesheet" />
</head>

<body>
    <div class="auth-page-content"
        style="background-image: linear-gradient(to right, #1A2980 0%, #2955b4 51%, #298bdb 100%); height:100vh;">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                    <div class="card login-card card-bg-fill" style="border-radius: 10px;">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h4 class="text-primary" style="font-size:50px">JMK Enterprises</h4>
                                <p class="text-muted" style="font-size:20px">Sign in to continue</p>
                                <div id="error_display" class="text-danger text-center" style="font-size:17px;">
                                    <?php
                                    if ($error != '') {
                                        if ($error == '0') {
                                            echo "Please fill-in the Username and Password";
                                        } else if ($error == '1') {
                                            echo '<script>swal("Invalid Username/Password", "Account not Active", "error");</script>';
                                            echo "Invalid Username /Password or Account not Active.";
                                        } else if ($error == '5') {
                                            echo '<script>swal("Invalid Captcha Code", "Please Try Again", "warning");</script>';
                                            echo "Invalid Captcha Code";
                                        } else if ($error == '6') {
                                            echo '<script>swal("Security Alert", "Multiple Login", "warning");</script>';
                                            echo "Security Alert";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="p-2 mt-4">
                                <form action="data/data_login.php" method="post">
                                    <div class="row">
                                        <div class="mb-3">
                                            <input type="text" id="a_username" name="a_username" class="form-control"
                                                placeholder="Enter username"
                                                style="height:60px; font-size:17px;">
                                        </div>
                                        <div class="mb-3">
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" id="a_password" name="a_password"
                                                    class="form-control pe-5 password-input"
                                                    placeholder="Enter password"
                                                    style="height:60px; font-size:17px;">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100"
                                                style="height:60px; font-size:20px;" type="submit">LogIn</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
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
                            <script>document.write(new Date().getFullYear())</script> JMK Enterprises. Developed by
                            <a href="https://www.tritcal.com">Tritcal International (Pvt.) Ltd</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>
