<?php

include_once './conn.php';
$gu_id = $_GET["id"];
$query = "SELECT * FROM guarantor WHERE gu_id=$gu_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$guarantor_gen = $row['gender'];


// $sql = "select * from customer where c_id='" . $c_id . "'";
//     $result_customer_view = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result_customer_view);
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


    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 25px; color: white; flex-grow:1;">
                Guarantor Details
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <div class="card shadow-lg p-4 rounded">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <label for="nic" class="form-label m-0 fw-normal" style="font-size: 17px;">NIC Number </label>
                <input type="text" name="nic" id="nic" value="<?= $row["nic"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="customer_name" class="form-label m-0 fw-normal" style="font-size: 17px;">Guarantor Name</label>
                <input type="text" name="guarantor_name" value="<?= $row["guarantor_name"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="customer_city" class="form-label m-0 fw-normal" style="font-size: 17px;">Guarantor City</label>
                <input type="text" name="guarantor_city" id="guarantor_city" value="<?= $row["guarantor_city"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="customer_address" class="form-label m-0 fw-normal"
                    style="font-size: 17px;">Guarantor Address </label>
                <input type="text" name="guarantor_address" id="guarantor_address" value="<?= $row["guarantor_address"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="customer_mobile" class="form-label m-0 fw-normal" style="font-size: 17px;">Mobile Number 01</label>
                <input type="number" name="guarantor_mobile_01" id="guarantor_mobile_01" value="<?= $row["guarantor_mobile_01"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="customer_mobile" class="form-label m-0 fw-normal" style="font-size: 17px;">Mobile Number 02</label>
                <input type="number" name="guarantor_mobile_02" id="guarantor_mobile_02" value="<?= $row["guarantor_mobile_02"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="inputName2" class="form-label m-0 fw-normal" style="font-size:17px;">Gender</label>
                <input name="gender" value="<?php
                if ($guarantor_gen == 1) {
                    echo 'Male';
                }else if($guarantor_gen == 2){
                    echo 'Female';
                } 
                ?>"
                 id="gender" class="form-control pt-1 pb-1 bg-dark-subtle "
                    style="height: 50px; font-size: 17px;" readonly>
            </div>

            <div class="col-lg-12 mb-3">
                <label for="guarantor_birthdate" class="form-label m-0 fw-normal" style="font-size: 17px;">Birth Day</label>
                <input type="date" name="birthdate" id="birthdate" value="<?= $row["birthdate"]; ?>"
                    class="form-control pt-1 pb-1 bg-dark-subtle" style="height: 50px; font-size: 17px;" readonly>
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