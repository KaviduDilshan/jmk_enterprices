<?php

session_start();
include_once '../conn.php';


$nic = $_POST['nic'];
$guarantor_name = $_POST['guarantor_name'];
$guarantor_city = $_POST['guarantor_city'];
$guarantor_address = $_POST['guarantor_address'];
$guarantor_mobile_01 = $_POST['guarantor_mobile_01'];
$guarantor_mobile_02 = $_POST['guarantor_mobile_02'];
$guarantor_gender = $_POST['guarantor_gender'];
$birthdate = $_POST['birthdate'];
$gua_image =isset($_POST['gua_image']) ? $_POST['gua_image']:"";

$img_name = "";
$target_dir = "../image/guarantor/";
if (isset($_FILES["gua_image"])) {

    $img_name = mt_rand(100000, 1000000) . "_" . basename($_FILES["gua_image"]["name"]);
    $target_file = $target_dir . $img_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["gua_image"]["tmp_name"]);
    if ($check !== false) {
        if (file_exists($target_file)) {
            while (!file_exists($target_file)) {
                $img_name = mt_rand(100000, 1000000) . "_" . basename($_FILES["gua_image"]["name"]);
                $target_file = $target_dir . $img_name;
            }
        }

        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
            move_uploaded_file($_FILES["gua_image"]["tmp_name"], $target_file);
        }
    }
}

$sql = "INSERT INTO guarantor (nic,guarantor_name,guarantor_city,guarantor_address,guarantor_mobile_01,guarantor_mobile_02,gender,birthdate,image)"
    . "VALUES(\"$nic\",\"$guarantor_name\",\"$guarantor_city\",\"$guarantor_address\",\"$guarantor_mobile_01\",\"$guarantor_mobile_02\",\"$guarantor_gender\",\"$birthdate\",\"$img_name\")";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);

    
        header('Location: ../dashboad.php?cu_id=' . base64_encode($last_id));
    
}
