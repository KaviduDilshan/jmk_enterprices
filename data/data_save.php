<?php

session_start();
include_once '../conn.php';


$order_id = base64_decode($_POST['order_id']);
$c_id = $_POST['inputCustomerid'];
$date = $_POST['date'];
$time = $_POST['time'];
$status = $_POST['status'];

$unit_price = $_POST['unit_price'];
$quantity = $_POST['quantity'];

$total_amount = $unit_price * $quantity;

$sql = "INSERT INTO order_save(order_id,c_id,order_date,order_time,total_price,order_status)"
    . "VALUES(\"$order_id\",\"$c_id\",\"$date\",\"$time\",\"$status\",\"$total_amount\")";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);

    
         header("Location: ../dashboad.php?order_id=" . base64_encode($order_id));
    
}
