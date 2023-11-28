<?php session_start(); ?>
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
        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the form was submitted
            if (isset($_POST['refund_id']) && isset($_POST['action'])) {
                $refundId = $_POST['refund_id'];
                $action = $_POST['action'];

                if ($action === 'accept') {
                    // Update the refund status to approved
                    $updateStmt = $conn->prepare("UPDATE refund SET status = 'approved' WHERE id = ?");
                    $updateStmt->bind_param("i", $refundId);
                    $updateStmt->execute();

                    // Get the refund details
                    $selectStmt = $conn->prepare("SELECT product_name, quantity, order_date FROM refund WHERE id = ?");
                    $selectStmt->bind_param("i", $refundId);
                    $selectStmt->execute();
                    $selectResult = $selectStmt->get_result();
                    $refundDetails = $selectResult->fetch_assoc();

                    if ($refundDetails) {
                        $productName = $refundDetails['product_name'];
                        $quantity = $refundDetails['quantity'];
                        $orderDate = $refundDetails['order_date'];

                        // Update the quantity and total_price in the "new_orders" table
                        $updateOrdersStmt = $conn->prepare("UPDATE new_orders SET quantity = quantity - ?, total_price = total_price - (SELECT total_price FROM refund WHERE id = ?) WHERE product_id IN (SELECT id FROM products WHERE name = ?) AND order_date = ?");
                        $updateOrdersStmt->bind_param("iiss", $quantity, $refundId, $productName, $orderDate);
                        $updateOrdersStmt->execute();
                    }
                } elseif ($action === 'cancel') {
                    // Check if the refund is already approved
                    $selectStmt = $conn->prepare("SELECT status FROM refund WHERE id = ?");
                    $selectStmt->bind_param("i", $refundId);
                    $selectStmt->execute();
                    $selectResult = $selectStmt->get_result();
                    $refundDetails = $selectResult->fetch_assoc();

                    if ($refundDetails['status'] === 'approved') {
                        // Update the refund status to rejected
                        $updateStmt = $conn->prepare("UPDATE refund SET status = 'rejected' WHERE id = ?");
                        $updateStmt->bind_param("i", $refundId);
                        $updateStmt->execute();

                        // Get the refund details
                        $selectStmt = $conn->prepare("SELECT product_name, quantity, order_date FROM refund WHERE id = ?");
                        $selectStmt->bind_param("i", $refundId);
                        $selectStmt->execute();
                        $selectResult = $selectStmt->get_result();
                        $refundDetails = $selectResult->fetch_assoc();

                        if ($refundDetails) {
                            $productName = $refundDetails['product_name'];
                            $quantity = $refundDetails['quantity'];
                            $orderDate = $refundDetails['order_date'];

                            // Update the quantity and total_price in the "new_orders" table
                            $updateOrdersStmt = $conn->prepare("UPDATE new_orders SET quantity = quantity + ?, total_price = total_price + (SELECT total_price FROM refund WHERE id = ?) WHERE product_id IN (SELECT id FROM products WHERE name = ?) AND order_date = ?");
                            $updateOrdersStmt->bind_param("iiss", $quantity, $refundId, $productName, $orderDate);
                            $updateOrdersStmt->execute();
                        }
                    }
                }
            }
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
                    'total_price' => $row['total_price'],
                    'status' => $row['status']
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
                    <th>Status</th>
                    <th>Action</th>
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
                    echo '<td><span class="badge bg-' . getStatusBadgeColor($refund['status']) . '">' . $refund['status'] . '</span></td>';
                    echo '<td>';
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="refund_id" value="' . $refund['id'] . '">';
                    echo '<div class="btn-group">';
                    echo '<button type="submit" class="btn btn-success" name="action" value="accept">Accept</button>';
                    echo '<button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>';
                    echo '</div>';
                    echo '</form>';
                    echo '</td>';
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