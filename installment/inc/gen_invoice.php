<?php

include_once '../../conn.php';
include_once './session.php';
$company = $_SESSION['company'];
$a_id = $_SESSION['login'];

$sales_max_id = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(sales_id) FROM sales_order "))["MAX(sales_id)"]) + 1;
$trans_max_id = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(t_id) FROM transaction "))["MAX(t_id)"]) + 1;
$cash_max_id = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(ca_l_id) FROM cash_ledger "))["MAX(ca_l_id)"]) + 1;
$invoice2 = ($sales_max_id * $trans_max_id * $cash_max_id) * mt_rand(100000, 1000000);
$invoice = $a_id . $company . $invoice2;

if (isset($_GET["invoice"]) && $_GET["invoice"] != null) {
    $invoice = $_GET["invoice"];
} else {
    $invoice = $a_id . $company . $invoice2;
}

//$sql = "SELECT MAX(mrn_re_id) FROM mrn_request";
//$max_trans_id = intval(mysqli_fetch_assoc(mysqli_query($conn, $sql))["MAX(mrn_re_id)"]) + 1;
//$finalcode = $max_trans_id * 9999;
//
//$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `mrn_request` WHERE `invoice`=\"$finalcode\""));
//while ($data != null) {
//    $finalcode *= mt_rand(100000, 1000000);
//    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `mrn_request` WHERE `invoice`=\"$finalcode\""));
//}

$finalcode_for_rmqc2 = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(ph_id) FROM purchase_history"))["MAX(ph_id)"]) + 1 * 9999;
$finalcode_for_rmqc = $a_id . $company . $finalcode_for_rmqc2;

$rmqcdata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `purchase_history` WHERE `invoice`=\"$finalcode_for_rmqc\""));
while ($rmqcdata != null) {
    $finalcode_for_rmqc *= mt_rand(100000, 1000000);
    $rmqcdata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `purchase_history` WHERE `invoice`=\"$finalcode_for_rmqc\""));
}

//$finalcode_for_dpqc = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(fph_id) FROM field_purchase_history"))["MAX(fph_id)"]) + 1 * 9999;
//
//$dpqcdata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `field_purchase_history` WHERE `invoice`=\"$finalcode_for_dpqc\""));
//while ($dpqcdata != null) {
//    $finalcode_for_dpqc *= mt_rand(100000, 1000000);
//    $dpqcdata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `field_purchase_history` WHERE `invoice`=\"$finalcode_for_rmqc\""));
//}
//$finalcode_for_pfdt = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(fdt_q) FROM `pro_fdt_q_control`"))["MAX(fdt_q)"]) + 1 * 9999;
//
//$pfdtdata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `pro_fdt_q_control` WHERE `qc_id`=\"$finalcode_for_pfdt\""));
//while ($pfdtdata != null) {
//    $finalcode_for_pfdt *= mt_rand(100000, 1000000);
//    $pfdtdata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `pro_fdt_q_control` WHERE `qc_id`=\"$finalcode_for_pfdt\""));
//}

$finalcode_for_po2 = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(po_id) FROM `purchase_order`"))["MAX(po_id)"]) + 1 * 9999;
$finalcode_for_po = $a_id . $company . $finalcode_for_po2;
$pfdtdatap = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `purchase_order` WHERE `invoice`=\"$finalcode_for_po\""));
while ($pfdtdatap != null) {
    $finalcode_for_po *= mt_rand(100000, 1000000);
    $pfdtdatap = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `purchase_order` WHERE `invoice`=\"$finalcode_for_po\""));
}

$finalcode_for_qo2 = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(qo_id) FROM `quotation`"))["MAX(qo_id)"]) + 1 * 9999;
$finalcode_for_qo = $a_id . $company . $finalcode_for_qo2;
$pfdtdataq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `quotation` WHERE `invoice`=\"$finalcode_for_qo\""));
while ($pfdtdataq != null) {
    $finalcode_for_qo *= mt_rand(100000, 1000000);
    $pfdtdataq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `quotation` WHERE `invoice`=\"$finalcode_for_qo\""));
}

$finalcode_for_bb2 = intval(mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(bb_id) FROM `stock_trans_b_to_b`"))["MAX(bb_id)"]) + 1 * 9999;
$finalcode_for_bb = $a_id . $company . $finalcode_for_bb2;
$pfdtdataqb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `stock_trans_b_to_b` WHERE `invoice`=\"$finalcode_for_bb\""));
while ($pfdtdataqb != null) {
    $finalcode_for_bb *= mt_rand(100000, 1000000);
    $pfdtdataqb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `stock_trans_b_to_b` WHERE `invoice`=\"$finalcode_for_bb\""));
}