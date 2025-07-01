<?php

if (file_exists('../conn.php')) {
    include_once '../conn.php';
}

function filterDate($prefer_date, $dateFrom, $dateTo) {
    $date1 = strtotime(trim($dateFrom));
    $date2 = strtotime(trim($dateTo));
    $theDate = strtotime(trim($prefer_date));
    if ($dateFrom != "" && $dateTo != "") {
        if ($theDate >= $date1 && $theDate <= $date2) {
            return true;
        } else {
            return false;
        }
    } elseif ($dateFrom == "" && $dateTo != "") {
        if ($theDate <= $date2) {
            return true;
        } else {
            return false;
        }
    } elseif ($dateFrom != "" && $dateTo == "") {
        if ($theDate >= $date1) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function getProDet($pro_id, $conn) {

    $sql = "SELECT * FROM products WHERE pro_id =$pro_id";
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function getRowMetDet($rmet_id, $conn) {

    $sql = "SELECT * FROM raw_material WHERE rmet_id=$rmet_id";
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function getAdminDetails($a_id, $conn) {

    $sql = "SELECT * FROM admins where a_id='" . $a_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    return $res;
}

function getAdminType($at_id, $conn) {
    $sql = "SELECT * FROM admin_types where at_id='" . $at_id . "'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    return $res['at_name'];
}

function getAdminTypeByid($a_id, $conn) {
    $sql = "SELECT * FROM admins where a_id='" . $a_id . "'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    return getAdminType($res['a_type'], $conn);
}

function setSecKey($a_id, $conn) {

    $sec_key = rand(1000, 9999);

    $sql = "update admins set  a_sec_key ='" . $sec_key . "'where a_id='" . $a_id . "'";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        $sec_key = '0';
    }

    return $sec_key;
}

function getSecKey($a_id, $conn) {

    $sql = "SELECT a_sec_key FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $res = mysqli_fetch_assoc($result);
        return $res['a_sec_key'];
    }else{
        return 0;
    }
}

function getAdminRef($a_id, $conn) {

    $sql = "SELECT a_ref FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int) $res['a_ref'];
}

function show_status($status) {

    $result = '';

    if ($status == 1) {
        $result = "Active";
    } elseif ($status == 2) {
        $result = "Inactive";
    } else {
        $result = "Pending";
    }

    return $result;
}

function getaAdminUpline($a_id, $conn) {

    $sql = "SELECT a_upline FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int) $res['a_upline'];
}

function getaAdminCountry($a_id, $conn) {

    $sql = "SELECT a_country FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_country'];
}

function getaAdminCity($a_id, $conn) {

    $sql = "SELECT a_city FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_city'];
}

function getaAdminLastLevel($u_id, $conn) {

    $sql = "SELECT u_type5_by FROM users WHERE u_id = '" . $u_id . "' and u_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int) $res['u_type5_by'];
}

function getAdminCurrency($a_id, $conn) {

    $sql = "SELECT a_currency FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return (int) $res['a_currency'];
}

function getCurrencyByCu_id($cu_id, $conn) {

    $sql = "select cu_symbol from currency where cu_id= '" . $cu_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cu_symbol'];
}

function getaAdminUserName($a_id, $conn) {

    $sql = "SELECT a_username FROM admins WHERE a_id = '" . $a_id . "' and a_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['a_username'];
}

function getUserName($u_id, $conn) {

    $sql = "SELECT u_username FROM users WHERE u_id = '" . $u_id . "' and u_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['u_username'];
}

function getUserUplineName($u_id, $conn) {
    $u_name = '';
    $sql = "SELECT u_username FROM users WHERE u_id = '" . $u_id . "' and u_status ='1'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);

        $u_name = $res['u_username'];
    } else {

        $u_name = getaAdminUserName($u_id, $conn);
    }

    return $u_name;
}

function getCategoryByCat_id($cat_id, $conn) {

    $sql = "select cat_id,cat_name from category where cat_id= '" . $cat_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cat_name'];
}

//nfuel

function get_db_opening_balce($c_id, $conn) {

    $sql = "select c_id,deb_amount from customer_opening_balance where c_id= '" . $c_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['deb_amount'];
}

function get_cr_opening_balce($c_id, $conn) {

    $sql = "select c_id,cre_amount from customer_opening_balance where c_id= '" . $c_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cre_amount'];
}

function get_s_db_opening_balce($v_id, $conn) {

    $sql = "select v_id,deb_amount from supplier_opening_balance where v_id= '" . $v_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['deb_amount'];
}

function get_s_cr_opening_balce($v_id, $conn) {

    $sql = "select v_id,cre_amount from supplier_opening_balance where v_id= '" . $v_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cre_amount'];
}

function get_e_db_opening_balce($emp_id, $conn) {

    $sql = "select emp_id,deb_amount from employer_opening_balance where emp_id= '" . $emp_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['deb_amount'];
}

function get_e_cr_opening_balce($emp_id, $conn) {

    $sql = "select emp_id,cre_amount from employer_opening_balance where emp_id= '" . $emp_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cre_amount'];
}

function get_b_db_opening_balce($ba_id, $conn) {

    $sql = "select ba_id,deb_amount from bank_opening_balance where ba_id= '" . $ba_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['deb_amount'];
}

function get_b_cr_opening_balce($ba_id, $conn) {

    $sql = "select ba_id,cre_amount from bank_opening_balance where ba_id= '" . $ba_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['cre_amount'];
}

function get_supplier_name($v_id, $conn) {

    $sql = "SELECT vendor_name FROM vendor WHERE v_id = '" . $v_id . "' and vendor_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['vendor_name'];
}

function get_customer_name($c_id, $conn) {

    $sql = "SELECT customer_name FROM customer WHERE c_id = '" . $c_id . "' and customer_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['customer_name'];
}

function get_employer_name($emp_id, $conn) {

    $sql = "SELECT f_name,l_name FROM employers WHERE emp_id = '" . $emp_id . "' and m_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['f_name'] . " " . $res['l_name'];
}

function get_unit_name($un_id, $conn) {

    $sql = "SELECT symbol FROM unit WHERE un_id = '" . $un_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['symbol'];
}

function get_bank_name($ba_id, $conn) {

    $sql = "SELECT ba_name FROM banks WHERE ba_id = '" . $ba_id . "' and ba_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['ba_name'] . '' . $res['ba_acc_no'];
}

function get_ex_cat_name($exc_id, $conn) {

    $sql = "SELECT name FROM ex_cat WHERE exc_id = '" . $exc_id . "'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_owner_name($ow_id, $conn) {

    $sql = "SELECT ow_name FROM owners WHERE ow_id = '" . $ow_id . "' and ow_status ='1'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['ow_name'];
}

function isEqualYMonth($Thatdate) {
    $data = explode("-", trim(strval($Thatdate)));
    $dbMon = intval($data[1]);
    $dbY = intval($data[0]);
    $thisMon = intval(date("m"));
    $thisY = intval(date("Y"));
    if ($dbMon == $thisMon && $dbY == $thisY) {
        return true;
    } else {
        return false;
    }
}

function get_mon_qty_sales($pro_id, $conn) {
    $this_year = date("Y");
    $mon = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $mon_qty = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $mon_val = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $sal_re = mysqli_query($conn, "SELECT * FROM sales_order WHERE pro_id=$pro_id AND date LIKE '$this_year%'");
    while ($sal_row = mysqli_fetch_array($sal_re)) {
        $db_mon = intval(explode("-", $sal_row["date"])[1]);
        for ($index = 0; $index < 12; $index++) {
            if ($db_mon == $mon[$index]) {
                $mon_qty[$index] += floatval($sal_row["quantity"]);
                $mon_val[$index] += floatval($sal_row["total"]);
                break;
            }
        }
    }
    return [$mon_qty, $mon_val];
}

function get_product_name($pro_id, $conn) {

    $sql = "SELECT product_name FROM products WHERE pro_id = '" . $pro_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['product_name'];
}

function get_product_det($pro_id, $conn) {

    $sql = "SELECT * FROM products WHERE pro_id = '" . $pro_id . "' ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function get_raw_product_det($raw_id, $conn) {

    $sql = "SELECT * FROM raw_material WHERE rmet_id = '" . $raw_id . "' ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function get_rcat_name($cat_id, $conn) {

    $sql = "SELECT name FROM raw_category WHERE cat_id = '" . $cat_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_salesby_invoice($invoice, $conn) {

    $sql = "SELECT * FROM sales_order WHERE invoice = '$invoice' ";
    return mysqli_query($conn, $sql);
}

function get_mrn_by_invoice($invoice, $conn) {

    $sql = "SELECT * FROM mrn_order WHERE invoice = '$invoice' ";
    return mysqli_query($conn, $sql);
}

function getTotalDisByInvoice($invoice, $conn) {
    $sql = "SELECT SUM(dis_amount) FROM temp_dis WHERE invoice = '$invoice' ";
    return floatval(mysqli_fetch_assoc(mysqli_query($conn, $sql))['SUM(dis_amount)']);
}

function get_ex_methord($ex_me_id, $conn) {

    $sql = "SELECT name FROM ex_methods WHERE ex_me_id = '" . $ex_me_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['name'];
}

function get_rawmet_name($rmet_id, $conn) {

    $sql = "SELECT row_name FROM raw_material WHERE rmet_id = '" . $rmet_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['row_name'];
}

function get_rawmet_code($rmet_id, $conn) {

    $sql = "SELECT code FROM raw_material WHERE rmet_id = '" . $rmet_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['code'];
}

function get_dep_det($de_id, $conn) {
    $sql = "SELECT * FROM `department` WHERE `de_id` = " . $de_id;
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function get_pro_name($rmet_id, $conn) {

    $sql = "SELECT product_name FROM products WHERE pro_id = '" . $rmet_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['product_name'];
}

function get_pro_code($rmet_id, $conn) {

    $sql = "SELECT barcode FROM products WHERE pro_id = '" . $rmet_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['barcode'];
}

function get_cus_trans($c_id, $conn) {
    $sql = "SELECT SUM(total),SUM(paid_amount) FROM `transaction` WHERE `c_id` = " . $c_id;
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function get_ven_trans($v_id, $conn) {
    $sql = "SELECT SUM(deb_amount),SUM(cre_amount) FROM `credit_bill` WHERE `v_id` = " . $v_id;
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function get_dealer_price($pro_id, $conn) {

    $sql = "SELECT dealer_price FROM products WHERE pro_id = '" . $pro_id . "' ";
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function get_exc_methord($exc_id, $conn) {

    $sql = "SELECT ex_me_id FROM ex_cat WHERE exc_id = '" . $exc_id . "' ";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['ex_me_id'];
}

function get_sal_det($e_id, $conn) {
    $sql = "SELECT * FROM `salary` WHERE `emp_id` = " . $e_id;
    return mysqli_query($conn, $sql);
}
