<?php

include_once '../session.php';

$lo_ty = $company = 0;
if (isset($_SESSION['login_type']) && isset($_SESSION['company'])) {
    $lo_ty = intval($_SESSION['login_type']);
    $company = intval($_SESSION['company']);
} else {
    session_destroy();
    die();
}

//Customer list ----------------------------------------------------

$sql = "select * from customer ORDER BY c_id DESC";
$result_customer_list = mysqli_query($conn, $sql);

//Customer view ----------------------------------------------------

if (isset($_GET['c_id'])) {
    $c_id = base64_decode($_GET['c_id']);
} else {
    $c_id = 0;
}

if ($c_id > 0) {

    $sql = "select * from customer where c_id='" . $c_id . "'";
    $result_customer_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_customer_view);
}

//Supplier list -----------------------------------------------------

$sql_supplier_list = "select * from vendor ORDER BY v_id DESC";
$result_supplier_list = mysqli_query($conn, $sql_supplier_list);

//Supplier view -----------------------------------------------------

if (isset($_GET['v_id'])) {
    $v_id = base64_decode($_GET['v_id']);
} else {
    $v_id = 0;
}

if ($v_id > 0) {

    $sql = "select * from vendor where v_id='" . $v_id . "'";
    $result_supplier_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_supplier_view);
}

//Department list ---------------------------------------------------

$sql_department_list = "select * from department ORDER BY de_id DESC";
$result_department_list = mysqli_query($conn, $sql_department_list);

//Department view ---------------------------------------------------

if (isset($_GET['de_id'])) {
    $de_id = base64_decode($_GET['de_id']);
} else {
    $de_id = 0;
}

if ($de_id > 0) {

    $sql = "select * from department where de_id='" . $de_id . "'";
    $result_department_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_department_view);
}

//Employer list ----------------------------------------------------

if (($lo_ty == 3) || ($lo_ty > 4)) {
    $sql_employers_list = "select * from employers WHERE company = $company ORDER BY de_id DESC";
} else {
    $sql_employers_list = "select * from employers ORDER BY de_id DESC";
}
$result_employers_list = mysqli_query($conn, $sql_employers_list);

//Employer view -----------------------------------------------------

if (isset($_GET['emp_id'])) {
    $emp_id = base64_decode($_GET['emp_id']);
} else {
    $emp_id = 0;
}

if ($emp_id > 0) {

    $sql = "select * from employers where emp_id='" . $emp_id . "'";
    $result_employers_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_employers_view);
}

//Bank list ---------------------------------------------------------

if (isset($_GET['c_card'])) {
    $c_card = base64_decode($_GET['c_card']);
} else {
    $c_card = 0;
}

$sql_bank_list = "select * from banks where c_card='" . $c_card . "' ORDER BY ba_id DESC";
$result_bank_list = mysqli_query($conn, $sql_bank_list);

//Bank view ---------------------------------------------------------

if (isset($_GET['ba_id'])) {
    $ba_id = base64_decode($_GET['ba_id']);
} else {
    $ba_id = 0;
}

if ($ba_id > 0) {

    $sql = "select * from banks where ba_id='" . $ba_id . "'";
    $result_bank_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_bank_view);
}

//Product list & Report -------------------------------------------------------

$sql_product_list = "select * from products ORDER BY pro_id DESC";
$result_product_list = mysqli_query($conn, $sql_product_list);

//Product view -------------------------------------------------------

if (isset($_GET['pro_id'])) {
    $pro_id = base64_decode($_GET['pro_id']);
} else {
    $pro_id = 0;
}

if ($pro_id > 0) {

    $sql = "select * from products where pro_id='" . $pro_id . "'";
    $result_product_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_product_view);
}

//Major Product list & Report -------------------------------------------------------

$sql_m_product_list = "select * from major_products ORDER BY m_pro_id DESC";
$result_m_product_list = mysqli_query($conn, $sql_m_product_list);

//Major Product view -------------------------------------------------------

if (isset($_GET['m_pro_id'])) {
    $m_pro_id = base64_decode($_GET['m_pro_id']);
} else {
    $m_pro_id = 0;
}

if ($m_pro_id > 0) {

    $sql = "select * from major_products where m_pro_id='" . $m_pro_id . "'";
    $result_m_product_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_m_product_view);
}

//Category list -------------------------------------------------------

$sql_category_list = "select * from category ORDER BY name DESC";
$result_category_list = mysqli_query($conn, $sql_category_list);

//Category view -------------------------------------------------------

if (isset($_GET['category_id'])) {
    $category_id = base64_decode($_GET['category_id']);
} else {
    $category_id = 0;
}

if ($category_id > 0) {

    $sql = "select * from category where category_id='" . $category_id . "'";
    $result_category_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_category_view);
}

