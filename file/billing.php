<?php
include_once './session.php';
include_once '../common.php';
include_once '../conn.php';
include_once '../inc/functions.php';
include_once '../inc/database.php';
include_once 'data/data_list.php';
include_once 'data/gen_invoice.php';

$company = $_SESSION['company'];
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>JMK Enterprises - Billing</title>
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
    
    <script src="js/custom.min.js" type="text/javascript"></script>
    <script src="js/sweetalert.min.js" type="text/javascript"></script>
    <script src="js/error_list.js" type="text/javascript"></script>
    <script src="js/custom_admin.js" type="text/javascript"></script>

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

        <div class="container-fluid">
            
            <div class="row mt-2 pb-0">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body pb-3">                                    
                            <div class="live-preview">
                                <form action="data/incoming.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <input type="text" name="invoice" value="<?= $invoice ?>" readonly required hidden>
                                    <input type="text" name="bra" value="<?= $company ?>" readonly required hidden>
                                    <input type="text" name="in_type" value="0" readonly required hidden>
                                    <div class="form-group row mt-1 mb-1">
                                        <div class="col-lg-3 col-md-3">
                                            <select class="form-select pt-1 pb-1 select" name="pro_id" id="pro_id" required>
                                                <option value="0">Select Product</option>
                                                <?php
                                                $pro_result = mysqli_query($conn, "SELECT * FROM `products`");
                                                while ($row = mysqli_fetch_array($pro_result)) {
                                                    echo '<option value="' . $row['pro_id'] . '" >' . $row['product_name'] . ' ' . $row['barcode'] . ' - ' . base64_decode($row['product_name_sl']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-1 col-md-1" >
                                            <input type="number" class="form-control pt-1 pb-1" step="0.01" min="0" name="quantity" id="quantity" value="1" required>
                                        </div>

                                        <div class="col-lg-1 col-md-2" >
                                            <input type="text" class="form-control pt-1 pb-1" step="0.01" min="0" name="unit_p" id="unit_p" value="0.00" required>
                                            <input type="text" id="unit_rp" value="0" required readonly hidden>
                                        </div>

                                        <div class="col-lg-1 col-md-1" >
                                            <input type="text" class="form-control pt-1 pb-1 " step="0.01" min="0" name="dis_p" placeholder="Discount %" id="dis_p" autocomplete="off">
                                            <input type="text" id="max_dis" value="0" required readonly hidden>
                                        </div>

                                        <div class="col-lg-2 col-md-2" >
                                            <input type="text" class="form-control pt-1 pb-1" name="serial" id="serial" placeholder="Serial Number" value="">
                                        </div>

                                        <div class="col-lg-2 col-md-2">
                                            <input type="date" name="warrenty_end" placeholder="Warrenty" id="dis_p" class="form-control pt-1 pb-1">
                                        </div>

                                        <div class="col-lg-1 col-md-1" >
                                            <input type="text" class="form-control pt-1 pb-1" name="duration" placeholder="Duration Months" id="dis_p">
                                        </div>

                                        <div class="col-lg-1 col-md-2">
                                            <button type="submit" name="add" class="ml-1 btn btn-secondary bg-gradient waves-effect waves-light w-100 pt-1 pb-1">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div>
                    <div class="row" style="margin-top:-1%;">
                        <div class="col-lg-12">
                            <div class="card p-0">
                                <div class="card-body pt-0">
                                    <div class="live-preview">
                                        <form action="data/add_trans_fun.php" class="form-horizontal" method="post" onsubmit="return preventSubmit()" enctype="multipart/form-data">
                                            <input type="text" name="invoice" value="<?= $invoice ?>" readonly required hidden>
                                            <input type="text" name="type" value="0" readonly required hidden>
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <div class="table-responsive"  style=" background-color: #f7ff99; padding: 1%;margin-top: 1%; height: 440px; overflow: scroll;">
                                                        <table class="table table-bordered mb-1" style="width: 100%; background-color: #fff;">
                                                            <thead class="" style="font-size:12px;">
                                                                <tr>
                                                                    <th style=" padding: 1%;">Product Name</th>
                                                                    <th style=" padding: 1%;">Searial</th>
                                                                    <th style="text-align: center; padding: 1%;">Warranty End </th>
                                                                    <th style="text-align: center; padding: 1%;">Qty</th>
                                                                    <th style="text-align: end; padding: 1%;">Unit Price</th>
                                                                    <th style="text-align: end; padding: 1%;">Total</th>
                                                                    <th style="text-align: center; padding: 1%;">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $item_count = 0;
                                                                $result = get_salesby_invoice($invoice, $conn);
                                                                $sub_total = 0;
                                                                $total = 0;
                                                                while ($row1 = mysqli_fetch_array($result)) {
                                                                    $item_count++;
                                                                    $pro_det = get_product_det($row1["pro_id"], $conn);
                                                                    $sub_total += (floatval($row1["quantity"]) * floatval($pro_det["unit_price"]));
                                                                    $total += floatval($row1["total"]);
                                                                    $pro_name = $pro_det["product_name"]
                                                                    ?>
                                                                   <tr>
                                                                        <td style="width: 30%; padding: 0.5%;"><?= $pro_name ?><?= "  " . base64_decode($pro_det['product_name_sl'])?></td>
                                                                        <td style="width: 10%; padding: 0.5%;"><?= $row1["serial"] ?></td>
                                                                        <td style="width: 15%; padding: 0.5%;"><input type="text" value='<?= $row1["warrenty_end"] ?>' class="form-control" readonly="" style="text-align: center; height: 30px;"/></td>
                                                                        <td style="width: 10%; padding: 0.5%;"><input type="text" name="srow_quantity" id="srow_quantity" value='<?= $row1["quantity"] ?>' class="form-control" readonly="" style="text-align: center; height: 30px;"/></td>
                                                                        <td style="width: 15%; padding: 0.5%;"><input type="text" name="srow_unit_price" id="srow_unit_price" value='<?= $row1["unit_price"] ?>' class="form-control" readonly="" style="text-align: right; height: 30px;"/></td>
                                                                        <td style="width: 15%; padding: 0.5%;"><input type="text" name="total" id="srow_total" value='<?= $row1["total"] ?>' class="form-control" readonly="" style="text-align: right; height: 30px;"/></td>
                                                                        <td style="width: 5%; padding: 0.5%; text-align: center;"><a href="data/del_sales.php?s=<?= $row1["sales_id"] ?>&invoice=<?= $invoice ?>&ty=0"><button type="button" class="btn-sm btn btn-danger" style="height: 30px;"> x </button></a></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row justify-content-end mb-2 mt-2 form-actions">
                                                    <div class="col-8 mt-1">
                                                        <?php if ($item_count > 0) { ?>
                                                            <button type="submit" name="add" class=" btn btn-primary bg-gradient waves-effect waves-light w-100">Print Bill</button>
                                                        <?php } else { ?>
                                                            <button type="submit" name="add" class=" btn btn-primary bg-gradient waves-effect waves-light w-100">Print Bill</button>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-4 mt-1">
                                                        <button type="reset" class="btn btn-warning bg-gradient waves-effect waves-light w-100" onclick="location.href = 'index.php';">Back to Home</button>
                                                    </div>
                                                </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-xl-4 mt-1">
                                                    <div style="background-color: #fff; padding: 1%;">
                                                        <table style="border: none" id="tab_logic_total">
                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Billing Date</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="date" name="date" value="<?= date("Y-m-d") ?>" class="form-control bg-dark-subtle pt-1 pb-1" placeholder="yyyy-mm-dd" required readonly>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="font-size:14px; text-align: left; border: none; font-weight:800;">Salesmen</td>
                                                                <td class="text-center" style="border: none;">
                                                                    <select style="width:100%;" class="form-select pt-1 pb-1 select" name="emp_id" id="emp_id" required>
                                                                        <?php
                                                                        $emp_re = mysqli_query($conn, "SELECT * FROM employers WHERE e_type=2 OR e_type=3");
                                                                        while ($row = mysqli_fetch_array($emp_re)) {
                                                                            echo '<option value="' . $row['emp_id'] . '" >' . $row['f_name'] . " " . $typ['l_name'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="font-size:14px; text-align: left; border: none; font-weight:800;">Select Customer</td>
                                                                <td class="text-center" style="border: none;">
                                                                    <select style="width:100%;" class="form-select pt-1 pb-1 select" name="c_id" id="c_id" required>
                                                                        <?php
                                                                        $cus_re = mysqli_query($conn, "SELECT * FROM customer");
                                                                        while ($row = mysqli_fetch_array($cus_re)) {
                                                                            echo '<option value="' . $row['c_id'] . '" >' . $row['customer_name'] . ' ' . $row['nic'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Sub Total</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="text" name="sub_total" value="<?= $sub_total ?>" placeholder="0.00" id="sub_total" class="form-control bg-dark-subtle pt-1 pb-1" readonly>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Other Dis</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="text" name="other_dis" id="other_dis" class="form-control bg-dark-subtle pt-1 pb-1" value="<?php echo round(getTotalDisByInvoice($invoice, $conn), 2) ?>" readonly>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Total</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="text" name="total" id="total" class="form-control bg-dark-subtle pt-1 pb-1"  value="<?= $total ?>" placeholder="0.00" readonly>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="font-size:14px; text-align: left; border: none; font-weight:800;">Branch</td>
                                                                <td class="text-center" style="border: none;">
                                                                    <select style="width:100%;" class="form-select pt-1 pb-1 select" name="company" id="customer_status" required>
                                                                        <?php
                                                                        if (isset($_SESSION['login_type'])) {
                                                                            $lo_ty = intval($_SESSION['login_type']);
                                                                            if (($lo_ty <= 2) || ($lo_ty == 4)) {
                                                                                $result = mysqli_query($conn, "SELECT * FROM department where de_status=1 ORDER BY de_name");
                                                                                while ($row = mysqli_fetch_array($result)) {
                                                                                    echo '<option value="' . $row['de_id'] . '" >' . $row['de_name'] . '</option>';
                                                                                }
                                                                            } else {
                                                                                if (isset($_SESSION['company'])) {
                                                                                    $company = intval($_SESSION['company']);
                                                                                    $result = mysqli_query($conn, "SELECT * FROM department where de_id=$company AND de_status=1");
                                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                                        echo '<option value="' . $row['de_id'] . '" >' . $row['de_name'] . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="font-size:14px; text-align: left; border: none; font-weight:800;">Payment Type</td>
                                                                <td class="text-center" style="border: none;">
                                                                    <select style="width:100%;" class="form-select pt-1 pb-1" name="pay_type" required>
                                                                        <option value="1">Cash Payment</option>
                                                                        <option value="3">Card Payment</option>
                                                                        <option value="4">Card / Cash Payment</option>
                                                                        <option value="2">Cheque Payment</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Chq. / Ref. No</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="text" name="chq_no" id="chq_no" class="form-control pt-1 pb-1" placeholder="XXX" autocomplete="off">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Advance Amount (Cash)</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="hidden" id="adv_amount_tmp" readonly/>
                                                                    <input type="nubmer" step="0.00" name="adv_amount"  id="adv_amount" class="form-control pt-1 pb-1" placeholder="0.00" accesskey="a" autocomplete="off">
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr class="" style="font-size:14px; text-align: left; border-top: 1px solid #b9bcbf; border-bottom: 1px solid #b9bcbf; font-weight:800;">
                                                                <td class="text-left pt-3 pb-3" colspan="2">Cash හා Card එකවර ගෙවීමේදී ගෙවිය යුතු බිල්පත් මුදල පමණක් වෙන් වෙන්ව ඇතුලත් කරන්න </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Paid Card Amount</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="text" name="paid_amount_c" id="paid_amount_c" class="form-control pt-1 pb-1" placeholder="0.00" accesskey="a" autocomplete="off">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Paid Cash Amount</td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="text" name="paid_amount" id="paid_amount" class="form-control pt-1 pb-1" accesskey="a" autocomplete="off" placeholder="0.00">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right" style="width: 50%; font-size:14px; text-align: left; border: none; font-weight:800;">Balance </td>
                                                                <td class="text-center" style="border: none">
                                                                    <input type="nubmer" name="balance" id="balance" class="form-control bg-dark-subtle pt-1 pb-1" placeholder="0.00" readonly>
                                                                </td>
                                                            </tr>

                                                            
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
    <script src="assets/js/app.js') ?>"></script>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

    <script src="js/validation.js" type="text/javascript"></script>
    <script src="plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="js/recordaction.js" type="text/javascript"></script>

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

        $(document).ready(function() {
            //Select2 
            $(".select").select2({
                maximumSelectionLength: 2,
            });
        });
    </script>

    <script>

        function preventSubmit() {
            var adv_amount = parseFloat($("#adv_amount").val());
            var paid_amount = parseFloat($("#paid_amount").val());
            var paid_amount_c = parseFloat($("#paid_amount_c").val());
            var tot_amount = parseFloat($("#total").val());
            if (isNaN(paid_amount)) {
                paid_amount = 0;
            }
            if (isNaN(adv_amount)) {
                adv_amount = 0;
            }
            if (isNaN(paid_amount_c)) {
                paid_amount_c = 0;
            }
            if (isNaN(tot_amount)) {
                tot_amount = 0;
            }
            if ((paid_amount + paid_amount_c + adv_amount) < tot_amount) {
                $("#paid_amount").addClass("border-danger");
                return false;
            } else {
                $("#paid_amount").removeClass("border-danger");
                return true;
            }
        }
        function reduceBal() {
            localStorage.setItem("ch", $("#balance").val());
            $("#balance").val("0.00");
            document.getElementById("chec").setAttribute("onclick", "rec()");
        }
        function rec() {
            $("#balance").val(localStorage.getItem("ch"));
            localStorage.removeItem("ch");
            document.getElementById("chec").setAttribute("onclick", "reduceBal()");
        }

        $("#paid_amount").on("input", function () {
            preventSubmit();
            var paid_amount = parseFloat($("#paid_amount").val());
            var paid_amount_c = parseFloat($("#paid_amount_c").val());
            var adv_amount = parseFloat($("#adv_amount").val());
        //            var adv_amount = $("#adv_amount").val();
            var sub_total = $("#total").val();
            if (isNaN(adv_amount)) {
                adv_amount = 0;
            }
            var balance = (sub_total - (adv_amount + paid_amount + paid_amount_c)).toFixed(2);
            $("#balance").val(balance);
        });
        $("#dis_p").on("input", function () {
            var dis_p = parseFloat($(this).val());
            var max_dis = parseFloat($('#max_dis').val());
            var unit_rp = parseFloat($('#unit_rp').val());
            if (isNaN(dis_p)) {
                dis_p = 0;
            }
            if (isNaN(unit_rp)) {
                unit_rp = 0;
            }
            if (isNaN(max_dis)) {
                max_dis = 0;
            }
            if (max_dis > 0 && dis_p > 0) {
                if (dis_p > max_dis) {
                    dis_p = max_dis;
                    $('#dis_p').val(max_dis.toFixed(2));
                }
            }
            var calc = unit_rp - dis_p;
            $('#unit_p').val(calc.toFixed(2));
        });
        $("select[name='pro_id']").change(function () {
            var pro_id = $(this).val();
            $.post("data/unit_price.php", {p: pro_id}, function (data) {
                var obj = JSON.parse(data);
                $('#unit_p').val(parseFloat(obj["unit_price"]).toFixed(2));
                $('#max_dis').val(parseFloat(obj["max_dis"]).toFixed(2));
                $('#unit_rp').val(parseFloat(obj["unit_price"]).toFixed(2));
                $("#quantity").focus();
            });
        });
        $('#quantity').on('input', function () {
            var item = $(this).val();
            var pro_id = $("#pro_id").val();
            $.post("data/max_quantity.php", {'item': item, 'p': pro_id}, function (data) {
                var obj2 = JSON.parse(data);
                if (obj2["errors"] !== "") {
                    $("#quantity").addClass("border-danger");
                } else {
                    $("#quantity").removeClass("border-danger");
                }
            });
        });
        $('#adv_amount').on('input', function () {
            var adv_amount = parseFloat($(this).val()).toFixed(2);
            var adv_amount_tmp = parseFloat($("#adv_amount_tmp").val());
            if(isNaN(adv_amount_tmp)){
                adv_amount_tmp = 0;
            }
            if(isNaN(adv_amount)){
                adv_amount = 0;
            }
            if(adv_amount > adv_amount_tmp){
                $('#adv_amount').val(adv_amount_tmp.toFixed(2));
            }
        });
        $('#pro_id').select2({
            selectOnClose: true
        });
        $('#c_id').select2({
            selectOnClose: true
        });
        $('#emp_id').select2({
            selectOnClose: true
        });

        $("select[name='c_id']").change(function () {
            var c_id = parseInt($(this).val());
            $.ajax({
                url: "data/cus_advance.php",
                Type: "get",
                data: {'c_id': c_id},
                success: function (data) {
                    var obj = JSON.parse(data);
                    $("#adv_amount").val(parseFloat(obj["adv_amount"]).toFixed(2));
                    $("#adv_amount_tmp").val(parseFloat(obj["adv_amount"]).toFixed(2));
                }
            });
        });
    </script>
</body>

</html>