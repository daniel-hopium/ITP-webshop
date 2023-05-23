<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // Prepare session data for JavaScript
    $sessionData = json_encode($_SESSION);
    echo "<script>console.log('Session data: ', $sessionData);</script>";
}

// Connect to the database
require_once('../../config/dbaccess.php');
$connection = new mysqli($host, $user, $password, $database);

// Retrieve the user_id from the POST parameters
$user_id = $_POST["user_id"];

// Retrieve the items in the cart from the database
$query = "SELECT shoppingcart.quantity, products.id, products.name, products.price FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
$result = mysqli_query($connection, $query);

// Loop through the items in the cart
while ($row = mysqli_fetch_assoc($result)) {
    // Calculate the total price for THIS product
    $total_price = $row["price"] * $row["quantity"];

    // Insert the order into the new_orders table
    $query = "INSERT INTO new_orders (buyer_name, buyer_email, product_id, quantity, total_price, status) VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ssiii", $user_id, $_SESSION["username"], $row["id"], $row["quantity"], $total_price); // Assuming $user_id is used as both buyer_name and buyer_email for testing purposes.
    $stmt->execute();
}

// Close the database connection
mysqli_close($connection);
?>

<div id="timer">5</div>

<script>
  let timeLeft = 5;
  const timerDisplay = document.getElementById("timer");

  const timerInterval = setInterval(() => {
    timeLeft--;
    timerDisplay.textContent = timeLeft;

    if (timeLeft === 0) {
      clearInterval(timerInterval);
      window.location.href = "order_status.php";
    }
  }, 1000);
</script>

