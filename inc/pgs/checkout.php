<?php
// Start the session
// Connect to the database
include '../includes/head.php';
require_once('../../config/dbaccess.php');

$connection = new mysqli($host, $user, $password, $database);

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Retrieve the items in the cart from the database
$user_id = $_SESSION["user_id"];
$query = "SELECT shoppingcart.quantity, products.id, products.name, products.price FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
$result = mysqli_query($connection, $query);

// Initialize variables for the order summary and total
$order_summary = "<table><thead><tr><th>Name</th><th>Quantity</th><th>Price</th><th>Total Price</th></tr></thead><tbody>";
$order_total = 0;

// Check if the cart is empty
if (mysqli_num_rows($result) > 0) {
    // Retrieve the products in the cart from the database
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the total price for the product
        $total_price = $row["price"] * $row["quantity"];

        // Add the product information to the order summary
        $order_summary .= "<tr>";
        $order_summary .= "<td>" . $row["name"] . "</td>";
        $order_summary .= "<td>" . $row["quantity"] . "</td>";
        $order_summary .= "<td>" . $row["price"] . " €</td>";
        $order_summary .= "<td>" . $total_price . " €</td>";
        $order_summary .= "</tr>";
  
        // Add the total price to the order total
        $order_total += $total_price;
    }

    // Close the table
    $order_summary .= "</tbody></table>";

    // Display the order summary and total
    echo "<h2>Order Summary</h2>";
    echo $order_summary;
    echo "<p><strong>Total: " . $order_total . " €</strong></p>";

    // Display the shipping options
    echo "<h2>Shipping Options</h2>";
    echo "<p>Select a shipping option:</p>";
    echo "<label for='standard'><input type='radio' id='standard' name='shipping' value='standard' checked>Standard (Free)</label><br>";
    echo "<label for='express'><input type='radio' id='express' name='shipping' value='express'>Express (10 €)</label><br>";
    echo "<label for='overnight'><input type='radio' id='overnight' name='shipping' value='overnight'>Overnight (20 €)</label><br>";

    // Display the address form
    echo "<h2>Shipping Information</h2>";
    echo "<form action='placeorder.php' method='post'>";
    echo "<label for='name'>Name:</label>";
    echo "<input type='text' id='name' name='name' required><br>";
    echo "<label for='address'>Address:</label>";
    echo "<textarea id='address' name='address' required></textarea><br>";
    echo "<label for='city'>City:</label>";
    echo "<input type='text' id='city' name='city' required><br>";
    echo "<label for='zip'>Zip Code:</label>";
    echo "<input type='text' id='zip' name='zip' required><br>";

    // Display the payment options
    echo "<h2>Payment Information</h2>";
    echo "<label for='payment'>Payment Method:</label>";
    echo "<select id='payment' name='payment' required>";
    echo "<option value='creditcard'>Credit Card</option>";
    echo "<option value='paypal'>PayPal</option>";
    echo "<option value='Auf_Rechnung'>Auf Rechnung</option>";
    echo "</select><br>";
    echo "<label for='cardnumber'>Card Number:</label>";
    echo "<input type='text' id='card
number' name='cardnumber' required><br>";
    echo "<label for='expmonth'>Expiration Month:</label>";
    echo "<input type='text' id='expmonth' name='expmonth' required><br>";
    echo "<label for='expyear'>Expiration Year:</label>";
    echo "<input type='text' id='expyear' name='expyear' required><br>";
    echo "<label for='cvv'>CVV:</label>";
    echo "<input type='text' id='cvv' name='cvv' required><br>";

    // Add the submit button
    echo "<input type='submit' value='Place Order'>";
    echo "</form>";
} else {
    // If the cart is empty, display a message
    echo "<p>Your cart is empty. Please add some products.</p>";
}

// Close the database connection
mysqli_close($connection);

// Include the footer
include '../includes/footer.php';


?>

<!-- < CREATE TABLE orders (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  shipping_name VARCHAR(255) NOT NULL,
  shipping_address TEXT NOT NULL,
  shipping_city VARCHAR(255) NOT NULL,
  shipping_zip VARCHAR(10) NOT NULL,
  payment_method VARCHAR(255) NOT NULL,
  payment_card_number VARCHAR(16),
  payment_exp_month INT(2),
  payment_exp_year INT(4),
  payment_cvv VARCHAR(3),
  shipping_cost DECIMAL(10,2) NOT NULL,
  total_cost DECIMAL(10,2) NOT NULL,
  order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  order_status VARCHAR(50) NOT NULL
  PRIMARY KEY (id)
);  -->