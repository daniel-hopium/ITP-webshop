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

// Get all the sellers
$sql = 'SELECT * FROM sellers';
$stmt = $db_obj->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$sellers = $result->fetch_all(MYSQLI_ASSOC);

// Check if a seller is selected
if (isset($_GET['seller_id'])) {
    // Get the selected seller's products
    $sql = 'SELECT * FROM products WHERE seller_id = ?';
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param('i', $_GET['seller_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Display the products in a table
    echo '<table>';
    echo '<tr><th>Name</th><th>Description</th><th>Price</th><th>Action</th></tr>';
    foreach ($products as $product) {
        echo '<tr>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>' . $product['description'] . '</td>';
        echo '<td>' . $product['price'] . '</td>';
        echo '<td><a href="#" onclick="editProduct(' . $product['id'] . ')">Edit</a> <a href="#" onclick="deleteProduct(' . $product['id'] . ')">Delete</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    // Display a list of all the sellers
    echo '<ul>';
    foreach ($sellers as $seller) {
        echo '<li><a href="?seller_id=' . $seller['id'] . '">' . $seller['name'] . '</a></li>';
    }
    echo '</ul>';
}

// Close the database connection
$db = null;
?>

<script>
  // JavaScript functions for editing and deleting products
  function editProduct(productId) {
    window.location.href = 'product_edit.php?id=' + productId;
  }

  function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
      // Make an AJAX request to delete the product
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            alert('Product deleted successfully.');
            // Refresh the page to show the updated product list
            location.reload();
          } else {
            alert('Error: ' + xhr.status);
          }
        }
      };
      xhr.open('DELETE', 'product_delete.php?id=' + productId);
      xhr.send();
    }
  }
</script>