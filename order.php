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
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100">
                <li class="nav-item px-4">
                    <a class="nav-link" href="#" style="font-size:35px; color:white;">Make Order</a>
                </li>
                <li class="nav-item ms-auto p-2">
                    <a class="btn btn-danger" href="index.php" style="font-size: 20px;">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Search input -->
    <div class="card shadow-lg p-4 rounded">
        <div class="input-group input-group-lg mb-2">
            <input type="text" id="productsearch" class="form-control" placeholder="Search items">
            <button class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
        </div>

        <div style="font-size: 20px;" id="product-list">
            <?php
            $query = "SELECT * FROM products ORDER BY pro_id";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0):
                while ($cus = mysqli_fetch_assoc($result)):
            ?>
                <div class="product_get text-dark" style="display: none; cursor: pointer;">
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

    <!-- Order form -->
    <div class="row" id="cardsContainer">
        <div class="col-md-6 col-sm-6 col-xs-6 mb-2">
            <div class="card shadow-lg p-3 rounded m-1 cardsmall">
                <p style="font-size: 20px;">item</p>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="quantity[]" class="form-control bg-dark-subtle" placeholder="0.00" style="height: 50px; font-size: 17px;">
                    </div>
                    <div class="col-md-6 mb-2">
                        <button type="button" class="btn btn-primary w-100" style="background-color:green; height: 50px; font-size: 17px;">add</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 mb-2">
            <div class="card shadow-lg p-3 rounded m-1 cardsmall">
                <p style="font-size: 20px;">item</p>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="quantity[]" class="form-control bg-dark-subtle" placeholder="0.00" style="height: 50px; font-size: 17px;">
                    </div>
                    <div class="col-md-6 mb-2">
                        <button type="button" class="btn btn-primary w-100" style="background-color:green; height: 50px; font-size: 17px;">add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total and customer -->
    <div class="card p-4 pt-3 mt-3">
        <div class="row">
            <div class="col-md-4 mb-2">
                <a class="btn btn-danger w-100" href="today_oder.php" style="height: 50px; font-size: 17px;">View</a>
            </div>
            <div class="col-md-8 mb-2">
                <input type="text" class="form-control bg-dark-subtle" value="0.00" style="height: 50px; font-size: 17px;" readonly>
            </div>
        </div>

        <div class="col-lg-12 mt-4 mb-4">
    <select name="c_id" id="customer_status" class="form-select pt-3 pb-3 select" style="font-size: 20px;">
        <option value="">Select Customer</option>
        <?php
        $custQuery = "SELECT c_id, customer_name FROM customer ORDER BY customer_name";
        $custResult = mysqli_query($con, $custQuery);
        if ($custResult && mysqli_num_rows($custResult) > 0) {
            while ($cust = mysqli_fetch_assoc($custResult)) {
                echo '<option value="' . $cust['c_id'] . '">' . htmlspecialchars($cust['customer_name']) . '</option>';
            }
        } else {
            echo '<option disabled>No customers found</option>';
        }
        ?>
    </select>
</div>


        <div class="row justify-content-end mt-5">
            <div class="col-md-6">
                <button type="reset" class="btn btn-warning w-100" style="height: 70px; font-size: 25px;">cancel</button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary w-100" style="height: 70px; font-size: 25px;">save</button>
            </div>
        </div>
    </div>

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
        const searchInput = document.getElementById('productsearch');
        const productItems = document.querySelectorAll('.product_get');
        const cardsContainer = document.getElementById('cardsContainer');

        // Filter products as you type
        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase().trim();
            productItems.forEach(function (item) {
                const name = item.querySelector('.product_name').textContent.toLowerCase();
                if (searchTerm !== "" && name.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Add click event to each product to add card or fill existing
        productItems.forEach(function (item) {
            item.style.cursor = "pointer";
            item.addEventListener('click', function () {
                const productName = item.querySelector('h3.product_name').textContent.trim();

                // Check if product already added in any card
                const cards = Array.from(cardsContainer.querySelectorAll('.cardsmall'));
                const exists = cards.some(card => card.querySelector('p').textContent.trim() === productName);
                if (exists) {
                    alert('This product is already added.');
                    return;
                }

                // Try to find an empty card (the <p> text is "item")
                const emptyCard = cards.find(card => card.querySelector('p').textContent.trim().toLowerCase() === 'item');

                if (emptyCard) {
                    // Fill the empty card with the product name
                    emptyCard.querySelector('p').textContent = productName;
                } else {
                    // No empty card found - append a new card
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-md-6 col-sm-6 col-xs-6 mb-2';

                    colDiv.innerHTML = `
                        <div class="card shadow-lg p-3 rounded m-1 cardsmall">
                            <p style="font-size: 20px;">${productName}</p>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <input type="text" name="quantity[]" class="form-control bg-dark-subtle" placeholder="0.00" style="height: 50px; font-size: 17px;">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <button type="button" class="btn btn-primary w-100" style="background-color:green; height: 50px; font-size: 17px;">add</button>
                                </div>
                            </div>
                        </div>
                    `;
                    cardsContainer.appendChild(colDiv);
                }
            });
        });
    });
    </script>
</body>
</html>
