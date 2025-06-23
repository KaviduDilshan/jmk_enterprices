<?php

session_start();
include_once '../conn.php';

if (isset($_GET["order_id"]) && isset($_SESSION['login'])) {
    $invoice = base64_decode($_GET["order_id"]);

    $query = "SELECT * FROM `hp_sales_order` WHERE `invoice`=$invoice";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0):
        while ($row = mysqli_fetch_assoc($result)):
            $hp_sales_id = $row['hp_sales_id'];
            $company = $row['company'];
            $qty = $row['quantity'];
            $pro_id = $row['pro_id'];
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
            mysqli_query($con, "DELETE FROM `hp_sales_order` WHERE `hp_sales_id`=$hp_sales_id");

        endwhile;
        header("Location:../dashboad.php");
    else:
        header("Location:../dashboad.php");
    endif;

    // $po_det = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `hp_sales_order` WHERE `hp_sales_id`=$hp_sales_id"));
    // $qty = $po_det["quantity"];
    // $pro_id = $po_det["pro_id"];
    // $company = $po_det['company'];
    // if ($company == 1) {
    //     $bra = 'qty_b1';
    // } elseif ($company == 2) {
    //     $bra = 'qty_b2';
    // } elseif ($company == 3) {
    //     $bra = 'qty_b3';
    // } elseif ($company == 4) {
    //     $bra = 'qty_b4';
    // } elseif ($company == 5) {
    //     $bra = 'qty_b5';
    // }
    // mysqli_query($con, "UPDATE products SET $bra = $bra + $qty WHERE pro_id=$pro_id");
    // if ($po_det != null) {
    //     mysqli_query($con, "DELETE FROM `hp_sales_order` WHERE `hp_sales_id`=$hp_sales_id");
    // }
    // header("Location:../today_oder.php?order_id=" . base64_encode($invoice));
}