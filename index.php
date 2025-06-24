<?php
include_once './conn.php';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>JMK Enterprises - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />
    <link href="assets/css/custom.min.css" rel="stylesheet" />
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Optional Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div class="auth-page-content"
        style="background: linear-gradient(to right, #1A2980, #26D0CE); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h4 class="text-primary" style="font-size: 40px;">JMK Enterprises</h4>
                                <p class="text-muted" style="font-size: 18px;">Login in to continue</p>
                            </div>

                            <div class="text-center text-danger mb-3" style="font-size: 17px;">
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

                            <form action="data/data_login.php" method="post">
                                <div class="mb-3 input-group">
                                    <span class="input-group-text bg-primary text-white"><i class="ri-user-line"></i></span>
                                    <input type="text" name="a_username" class="form-control" placeholder="Enter username"
                                        style="height: 55px; font-size: 16px;" required>
                                </div>

                                <div class="mb-4 input-group">
                                    <span class="input-group-text bg-primary text-white"><i class="ri-lock-line"></i></span>
                                    <input type="password" name="a_password" class="form-control" placeholder="Enter password"
                                        style="height: 55px; font-size: 16px;" required>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-success" type="submit"
                                        style="height: 55px; font-size: 18px;">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer mt-auto bg-light py-3" style="position: fixed; bottom: 0; left: 0; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-start">
                        <p class="mb-0 text-muted text-center ">&copy;
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
    <script src="assets/js/plugins.js"></script>
</body>

</html>
