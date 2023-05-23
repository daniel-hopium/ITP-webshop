<?php
// Start the session
// Connect to the database
include '../includes/head.php';
require_once('../../config/dbaccess.php');

$connection = new mysqli($host, $user, $password, $database);

// Retrieve the items in the cart from the database
$user_id = $_SESSION["user_id"];
$query = "SELECT shoppingcart.quantity, products.id, products.name, products.price FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
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
$order_summary = "<form method='post'><table><thead><tr><th>Name</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Remove</th></tr></thead><tbody>";
$order_total = 0;

echo "<div class='container'>";


// Check if the cart is empty
if (mysqli_num_rows($result) > 0) {
    // Retrieve the products in the cart from the database
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the total price for the product
        $total_price = $row["price"] * $row["quantity"];

        // Add the product information to the order summary
        $order_summary .= "<tr>";
        $order_summary .= "<td>" . $row["name"] . "</td>";
        $order_summary .= "<td><input type='number' name='quantity[" . $row["id"] . "]' value='" . $row["quantity"] . "' min='1' max='100' onchange='this.form.submit()' required></td>";
        $order_summary .= "<td>" . $row["price"] . " €</td>";
        $order_summary .= "<td>" . $total_price . " €</td>";
        $order_summary .= "<td><a href='removefromcart.php?id=" . $row["id"] . "'>Remove</a></td>";
        $order_summary .= "</tr>";

        // Add the total price to the order total
        $order_total += $total_price;
    }

    // Close the table
    $order_summary .= "</tbody></table></form>";

    // Display the order summary and total
    echo "<h2>Shopping Cart</h2>";
    echo $order_summary;
    echo "<p><strong>Total: " . $order_total . " €</strong></p>";

    // checkout button
    echo "<form action='../pgs/payment.php' method='post'>";
    echo "<input type='submit' value='Checkout'>";
    echo "</form>";

    // !!!! Hier Zweiter Knopf
    // simulate checkout button
    echo "<form action='bestell_sim.php' method='post'>";
    echo "<input type='hidden' name='user_id' value='" . $_SESSION["user_id"] . "'>";
    echo "<input type='submit' value='Simulate Checkout'>";
    echo "</form>";

} else {
    // If the cart is empty, display a message
    echo "<p>Your cart is empty. Please add some products.</p>";
}

echo "</div >";

// Close the database connection
mysqli_close($connection);

// Include the footer
include '../includes/footer.php';
