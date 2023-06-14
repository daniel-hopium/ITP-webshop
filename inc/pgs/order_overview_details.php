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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">

  <div class="container site-font-color text-center">
    

    <h1 class="h1 my-5">Bestellübersicht</h1>
    <?php
        // Check if the ID parameter is provided in the URL
        if (isset($_GET['id'])) {
            // Sample data array
            $orders = [
                [
                    'id' => 1,
                    'customer_name' => 'John Doe',
                    'order_date' => '2023-06-01',
                    'status' => 'Pending',
                    'products' => [
                        ['name' => 'Product A', 'quantity' => 2, 'price' => 10.99],
                        ['name' => 'Product B', 'quantity' => 1, 'price' => 5.99]
                    ]
                ],
                [
                    'id' => 2,
                    'customer_name' => 'Jane Smith',
                    'order_date' => '2023-06-05',
                    'status' => 'Processing',
                    'products' => [
                        ['name' => 'Product C', 'quantity' => 3, 'price' => 7.99]
                    ]
                ],
                [
                    'id' => 3,
                    'customer_name' => 'Robert Johnson',
                    'order_date' => '2023-06-10',
                    'status' => 'Delivered',
                    'products' => [
                        ['name' => 'Product A', 'quantity' => 5, 'price' => 10.99],
                        ['name' => 'Product D', 'quantity' => 2, 'price' => 8.99]
                    ]
                ]
            ];
            
            

            $order = null;

            // Find the order in the array based on the ID
            foreach ($orders as $o) {
                if ($o['id'] == 1) {
                    $order = $o;
                    break;
                }
            }

            if ($order) {
                echo '<h2 class="text-start">Order ID: ' . $order['id'] . '</h2>';
                echo '<h4 class="text-start">Customer Name: ' . $order['customer_name'] . '</h4>';
                echo '<h4 class="text-start">Order Date: ' . $order['order_date'] . '</h4>';
                echo '<h4 class="text-start">Order Status: ' . $order['status'] . '</h4>';

                // Display the table of products with quantities
                
                echo '<table class="table table-striped">';
                echo '<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead>';
                echo '<tbody>';
                foreach ($order['products'] as $product) {
                    echo '<tr><td>' . $product['name'] . '</td><td>' . $product['quantity'] . '</td><td>' . $product['price'] . '</td></tr>';
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