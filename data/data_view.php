<?php

session_start();
include_once '../conn.php';


$nic = $_POST['nic'];
$customer_name = $_POST['customer_name'];
$customer_city = $_POST['customer_city'];
$customer_address = $_POST['customer_address'];
$customer_mobile = $_POST['customer_mobile'];
$customer_gender = $_POST['customer_gender'];
$customer_birthdate = $_POST['customer_birthdate'];
$cus_image =isset($_POST['cus_image']) ? $_POST['cus_image']:"";

$sql = "INSERT INTO customer(nic,customer_name,customer_city,customer_address,customer_mobile,customer_gender,customer_birthdate,image)"
    . "VALUES(\"$nic\",\"$customer_name\",\"$customer_city\",\"$customer_address\",\"$customer_mobile\",\"$customer_gender\",\"$customer_birthdate\",\"$cus_image\")";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);

    
        header('Location: ../dashboad.php?cu_id=' . base64_encode($last_id));
    
}