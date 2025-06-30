<?php
include_once './conn.php';

$order_id = $_GET["order_id"];
// $query = "SELECT * FROM hp_sales_order WHERE invoice='$order_id'";
// $result = mysqli_query($con, $query);
// $row = mysqli_fetch_assoc($result);

// $sumquery = "SELECT SUM(total) AS total_sum FROM hp_sales_order WHERE invoice = '$order_id'";
// $sumresult = mysqli_query($con, $query);
// $sumrow = mysqli_fetch_assoc($result);
// $totalAmount = $sumrow['total_sum'] ?? 0.00;

$order_id_de = base64_decode($_GET["order_id"]);
$totalAmount = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM hp_sales_order WHERE invoice=$order_id_de"));
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
    <form action="data/data_save.php" method="POST">
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
                        style=" font-size: 21px;">View</a>
                </div>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control bg-dark-subtle" style="height: 50px; font-size: 17px;"
                        value="<?= number_format($totalAmount['SUM(total)'], 2) ?>" readonly>
                </div>
            </div>

            <!-- customer -->
            <div class="input-group input-group-lg mt-3 ">
                <input type="text" id="customersearch" class="form-control" placeholder="Search customer" required
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



            <!-- Guarantor 01 -->
            <div class="input-group input-group-lg mt-3 ">
                <input type="text" id="guarantorsearch1" class="form-control" placeholder="Search First Guarantor "
                    required autocomplete="off">
                <button class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
            </div>

            <div style="font-size: 20px;" id="guarantor-list">
                <?php
                $query = "SELECT * FROM guarantor ORDER BY gu_id  DESC";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0):
                    while ($cus = mysqli_fetch_assoc($result)):
                        ?>
                        <div class="guarantor_get text-dark" style="display: none; cursor: pointer;"
                            data-gid1="<?= $cus['gu_id'] ?>">
                            <h3 class="guarantor_name1"><?= htmlspecialchars($cus['guarantor_name']) ?></h3>
                            <hr>
                        </div>
                        <?php
                    endwhile;
                else:
                    echo '<p>No customer found.</p>';
                endif;
                ?>
            </div>

            <!-- Guarantor 02 -->
            <div class="input-group input-group-lg mt-3">
                <input type="text" id="guarantorsearch2" class="form-control" placeholder="Search Second Guarantor"
                    required autocomplete="off">
                <button class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
            </div>

            <div style="font-size: 20px;" id="guarantor-list2">
                <?php
                $query = "SELECT * FROM guarantor ORDER BY gu_id DESC";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0):
                    while ($cus = mysqli_fetch_assoc($result)):
                        ?>
                        <div class="guarantor_get2 text-dark" style="display: none; cursor: pointer;"
                            data-gid2="<?= $cus['gu_id'] ?>">
                            <h3 class="guarantor_name2"><?= htmlspecialchars($cus['guarantor_name']) ?></h3>
                            <hr>
                        </div>
                        <?php
                    endwhile;
                else:
                    echo '<p>No guarantor found.</p>';
                endif;
                ?>
            </div>


            <input type="text" name="order_id" value="<?= $_GET["order_id"]; ?>" readonly hidden>
            <input type="text" id="inputCustomerid" name="customer_id" readonly hidden>
            <input type="text" id="guarantorId1" name="guarantor_1_id" readonly hidden>
            <input type="text" id="guarantorId2" name="guarantor_2_id" readonly hidden>
            <input type="text" name="date" class="form-control mt-2" value="<?= date("Y-m-d"); ?>" readonly hidden>
            <input type="text" name="time" value="<?= date("H:i:s"); ?>" readonly hidden>
            <input type="text" id="totalAmount" name="totalAmount" value="<?= ($totalAmount['SUM(total)']) ?>" readonly
                hidden>
            <input type="text" id="status" name="status" readonly hidden>

            <div class="row text-center mt-3">
                <div class="col-6 col-md-6 col-lg-6 mt-1">
                    <a type="reset" class="btn btn-warning w-100 " style="font-size: 17px;"
                        href="data/remove_hp_itemall.php?order_id=<?= $order_id ?>">Cancel & Remove</a>
                </div>
                <div class="col-6 col-md-6 col-lg-6 mt-1">
                    <button type="submit" class="btn btn-primary w-100" style=" font-size: 17px;">save</button>
                </div>
            </div>
        </div>
    </form>


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

                    const customerId = item.dataset.cid;

                    //post hidden
                    document.getElementById('inputCustomerid').value = customerId;


                })
            });

            // Filter and select for Guarantor 01
            const guarantorsearch1 = document.getElementById('guarantorsearch1');
            const guarantorItems1 = document.querySelectorAll('.guarantor_get');

            guarantorsearch1.addEventListener('keyup', function () {
                const term = guarantorsearch1.value.toLowerCase().trim();
                guarantorItems1.forEach(item => {
                    const name = item.querySelector('.guarantor_name1').textContent.toLowerCase();
                    item.style.display = (term !== "" && name.includes(term)) ? 'block' : 'none';
                });
            });

            guarantorItems1.forEach(item => {
                item.addEventListener('click', function () {
                    guarantorsearch1.value = item.querySelector('.guarantor_name1').textContent.trim();
                    guarantorItems1.forEach(i => i.style.display = 'none');

                    const guId1 = item.dataset.gid1;
                    // Optional: assign to hidden input
                    document.getElementById('guarantorId1').value = guId1;
                });
            });

            // Filter and select for Guarantor 02
            const guarantorsearch2 = document.getElementById('guarantorsearch2');
            const guarantorItems2 = document.querySelectorAll('.guarantor_get2');

            guarantorsearch2.addEventListener('keyup', function () {
                const term = guarantorsearch2.value.toLowerCase().trim();
                guarantorItems2.forEach(item => {
                    const name = item.querySelector('.guarantor_name2').textContent.toLowerCase();
                    item.style.display = (term !== "" && name.includes(term)) ? 'block' : 'none';
                });
            });

            guarantorItems2.forEach(item => {
                item.addEventListener('click', function () {
                    guarantorsearch2.value = item.querySelector('.guarantor_name2').textContent.trim();
                    guarantorItems2.forEach(i => i.style.display = 'none');

                    const guId2 = item.dataset.gid2;
                    // Optional: assign to hidden input
                    document.getElementById('guarantorId2').value = guId2;
                });
            });

        })
    </script>

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
                                <h4>Unit Price : <span id="modalProductPrice"></span></h4>

                                <!-- Quantity -->
                                <div class="d-flex align-items-center mb-2">
                                    <label for="inputQty" class="me-2" style="min-width: 70px;">Quantity:</label>
                                    <input type="number" name="quantity" id="inputQty" class="form-control"
                                        placeholder="Enter Quantity">
                                </div>

                                <!-- Warranty End Date -->
                                <div class="d-flex align-items-center mb-2">
                                    <label for="warrenty_end" class="me-2" style="min-width: 70px;">Warranty
                                        End:</label>
                                    <input type="date" name="warrenty_end" id="warrenty_end" class="form-control" autocomplete="off"
                                        value="<?= date("Y-m-d"); ?>">
                                </div>

                                <!-- Duration -->
                                <div class="d-flex align-items-center mb-2">
                                    <label for="duration" class="me-2" style="min-width: 70px;">Duration:</label>
                                    <input type="number" name="duration" id="duration" class="form-control"
                                        placeholder="Enter Duration" autocomplete="off">
                                </div>

                                <input type="text" id="inputCustomerid" name="customer_id" readonly hidden>

                                <input type="text" name="product_id" id="inputProductId" readonly hidden>

                                <input type="text" name="unit_price" id="inputProductprice" readonly hidden>

                                <input type="text" name="product_name" id="inputProductname" readonly hidden>

                                <input type="text" name="total_amount" readonly hidden>

                                <input type="text" name="date" class="form-control mt-2" value="<?= date("Y-m-d"); ?>"
                                    readonly hidden>

                                <input type="text" name="time" value="<?= date("H:i:s"); ?>" readonly hidden>

                                <input type="text" name="order_id" value="<?= $_GET["order_id"]; ?>" readonly hidden>

                            </div>
                            <div class="col-2">
                                <button type="submit" id="addBtn" class="btn btn-success" style="margin-top:132px"><i
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