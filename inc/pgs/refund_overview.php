<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Overview</title>

    <?php
    include '../includes/head.php';
    if (!isset($_SESSION['user_id'])) {
        header('Location: home.php');
    }
    require_once('../../config/dbaccess.php');

    function getStatusBadgeColor($status)
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

<body class="d-flex flex-column min-vh-100">

    <div class="container site-font-color text-center">
        <?php
        // Assuming you have established a database connection
        $conn = new mysqli($host, $user, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from 'new_orders' table
        if ($role == 'administrator') {
            $sql = "SELECT new_orders.orderid, users.username, new_orders.order_date, new_orders.status FROM new_orders INNER JOIN users ON new_orders.user_id = users.id GROUP BY new_orders.orderid ORDER BY new_orders.order_date DESC";
        } else if ($role == 'seller') {
            $sql = "SELECT new_orders.orderid, users.username, new_orders.order_date, new_orders.status FROM new_orders INNER JOIN users ON new_orders.user_id = users.id GROUP BY new_orders.orderid ORDER BY new_orders.order_date DESC";
        } else if ($role == 'customer') {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT new_orders.orderid, users.username, new_orders.order_date, new_orders.status FROM new_orders INNER JOIN users ON new_orders.user_id = users.id WHERE users.id = '$user_id' GROUP BY new_orders.orderid ORDER BY new_orders.order_date DESC";
        }

        $result = $conn->query($sql);

        //empty array to store fetched orders
        $orders = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order = [
                    'id' => $row['orderid'],
                    'username' => $row['username'],
                    'order_date' => $row['order_date'],
                    'status' => $row['status']
                ];
                $orders[] = $order;
            }
        }
        
        $conn->close();
        ?>

        <h1 class="h1 my-5">Order Overview</h1>
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
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<td>' . $order['id'] . '</td>';
                    echo '<td>' . $order['username'] . '</td>';
                    echo '<td>' . $order['order_date'] . '</td>';
                    echo '<td><span class="badge bg-' . getStatusBadgeColor($order['status']) . '">' . $order['status'] . '</span></td>';
                    echo '<td><a href="order_overview_details.php?id=' . $order['id'] . '" class="btn btn-dark secondary-bg-color ">View Details</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <?php
    include '../includes/footer.php';
    ?>

</body>

</html>