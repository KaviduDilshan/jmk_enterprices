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



    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 20px; color: white; flex-grow:1;">
                Register New Customer
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 16px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <div class="card shadow-lg p-4 rounded">
        <form action="data/data_customer.php" class="form-horizontal" method="post" enctype="multipart/form-data"
            name="update_members">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label for="deb_amount" class="form-label m-0 fw-normal" style="font-size: 17px;">NIC Number
                        <span class="text-danger">*</span></label>
                    <input type="text" name="nic" id="nic" class="form-control pt-1 pb-1" placeholder="Enter nic"
                        style="height: 50px; font-size: 17px;" required autocomplete="off">
                </div>
                <div class="col-lg-12 mb-3">
                    <label for="customer_name" class="form-label m-0 fw-normal" style="font-size: 17px;">Customer
                        Name <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control pt-1 pb-1"
                        placeholder="Enter customer name" style="height: 50px; font-size: 17px;" required
                        autocomplete="off">
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="customer_city" class="form-label m-0 fw-normal" style="font-size: 17px;">Customer
                        City <span class="text-danger">*</span></label>
                    <input type="text" name="customer_city" id="customer_city" class="form-control pt-1 pb-1"
                        placeholder="Enter city" style="height: 50px; font-size: 17px;" required autocomplete="off">
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="customer_address" class="form-label m-0 fw-normal" style="font-size: 17px;">Address
                        <span class="text-danger">*</span></label>
                    <input type="text" name="customer_address" id="customer_address" class="form-control pt-1 pb-1"
                        placeholder="Enter address" style="height: 50px; font-size: 17px;" required autocomplete="off">
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="customer_mobile" class="form-label m-0 fw-normal" style="font-size: 17px;">Mobile
                        Number (9477777777) <span class="text-danger">*</span></label>
                    <input type="number" name="customer_mobile" id="customer_mobile" class="form-control pt-1 pb-1"
                        placeholder="Enter mobile number" style="height: 50px; font-size: 17px;" required
                        autocomplete="off">
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="inputName2" class="form-label m-0 fw-normal" style="font-size: 17px;">Gender</label>
                    <select name="customer_gender" id="customer_gender" style="height: 50px; font-size: 17px;"
                        class="form-select pt-1 pb-1">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="customer_birthdate" class="form-label m-0 fw-normal" style="font-size: 17px;">Birth
                        Day</label>
                    <input type="date" name="customer_birthdate" style="height: 50px; font-size: 17px;"
                        id="customer_birthdate" class="form-control pt-1 pb-1">
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="deb_amount" class="form-label m-0 fw-normal" style="font-size: 17px;">Profile
                        Pic</label>
                    <input type="file" name="cus_image" id="cus_image" style="height: 50px; font-size: 17px;"
                        class="form-control pt-1 pb-1" value="">
                </div>
            </div>

            <div class="row ">
                <div class="col-md-6 mt-1 ">
                    <a href="dashboad.php" class="ml-1 btn btn-warning bg-gradient waves-effect waves-light w-100  "
                        style="font-size: 17px; ">Cancel & Remove</a>
                </div>
                <div class="col-md-6 mt-1 mb-1 ">
                    <button type="submit" class="ml-1 btn btn-primary bg-gradient waves-effect waves-light w-100 "
                        style="font-size: 17px; ">Save</button><br>
                </div>

            </div>
        </form>
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