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

$img_name = "";
$target_dir = "../image/customer/";
if (isset($_FILES["cus_image"])) {

    $img_name = mt_rand(100000, 1000000) . "_" . basename($_FILES["cus_image"]["name"]);
    $target_file = $target_dir . $img_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["cus_image"]["tmp_name"]);
    if ($check !== false) {
        if (file_exists($target_file)) {
            while (!file_exists($target_file)) {
                $img_name = mt_rand(100000, 1000000) . "_" . basename($_FILES["cus_image"]["name"]);
                $target_file = $target_dir . $img_name;
            }
        }

        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
            move_uploaded_file($_FILES["cus_image"]["tmp_name"], $target_file);
        }
    }
}

$sql = "INSERT INTO customer(nic,customer_name,customer_city,customer_address,customer_mobile,customer_gender,customer_birthdate,image)"
    . "VALUES(\"$nic\",\"$customer_name\",\"$customer_city\",\"$customer_address\",\"$customer_mobile\",\"$customer_gender\",\"$customer_birthdate\",\"$img_name\")";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);

    
        header('Location: ../dashboad.php?cu_id=' . base64_encode($last_id));
    
}
