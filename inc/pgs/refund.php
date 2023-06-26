<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../includes/head.php'; ?>
    <br>
    <title>Refund Page</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 20px;
    }
    </style>

</head>

<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $database = 'webshop';
            $username = 'webshop_user';
            $password = 'admin';
            $table = 'refund';
            $productsTable = 'products';

            $productNames = $_POST['product_name'];
            $quantities = $_POST['quantity'];
            $orderDate = $_POST['order_date'];
            $reason = $_POST['reason'];
            $newOrdersTable = 'new_orders';

            try {
                $conn = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $alterTableStmt = $conn->prepare("ALTER TABLE $table ADD COLUMN IF NOT EXISTS total_price DECIMAL(10, 2)");

                $selectStmt = $conn->prepare("SELECT price FROM $productsTable WHERE name = ?");
                $insertStmt = $conn->prepare("INSERT INTO $table (product_name, quantity, order_date, reason, total_price, status) VALUES (?, ?, ?, ?, ?, 'pending')");

                foreach ($productNames as $key => $productName) {
                    $quantity = $quantities[$key];

                    // Retrieve the price from the "products" table based on the product name
                    $selectStmt->execute([$productName]);
                    $price = $selectStmt->fetchColumn();

                    // Calculate the total price
                    $totalPrice = $quantity * $price;

                    // Insert refund request data into the "refund" table
                    $insertStmt->execute([$productName, $quantity, $orderDate, $reason, $totalPrice]);
                }

                // Display success message
                echo "<div class='success-message'>Refund request submitted successfully. Please wait for admin approval.</div>";
            } catch (PDOException $e) {
                // Display error message
                echo "<div class='error-message'>Error: " . $e->getMessage() . "</div>";
            }

            $conn = null;
        }
        ?>

        <main>
            <div class="container">
                <h2>Refund Request</h2>
                <form action="refund.php" method="post">
                    <div id="product_fields">
                        <div class="form-group">
                            <label for="product_name_1">Product Name:</label>
                            <input type="text" class="form-control" id="product_name_1" name="product_name[]" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity_1">Quantity:</label>
                            <input type="number" class="form-control" id="quantity_1" name="quantity[]" required>
                        </div>
                        <div class="form-group">
                            <label for="order_date">Order Date:</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" required>
                        </div>
                        <br>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success" id="add_product">Add Another Product</button>
                    <button type="button" class="btn btn-danger" id="remove_product">Remove Last
                        Product</button>
                    <div class="form-group">
                        <label for="reason">Reason for Refund:</label>
                        <textarea class="form-control" id="reason" name="reason" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg secondary-bg-color btn-block secondary-color mt-2">Submit
                        Refund Request</button>
                </form>
            </div>

            <script>
            $(document).ready(function() {
                // Add more product fields dynamically
                var maxProducts = 10; // Maximum number of product fields
                var productCount = 1; // Initial product field count

                $("#add_product").click(function() {
                    if (productCount < maxProducts) {
                        productCount++;
                        var html = '<div class="form-group">';
                        html += '<label for="product_name_' + productCount + '">Product Name:</label>';
                        html += '<input type="text" class="form-control" id="product_name_' +
                            productCount + '" name="product_name[]" required>';
                        html += '</div>';
                        html += '<div class="form-group">';
                        html += '<label for="quantity_' + productCount + '">Quantity:</label>';
                        html += '<input type="number" class="form-control" id="quantity_' +
                            productCount + '" name="quantity[]" required>';
                        html += '</div>';
                        html += '<div class="form-group">';
                        html += '<label for="order_date_' + productCount + '">Order Date:</label>';
                        html += '<input type="date" class="form-control" id="order_date_' +
                            productCount + '" name="order_date[]" required>';
                        html += '</div>';

                        $("#product_fields").append(html);
                    }
                });

                // Remove product fields dynamically
                $("#remove_product").click(function() {
                    if (productCount > 1) {
                        $("#product_fields .form-group:last-child").remove();
                        $("#product_fields .form-group:last-child").remove();
                        $("#product_fields .form-group:last-child").remove();
                        productCount--;
                    }
                });
            });
            </script>
        </main>
    </div>
</body>

<?php include '../includes/footer.php'; ?>

</html>