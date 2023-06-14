<!DOCTYPE html>
<html lang="en">

<head>
  <title>Finanzübersicht</title>

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
    

    <h1>Bestellübersicht</h1>
    <?php
        // Check if the ID parameter is provided in the URL
        if (isset($_GET['id'])) {
            // Sample data array
            $orders = [
                [
                    'id' => 1,
                    'customer_name' => 'John Doe',
                    'order_date' => '2023-06-01',
                    'products' => [
                        ['name' => 'Product A', 'quantity' => 2],
                        ['name' => 'Product B', 'quantity' => 1]
                    ]
                ],
                [
                    'id' => 2,
                    'customer_name' => 'Jane Smith',
                    'order_date' => '2023-06-05',
                    'products' => [
                        ['name' => 'Product C', 'quantity' => 3]
                    ]
                ],
                [
                    'id' => 3,
                    'customer_name' => 'Robert Johnson',
                    'order_date' => '2023-06-10',
                    'products' => [
                        ['name' => 'Product A', 'quantity' => 5],
                        ['name' => 'Product D', 'quantity' => 2]
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
                echo '<h2>Order ID: ' . $order['id'] . '</h2>';
                echo '<h3>Customer Name: ' . $order['customer_name'] . '</h3>';
                echo '<h3>Order Date: ' . $order['order_date'] . '</h3>';

                // Display the list of products with quantities
                echo '<h3>Products:</h3>';
                echo '<ul class="list-group">';
                foreach ($order['products'] as $product) {
                    echo '<li class="list-group-item">' . $product['name'] . ' - Quantity: ' . $product['quantity'] . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>Order not found.</p>';
            }
            // Return button
            echo '<a href="order_overview.php" class="btn btn-primary mt-3">Return to Order Overview</a>';
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