<?php

session_start();
include_once '../conn.php';


$order_id = base64_decode($_POST['order_id']);
$c_id = $_POST['customer_id'];
$guarantor_1_id = $_POST['guarantor_1_id'];
$guarantor_2_id = $_POST['guarantor_2_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$total_amount = $_POST['totalAmount'];
$status = $_POST['status'];

$sql = "INSERT INTO order_save(order_id,c_id,gu_id_1,gu_id_2,order_date,order_time,total_price,order_status)"
    . "VALUES(\"$order_id\",\"$c_id\",\"$guarantor_1_id\",\"$guarantor_2_id\",\"$date\",\"$time\",\"$total_amount\",\"$status\")";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);

    
         header("Location: ../dashboad.php?order_id=" . base64_encode($order_id));
    
}
