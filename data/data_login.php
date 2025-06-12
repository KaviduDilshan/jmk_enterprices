<?php

session_start();
include_once '../conn.php';

//Fetching Values from URL
$login_pass = $_POST['a_password'];
$hash = password_hash($login_pass, PASSWORD_DEFAULT);
$login_user = $_POST['a_username'];

if ($login_pass != '' && $login_user != '') {

    $sqlcheck = "SELECT * FROM admins WHERE a_username='" . $login_user . "' ";
    $result = mysqli_query($con, $sqlcheck);

    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);
        if (password_verify($login_pass, $res['a_password'])) {
            if ($_SESSION['SecKey'] == '') {
                $_SESSION['login'] = $res['a_id'];

                header('Location: ../dashboad.php');
            } else {

                header('Location: ../index.php');
            }
        } else {
            header('Location: ../index.php?error=1');
        }
    } else {
        header('Location: ../index.php?error=1');
    }
} else {
    header('Location: ../index.php?error=0');
}

