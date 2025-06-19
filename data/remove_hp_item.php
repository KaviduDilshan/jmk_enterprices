<?php

session_start();
include_once '../conn.php';

if (isset($_GET["hp_sales_id"]) && isset($_GET["order_id"]) && isset($_SESSION['login'])) {
    $hp_sales_id = base64_decode($_GET["hp_sales_id"]);
    $invoice = $_GET["order_id"];
    

    $po_det = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `hp_sales_order` WHERE `hp_sales_id`=$hp_sales_id"));
    $qty = $po_det["quantity"];
    $pro_id = $po_det["pro_id"];
    $company = $po_det['company'];
    if ($company == 1) {
        $bra = 'qty_b1';
    } elseif ($company == 2) {
        $bra = 'qty_b2';
    } elseif ($company == 3) {
        $bra = 'qty_b3';
    } elseif ($company == 4) {
        $bra = 'qty_b4';
    } elseif ($company == 5) {
        $bra = 'qty_b5';
    }
    mysqli_query($con, "UPDATE products SET $bra = $bra + $qty WHERE pro_id=$pro_id");
    if ($po_det != null) {
        mysqli_query($con, "DELETE FROM `hp_sales_order` WHERE `hp_sales_id`=$hp_sales_id");
    }
    header("Location:../today_oder.php?order_id=" . base64_encode($invoice));
}