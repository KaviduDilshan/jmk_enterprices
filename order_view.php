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

    <link rel="stylesheet" href="assets/css/cus_view.css">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <a href="#" class="navbar-brand" style="font-size: 25px; color: white; flex-grow:1;">
                Oder View
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <!-- <div class="card shadow-lg p-4 rounded">
        <div class="input-group input-group-lg  mb-4">
            <input type="text" class="form-control " placeholder="Search oder by name " id="productsearch"
                autocomplete="off">
            <button class="btn btn-primary p-3" type="submit"><i class="fa fa-search"></i></button>
        </div> -->


    
        <?php
date_default_timezone_set('Asia/Colombo');
$today = date("Y-m-d");

$query = "
    SELECT 
        customer.customer_name,
        order_save.c_id,
        SUM(order_save.total_price) AS total_sum,
        GROUP_CONCAT(DISTINCT products.product_name SEPARATOR ' / ') AS product_list
    FROM order_save  
    JOIN customer ON order_save.c_id = customer.c_id
    JOIN hp_sales_order ON hp_sales_order.invoice = order_save.order_id
    JOIN products ON products.pro_id = hp_sales_order.pro_id
    WHERE order_save.order_date = '$today'
    GROUP BY order_save.c_id
    ORDER BY total_sum DESC
";

$result = mysqli_query($con, $query);
?>

        <div class="card row justify-content-end p-3" style="font-size:20px;">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($cus = mysqli_fetch_assoc($result)): ?>
            <div <?= $cus['c_id'] ?> class="product_get text-decoration-none text-dark">
                <h3 class="customer_name"><?= htmlspecialchars($cus['customer_name']) ?></h3>
                <h4 class="products"><strong>Products : </strong> <?= htmlspecialchars($cus['product_list']) ?></h4>
                <h3 class="total"><strong>Rs. </strong> <?= number_format($cus['total_sum'], 2) ?></h3>
                <hr>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No orders found for today.</p>
    <?php endif; ?>
</div>





    <!-- <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('productsearch');
                const customerItems = document.querySelectorAll('.product_get');
 
                searchInput.addEventListener('keyup', function () {
                    const searchTerm = searchInput.value.toLowerCase().trim();

                    customerItems.forEach(function (item) {
                        const name = item.querySelector('.product_name').textContent.toLowerCase();
                        if (name.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        </script> -->



    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>

</body>

</html>