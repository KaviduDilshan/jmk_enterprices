<?php
include_once './session.php';
include_once '../common.php';
include_once '../conn.php';
include_once '../inc/functions.php';
include_once '../inc/database.php';
include_once 'data/data_list.php';
include_once 'data/gen_invoice.php';

if (isset($_POST['agreement_number'])) {
    $agree = $_POST['agreement_number'];
} else {
    $agree = 0;
}
$agree_detail_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hp_transaction WHERE agreement_number = '$agree'"));
$hp_t_id = $agree_detail_id['hp_t_id'];
$agree_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hp_transaction WHERE hp_t_id = $hp_t_id"));

$c_id = $agree_detail['c_id'];
$gu_id_01 = $agree_detail['gu_id_01'];
$gu_id_02 = $agree_detail['gu_id_02'];
$customer = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT customer_name FROM customer WHERE c_id = $c_id"))["customer_name"]);
$other_char = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(charge_amount) FROM hp_other_chargers WHERE hp_t_id = $hp_t_id"))["SUM(charge_amount)"]);
$gurenter_01 = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT guarantor_name FROM guarantor WHERE gu_id = $gu_id_01"))["guarantor_name"]);
$gurenter_02 = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT guarantor_name FROM guarantor WHERE gu_id = $gu_id_02"))["guarantor_name"]);

$loan_amount = $agree_detail['tot_loan_amount'] + $other_char;
$paid_total = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(paid_total) FROM `hp_installments` WHERE `hp_t_id`=$hp_t_id"))["SUM(paid_total)"]);

