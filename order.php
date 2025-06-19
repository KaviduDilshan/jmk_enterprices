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
                Make order
            </a>
            <a class="btn btn-danger" href="index.php" style="font-size: 18px; white-space: nowrap;">
                Log Out
            </a>
        </div>
    </nav>

    <!-- Search input -->
    <form action="data/data_save.php">
        <div class="card shadow-lg p-4 rounded">
            <div class="input-group input-group-lg mb-2">
                <input type="text" id="productsearch" class="form-control" placeholder="Search items"
                    autocomplete="off">
                <button class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
            </div>

            <div style="font-size: 20px;" id="product-list">
                <?php
                $query = "SELECT * FROM products ORDER BY pro_id";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0):
                    while ($cus = mysqli_fetch_assoc($result)):
                        ?>
                        <div class="product_get text-dark" style="display: none; cursor: pointer;"
                            data-proid="<?= $cus['pro_id'] ?>" data-unitprice="<?= $cus['unit_price'] ?>">
                            <h3 class="product_name"><?= htmlspecialchars($cus['product_name']) ?></h3>
                            <hr>
                        </div>
                        <?php
                    endwhile;
                else:
                    echo '<p>No products found.</p>';
                endif;
                ?>
            </div>
        </div>

        <!-- Total and customer -->
        <div class="card p-4 pt-3 mt-3">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <a class="btn btn-danger w-100" href="today_oder.php?order_id=<?= $_GET["order_id"]; ?>"
                        style="height: 50px; font-size: 17px;">View</a>
                </div>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control bg-dark-subtle" value="0.00"
                        style="height: 50px; font-size: 17px;" readonly>
                </div>
            </div>

            <div class="input-group input-group-lg mt-3 ">
                <input type="text" id="customersearch" class="form-control" placeholder="Search customer"
                    autocomplete="off">
                <button class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
            </div>

            <div style="font-size: 20px;" id="customer-list">
                <?php
                $query = "SELECT * FROM customer ORDER BY c_id";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0):
                    while ($cus = mysqli_fetch_assoc($result)):
                        ?>
                        <div class="customer_get text-dark" style="display: none; cursor: pointer;"
                            data-cid="<?= $cus['c_id'] ?>">
                            <h3 class="customer_name"><?= htmlspecialchars($cus['customer_name']) ?></h3>
                            <hr>
                        </div>
                        <?php
                    endwhile;
                else:
                    echo '<p>No customer found.</p>';
                endif;
                ?>
            </div>

            <div class="row justify-content-end mt-4">
                <div class="col-md-6 mb-2">
                    <button type="reset" class="btn btn-warning w-100"
                        style="height: 70px; font-size: 25px;">cancel</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100"
                        style="height: 70px; font-size: 25px;">save</button>
                </div>
            </div>
        </div>
    </form>
    </body>

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

    <!-- Live product search filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productsearchInput = document.getElementById('productsearch');
            const productItems = document.querySelectorAll('.product_get');

            // Filter products as you type
            productsearchInput.addEventListener('keyup', function () {
                const searchTerm = productsearchInput.value.toLowerCase().trim();
                productItems.forEach(function (item) {
                    const name = item.querySelector('.product_name').textContent.toLowerCase();
                    if (searchTerm !== "" && name.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // Show popup on click
            productItems.forEach(function (item) {
                item.style.cursor = "pointer";
                item.addEventListener('click', function () {
                    const productName = item.querySelector('h3.product_name').textContent.trim();
                    productsearchInput.value = productName;
                    productItems.forEach(i => i.style.display = 'none');

                    const productId = item.dataset.proid;
                    const productPrice = item.dataset.unitprice;

                    // Set modal content
                    document.getElementById('modalProductName').textContent = productName;
                    document.getElementById('modalProductPrice').textContent = productPrice;

                    //post
                    document.getElementById('inputProductname').value = productName;
                    document.getElementById('inputProductId').value = productId;
                    document.getElementById('inputProductprice').value = productPrice;

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('productModal'));
                    modal.show();
                });
            });

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

                    const customerId = item.dataset.proid;

                    //post
                    document.getElementById('inputCustomerid').value = customerId;
                    

                })
            });




        })
    </script>
    
<body>
    <!-- Product Popup Modal -->
    
        <div class="modal fade" id="productModal" tabindex="-1">
            <div class="modal-dialog">
                <form action="data/data_view.php" method="POST">
                <div class="modal-content ">
                    <div class="modal-header  " style="background-color:blue ">
                        <h4 id="modalProductName" class="mb-3" style="color:white"></h4>
                        <button type="button" class="btn-close bg-white mb-2" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10">

                                <input type="text" name="product_id" id="inputProductId" readonly hidden>

                                <input type="text" name="unit_price" id="inputProductprice" readonly hidden>

                                <input type="number" name="quantity" id="inputQty" class="form-control mt-2"
                                    placeholder="Enter Quantity">

                                <input type="text" name="product_name" id="inputProductname" readonly hidden>

                                <input type="text" name="total_amount" readonly hidden>

                                <input type="text" name="date" value="<?= date("Y-m-d"); ?>" readonly hidden>

                                <input type="text" name="time" value="<?= date("H:i:s"); ?>" readonly hidden>

                                <input type="text" name="order_id" value="<?= $_GET["order_id"]; ?>" readonly hidden>

                                <input type="number" name="warrenty_end" class="form-control mt-2"
                                    placeholder="Enter Quantity">

                                <input type="text" name="duration" class="form-control mt-2"
                                    placeholder="Enter Duration">
                            </div>
                            <div class="col-2">
                                <button type="submit" id="addBtn" class="btn btn-success" style="margin-top:62px"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    
    </body>
</html>