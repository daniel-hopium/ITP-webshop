<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bestellübersicht</title>

  <?php
  include '../includes/head.php';
  if (!isset($_SESSION['username']) ) {
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

        // Display the select element for order status
        if($role != 'customer')
        {
          echo '<form class="h4 col-9 d-flex align-items-center" method="POST">';
  echo '<label for="orderStatus" class=" col-4 text-start">Order Status:</label>';
  echo '<select class="form-select  " name="orderStatus" id="orderStatus">';
  echo '<option  value="pending" ' . ($order['status'] == 'pending' ? 'selected' : '') . '>Pending</option>';
  echo '<option value="in_progress" ' . ($order['status'] == 'in_progress' ? 'selected' : '') . '>In Progress</option>';
  echo '<option value="completed" ' . ($order['status'] == 'completed' ? 'selected' : '') . '>Completed</option>';
  echo '</select>';
  echo '<button type="submit" name="updateStatusBtn" class="btn col-3 btn-dark secondary-bg-color">Update Status</button>';
  echo '</form>';

        }
        else 
        {
          echo "<h4 class='h4 text-start'</h4>Order Status: " .$order['status'] ."</h4>";
        }


        // Check if the form is submitted for updating the order status
        if (isset($_POST['updateStatusBtn'])) {
          $newStatus = $_POST['orderStatus'];

          // Update the order status in the database
          $updateQuery = "UPDATE new_orders SET status = '$newStatus' WHERE orderid = $orderId";

          if (mysqli_query($connection, $updateQuery)) {
            echo '<p>Order status updated successfully.</p>';
            // Refresh the page to reflect the updated status
            echo '<meta http-equiv="refresh" content="0">';
          } else {
            echo '<p>Error updating order status.</p>';
          }
        }

        // Display the table of products with quantities
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead>';
        echo '<tbody>';

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
