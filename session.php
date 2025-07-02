<?php

session_start();
include_once '../inc/functions.php';


if ($_SESSION['SecKey'] != getSecKey($_SESSION['login'], $conn)) {

    include_once '../inc/del_session.php';
    header('Location: login.php');
    exit();
}

if ($_SESSION['login'] == '') {

    include_once '../inc/del_session.php';
    header('Location: login.php');
    exit();
}

//if ($_SESSION['site'] != $_SESSION['last_site']) {
//    include_once '../inc/del_session.php';
//    header('Location: login.php');
//    exit();
//}
