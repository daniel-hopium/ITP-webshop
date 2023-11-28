<?php session_start(); ?>
<?php
// Check if the user is logged in and is an admin

// Connect to the database

include '../includes/head.php';
require_once('../../config/dbaccess.php');

if(!isset($_SESSION['username'])) {
    header('Location: landing_page.php');
}

// Create a new mysqli object
$db_obj = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($db_obj->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $db_obj->connect_error;
    exit();
}

// Check if a product ID is provided
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Delete the product from the database
    $sql = 'DELETE FROM products WHERE id = ?';
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param('i', $productId);
    if ($stmt->execute()) {
        echo 'Product deleted successfully.';
    } else {
        echo 'Error deleting product: ' . $stmt->error;
    }
} else {
    echo 'Product ID not provided.';
}

// Close the database connection
$db_obj->close();
