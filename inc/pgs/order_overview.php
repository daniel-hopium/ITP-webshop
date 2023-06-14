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
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have an array of orders, replace this with your actual data source
                $orders = [
                    [
                        'id' => 1,
                        'customer_name' => 'John Doe',
                        'order_date' => '2023-06-01',
                        'status' => 'Pending'
                    ],
                    [
                        'id' => 2,
                        'customer_name' => 'Jane Smith',
                        'order_date' => '2023-06-05',
                        'status' => 'Processing'
                    ],
                    [
                        'id' => 3,
                        'customer_name' => 'Robert Johnson',
                        'order_date' => '2023-06-10',
                        'status' => 'Delivered'
                    ]
                ];
                
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<td>' . $order['id'] . '</td>';
                    echo '<td>' . $order['customer_name'] . '</td>';
                    echo '<td>' . $order['order_date'] . '</td>';
                    echo '<td>' . $order['status'] . '</td>';
                    echo '<td><a href="order_overview_details.php?id=' . $order['id'] . '" class="btn btn-dark secondary-bg-color ">View Details</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>






  </div>

  <?php
 include '../includes/footer.php';
  ?>

</body>

</html>