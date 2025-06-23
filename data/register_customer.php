<?php

include_once '../../conn.php';
include_once '../../inc/functions.php';

//Fetching Values from URL
if (isset($_POST['c_id'])) {
    $c_id = $_POST['c_id'];
} else {
    $c_id = 0;
}
if (isset($_POST['customer_name'])) {
    $customer_name = $_POST['customer_name'];
} else {
    $customer_name = 0;
}
if (isset($_POST['customer_city'])) {
    $customer_city = $_POST['customer_city'];
} else {
    $customer_city = '';
}
if (isset($_POST['customer_address'])) {
    $customer_address = $_POST['customer_address'];
} else {
    $customer_address = '-';
}
if (isset($_POST['customer_mobile'])) {
    $customer_mobile = $_POST['customer_mobile'];
} else {
    $customer_mobile = '1';
}
if (isset($_POST['customer_gender'])) {
    $customer_gender = $_POST['customer_gender'];
} else {
    $customer_gender = 0;
}
if (isset($_POST['customer_birthdate'])) {
    $customer_birthdate = $_POST['customer_birthdate'];
} else {
    $customer_birthdate = '';
}
if (isset($_POST['customer_status'])) {
    $customer_status = $_POST['customer_status'];
} else {
    $customer_status = '1';
}
if (isset($_POST['customer_type'])) {
    $customer_type = $_POST['customer_type'];
} else {
    $customer_type = '1';
}
if (isset($_POST['company'])) {
    $company = $_POST['company'];
} else {
    $company = '1';
}
if (isset($_POST['deb_amount'])) {
    $deb_amount = $_POST['deb_amount'];
} else {
    $deb_amount = '0';
}
if (isset($_POST['cre_amount'])) {
    $cre_amount = $_POST['cre_amount'];
} else {
    $cre_amount = '0';
}
if (isset($_POST['nic'])) {
    $nic = $_POST['nic'];
} else {
    $nic = '1';
}

$img_name = "";
$target_dir = "../img/cus_imgs/";
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

//Action 
$action = $_POST['action'];
$today = date('Y-m-d');

if ($action == 'register') {

    $pass = 'Sa@3$sTa';
    $MSISDN = $customer_mobile;
    $MESSAGE = "Dear $customer_name,\nWelcome to Savista Trade Center\n\nThank you for choosing us.!";
    $USERNAME = "savista";
    $PWD = $pass;
    $SRC = "SAVISTA";

    $url = 'http://sms.airtel.lk:5000/sms/send_sms.php';
    $myvars = 'username=' . $USERNAME . '&password=' . $PWD . '&src=' . $SRC . '&dst=' . $MSISDN . '&msg=' . $MESSAGE;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    $sql = "INSERT INTO `customer` ( `customer_name`,`customer_city`, `customer_address`, `nic`, `customer_mobile`, `customer_gender`,`customer_birthdate`, `customer_status`, `customer_type`, `company`, `image`) VALUES "
            . "( '" . $customer_name . "', '" . $customer_city . "', '" . $customer_address . "', '" . $nic . "', '" . $customer_mobile . "', '" . $customer_gender . "', '" . $customer_birthdate . "', '" . $customer_status . "', '" . $customer_type . "', '" . $company . "','" . $img_name . "')";

    if (mysqli_query($conn, $sql)) {

        $last_id = mysqli_insert_id($conn);
        $sql1 = "INSERT INTO `customer_opening_balance` ( `c_id`,`deb_amount`, `cre_amount`, `date`) VALUES ( '" . $last_id . "', '" . $deb_amount . "', '" . $cre_amount . "', '" . $today . "')";

        if (mysqli_query($conn, $sql1)) {

            if ($deb_amount > 0) {
                $sql11 = "INSERT INTO `customer_ledger` ( `c_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $last_id . "', '" . $deb_amount . "', '1', 'Opening Balance', '" . $company . "', '" . $today . "')";

                if (mysqli_query($conn, $sql11)) {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                } else {
                    header('Location: ../customer_list.php?error=' . base64_encode(10));
                }
            } elseif ($cre_amount > 0) {
                $sql11 = "INSERT INTO `customer_ledger` ( `c_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $last_id . "', '" . $cre_amount . "', '1', 'Opening Balance', '" . $company . "', '" . $today . "')";

                if (mysqli_query($conn, $sql11)) {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                } else {
                    header('Location: ../customer_list.php?error=' . base64_encode(10));
                }
            } else {
                $sql11 = "INSERT INTO `customer_ledger` ( `c_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $last_id . "', '" . $deb_amount . "', '1', 'Opening Balance', '" . $company . "', '" . $today . "')";

                if (mysqli_query($conn, $sql11)) {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                } else {
                    header('Location: ../customer_list.php?error=' . base64_encode(10));
                }
            }
        }
    } else {
        if ($img_name != "" && file_exists($target_dir . $img_name)) {
            unlink($target_dir . $img_name);
        }
        header('Location: ../customer.php?error=' . base64_encode(3));
    }
}

