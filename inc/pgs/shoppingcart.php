<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include '../includes/head.php';
    require_once('../../config/dbaccess.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .centered {
            display: block;
            text-align: center;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    // Start the session
    // Connect to the database

    $connection = new mysqli($host, $user, $password, $database);

    // Retrieve the items in the cart from the database
    $user_id = $_SESSION["user_id"];
    $query = "SELECT shoppingcart.quantity, products.id, products.name, products.price, products.discount FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
    $result = mysqli_query($connection, $query);

    // Check if the user is logged in
    if (!isset($_SESSION["user_id"])) {
        // If the user is not logged in, redirect to the login page
        exit();
    }

    // If the user updates the quantity of an item in the cart
    if (isset($_POST['quantity'])) {
        // Loop through the items in the cart
        foreach ($_POST['quantity'] as $key => $value) {
            // Update the quantity for the current item
            $id = (int)$key;
            $quantity = (int)$value;
            $query = "UPDATE shoppingcart SET quantity=$quantity WHERE user_id=$user_id AND product_id=$id";
            mysqli_query($connection, $query);
        }
        echo "<script>location.href='shoppingcart.php'</script>";
    }

    // Initialize variables for the order summary and total
    $order_summary = "<form method='post'><table class='table'><thead><tr><th>Name</th><th>Quantity</th><th>Price</th><th>Discount</th><th>Total Price</th><th>Remove</th></tr></thead><tbody>";
    $order_total = 0;

    echo "<div class='container'>";

    // Check if the cart is empty
    if (mysqli_num_rows($result) > 0) {
        // Retrieve the products in the cart from the database
        while ($row = mysqli_fetch_assoc($result)) {
            // Calculate the total price for the product
            $discount = $row["discount"];
            $discounted_price = $row["price"] - ($row["price"] * $discount / 100);
            $total_price = $discounted_price * $row["quantity"];

            // Format the prices to two decimal places
            $discounted_price_formatted = number_format($discounted_price, 2);
            $total_price_formatted = number_format($total_price, 2);

            // Determine the discount text to display
            $discount_text = ($discount > 0) ? $discount . "%" : "<span >0%</span>";

            // Add the product information to the order summary
            $order_summary .= "<tr>";
            $order_summary .= "<td>" . $row["name"] . "</td>";
            $order_summary .= "<td><input type='number' name='quantity[" . $row["id"] . "]' value='" . $row["quantity"] . "' min='1' max='100' onchange='this.form.submit()' required></td>";
            $order_summary .= "<td>" . $row["price"] . " €</td>";
            $order_summary .= "<td class='discount'>" . $discount_text . "</td>";
            $order_summary .= "<td>" . $total_price_formatted . " €</td>";
            $order_summary .= "<td><a href='removefromcart.php?id=" . $row["id"] . "'>Remove</a></td>";
            $order_summary .= "</tr>";

            // Add the total price to the order total
            $order_total += $total_price;
        }

        // Close the table
        $order_summary .= "</tbody></table></form>";

        // Format the order total to two decimal places
        $order_total_formatted = number_format($order_total, 2);

        // Display the order summary and total
        echo "<h2 class='mt-4'>Shopping Cart</h2>";
        echo $order_summary;
        echo "<p class='mt-3'><strong>Total: " . $order_total_formatted . " €</strong></p>";

        // Add the checkout button
        echo "<form action='../pgs/payment.php' method='post'>";
        echo "<input type='submit' value='Checkout'>";
        echo "</form>";

        // Add the simulate checkout button
        echo "<form action='bestell_sim.php' method='post'>";
        echo "<input type='hidden' name='user_id' value='" . $_SESSION["user_id"] . "'>";
        echo "<input type='submit' value='Simulate Checkout'>";
        echo "</form>";
        
    } else {
        // If the cart is empty, display a message
        echo "<p>Your cart is empty. Please add some products.</p>";
    }

    echo "</div>";

    // Close the database connection
    mysqli_close($connection);

    // Include the footer
    include '../includes/footer.php';
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>