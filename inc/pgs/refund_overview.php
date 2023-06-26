<!DOCTYPE html>
<html lang="en">

<head>
    <title>Refund Overview</title>

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
            case "approved":
                return "success";
            case "rejected":
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

        // Fetch data from 'refund' table
        if ($role == 'administrator') {
            $sql = "SELECT * FROM refund ORDER BY created_at DESC";
        } else if ($role == 'seller') {
            $sql = "SELECT * FROM refund ORDER BY created_at DESC";
        } else if ($role == 'customer') {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM refund WHERE user_id = '$user_id' ORDER BY created_at DESC";
        }

        $result = $conn->query($sql);

        // Empty array to store fetched refunds
        $refunds = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $refund = [
                    'id' => $row['id'],
                    'product_name' => $row['product_name'],
                    'quantity' => $row['quantity'],
                    'order_date' => $row['order_date'],
                    'reason' => $row['reason'],
                    'created_at' => $row['created_at'],
                    'total_price' => $row['total_price']
                ];
                $refunds[] = $refund;
            }
        }

        $conn->close();
        ?>

        <h1 class="h1 my-5">Refund Overview</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Refund ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Reason</th>
                    <th>Created At</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($refunds as $refund) {
                    echo '<tr>';
                    echo '<td>' . $refund['id'] . '</td>';
                    echo '<td>' . $refund['product_name'] . '</td>';
                    echo '<td>' . $refund['quantity'] . '</td>';
                    echo '<td>' . $refund['order_date'] . '</td>';
                    echo '<td>' . $refund['reason'] . '</td>';
                    echo '<td>' . $refund['created_at'] . '</td>';
                    echo '<td>' . $refund['total_price'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
        include '../includes/footer.php';
        ?>

</html>