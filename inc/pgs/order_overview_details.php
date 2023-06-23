<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bestellübersicht</title>

  <?php
  include '../includes/head.php';
  if (!isset($_SESSION['username'])) {
    header('Location: home.php');
  }
  require_once('../../config/dbaccess.php');

  function getStatusPercentage($status)
  {
    switch ($status) {
      case "pending":
        return 25;
      case "in_progress":
        return 50;
      case "shipped":
        return 75;
      case "completed":
        return 100;
      case "cancelled":
        return 100;
      default:
        return 0;
    }
  }

  function getProgressBarColor($status)
  {
    switch ($status) {
      case "pending":
        return "primary";
      case "in_progress":
        return "warning";
      case "shipped":
        return "info";
      case "completed":
        return "success";
      case "cancelled":
        return "danger";
      default:
        return "secondary";
    }
  }
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

      //Query heee
      $query = "SELECT new_orders.orderid, users.username, new_orders.order_date, new_orders.status, new_orders.quantity, new_orders.total_price FROM new_orders JOIN users ON new_orders.user_id = users.id WHERE new_orders.orderid = $orderId";

      $result = mysqli_query($connection, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);

        echo '<h2 class="text-start">Order ID: ' . $order['orderid'] . '</h2>';
        echo '<h4 class="text-start">Username: ' . $order['username'] . '</h4>';
        echo '<h4 class="text-start">Order Date: ' . $order['order_date'] . '</h4>';


        // Display the select element for order status
        if ($role != 'customer') {
          echo '<form class="h4 col-9 d-flex align-items-center" method="POST">';
          echo '<label for="orderStatus" class=" col-4 text-start">Order Status:</label>';
          echo '<select class="form-select  " name="orderStatus" id="orderStatus">';
          echo '<option  value="pending" ' . ($order['status'] == 'pending' ? 'selected' : '') . '>Pending</option>';
          echo '<option value="in_progress" ' . ($order['status'] == 'in_progress' ? 'selected' : '') . '>In Progress</option>';
          echo '<option value="shipped" ' . ($order['status'] == 'shipped' ? 'selected' : '') . '>Shipped</option>';
          echo '<option value="completed" ' . ($order['status'] == 'completed' ? 'selected' : '') . '>Completed</option>';
          echo '<option value="cancelled" ' . ($order['status'] == 'cancelled' ? 'selected' : '') . '>Cancelled</option>';
          echo '</select>';
          echo '<button type="submit" name="updateStatusBtn" class="btn col-3 btn-dark secondary-bg-color">Update Status</button>';
          echo '</form>';
        } else {
          echo "<h4 class='h4 text-start'</h4>Order Status: " . $order['status'] . "</h4>";
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

      // progress bar
      $status = $order['status'];
      $percentage = getStatusPercentage($status);
      $color = getProgressBarColor($status);

      // Display the progress bar with animation and custom label
      echo "<div class='progress my-4 position-relative'>";
      echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-$color' role='progressbar' style='width: $percentage%' aria-valuenow='$percentage' aria-valuemin='0' aria-valuemax='100'></div>";
      echo "<div class='position-absolute w-100 h-100 d-flex justify-content-center'><span>$status ($percentage%)</span></div>";
      echo "</div>";

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