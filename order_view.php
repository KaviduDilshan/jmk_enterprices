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
    <div class="">
        <nav class="navbar navbar-expand-md navbar-dark ">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item px-4">
                        <a class="nav-link" href="#" style="font-size:35px; color:white;">Oder View</a>
                    </li>
                    <li class="nav-item ms-auto p-2">
                        <a class="btn btn-danger" href="index.php" style="font-size: 20px;">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="card shadow-lg p-4 rounded">
            <div class="input-group input-group-lg  mb-4">
                <input type="text" class="form-control " placeholder="Search oder by name ">
                <button class="btn btn-primary p-3" type="submit"><i class="fa fa-search"></i></button>
            </div>


            <div class="" style="font-size:20px;">
                   <?php  
    $query = "SELECT * FROM products ORDER BY pro_id DESC";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0): 
        while ($cus = mysqli_fetch_assoc($result)):
    ?>
        <a href="order_detils.php?id=<?= $cus['pro_id'] ?>" class="product_get text-decoration-none text-dark">
            <h3 class="product_name"><?= htmlspecialchars($cus['product_name']) ?></h3>
            <p><?= htmlspecialchars($cus['barcode']) ?> | <?= htmlspecialchars($cus['customer_mobile']) ?><br>
                <small><?= htmlspecialchars($cus['customer_address']) ?></small>
            </p>
            <hr>
        </a>
    <?php 
        endwhile;
    else: 
    ?>
        <p>No customers found.</p>
    <?php endif; ?>
</div>


<script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('customerserach');
            const customerItems = document.querySelectorAll('.customer_get');

            searchInput.addEventListener('keyup', function () {
                const searchTerm = searchInput.value.toLowerCase().trim();

                customerItems.forEach(function (item) {
                    const name = item.querySelector('.customer_name').textContent.toLowerCase();
                    if (name.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
   


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