////Expenses Category list -------------------------------------------------------
//
//$sql_expenses_list = "select * from ex_cat ORDER BY name DESC";
//$result_expenses_list = mysqli_query($conn, $sql_expenses_list);
//
////Expenses Category view -------------------------------------------------------
//
//if (isset($_GET['exc_id'])) {
//    $exc_id = base64_decode($_GET['exc_id']);
//} else {
//    $exc_id = 0;
//}
//
//if ($exc_id > 0) {
//
//    $sql = "select * from ex_cat where exc_id='" . $exc_id . "'";
//    $result_expenses_view = mysqli_query($conn, $sql);
//    $row = mysqli_fetch_assoc($result_expenses_view);
//}
//Bank Deposit list -------------------------------------------------------
if (($lo_ty == 3) || ($lo_ty > 4)) {
    $sql_deposit_list = "select * from bank_ledger where bl_type <= 4 AND company = $company ORDER BY bl_id DESC";
} else {
    $sql_deposit_list = "select * from bank_ledger where bl_type <= 4 ORDER BY bl_id DESC";
}
$result_deposit_list = mysqli_query($conn, $sql_deposit_list);

//Bank Withdraw list -------------------------------------------------------
if (($lo_ty == 3) || ($lo_ty > 4)) {
    $sql_withdraw_list = "select * from bank_ledger where bl_type >= 5 AND bl_type <= 7 AND company = $company ORDER BY bl_id DESC";
} else {
    $sql_withdraw_list = "select * from bank_ledger where bl_type >= 5 AND bl_type <= 7 ORDER BY bl_id DESC";
}
$result_withdraw_list = mysqli_query($conn, $sql_withdraw_list);

//Bank Deposit / Withdraw view -------------------------------------------------------

if (isset($_GET['bl_id'])) {
    $bl_id = base64_decode($_GET['bl_id']);
} else {
    $bl_id = 0;
}

if ($bl_id > 0) {

    $sql = "select * from bank_ledger where bl_id='" . $bl_id . "'";
    $result_deposit_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_deposit_view);
}

//Customer Account list -------------------------------------------------------

$sql_customer_acc_list = "select * from customer_ledger ORDER BY cl_id DESC";
$result_customer_acc_list = mysqli_query($conn, $sql_customer_acc_list);

$sql_customer_acc_sum = "select c_id,date,SUM(deb_amount),SUM(cre_amount) from customer_ledger";
$result_customer_acc_sum = mysqli_query($conn, $sql_customer_acc_sum);

//Employer Account list -------------------------------------------------------

$sql_employer_acc_list = "select * from employer_ledger ORDER BY eml_id DESC";
$result_employer_acc_list = mysqli_query($conn, $sql_employer_acc_list);

//Supplier Account list -------------------------------------------------------

$sql_supplier_acc_list = "select * from supplier_ledger ORDER BY sl_id DESC";
$result_supplier_acc_list = mysqli_query($conn, $sql_supplier_acc_list);

//Bank Statement list -------------------------------------------------------

if (isset($_POST["de_id"])) {
    $br = intval($_POST["de_id"]);
    if ($br > 0) {
        $sql_bank_acc_list = "select * from bank_ledger where (cq_rel=0 OR cq_rel=2) AND `company`=" . intval($_POST["de_id"]) . " ORDER BY bl_id DESC";
    } else {
        $sql_bank_acc_list = "select * from bank_ledger where (cq_rel=0 OR cq_rel=2) ORDER BY bl_id DESC";
    }
} else {
    $sql_bank_acc_list = "select * from bank_ledger where cq_rel=0 OR cq_rel=2 ORDER BY bl_id DESC";
}
$result_bank_acc_list = mysqli_query($conn, $sql_bank_acc_list);

//Cash Book view -------------------------------------------------------

if (isset($_GET['company'])) {
    $company = base64_decode($_GET['company']);
} else {
    $company = 0;
}

// if ($company == 1) {
$getMaxId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(ca_l_id) FROM cash_ledger"))["MAX(ca_l_id)"];
$latestDate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cash_ledger WHERE ca_l_id=\"$getMaxId\""))["date"];
$sql_cashbook_list = "select * from cash_ledger where company='" . $company . "' ORDER BY ca_l_id ASC";
//        $sql_cashbook_list = "select * from cash_ledger where company='" . $company . "' AND date='" . $latestDate . "' ORDER BY ca_l_id ASC";

$result_cashbook_list = mysqli_query($conn, $sql_cashbook_list);
// } else {
//     $getMaxId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(ca_l_id) FROM cash_ledger"))["MAX(ca_l_id)"];
//     $latestDate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cash_ledger WHERE ca_l_id=\"$getMaxId\""))["date"];
//     $sql_cashbook_list = "select * from cash_ledger where company='" . $company . "' AND date='" . $latestDate . "' ORDER BY ca_l_id ASC";
//     $result_cashbook_list = mysqli_query($conn, $sql_cashbook_list);
// }
//Cash Book Bank view -------------------------------------------------------

if (isset($_GET['company'])) {
    $company = base64_decode($_GET['company']);
} else {
    $company = 0;
}

