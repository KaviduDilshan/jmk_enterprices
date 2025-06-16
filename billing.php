<?php
session_start();
require_once 'valid_fun.php';
require_once 'promo_validate.php';

if (isset($_SESSION["type"]) && isset($_SESSION["id"])) {
    if (empty($_GET["invoice"]) || !isset($_GET["invoice"])) {
        require_once 'code.php';
        header("location:billing.php?invoice=$finalcode");
    } else {
        $code = $_GET["invoice"];
    }
    if (isset($_GET["t"])) {
        $tb = intval(base64_decode($_GET["t"]));
        if ($tb > 0 && $tb < 5) {
            $_SESSION["tb"] = $tb;
        }
    }
    $prev_trans_data = null;
    $ret_g = $prev_tot = 0;
    if (isset($_GET["ret_g"]) && isset($_GET["b"])) {
        $bill_det = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `bill_nums` WHERE `bill_no`=" . $_GET["b"]));
        $table = "transaction_cash_3";
        $prev_trans_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `" . $table . "` WHERE `invoice`=\"$code\""));
        $ret_g = intval($_GET["ret_g"]);
        $prev_tot = floatval($prev_trans_data["total"]);
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
            content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords"
            content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="pixelstrap">
        <link rel="icon" href="../../assets/images/favi.png" type="image/x-icon">
        <link rel="shortcut icon" href="../../assets/images/favi.png" type="image/x-icon">
        <title>POS | Billing</title>
        <!-- Google font-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">
        <!-- Font Awesome-->
        <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
        <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/owlcarousel.css">
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
        <script src="js/addon/jquery.min.js"></script>

    </head>

    <body class="landing-wrraper">
        <div class="page-wrapper landing-page">
            <!-- Page Body Start-->
            <div class="page-body-wrapper">
                <!-- header start-->

                <div class="outer">

                    <!--Applications end-->
                    <!-- <div class="container-fluid"> -->
                    <div class="card" style="background-color: #e2e2e2;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input style="height: 50px;" class="form-control" type="text" id="search" placeholder="Search Item Name or Search Code ..." autofocus>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="items-outer" style="height:540px;">
                                            <div class="row">
                                                <?php
                                                $pro_result = mysqli_query($con, "SELECT pro_id,pro_code,unit_price,product_name FROM `products` WHERE ser_st=1");
                                                while ($pro_row = mysqli_fetch_array($pro_result)) { ?>
                                                    <div class="item-card col-md-2" style="height:120px;">
                                                        <form id="incomming">
                                                            <input type="text" id="b<?= $pro_row["pro_id"]; ?>" name="b" value="<?= isset($_GET["b"]) ? intval($_GET["b"]) : 0 ?>" readonly required hidden>
                                                            <input type="text" id="pro_idy<?= $pro_row["pro_id"]; ?>" name="pro_id" value="<?= $pro_row["pro_id"]; ?>" readonly required hidden>
                                                            <input type="text" value="<?= $pro_row["pro_code"]; ?>" id="barcode<?= $pro_row["pro_id"]; ?>" name="barcode" hidden>
                                                            <input type="text" id="ret_g<?= $pro_row["pro_id"]; ?>" name="ret_g" value="<?= $ret_g ?>" readonly required hidden />
                                                            <input type="text" id="invoice<?= $pro_row["pro_id"]; ?>" name="invoice" value="<?= $code ?>" readonly required hidden />
                                                            <input type="text" class="form-control" name="unit_p" id="unit_p<?= $pro_row["pro_id"]; ?>" value="<?= $pro_row["unit_price"] ?>" required hidden />
                                                            <input id="quantity<?= $pro_row["pro_id"]; ?>" name="quantity" type="text" value="1" min="1" readonly required hidden>
                                                            <button id="main<?= $pro_row["pro_id"]; ?>" type="submit" class="product-name" style="width:100%; height:100%;font-weight: bold; font-size: 12px; text-align:center; color:#000000; background-color:#ffffff; border: 0 #ffffff;">
                                                                <?= $pro_row["product_name"]; ?><br><?= $pro_row["pro_code"]; ?> <br><br> Rs. <?= number_format($pro_row["unit_price"], 2, '.', ','); ?>
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $("#main<?= $pro_row["pro_id"]; ?>").click(function(e) {
                                                                e.preventDefault(); //add this line to prevent reload

                                                                var b1 = $("#b<?= $pro_row["pro_id"]; ?>").val();
                                                                var pro_id1 = $("#pro_idy<?= $pro_row["pro_id"]; ?>").val();
                                                                var barcode1 = $("#barcode<?= $pro_row["pro_id"]; ?>").val();
                                                                var ret_g1 = $("#ret_g<?= $pro_row["pro_id"]; ?>").val();
                                                                var invoice1 = $("#invoice<?= $pro_row["pro_id"]; ?>").val();
                                                                var unit_p1 = $("#unit_p<?= $pro_row["pro_id"]; ?>").val();
                                                                var quantity1 = $("#quantity<?= $pro_row["pro_id"]; ?>").val();
                                                                $.ajax({
                                                                    type: "post",
                                                                    url: "data/incoming.php",
                                                                    data: {
                                                                        invoice: invoice1,
                                                                        b: b1,
                                                                        invoice: invoice1,
                                                                        pro_id: pro_id1,
                                                                        barcode: barcode1,
                                                                        ret_g: ret_g1,
                                                                        unit_p: unit_p1,
                                                                        quantity: quantity1
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="items-outer" style="height:260px;">
                                            <div class="row">
                                                <?php
                                                $pro_result = mysqli_query($con, "SELECT pro_id,pro_code,unit_price,product_name FROM `products` WHERE ser_st=2");
                                                while ($pro_row = mysqli_fetch_array($pro_result)) { ?>
                                                    <div class="item-card col-md-2" style="height:110px;">
                                                        <form id="incomming_w<?= $pro_row["pro_id"]; ?>">
                                                            <input type="text" id="pro_id_det<?= $pro_row["pro_id"]; ?>" name="pro_id" value="<?= $pro_row["pro_id"]; ?>" readonly required hidden>
                                                            <input type="text" value="<?= $pro_row["pro_code"]; ?>" id="barcode_det<?= $pro_row["pro_id"]; ?>" name="barcode" hidden>
                                                            <input type="text" name="ret_g" id="ret_g_det<?= $pro_row["pro_id"]; ?>" value="<?= $ret_g ?>" readonly required hidden />
                                                            <input type="text" name="invoice" id="invoice_det<?= $pro_row["pro_id"]; ?>" value="<?= $code ?>" readonly required hidden />
                                                            <input type="text" name="unit_p" id="unit_p_det<?= $pro_row["pro_id"]; ?>" value="<?= $pro_row["unit_price"] ?>" required hidden />
                                                            <input id="quantity_det<?= $pro_row["pro_id"]; ?>" name="quantity" type="text" value="1" required hidden>
                                                            <button type="submit" id="subw<?= $pro_row["pro_id"]; ?>" class="product-name" style="font-weight: bold; font-size: 12px; text-align:center; color:#000000; background-color:#ffffff; border: 0 #ffffff;">
                                                                <?= $pro_row["product_name"]; ?><br> <?= $pro_row["pro_code"]; ?> <br><br> Rs. <?= number_format($pro_row["unit_price"], 2, '.', ','); ?>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $("#subw<?= $pro_row["pro_id"]; ?>").click(function(e) {
                                                                e.preventDefault(); //add this line to prevent reload

                                                                var pro_id = $("#pro_id_det<?= $pro_row["pro_id"]; ?>").val();
                                                                var barcode = $("#barcode_det<?= $pro_row["pro_id"]; ?>").val();
                                                                var ret_g = $("#ret_g_det<?= $pro_row["pro_id"]; ?>").val();
                                                                var invoice = $("#invoice_det<?= $pro_row["pro_id"]; ?>").val();
                                                                var unit_p = $("#unit_p_det<?= $pro_row["pro_id"]; ?>").val();
                                                                var quantity = $("#quantity_det<?= $pro_row["pro_id"]; ?>").val();
                                                                $.ajax({
                                                                    type: "post",
                                                                    url: "data/incoming_w.php",
                                                                    data: {
                                                                        invoice: invoice,
                                                                        pro_id: pro_id,
                                                                        barcode: barcode,
                                                                        ret_g: ret_g,
                                                                        unit_p: unit_p,
                                                                        quantity: quantity
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="here">
                                            <?php
                                            $bill_total = 0;
                                            $loop = 1;
                                            $pro_per_result = mysqli_query($con, "SELECT *,SUM(quantity),SUM(unit_price),SUM(total) FROM sales_order WHERE invoice='$code' GROUP BY pro_id ORDER BY sales_id DESC");
                                            while ($pro_per_row = mysqli_fetch_array($pro_per_result)) {
                                                $pro_id = intval($pro_per_row["pro_id"]);
                                                $pro_det = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE pro_id=$pro_id"));

                                                $tmp_qty = floatval($pro_per_row["SUM(quantity)"]);
                                                $tmp_f_qty = floatval($pro_per_row["f_qty"]);
                                            ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><?= ucwords($pro_det["product_name"]) ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p><strong>QTY : <?= $tmp_qty ?></strong></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p><?= number_format($pro_per_row["SUM(unit_price)"], 2, '.', ',') ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p><?= number_format($pro_per_row["SUM(total)"], 2, '.', ',') ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="data/del_sales_row.php?sal=<?= encrydata(intval($pro_per_row["sales_id"])) ?>&ret_g=<?= isset($_GET["ret_g"]) ? intval($_GET["ret_g"]) : 0 ?>&pp=<?= base64_encode($pro_per_row["pro_id"]) ?>&b=<?= isset($_GET["b"]) ? intval($_GET["b"]) : 0 ?>">
                                                            <button type="button" id="del_re_<?= $loop ?>" class="del_re btn-sm btn-danger" style="width:100%;"><i class="fa fa-trash"></i></button>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php
                                                $bill_total += floatval($pro_per_row["SUM(total)"]);
                                                $loop++;
                                            }
                                            $loop2 = 1;
                                            $pro_per_result2 = mysqli_query($con, "SELECT *,SUM(quantity),SUM(unit_price),SUM(total) FROM temp_dis WHERE invoice='$code' GROUP BY pro_id ORDER BY td_id DESC");
                                            while ($pro_per_row2 = mysqli_fetch_array($pro_per_result2)) {
                                                $pro_id = intval($pro_per_row2["pro_id"]);
                                                $pro_det2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE pro_id=$pro_id"));
                                            ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><?= ucwords($pro_det2["product_name"]) ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p><strong>QTY : <?= $pro_per_row2["SUM(quantity)"] ?></strong></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p><?= number_format($pro_per_row2["SUM(unit_price)"], 2, '.', ',') ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p><?= number_format($pro_per_row2["SUM(total)"], 2, '.', ',') ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="data/del_sales_row_w.php?sal=<?= encrydata(intval($pro_per_row2["td_id"])) ?>&ret_g=<?= isset($_GET["ret_g"]) ? intval($_GET["ret_g"]) : 0 ?>&pp=<?= base64_encode($pro_per_row2["pro_id"]) ?>&b=<?= isset($_GET["b"]) ? intval($_GET["b"]) : 0 ?>">
                                                            <button type="button" id="del_re2_<?= $loop2 ?>" class="del_re btn-sm btn-danger" style="width:100%;"><i class="fa fa-trash"></i></button>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php

                                                $loop2++;
                                            }
                                            $dis_am = 0;
                                            ?>

                                        </div>
                                        <form action="data/add_trans_fun.php" id="finish" method="post">
                                            <div class="row g-3">
                                                <input type="hidden" name="b" value="<?= isset($_GET["b"]) ? intval($_GET["b"]) : 0 ?>" readonly required>
                                                <input type="hidden" id="prev_paid_tot" value="<?= $prev_tot ?>" readonly required />
                                                <input type="hidden" name="user" value="<?= encrydata($_SESSION["id"]) ?>" readonly required />
                                                <input type="hidden" name="invoice" value="<?php echo $code ?>" readonly required />
                                                <input type="text" name=' ous' id="ous" value="0" placeholder='0.00' readonly hidden />
                                                <input type="text" name='c_id' value="1" placeholder='0.00' readonly hidden />
                                                <input type="text" name='department' value="1" placeholder='0.00' readonly hidden />
                                                <?php
                                                $other_dis_amount = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(total) FROM temp_dis WHERE invoice='$code'"))["SUM(total)"];
                                                ?>
                                                <div class="col-md-12">
                                                    <div id="here2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <br>
                                                                <hr>
                                                                <p style="font-weight:bold; font-size: 18px; color:#000000;">Subtotal : <?= number_format($bill_total, 2, '.', '') ?></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <br>
                                                                <hr>
                                                                <p style="font-weight:bold; font-size: 18px; color:#046b00;">Empty : <?= number_format($other_dis_amount, 2, '.', '') ?></p>
                                                            </div>

                                                            <div class="col-md-12" style="background-color:#ffffff;">
                                                                <center>
                                                                    <br>
                                                                    <p style="font-weight:bold; font-size: 20px; color:#870500;">TOTAL AMOUNT (Rs.) : <?= number_format($tmp_total = $bill_total - $other_dis_amount, 2, '.', '') ?></p>
                                                                </center><br>
                                                            </div>
                                                            <div class="col-md-6" style="display:none;">
                                                                <input type="text" name='sub_total' id="sub_total" class="form-control" value="<?= number_format($bill_total, 2, '.', '') ?>" placeholder='0.00' readonly style="height: 50px; font-weight:bold; font-size: 16px; color:#000000;" />
                                                                <label class="form-label" for="validationCustom01" style="color:#000000;">Empty Amount (Rs.)</label>
                                                                <input type="text" name='discount' id="discount" class="form-control" value='<?= number_format($other_dis_amount, 2, '.', '') ?>' readonly style="height: 50px; font-weight:bold; font-size: 16px; color:#046b00;" />
                                                            </div>
                                                            <div class="col-md-6" style="display:none;">
                                                                <label class="form-label" for="validationCustom01" style="color:#000000;">Total Amount (Rs.)</label>
                                                                <input type="hidden" name='total_tmp' id="total_tmp" class="form-control" value="<?= $tmp_total = $bill_total - $other_dis_amount ?>" readonly />
                                                                <input type="text" name='total' id="total" class="form-control" value="<?= number_format($tmp_total, 2, '.', '') ?>" placeholder='0.00' readonly style="height: 50px; font-weight:bold; font-size: 16px; color:#870500;" />
                                                            </div>
                                                            <?php
                                                            if (isset($_GET["ret_g"])) {
                                                            ?>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="validationCustom01" style="color:#000000;">Previous Total (Rs.)</label>
                                                                    <input class="form-control" name='re_total' type="text" id="prev_tot" value="<?= number_format($prev_tot, 2, '.', '') ?>" placeholder='0.00' readonly style="height: 50px;">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="validationCustom01" style="color:#000000;">To Pay (Rs.)</label>
                                                                    <input type="text" id="to_pay" class="form-control" value="<?= number_format($prev_tot - $tmp_total, 2, '.', '') ?>" placeholder='0.00' readonly />
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="validationCustom01" style="color:#000000;">Paid Amount Cash (Rs.)</label>
                                                    <input class="form-control cal_bal" name='paid_cash' id="paid_cash" type="text" value="" style="height: 50px;" autocomplete="off">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="validationCustom01" style="color:#000000;">Paid Amount Card (Rs.)</label>
                                                    <input class="form-control cal_bal" name='paid_card' id="paid_card" type="text" value="" style="height: 50px;" autocomplete="off">
                                                    <input type="text" name='paid_cheque' id="paid_cheque" class="form-control cal_bal" value="<?= ($prev_trans_data != null) ? $prev_trans_data["paid_card"] : "" ?>" autocomplete="off" hidden="" />

                                                    <input type="text" name='ref_chq' placeholder='Cheque Number' value="" class="form-control" autocomplete="off" hidden="" />
                                                    <input type="text" name='ref' placeholder='Card Number' value="" class="form-control" autocomplete="off" hidden="" />
                                                    <!-- <input class="form-control" name='discount' id="discount" type="text" value="" required="" style="height: 50px;" hidden> -->
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label" for="validationCustom01" style="color:#000000;">Balance (Rs.)</label>
                                                    <input class="form-control balance" name='balance' id="balance" type="text" value="" readonly style="height: 50px; font-weight:bold; font-size: 16px;">
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary w-100" name="save" value="save" type="submit" style="height: 50px;">Save Bill</button>
                                            <br><br>
                                            <button class="btn btn-warning w-100" onclick="submitForm()" name="save" value="print" id="print" type="submit" style="color:#000000; height: 50px;">Save & Print</button>
                                            <br><br>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <?php if (!isset($_GET["ret_g"])) { ?>
                                                        <br><br>
                                                        <div class="col-md-6">
                                                            <a href="return_goods.php" class="btn btn-danger w-100" id="return" style="padding:3%;">Make Return</a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <br><br>
                                                        <div class="col-md-6">
                                                            <a href="billing.php" class="btn btn-primary w-100" style="padding:3%;">New Bill</a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-5">
                                                        <a href="index.php" id="ret_btn" class="btn btn-light w-100" type="submit" style="padding:4%;color:#000000;">Exit to dashboard</a>
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
        <!-- latest jquery-->
        <script src="../assets/js/jquery-3.5.1.min.js"></script>
        <!-- feather icon js-->
        <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- Sidebar jquery-->
        <script src="../assets/js/sidebar-menu.js"></script>
        <script src="../assets/js/config.js"></script>
        <!-- Bootstrap js-->
        <script src="../assets/js/bootstrap/popper.min.js"></script>
        <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
        <!-- Plugins JS start-->
        <script src="../assets/js/owlcarousel/owl.carousel.js"></script>
        <script src="../assets/js/owlcarousel/owl-custom.js"></script>
        <script src="../assets/js/landing_sticky.js"></script>
        <script src="../assets/js/landing.js"></script>
        <script src="../assets/js/jarallax_libs/libs.min.js"></script>
        <script src="../assets/js/script.js"></script>
        <script src="../assets/js/touchspin/touchspin.js"></script>
        <script src="../assets/js/touchspin/input-groups.min.js"></script>


        <script src="js/billings_fun.js"></script>
        <script src="js/base_fun.js"></script>
        <script src="js/bill_ajax.js"></script>

        <script>
            $('#search').keyup(function() {
                var search = $(this).val().trim();
                if (search.length > 0) {

                    $(".product-name").each(function() {
                        if ($(this).text().search(new RegExp(search, "i")) < 0 && String($(this).data('description')).search(new RegExp(search, "i"))) {
                            $(this).parent().parent().hide();
                        }
                    });
                } else {
                    $(".product-name").parent().parent().show();
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                setInterval(function() {
                    $("#here").load(location.href + " #here");
                }, 500);


            });


            $(document).ready(function() {

                setInterval(function() {
                    $("#here2").load(location.href + " #here2");
                }, 500);


            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:index.php");
}
