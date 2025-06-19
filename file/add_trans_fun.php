<?php

session_start();
include '../../conn.php';

if (isset($_POST["add"])) {
    $date = $_POST["date"];
//     . " " . date("H:i:s")
    $c_id = $_POST["c_id"];
    $sub_total = $_POST["sub_total"];
    $total = $_POST["total"];
    $emp_id = $_POST["emp_id"];
    $pay_type = $_POST["pay_type"];
    $paid_amount_c = $_POST["paid_amount_c"];
    $paid_amount = $_POST["paid_amount"] + $_POST["adv_amount"] + $_POST["paid_amount_c"];
    $paid_amount_o = $_POST["paid_amount"] + $_POST["adv_amount"];
    if (isset($_POST['adv_amount'])) {
        $av_amount = $_POST['adv_amount'];
        $av_amount_mine = '-' . $_POST['adv_amount'];
    } else {
        $av_amount = 0;
    }
    $balance = $_POST["balance"];
    $company = $_POST["company"];
    $invoice = $_POST["invoice"];
    $other_dis = $_POST['other_dis'];
    $chq_no = $_POST['chq_no'];

    $type = $_POST['type'];

    if ($type == 1) {
        $bill_type = 1;
    } else {
        $bill_type = 0;
    }
    $ba_id = 4;

    $sales_re = mysqli_query($conn, "SELECT * FROM `sales_order` WHERE `invoice`='$invoice'");
    while ($row = mysqli_fetch_array($sales_re)) {
        $quantity = floatval($row["quantity"]);
        // $company = intval($row["company"]);
        $pro_id = intval($row["pro_id"]);
        if ($company == 1) {
            $bra = 'qty_b1';
        } 
        elseif ($company == 2) {
            $bra = 'qty_b2';
        } elseif ($company == 3) {
            $bra = 'qty_b3';
        } elseif ($company == 4) {
            $bra = 'qty_b4';
        } elseif ($company == 5) {
            $bra = 'qty_b5';
        }
        mysqli_query($conn, "UPDATE products SET $bra = $bra - $quantity WHERE pro_id=$pro_id");
    }

    $description = 'Advance Re payment';
    $bl_type = 16;
    $target_month = date("n");
    $achieve = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT achieve_amount FROM emp_target WHERE emp_id = $emp_id AND target_month = $target_month"))["achieve_amount"]);
    $tot_achieve = $achieve + $total;

    $pass = 'Sa@3$sTa';
    $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT customer_name FROM customer WHERE c_id = $c_id"))["customer_name"];
    $mobile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT customer_mobile FROM customer WHERE c_id = $c_id"))["customer_mobile"];
    $val1 = number_format($total, 2, ".", ",");
    $val2 = number_format($paid_amount, 2, ".", ",");
    $MSISDN = $mobile;
    $MESSAGE = "Dear $name,\n\nDate - $date\nItem Total (Rs.) - $val1\nItem Paid (Rs.) - $val2\n\nThank you!";
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

    $sql_target = "update emp_target set `achieve_amount`='" . $tot_achieve . "' WHERE emp_id = $emp_id AND target_month = $target_month";
    if (mysqli_query($conn, $sql_target)) {
        $tras_re = mysqli_query($conn, "SELECT * FROM `transaction` WHERE `invoice`='$invoice'");
        if ($pay_type == 1) {
            if ($total == $paid_amount) {
                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,adv_amount,balance,ref_no,pay_type,company,bill_type) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$av_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\",\"$bill_type\")";
                }

                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $av_amount . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $c_last_id = mysqli_insert_id($conn);
                        $sql2 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type`, `cre_amount`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $c_last_id . "', '6', '" . $av_amount . "', '" . $total . "', '" . $pay_type . "', 'Bill Payment / Income', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $sql3 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Credit Bill ', '" . $company . "', '" . $date . "')";
                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                // header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        }
                    }
                }
            } elseif ($total > $paid_amount) {
                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,adv_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$av_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $paid_amount . "', '" . $av_amount . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $sql2 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Credit Bill', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $c_last_id = mysqli_insert_id($conn);
                            $sql3 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type`, `cre_amount`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $c_last_id . "', '6', '" . $av_amount . "', '" . $total . "', '" . $pay_type . "', 'Bill Payment / Income', '" . $company . "', '" . $date . "')";

                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                //   header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        }
                    }
                }
            } elseif ($total < $paid_amount) {

                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,adv_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$av_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $paid_amount . "', '" . $av_amount . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $sql2 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Credit Bill', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $c_last_id = mysqli_insert_id($conn);
                            $sql3 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type`, `cre_amount`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $c_last_id . "', '6', '" . $av_amount . "', '" . $total . "', '" . $pay_type . "', 'Bill Payment / Income', '" . $company . "', '" . $date . "')";

                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                // header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        }
                    }
                }
            }
        } elseif ($pay_type == 2) {
            if ($total == $paid_amount) {

                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $t_last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Bill Payment Cheque', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $c_last_id = mysqli_insert_id($conn);
//                    $sql2 = "INSERT INTO `bank_ledger` ( `ba_id`, `c_id`,  `cl_id`, `t_id`, `deb_amount`, `bl_description`, `bl_date`, `company`,`tra_type`, `bl_type`, `ref_no`, `cc_rel`) VALUES ( '" . $ba_id . "', '" . $c_id . "', '" . $c_last_id . "', '" . $last_id . "', '" . $total . "', 'Bill Payment Credit Card', '" . $date . "', '" . $company . "', '" . $pay_type . "', '" . $bl_type . "', '" . $chq_no . "', '1')";

                        $sql2 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type` , `ca_l_description`, `chq_no`, `deb_amount`, `pay_type`, `company`, `date`) VALUES "
                                . "( '" . $c_id . "', '" . $t_last_id . "', '" . $c_last_id . "', '6', 'Bill Payment / Income', '" . $chq_no . "', '" . $total . "', '" . $pay_type . "', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $sql3 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Credit Bill', '" . $company . "', '" . $date . "')";
                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                //  header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        }
                    }
                }
            } elseif ($total > $paid_amount) {

                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $paid_amount . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $sql2 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Credit Bill', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $c_last_id = mysqli_insert_id($conn);
                            $sql3 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`, `chq_no`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $c_last_id . "', '6', '" . $paid_amount . "', '" . $pay_type . "', 'Bill Payment / Income', '" . $company . "', '" . $date . "', '" . $chq_no . "')";

                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                //   header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
            } elseif ($total < $paid_amount) {

                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $paid_amount . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $sql2 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `deb_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Credit Bill', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $c_last_id = mysqli_insert_id($conn);
                            $sql3 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`, `chq_no`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $c_last_id . "', '6', '" . $paid_amount . "', '" . $pay_type . "', 'Bill Payment / Income', '" . $company . "', '" . $date . "', '" . $chq_no . "')";

                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                //  header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
            }
        } elseif ($pay_type == 3) {
            if ($total <= $paid_amount) {

                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $c_last_id = mysqli_insert_id($conn);
                        $sql2 = "INSERT INTO `bank_ledger` ( `ba_id`, `c_id`,  `cl_id`, `t_id`, `deb_amount`, `bl_description`, `bl_date`, `company`,`tra_type`, `bl_type`, `chq_no`) VALUES ( '" . $ba_id . "', '" . $c_id . "', '" . $c_last_id . "', '" . $last_id . "', '" . $total . "', 'Bill Payment Cheque / Income', '" . $date . "', '" . $company . "', '" . $pay_type . "', '" . $bl_type . "', '" . $chq_no . "')";

                        if (mysqli_query($conn, $sql2)) {

                            if (isset($_POST['adv_amount'])) {
                                $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                        . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                if (mysqli_query($conn, $ins)) {
                                    // header('Location: ../index.php?error=' . base64_encode(4));
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        } else {
                            //   header('Location: ../index.php?error=' . base64_encode(3));
                            header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                        }
                    }
                }
            } elseif ($total > $paid_amount) {

                if (mysqli_num_rows($tras_re) > 0) {
                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                } else {
                    $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,balance,ref_no,pay_type,company) "
                            . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
                }
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $paid_amount . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                    if (mysqli_query($conn, $sql1)) {
                        $c_last_id = mysqli_insert_id($conn);
                        $sql2 = "INSERT INTO `customer_ledger` ( `c_id`, `ba_id`, `t_id`, `deb_amount`, `pay_type`, `chq_no`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $ba_id . "', '" . $last_id . "', '" . $balance . "', '" . $pay_type . "', '" . $chq_no . "', 'Bill Oustanding', '" . $company . "', '" . $date . "')";

                        if (mysqli_query($conn, $sql2)) {
                            $sql3 = "INSERT INTO `bank_ledger` ( `ba_id`, `c_id`, `cl_id`, `t_id`, `deb_amount`, `bl_description`, `bl_date`, `company`, `tra_type`, `bl_type`, `chq_no`) VALUES ( '" . $ba_id . "', '" . $c_id . "', '" . $c_last_id . "', '" . $last_id . "', '" . $paid_amount . "', 'Bill Payment', '" . $date . "', '" . $company . "', '" . $pay_type . "', '" . $bl_type . "', '" . $chq_no . "')";

                            if (mysqli_query($conn, $sql3)) {

                                if (isset($_POST['adv_amount'])) {
                                    $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                            . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                    if (mysqli_query($conn, $ins)) {
                                        // header('Location: ../index.php?error=' . base64_encode(4));
                                        header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                    }
                                } else {
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                // header('Location: ../index.php?error=' . base64_encode(3));
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        }
                    }
                }
            }
        } elseif ($pay_type == 4) {
            if (mysqli_num_rows($tras_re) > 0) {
                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
            } else {
                $sql = "INSERT INTO transaction(c_id,emp_id,transaction_date,invoice,sub_total,discount,total,paid_amount,balance,ref_no,pay_type,company) "
                        . "VALUES(\"$c_id\",\"$emp_id\",\"$date\",\"$invoice\",\"$sub_total\",\"$other_dis\",\"$total\",\"$paid_amount\",\"$balance\",\"$chq_no\",\"$pay_type\",\"$company\")";
            }
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                $sql1 = "INSERT INTO `customer_ledger` ( `c_id`, `t_id`, `cre_amount`, `pay_type`, `cl_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $total . "', '" . $pay_type . "', 'Bill Payment', '" . $company . "', '" . $date . "')";

                if (mysqli_query($conn, $sql1)) {
                    $c_last_id = mysqli_insert_id($conn);
                    $sql2 = "INSERT INTO `bank_ledger` ( `ba_id`, `c_id`,  `cl_id`, `t_id`, `deb_amount`, `bl_description`, `bl_date`, `company`,`tra_type`, `bl_type`, `chq_no`) VALUES ( '" . $ba_id . "', '" . $c_id . "', '" . $c_last_id . "', '" . $last_id . "', '" . $paid_amount_c . "', 'Bill Payment Card', '" . $date . "', '" . $company . "', '3', '" . $bl_type . "', '" . $chq_no . "')";

                    if (mysqli_query($conn, $sql2)) {
                        $sql3 = "INSERT INTO `cash_ledger` ( `c_id`, `t_id`, `cl_id`, `ca_type`, `cre_amount`, `deb_amount`, `pay_type`, `ca_l_description`, `company`, `date`) VALUES ( '" . $c_id . "', '" . $last_id . "', '" . $c_last_id . "', '6', '" . $av_amount . "', '" . $paid_amount_o . "', '1', 'Bill Payment / Income', '" . $company . "', '" . $date . "')";
                        if (mysqli_query($conn, $sql3)) {

                            if (isset($_POST['adv_amount'])) {
                                $ins = "INSERT INTO `customer_advance` ( `c_id`, `description`, `amount`, `company`, `date`) VALUES "
                                        . "( '" . $c_id . "', '" . $description . "', '" . $av_amount_mine . "', '" . $company . "', '" . $date . "')";
                                if (mysqli_query($conn, $ins)) {
                                    // header('Location: ../index.php?error=' . base64_encode(4));
                                    header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                                }
                            } else {
                                header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                            }
                        } else {
                            //   header('Location: ../index.php?error=' . base64_encode(3));
                            header('Location: ../pdf/bill_receipt.php?invoice=' . $invoice);
                        }
                    }
                }
            }
        }
    }
} else {
    header("location:../");
}    