if ($action == 'update' && $c_id > 0) {
    $sql = "update customer set c_id='" . $c_id . "', customer_name='" . $customer_name . "', customer_city='" . $customer_city . "', customer_address='" . $customer_address . "', nic='" . $nic . "', customer_mobile='" . $customer_mobile . "', `image` = '" . $img_name . "', customer_gender='" . $customer_gender . "', customer_birthdate='" . $customer_birthdate . "', customer_status='" . $customer_status . "', customer_type='" . $customer_type . "', company='" . $company . "' where c_id='" . $c_id . "'";

    if (mysqli_query($conn, $sql)) {

        $sqlcheck1 = "SELECT * FROM customer_opening_balance WHERE c_id='" . $c_id . "'";
        $result = mysqli_query($conn, $sqlcheck1);

        if (mysqli_num_rows($result) > 0) {
            $sql1 = "update customer_opening_balance set c_id='" . $c_id . "', deb_amount='" . $deb_amount . "', cre_amount='" . $cre_amount . "', last_update='" . $today . "' where c_id='" . $c_id . "'";

            if (mysqli_query($conn, $sql1)) {
                if ($deb_amount > 0) {
                    $sql11 = "update customer_ledger set c_id='" . $c_id . "', deb_amount='" . $deb_amount . "', cre_amount='0', date='" . $today . "' where c_id='" . $c_id . "'";

                    if (mysqli_query($conn, $sql11)) {
                        header('Location: ../customer.php?c_id=' . base64_encode($c_id) . '&error=' . base64_encode(1));
                    } else {
                        header('Location: ../customer.php?c_id=' . base64_encode($c_id) . '&error=' . base64_encode(10));
                    }
                } elseif ($cre_amount > 0) {
                    $sql11 = "update customer_ledger set c_id='" . $c_id . "', deb_amount='0', cre_amount='" . $cre_amount . "', date='" . $today . "' where c_id='" . $c_id . "'";

                    if (mysqli_query($conn, $sql11)) {
                        header('Location: ../customer.php?c_id=' . base64_encode($c_id) . '&error=' . base64_encode(1));
                    } else {
                        header('Location: ../customer.php?c_id=' . base64_encode($c_id) . '&error=' . base64_encode(10));
                    }
                } elseif ($cre_amount == 0 && $deb_amount == 0) {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                } else {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                }
            } else {
                header('Location: ../customer_list.php?error=' . base64_encode(10));
            }
        } else {
            $sql1 = "INSERT INTO `customer_opening_balance` ( `c_id`,`deb_amount`, `cre_amount`, `date`) VALUES ( '" . $c_id . "', '" . $deb_amount . "', '" . $cre_amount . "', '" . $today . "')";

            if (mysqli_query($conn, $sql1)) {

                if ($deb_amount > 0) {
                    $sql11 = "INSERT INTO `customer_ledger` ( `c_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $deb_amount . "', '1', 'Opening Balance', '" . $company . "', '" . $today . "')";

                    if (mysqli_query($conn, $sql11)) {
                        header('Location: ../customer_list.php?error=' . base64_encode(4));
                    } else {
                        header('Location: ../customer_list.php?error=' . base64_encode(10));
                    }
                } elseif ($cre_amount > 0) {
                    $sql11 = "INSERT INTO `customer_ledger` ( `c_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $cre_amount . "', '1', 'Opening Balance', '" . $company . "', '" . $today . "')";

                    if (mysqli_query($conn, $sql11)) {
                        header('Location: ../customer_list.php?error=' . base64_encode(4));
                    } else {
                        header('Location: ../customer_list.php?error=' . base64_encode(10));
                    }
                } elseif ($cre_amount == 0 && $deb_amount == 0) {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                } else {
                    header('Location: ../customer_list.php?error=' . base64_encode(4));
                }
            } else {
                header('Location: ../customer_list.php?error=' . base64_encode(10));
            }
        }
    } else {
        header('Location: ../customer.php?c_id=' . base64_encode($c_id) . '&error=' . base64_encode(3));
    }
}


 
