<?php
require_once('../../config/dbaccess.php');
$conn = new mysqli($host, $user, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['status']) && isset($_POST['id'])) {
        $status = $_POST['status'];
        $id = intval($_POST['id']);
        $sql = "UPDATE new_orders SET status = '$status' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Status of " . $id . " updated to " . $status;
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}
$conn->close();
?>
