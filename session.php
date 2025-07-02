<?php

session_start();
include_once './inc/functions.php';
include_once './conn.php';



if ($_SESSION['login'] == '') {
   
    header('Location: index.php');
    exit();
}

//if ($_SESSION['site'] != $_SESSION['last_site']) {
//    include_once '../inc/del_session.php';
//    header('Location: login.php');
//    exit();
//}