if ($company == 1) {
    $getbMaxId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(bl_id) FROM bank_ledger"))["MAX(bl_id)"];
    $latestbDate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bank_ledger WHERE bl_id=\"$getbMaxId\""))["bl_date"];
    $sql_cashbook_bank_list = "select * from bank_ledger where company='" . $company . "' AND bl_date='" . $latestbDate . "' AND cq_rel='0' OR cq_rel='2' ORDER BY bl_id ASC";
    $result_cashbook_bank_list = mysqli_query($conn, $sql_cashbook_bank_list);
} else {
    $getbMaxId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(bl_id) FROM bank_ledger"))["MAX(bl_id)"];
    $latestbDate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bank_ledger WHERE bl_id=\"$getbMaxId\""))["bl_date"];
    $sql_cashbook_bank_list = "select * from bank_ledger where company='" . $company . "' AND bl_date='" . $latestbDate . "' AND cq_rel='0' OR cq_rel='2' ORDER BY bl_id ASC";
    $result_cashbook_bank_list = mysqli_query($conn, $sql_cashbook_bank_list);
}

//Expenses list & Report -------------------------------------------------------

if (($lo_ty == 3) || ($lo_ty > 4)) {
    $sql_expenses_list = "select * from pay_expenses WHERE ex_type != 7 AND ex_type != 5 AND ex_type != 6 AND company = $company ORDER BY date DESC";
} else {
    $sql_expenses_list = "select * from pay_expenses WHERE ex_type != 7 AND ex_type != 5 AND ex_type != 6 ORDER BY date DESC";
}
$result_expenses_list = mysqli_query($conn, $sql_expenses_list);

//Expenses view -------------------------------------------------------

if (isset($_GET['e_id'])) {
    $e_id = base64_decode($_GET['e_id']);
} else {
    $e_id = 0;
}

if ($e_id > 0) {

    $sql = "select * from pay_expenses where e_id='" . $e_id . "'";
    $result_expenses_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_expenses_view);
}

//Cheque Release list -------------------------------------------------------

$sql_cq_rel_list = "select * from bank_ledger where cq_rel=1 AND tra_type=2 ORDER BY bl_date DESC";
$result_cq_rel_list = mysqli_query($conn, $sql_cq_rel_list);

//Cheque Release view -------------------------------------------------------

if (isset($_GET['bl_id'])) {
    $bl_id = base64_decode($_GET['bl_id']);
} else {
    $bl_id = 0;
}

if ($bl_id > 0) {

    $sql = "select * from bank_ledger where bl_id='" . $bl_id . "'";
    $result_cq_rel_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_cq_rel_view);
}

//Liability list -------------------------------------------------------

$sql_liability_list = "select * from liability_ledger ORDER BY date DESC";
$result_liability_list = mysqli_query($conn, $sql_liability_list);

//Cheque Release list -------------------------------------------------------

if (($lo_ty >= 3)) {
    $sql_credit_bill_list = "select * from credit_bill where status=0 AND company = $company ORDER BY date DESC";
} else {
    $sql_credit_bill_list = "select * from credit_bill where status=0 ORDER BY date DESC";
}
$result_credit_bill_list = mysqli_query($conn, $sql_credit_bill_list);

//Cheque Release view -------------------------------------------------------

if (isset($_GET['cre_id'])) {
    $cre_id = base64_decode($_GET['cre_id']);
} else {
    $cre_id = 0;
}

if ($e_id > 0) {

    $sql = "select * from credit_bill where cre_id='" . $cre_id . "'";
    $result_credit_bill_view = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_credit_bill_view);
}

//Daily Pump list -------------------------------------------------------

$sql_daily_pump_list = "select * from daily_pump_record";
$result_daily_pump_list = mysqli_query($conn, $sql_daily_pump_list);

//Daily Pump list -------------------------------------------------------

$sql_daily_pump_ex_list = "select * from temp_expenses";
$result_daily_pump_ex_list = mysqli_query($conn, $sql_daily_pump_ex_list);

//Daily Income list -------------------------------------------------------

if (($lo_ty == 3) || ($lo_ty > 4)) {
    $sql_daily_income_list = "select * from transaction where company = $company";
} else {
    $sql_daily_income_list = "select * from transaction";
}
$result_daily_income_list = mysqli_query($conn, $sql_daily_income_list);

//Daily Sales list -------------------------------------------------------
if (($lo_ty == 3) || ($lo_ty > 4)) {
    $result_sales_result = mysqli_query($conn, "select * from `sales_order` where company = $company order by `date` DESC");
} else {
    $result_sales_result = mysqli_query($conn, "select * from `sales_order` order by `date` DESC");
}

//customer list -------------------------------------------------------

$result_ven_result = mysqli_query($conn, "select * from `vendor`");

//customer list -------------------------------------------------------

$result_emp_result = mysqli_query($conn, "select * from `employers`");
