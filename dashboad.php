<?php
session_start();
include_once 'conn.php';
// Check if user is logged in
if (!isset($_SESSION['login'])) {
    // If not logged in, redirect to login page
    header("Location: index.php");
    exit();
}

$company = 1;
$a_id = $_SESSION['login'];

$sales_max_id = intval(mysqli_fetch_assoc(mysqli_query($con, "SELECT MAX(sales_id) FROM sales_order "))["MAX(sales_id)"]) + 1;
$trans_max_id = intval(mysqli_fetch_assoc(mysqli_query($con, "SELECT MAX(t_id) FROM transaction"))["MAX(t_id)"]) + 1;
$cash_max_id = intval(mysqli_fetch_assoc(mysqli_query($con, "SELECT MAX(ca_l_id) FROM cash_ledger"))["MAX(ca_l_id)"]) + 1;
$invoice2 = ($sales_max_id * $trans_max_id * $cash_max_id) * mt_rand(100000, 1000000);
$invoice = $a_id . $company . $invoice2;

if (isset($_GET["invoice"]) && $_GET["invoice"] != null) {
    $invoice = $_GET["invoice"];
} else {
    $invoice = $a_id . $company . $invoice2;
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />


</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 25px; color: white; flex-grow:1;">
                JMK ENTERPRISES
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>


    <!-- ✅ Card with Buttons -->
    <div class="card shadow-lg p-4 rounded" style="min-height:100vh">
        <div class="row custom-two-cols text-center mt-2">
            <div class="col-md-6  mb-4 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center"
                    href="cus_registration.php">
                    <img src="assets/images/icons/1.png" style="width: 100px; height: 100px; margin-bottom: 30px;">
                    Customer Registration
                </a>
            </div>

            <div class="col-md-6 mb-4 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center" href="cus_view.php">
                    <img src="assets/images/icons/2.png" style="width: 110px; height: 110px; margin-bottom: 20px;">
                    Customer View</a>
            </div>
        </div>

        <div class="row custom-two-cols text-center mt-2">
            <div class="col-md-6  mb-4 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center"
                    href="guar_register.php">
                    <img src="assets/images/icons/9.png" style="width: 100px; height: 100px; margin-bottom: 30px;">
                    Guarantor Registration
                </a>
            </div>

            <div class="col-md-6 mb-4 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center" href="guar_view.php">
                    <img src="assets/images/icons/6.png" style="width: 100px; height: 100px; margin-bottom: 30px;">
                    Guarantor View</a>
            </div>
        </div>

        <div class="row custom-two-cols text-center mt-2">
            <div class="col-md-6 mb-4 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center"
                    href="order.php?order_id=<?= base64_encode($invoice); ?>">
                    <img src="assets/images/icons/8.png" style="width: 110px; height: 110px; margin-bottom: 30px;">
                    Make Order</a>
            </div>
            <div class="col-md-6 mb-4 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center" href="order_view.php">
                    <img src="assets/images/icons/4.png" style="width: 100px; height: 100px; margin-bottom: 30px;">
                    Order View</a>
            </div>
        </div>

        <div class="row custom-two-cols text-center mt-2">
            <div class="col-md-6 mb-2 d-flex justify-content-center">
                <a class="btns btn-primary text-center d-flex flex-column align-items-center"
                    href="guar_register.php">
                    <img src="assets/images/icons/7.png" style="width: 100px; height: 100px; margin-bottom: 30px;">
                    Installments 
                </a>
            </div>
            
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