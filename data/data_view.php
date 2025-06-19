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

$total_amount = $unit_price * $quantity;

$sql = "INSERT INTO hp_sales_order (invoice,pro_id,unit_price,total,quantity,date,warrenty_end,duration,company) 
        VALUES('$order_id','$product_id','$unit_price','$total_amount','$quantity','$date','$warrenty_end','$duration','$company')";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
    header("Location: ../order.php?order_id=" . base64_encode($order_id));

    exit();
}
