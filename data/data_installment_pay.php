<?php

session_start();
include '../../conn.php';

if (isset($_POST["add"])) {
    $date = $_POST["date"];
    $installment_term = $_POST["month"];

    $hp_t_id = $_POST["hp_t_id"];
    $c_id = $_POST["c_id"];

    $total = $_POST["total"];
    $company = $_POST["company"];
    $month = $_POST["month"];
    $paid_total = $_POST["paid_total"];
    $balance = $_POST["tot_arries"];
    $cash_commission = $_POST["cash_commission"];

    $pay_type = $_POST['tra_type'];
    $ba_id = $_POST["ba_id"];
    $chq_no = $_POST['chq_no'];

    $transaction_date = date("Y-m-d");
    $agreement_number = $_POST["agreement_number"];

    $bl_type = 16;
    $cl_description = 'Installment Payment - ' . $agreement_number;

    $next_date = date("Y-m-d", strtotime(+1 . ' month', strtotime($transaction_date)));

    // $pass = 'Sa@3$sTa';
    // $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT customer_name FROM customer WHERE c_id = $c_id"))["customer_name"];
    // $mobile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT customer_mobile FROM customer WHERE c_id = $c_id"))["customer_mobile"];
    // $val1 = number_format($paid_total, 2, ".", ",");
    // $MSISDN = $mobile;
    // $MESSAGE = "Dear $name,\n\nDate - $transaction_date\nAgreement Number - $agreement_number\nPayment Amount (Rs.) - $val1\nNext Installment Date - $next_date\n\nThank you!";
    // $USERNAME = "savista";
    // $PWD = $pass;
    // $SRC = "SAVISTA";

    // $url = 'http://sms.airtel.lk:5000/sms/send_sms.php';
    // $myvars = 'username=' . $USERNAME . '&password=' . $PWD . '&src=' . $SRC . '&dst=' . $MSISDN . '&msg=' . $MESSAGE;

    // $ch = curl_init($url);

    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $response = curl_exec($ch);
    // curl_close($ch);

    $sql = "update `hp_installments` set date='" . $transaction_date . "', paid_total='" . $paid_total . "', balance='" . $balance . "' WHERE hp_t_id='" . $hp_t_id . "' AND month='" . $month . "'";

    if (mysqli_query($conn, $sql)) {
        $sqi11 = "INSERT INTO `customer_commission` ( `t_id`, `hp_t_id`, `c_id`, `com_date`, `total_amount`, `installment_term`, `cash_commission`, `company`) VALUES ( '0', '" . $hp_t_id . "', '" . $c_id . "', '" . $date . "', '" . $total . "', '" . $installment_term . "', '" . $cash_commission . "', '" . $company . "')";

        if (mysqli_query($conn, $sqi11)) {
            $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `hp_t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES "
                . "( '" . $c_id . "', '" . $hp_t_id . "', '" . $paid_total . "', '" . $pay_type . "', '" . $cl_description . "', '" . $company . "', '" . $transaction_date . "')";


            if (mysqli_query($conn, $sql1)) {
                $c_last_id = mysqli_insert_id($conn);

                if ($pay_type == 1) {
                    $sql3 = "INSERT INTO `cash_ledger` ( `c_id`, `hp_t_id`, `cl_id`, `ca_type`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`) VALUES "
                        . "( '" . $c_id . "', '" . $hp_t_id . "', '" . $c_last_id . "', '6', '" . $paid_total . "', '" . $pay_type . "', '" . $cl_description . "', '" . $company . "', '" . $transaction_date . "')";

                    if (mysqli_query($conn, $sql3)) {
                        header('Location: ../pdf/bill_receipt_hp_i.php?hp_t_id=' . $hp_t_id . '&month=' . $month . '&tra=' . $pay_type);
                    }
                } elseif ($pay_type == 2) {
                    $sql3 = "INSERT INTO `bank_ledger` ( `ba_id`, `c_id`,  `cl_id`, `hp_t_id`, `deb_amount`, `bl_description`, `bl_date`, `company`,`tra_type`, `bl_type`, `chq_no`) VALUES "
                        . "( '" . $ba_id . "', '" . $c_id . "', '" . $c_last_id . "', '" . $hp_t_id . "', '" . $paid_total . "', '" . $cl_description . "', '" . $transaction_date . "', '" . $company . "', '" . $pay_type . "', '" . $bl_type . "', '" . $chq_no . "')";

                    if (mysqli_query($conn, $sql3)) {
                        header('Location: ../pdf/bill_receipt_hp_i.php?hp_t_id=' . $hp_t_id . '&month=' . $month . '&tra=' . $pay_type);
                    }
                } elseif ($pay_type == 3) {
                    $sql3 = "INSERT INTO `bank_ledger` ( `ba_id`, `c_id`,  `cl_id`, `hp_t_id`, `deb_amount`, `bl_description`, `bl_date`, `company`,`tra_type`, `bl_type`) VALUES "
                        . "( '" . $ba_id . "', '" . $c_id . "', '" . $c_last_id . "', '" . $hp_t_id . "', '" . $paid_total . "', '" . $cl_description . "', '" . $transaction_date . "', '" . $company . "', '" . $pay_type . "', '" . $bl_type . "')";

                    if (mysqli_query($conn, $sql3)) {
                        header('Location: ../pdf/bill_receipt_hp_i.php?hp_t_id=' . $hp_t_id . '&month=' . $month . '&tra=' . $pay_type);
                    }
                }
            }
        }
    }
} else {
    header("location:../");
}