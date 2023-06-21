<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bestellübersicht</title>

  <?php
        include '../includes/head.php';
  if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) {
      header('Location: home.php');
  }
  require_once('../../config/dbaccess.php');
  ?>

</head>

<?php
$connection = new mysqli($host, $user, $password, $database);

?>

<body class="d-flex flex-column min-vh-100">
  <div class="container site-font-color text-center">
    <h1 class="h1 my-5">Bestellübersicht</h1>
    <?php
    // Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Query to fetch the order from the database
    $query = "SELECT * FROM new_orders WHERE orderid = $orderId";
    
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
        
        echo '<h2 class="text-start">Order ID: ' . $order['orderid'] . '</h2>';
        echo '<h4 class="text-start">Customer Name: ' . $order['buyer_name'] . '</h4>';
        echo '<h4 class="text-start">Order Date: ' . $order['order_date'] . '</h4>';
        echo '<h4 class="text-start">Order Status: ' . $order['status'] . '</h4>';

        // Display the table of products with quantities
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead>';
        echo '<tbody>';

        // Fetch the associated products for the order
        $productId = $order['product_id'];
        // Fetch the associated products for the order
        $productQuery = "SELECT * FROM products WHERE id IN (SELECT product_id FROM new_orders WHERE orderid = $orderId)";
        $productResult = mysqli_query($connection, $productQuery);

        if ($productResult && mysqli_num_rows($productResult) > 0) {
            while ($product = mysqli_fetch_assoc($productResult)) {
                echo '<tr><td>' . $product['name'] . '</td><td>' . $order['quantity'] . '</td><td>' . $order['total_price'] . '</td></tr>';
            }
        } else {
            echo '<tr><td colspan="3">No products found for this order.</td></tr>';
        }


        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Order not found.</p>';
    }

    // Return button
    echo '<a href="order_overview.php" class="btn btn-dark secondary-bg-color mt-3">Return to Order Overview</a>';
} else {
    echo '<p>Invalid request. Please provide an order ID.</p>';
}
?>
  </div>

  <?php
 include '../includes/footer.php';
  ?>

</body>

</html>