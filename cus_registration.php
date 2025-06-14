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
                        <a class="nav-link" href="#" style="font-size:35px; color:white;">Customer Ragistraion</a>
                    </li>
                    <li class="nav-item ms-auto p-2">
                        <a class="btn btn-danger" href="dashboad.php" style="font-size: 20px;">back</a>
                        <a class="btn btn-danger" href="index.php" style="font-size: 20px;">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="card shadow-lg p-4 rounded">
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data" name="update_members">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="deb_amount" class="form-label m-0 fw-normal" style="font-size: 17px;">NIC Number
                            <span class="text-danger">*</span></label>
                        <input type="text" name="nic" id="cus_image" class="form-control pt-1 pb-1"
                            placeholder="Enter nic" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="customer_name" class="form-label m-0 fw-normal" style="font-size: 17px;">Customer
                            Name <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control pt-1 pb-1"
                            placeholder="Enter customer name" style="height: 50px; font-size: 17px;" required>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_city" class="form-label m-0 fw-normal" style="font-size: 17px;">Customer
                            City <span class="text-danger">*</span></label>
                        <input type="text" name="customer_city" id="customer_city" class="form-control pt-1 pb-1"
                            placeholder="Enter city" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="customer_address" class="form-label m-0 fw-normal" style="font-size: 17px;">Address
                            <span class="text-danger">*</span></label>
                        <input type="text" name="customer_address" id="customer_address" class="form-control pt-1 pb-1"
                            placeholder="Enter address" required>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_mobile" class="form-label m-0 fw-normal" style="font-size: 17px;">Mobile
                            Number (9477777777) <span class="text-danger">*</span></label>
                        <input type="number" name="customer_mobile" id="customer_mobile" class="form-control pt-1 pb-1"
                            placeholder="Enter mobile number" required>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="inputName2" class="form-label m-0 fw-normal" style="font-size: 17px;">Gender</label>
                        <select name="customer_gender" id="customer_gender" class="form-select pt-1 pb-1">
                            <option>Female</option>
                        </select>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_birthdate" class="form-label m-0 fw-normal" style="font-size: 17px;">Birth
                            Day</label>
                        <input type="date" name="customer_birthdate" id="customer_birthdate"
                            class="form-control pt-1 pb-1">
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal"
                            style="font-size: 17px;">Status</label>
                        <select name="customer_status" id="customer_status" class="form-select pt-1 pb-1">
                            <option>Inactive</option>
                        </select>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="customer_status" class="form-label m-0 fw-normal" style="font-size: 17px;">Credit
                            Status</label>
                        <select name="customer_type" id="customer_status" class="form-select pt-1 pb-1">
                            <option>Credit Not Accept</option>
                        </select>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="deb_amount" class="form-label m-0 fw-normal" style="font-size: 17px;">Profile
                            Pic</label>
                        <input type="file" name="cus_image" id="cus_image" class="form-control pt-1 pb-1" value="">
                    </div>

                    <hr>
                    <div class="col-lg-6 mb-3">
                        <label for="deb_amount" class="form-label m-0 fw-normal" style="font-size: 17px;">Opening Bal.
                            (+ Debit)</label>
                        <input type="number" step="0.01" min="0" name="deb_amount" class="form-control pt-1 pb-1"
                            placeholder="0.00">
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="cre_amount" class="form-label m-0 fw-normal" style="font-size: 17px;">Opening Bal.
                            (- Credit)</label>
                        <input type="text" name="company" value="1" hidden>
                        <input type="number" step="0.01" min="0" name="cre_amount" class="form-control pt-1 pb-1"
                            placeholder="0.00">
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-md-6 mt-1 text-end">
                        <button type="reset" class="ml-1 btn btn-warning bg-gradient waves-effect waves-light w-100"
                            style="font-size: 17px;">cacel</button>
                    </div>
                    <div class="col-md-6 mt-1 mb-1 text-end">
                        <button type="submit" class="ml-1 btn btn-primary bg-gradient waves-effect waves-light w-100"
                            style="font-size: 17px;">save</button><br>
                    </div>
                    <!-- footer -->
                    <footer class="footer mt-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <p class="mb-0  text-muted">&copy;
                                            <script>document.write(new Date().getFullYear())</script> JMK Enterprises.
                                            Developed by
                                            <a href="www.tritcal.com">Tritcal International (Pvt.) Ltd</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->

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