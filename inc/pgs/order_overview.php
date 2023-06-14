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
    <?php
  // Assuming you have established a database connection
  $conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the 'new_orders' table
$sql = "SELECT * FROM new_orders ORDER BY order_date DESC";

$result = $conn->query($sql);

// Initialize an empty array to store the fetched orders
$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $order = [
            'id' => $row['id'],
            'customer_name' => $row['buyer_name'],
            'order_date' => $row['order_date'],
            'status' => $row['status']
        ];
        $orders[] = $order;
    }
}

// Close the database connection
$conn->close();
?>

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