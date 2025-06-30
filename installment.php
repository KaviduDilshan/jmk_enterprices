<?php
include_once './conn.php';
?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>JMK Enterprises</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="stylesheet" href="assets/css/order.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 25px; color: white; flex-grow:1;">
                Installment Payments
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <div class="card shadow-lg p-4 rounded">
        <div class="input-group input-group-lg mt-3 ">
            <input type="text" id="customersearch" class="form-control" placeholder="Search customer" required
                autocomplete="off">
            <button class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
        </div>

        <div style="font-size: 20px;" id="customer-list">
            <?php
            $detailquery = "SELECT * FROM hp_transaction WHERE loan_status = 1 ORDER BY hp_t_id";
            $detailsresult = mysqli_query($con, $detailquery);

            if (mysqli_num_rows($detailsresult) > 0):
            while ($row = mysqli_fetch_array($detailsresult)):
                $c_id = $row['c_id'];
                $customer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `customer` WHERE `c_id`=$c_id"));

                $hp_t_id = $row['hp_t_id'];
                $paid_amount = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(paid_total) FROM hp_installments WHERE `hp_t_id`=$hp_t_id"));
                if($paid_amount != null){
                    $paid_amount = $paid_amount["SUM(paid_total)"];
                }
                $balance=$row["tot_loan_amount"]-$paid_amount;

                if($customer):
                    ?>
                    <div class="customer_get text-dark" style="display: none; cursor: pointer;" data-cid="<?= $c_id?>">
                        <h3 class="customer_name"><?= htmlspecialchars($customer['customer_name']) ?></h3>
                        <hr>
                    </div>

                    <div class="mt-4">
                    <a href="cus_details.php?id=<?= $customer['c_id'] ?>" class="customer_get text-decoration-none text-dark">
                        <h3 class="customer_name"><?= htmlspecialchars($customer['customer_name']) ?></h3>
                        <h3 class="customer_name">Agreement number : <strong><?= $row['hp_t_id'] ?></strong></h3>
                        <h3 class="customer_name">Loan date : <strong><?= $row['transaction_date'] ?></strong></h3>
                        <h3 class="customer_name">Total Loan Amount : <strong>Rs.<?= $row['tot_loan_amount'] ?></strong></h3>
                        <h3 class="customer_name">Paid Amount : <strong>Rs.<?= $paid_amount  ?></strong></h3>
                        <h3 class="customer_name">Balance Amount : <strong>Rs.<?= $balance  ?></strong></h3>
                        <hr>
                    </a>
                    </div>
                    <?php
                    endif;
                endwhile;     
            else:
                echo '<p>No customer found.</p>';
            endif;
        ?>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
             // Filter customer as you type
            const customersearchInput = document.getElementById('customersearch');
            const customertItems = document.querySelectorAll('.customer_get');

            customersearchInput.addEventListener('keyup', function () {
                const searchTerm = customersearchInput.value.toLowerCase().trim();
                customertItems.forEach(function (item) {
                    const name = item.querySelector('.customer_name').textContent.toLowerCase();
                    if (searchTerm !== "" && name.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // Show popup on click
            customertItems.forEach(function (item) {
                item.style.cursor = "pointer";
                item.addEventListener('click', function () {
                    const customerName = item.querySelector('h3.customer_name').textContent.trim();
                    customersearchInput.value = customerName;
                    customertItems.forEach(i => i.style.display = 'none');

                    const customerId = item.dataset.cid;

                    //post hidden
                    document.getElementById('inputCustomerid').value = customerId;


                })
            });
        })
    </script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="assets/js/pages/password-addon.init.js"></script>

</body>
</html>