<?php

include_once './session.php';
include_once '../common.php';
include_once '../conn.php';
include_once '../inc/functions.php';
include_once '../inc/database.php';
// include_once './data/data_list.php';

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>JMK Enterprises - Pending orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />


    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
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

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!-- Ionicons -->
    <link href="css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <?php
    if (isset($_GET['error'])) {
        $error = base64_decode($_GET['error']);
        echo '<script>  error_by_code(' . $error . ');</script>';
    }
    ?>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include_once './navbar.php'; ?>
        <?php include_once './sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Pending Orders</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active">Pending Orders</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin:-1% -2% 0% -2%;">
                        <div class="col-lg-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                
                                </div> -->
                                <div class="card-body" style="overflow: scroll;">
                                    <table id="example23" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Customer Name</th>
                                                <th style="text-align: center;">Mobile Number</th>
                                                <th>Address</th>
                                                <th>Product Details</th>
                                                <th>Total order</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM order_save where order_status=0";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_array($result)) {

                                                $order_id = $row["order_id"];
                                                // $order_view = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `hp_sales_order` WHERE `invoice`='$order_id'"));
                                                $c_id = $row["c_id"];
                                                $customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `customer` WHERE `c_id`=$c_id"));
                                                ?>
                                                <tr>
                                                    <td><?= $row["os_id"]; ?></td>
                                                    <td><?= $row["order_date"]; ?></td>
                                                    <td><?= $row["order_time"]; ?></td>
                                                    <td><?= $customer["customer_name"]; ?></td>
                                                    <td style="text-align: center;"><?= $customer["customer_mobile"]; ?></td>
                                                    <td><?= $customer["customer_address"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $view_order = "SELECT * FROM `hp_sales_order` WHERE `invoice`='$order_id'";
                                                        $view_result = mysqli_query($conn, $view_order);
                                                        while ($view_row = mysqli_fetch_array($view_result)) {
                                                            $pro_id = $view_row["pro_id"];
                                                            $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `pro_id`='$pro_id'"));
                                                            echo $product["product_name"] . " | " . $view_row["quantity"] . " X " . number_format($view_row["unit_price"], 2, '.', ',') . " = " . number_format($view_row["total"], 2, '.', ',') . "<hr>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= number_format($row["total_price"], 2, '.', ','); ?></td>
                                                    <td style="text-align: center;"><a href="hp_sales.php?invoice=<?= $row["order_id"]; ?>&c_id=<?= $c_id?>"
                                                            class="btn btn-sm btn-success"><i class="ri-check-fill"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="assets/js/app.js"></script>

    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src=" https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src=" https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>

    <script src="js/validation.js" type="text/javascript"></script>

    <script src="plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="js/recordaction.js" type="text/javascript"></script>
    <script src="js/custom.min.js" type="text/javascript"></script>
    <script src="js/sweetalert.min.js" type="text/javascript"></script>
    <script src="js/error_list.js" type="text/javascript"></script>
    <script src="js/custom_admin.js" type="text/javascript"></script>

    <script type="text/javascript">
        function logout() {
            swal({
                title: "Are You Sure ",
                text: "Loging Out",
                icon: "warning",
                buttons: ['No Cancel It', 'I am Sure'],
                dangerMode: true
            }).then(function (isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Log Out',
                        text: 'Thank You',
                        icon: 'success'
                    }).then(function () {
                        window.location = 'data/logout.php';
                    });
                } else {
                    swal('Cancelled', 'User Not Login Out', 'error');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>

</body>

</html>