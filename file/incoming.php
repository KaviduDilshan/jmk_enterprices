<?php

include_once '../../conn.php';
if (isset($_POST["add"])) {

    $the_date = date("Y-m-d");
    $invoice = trim($_POST["invoice"]);
    $pro_id = intval($_POST["pro_id"]);
    $pro_det = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE pro_id=$pro_id"));
    $quantity = floatval(trim($_POST["quantity"]));
    $unit_p = floatval(trim($_POST["unit_p"]));
    $real_price = floatval($pro_det["unit_price"]);
    $warrenty_end = $_POST["warrenty_end"];
    $duration = $_POST["duration"];
    $serial = $_POST["serial"];
    $tot = $quantity * $unit_p;
    $company = intval($_POST["bra"]);
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
    $in_type = $_POST["in_type"];
    $ses_id = $_POST["ses_id"];

    $bim_des = 'Issue Inovice';

    $query = "INSERT INTO sales_order (invoice,date,pro_id,quantity,unit_price,total,warrenty_end,duration,company,serial) VALUES(\"$invoice\",\"$the_date\",\"$pro_id\",\"$quantity\",\"$unit_p\",\"$tot\",\"$warrenty_end\",\"$duration\",\"$company\",\"$serial\")";
    mysqli_query($conn, $query);
    $sales_id = mysqli_insert_id($conn);
    
    $query_bim = "INSERT INTO bim_card (date,unit_price,description,sales_id,pro_id,stock_out,company) VALUES (\"$the_date\",\"$real_price\",\"$bim_des\",\"$sales_id\",\"$pro_id\",\"$quantity\",\"$company\")";
    mysqli_query($conn, $query_bim);

    if ($unit_p < $real_price) {
        $dis_am = ($real_price - $unit_p) * $quantity;
        $query = "INSERT INTO temp_dis(invoice,dis_amount,sales_id) VALUES('$invoice',$dis_am,'$sales_id')";
        mysqli_query($conn, $query);
    }
    if ($in_type == 1) {
        mysqli_query($conn, "UPDATE sezing_stock SET $bra = $bra - $quantity WHERE ses_id=$ses_id");
        header("location:../billing_seized.php?invoice=$invoice");
    } else {
        //mysqli_query($conn, "UPDATE products SET $bra = $bra - $quantity WHERE pro_id=$pro_id");
        header("location:../billing.php?invoice=$invoice");
    }
} else {
    header("location:../");
}
