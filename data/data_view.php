<?php
session_start();
include_once '../conn.php';

$order_id = base64_decode($_POST['order_id']);
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$unit_price = $_POST['unit_price'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];
$warrenty_end = $_POST['warrenty_end'];
$duration = $_POST['duration'];
$company = 1;
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

$total = $unit_price * $quantity;

$sql = "INSERT INTO hp_sales_order (invoice,date,pro_id,quantity,unit_price,total,warrenty_end,duration,company) 
        VALUES('$order_id','$date','$product_id','$quantity','$unit_price','$total','$warrenty_end','$duration','$company')";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
    mysqli_query($con, "UPDATE products SET $bra = $bra - $quantity WHERE pro_id=$product_id");
    header("Location: ../order.php?order_id=" . base64_encode($order_id));

    exit();
}
