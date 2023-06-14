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

// Generate a unique order ID
$orderid = generateOrderID($connection);

// Retrieve the items in the cart from the database
$query = "SELECT shoppingcart.quantity, products.id, products.name, products.price FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
$result = mysqli_query($connection, $query);

// Loop through the items in the cart
while ($row = mysqli_fetch_assoc($result)) {
  // Calculate the total price for THIS product
  $total_price = $row["price"] * $row["quantity"];

  // Insert the order into the new_orders table
  $query = "INSERT INTO new_orders (orderid, buyer_name, buyer_email, product_id, quantity, total_price, status, order_date) VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())";
  $stmt = $connection->prepare($query);
  $stmt->bind_param("ssiiis", $orderid, $user_id, $_SESSION["username"], $row["id"], $row["quantity"], $total_price);
  $stmt->execute();
}

// Drop the contents of the shopping cart
$deleteQuery = "DELETE FROM shoppingcart WHERE user_id = $user_id";
mysqli_query($connection, $deleteQuery);


// Close the database connection
mysqli_close($connection);

// Function to generate a unique order ID
function generateOrderID($connection) {
  $orderid = generateRandomID();

  // Check if the generated order ID already exists in the database
  $query = "SELECT COUNT(*) AS count FROM new_orders WHERE orderid = ?";
  $stmt = $connection->prepare($query);
  $stmt->bind_param("s", $orderid);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $count = $row["count"];

  // If the order ID already exists, generate a new one recursively
  if ($count > 0) {
      return generateOrderID($connection); // Generate a new order ID
  }

  return $orderid;
}

// Function to generate a random order ID
function generateRandomID() {
  $unique_id = uniqid('', true);
  $random_bytes = random_bytes(8);
  $random_number = hexdec(bin2hex($random_bytes));
  $order_id = $unique_id . $random_number;
  return $order_id;
}
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