$arriess = $loan_amount - $paid_total;

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>JMK Enterprises - Installment Payments</title>
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
    <script src="js/error_list.js" type="text/javascript"></script>

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
                    <div class="card mb-2">
                        <div class="card-body pb-0">                                    
                            <div class="live-preview">
                                <form action="#" method="post">
                                    <div class="form-group row">
                                        <div class="col-lg-10 col-md-8 mb-2" >
                                            <input type="text" class="form-control pt-1 pb-1" name="agreement_number" placeholder="Enter Agreement No *" value="" required>
                                        </div>
                                        <div class="col-lg-2 col-md-2  mb-2">
                                            <button type="submit" class="ml-1 pt-1 pb-1 btn btn-secondary bg-gradient waves-effect waves-light w-100">Find</button>
                                        </div>
                                    </div>
                                </form>
                                <hr class="mt-2 mb-3">
                                <div class="row mb-0">
                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $agree_detail['duration']; ?>" readonly>
                                        <small class="mx-1"><b>Duration</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $agree_detail['transaction_date']; ?>" readonly>
                                        <small class="mx-1"><b>Loan Date</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" name="date" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= date("Y-m-d") ?>" readonly>
                                        <small class="mx-1"><b>Payment Date</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $customer ?>" readonly>
                                        <small class="mx-1"><b>Customer</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $gurenter_01 ?>" readonly>
                                        <small class="mx-1"><b>Guarantor 01</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $gurenter_02 ?>" readonly>
                                        <small class="mx-1"><b>Guarantor 02</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $agree_detail['des']; ?>" readonly>
                                        <small class="mx-1"><b>Description</b></small>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mb-3">
                                        <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= $agree_detail['agreement_number']; ?>" readonly>
                                        <small class="mx-1"><b>Agreement #</b></small>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="data/installment_pay.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <input type="text" name="hp_t_id" value="<?= $hp_t_id ?>" readonly required hidden>
                                            <input type="text" name="c_id" value="<?= $c_id ?>" readonly required hidden>
                                            <input type="text" name="total" value="<?= $agree_detail['net_total'] ?>" readonly required hidden>
                                            <input type="text" name="company" value="<?= $agree_detail['company'] ?>" readonly required hidden>
                                            <input type="text" name="agreement_number" value="<?= $agree_detail['agreement_number'] ?>" readonly required hidden>
                                            <input type="text" name="date" class="form-control pt-1 pb-1 bg-dark-subtle" value="<?= date("Y-m-d") ?>"hidden readonly>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <p class="m-0 mb-1"><strong>Payment History</strong></p>
                                                    <div class="table-responsive mt-0"  style=" background-color: #f7ff99; padding: 1%;margin-top: 1%; height: 250px; overflow: scroll;">
                                                        <table class="table table-bordered mb-1 mt-0" style="width: 100%; background-color: #fff;">
                                                            <thead>
                                                                <tr>
                                                                    <th> TERM </th>
                                                                    <th> DUE DATE </th>
                                                                    <th> AMOUNT </th>
                                                                    <th> INSTALLMENT </th>
                                                                    <th> PAID </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $installments = mysqli_query($conn, "SELECT * FROM `hp_installments` WHERE `hp_t_id`=$hp_t_id");
                                                                while ($row = mysqli_fetch_array($installments)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $row['month']; ?></td>
                                                                        <td><?= $row['due_date']; ?></td>
                                                                        <td><?= $row['amount_total']; ?></td>
                                                                        <td><?= $row['installment_amount']; ?></td>
                                                                        <td><?= $row['paid_total']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-xl-6">
                                                    <div class="row pt-1 pb-1 mt-3 form-actions">
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle o_chargers" value="<?= $agree_detail['loan_amount'] ?>" placeholder="" readonly>
                                                            <small class="mx-1"><b>Loan Amount</b></small>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle o_chargers" value="<?= $agree_detail['installment_amount'] ?>" placeholder="" readonly>
                                                            <small class="mx-1"><b>Monthly Installment</b></small>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <select name="month" id="customer_status" class="form-select pt-1 pb-1 bg-dark-subtle" readonly>
                                                                <?php
                                                                $installments = mysqli_query($conn, "SELECT * FROM `hp_installments` WHERE `paid_total` = 0 AND `hp_t_id`=$hp_t_id ");
                                                                while ($row = mysqli_fetch_array($installments)) {
                                                                    ?>
                                                                    <option value="<?= $row['month']; ?>"><?= $row['month']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <small class="mx-1"><b>Installment Term</b></small>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="number" class="form-control pt-1 pb-1 o_chargers" step="0.01" name='paid_total' id="total_c" value="0.00" placeholder="0.00">
                                                            <small class="mx-1"><b>Payment</b></small>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="number" class="form-control pt-1 pb-1 bg-dark-subtle" step="0.01" name='' value="<?= $agree_detail['month_interest']; ?>" placeholder="0.00" readonly>
                                                            <small class="mx-1"><b>Interest</b></small>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <input type="number" class="form-control pt-1 pb-1 bg-dark-subtle" step="0.01" name='other_tot' value="<?= $other_char ?>" placeholder="0.00" readonly>
                                                            <small class="mx-1"><b>Other Charges</b></small>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" name='tot_arries' id="arriess" value="<?= $arriess ?>" placeholder="0.00" readonly>
                                                            <small class="mx-1"><b>Total Arrease</b></small>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <input type="text" class="form-control pt-1 pb-1 bg-dark-subtle" name='tot_arries' id="tot_arries" value="" placeholder="0.00" readonly>
                                                            <small class="mx-1"><b>Balance Amount</b></small>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <input type="text" class="form-control pt-1 pb-1" name='cash_commission' id="cash_commission" value="0">
                                                            <small class="mx-1"><b>Cash Commission</b></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <!-- <div class="row justify-content-end mb-3 mt-3 form-actions">
                                                    <div class="col-4 mt-1">
                                                        <button type="submit" name="add" class=" btn btn-primary bg-gradient waves-effect waves-light w-100">Save & Close Loan Account</button>
                                                    </div>
                                                    <div class="col-2 mt-1">
                                                        <button type="reset" class="btn btn-warning bg-gradient waves-effect waves-light w-100" onclick="location.href = 'index.php';">Back to Home</button>
                                                    </div>
                                                </div> -->
                                                    
                                                <div class="row mt-2">
                                                <hr><h6><b>Payment Type Details</b></h6><hr>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-3">
                                                                <select name="tra_type" id="tra_type" class="form-select pt-1 pb-1" required>
                                                                    <option value="1"<?php
                                                                    if ($row['tra_type'] == 1) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Cash Payment</option>
                                                                    <option value="2"<?php
                                                                    if ($row['tra_type'] == 2) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Cheque Payment</option>
                                                                    <option value="3"<?php
                                                                    if ($row['tra_type'] == 3) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>Online Transfer</option>
                                                                </select>
                                                                <small class="mx-1"><b>Payment Type<span class="text-danger">*</span></b></small>
                                                            </div>

                                                            <div class="col-lg-6 mb-3" style="display: <?= ($row['tra_type'] > 1) ? "block" : "none" ?>" id="tra_online">
                                                                <select name="ba_id" id="ba_id" class="form-select pt-1 pb-1 select">
                                                                    <option value="0">Select Bank</option>
                                                                    <?= $database->loadAllbank($row['ba_id']) ?>
                                                                </select>
                                                                <small class="mx-1"><b>Select Bank<span class="text-danger">*</span></b></small>
                                                            </div>

                                                            <div class="col-lg-6 mb-3" style="display: <?= ($row['tra_type'] == 2) ? "block" : "none" ?>" id="tra_chq_no">
                                                                <input type="number" name="chq_no" class="form-control pt-1 pb-1" value="value="<?php echo $row['chq_no']; ?>>
                                                                <small class="mx-1"><b>Cheque No.<span class="text-danger">*</span></b></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="row justify-content-end mb-1 form-actions">
                                                            <div class="col-6">
                                                                <button type="submit" name="add" class=" btn btn-primary bg-gradient waves-effect waves-light w-100">Print Bill</button>
                                                            </div>
                                                            <div class="col-4">
                                                                <button type="reset" class="btn btn-warning bg-gradient waves-effect waves-light w-100" onclick="location.href = 'index.php';">Back to Home</button>
                                                            </div>
                                                        </div>
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

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

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
        $(".o_chargers").on('input', function () {
            var total_c = parseFloat($("#total_c").val());
            var arriess = parseFloat($("#arriess").val());
            var total = total_c;
            $("#total").val((total).toFixed(2));
            var tot_arries = arriess - total;
            $("#tot_arries").val((tot_arries).toFixed(2));
        });
        
        $("select[name='tra_type']").change(function () {
            var tra_type = parseInt($(this).val());
            if (tra_type == 1) {
                document.getElementById("tra_chq_no").style.display = "none";
                document.getElementById("tra_online").style.display = "none";
            } else if (tra_type == 2) {
                document.getElementById("tra_chq_no").style.display = "block";
                document.getElementById("tra_online").style.display = "none";
            } else {
                document.getElementById("tra_chq_no").style.display = "none";
                document.getElementById("tra_online").style.display = "block";
            }
        });

        $('#pro_id').select2({
            selectOnClose: true
        });
        $('#gu_id').select2({
            selectOnClose: true
        });
        $('#gu_id2').select2({
            selectOnClose: true
        });
        $('#c_id').select2({
            selectOnClose: true
        });
        $('#ldu_id').select2({
            selectOnClose: true
        });
        $('#emp_id').select2({
            selectOnClose: true
        });
    </script>
</body>

</html>