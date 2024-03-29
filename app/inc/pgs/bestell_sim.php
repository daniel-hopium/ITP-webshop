<?php
session_start();

if (isset($_SESSION["user_id"])) {
    //prepare sessiondata for js
    $sessionData = json_encode($_SESSION);
    echo "<script>console.log('Session data: ', $sessionData);</script>";
}

require_once('../../config/dbaccess.php');
$connection = new mysqli($host, $user, $password, $database);

//user_id from POST 
$user_id = $_POST["user_id"];

//next free order ID from database
$orderid = getNextFreeOrderID($connection);

// Retrieve the items in the cart from the database
$query = "SELECT shoppingcart.quantity, products.id, products.name, products.price FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
$result = mysqli_query($connection, $query);

// Loop through the items in the cart
while ($row = mysqli_fetch_assoc($result)) {

    // Calculate the total price for THIS product
    $total_price = $row["price"] * $row["quantity"];

    // Insert the order into the new_orders table
    $query = "INSERT INTO new_orders (orderid, user_id, product_id, quantity, total_price, status, order_date) VALUES (?, ?, ?, ?, ?, 'pending', NOW())";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("iiisi", $orderid, $user_id, $row["id"], $row["quantity"], $total_price);
    $stmt->execute();
}

// Drop the contents of the shopping cart
$deleteQuery = "DELETE FROM shoppingcart WHERE user_id = $user_id";
mysqli_query($connection, $deleteQuery);

// Close the database connection
mysqli_close($connection);

// Function to retrieve the next free order ID from the database
function getNextFreeOrderID($connection)
{
    // Get the maximum order ID from the new_orders table
    $query = "SELECT MAX(orderid) AS max_orderid FROM new_orders";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $max_orderid = $row["max_orderid"];

    // If there are no existing order IDs, start with 1; otherwise, increment the maximum order ID by 1
    if ($max_orderid === null) {
        return 1;
    } else {
        return $max_orderid + 1;
    }
}
echo "<script>location.href='redirect_page.php?type=order_success&id=" . $orderid . "'</script>";
