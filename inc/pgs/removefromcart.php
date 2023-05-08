<?php

// Start the session
// Connect to the database
include '../includes/head.php';
require_once('../../config/dbaccess.php');

$connection = new mysqli($host, $user, $password, $database);


// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
  // If the user is not logged in, redirect to the login page

  exit();
}

// Check if the product ID is set in the URL
if (isset($_GET['id'])) {
  // Retrieve the product ID from the URL
  $product_id = $_GET['id'];

  // Delete the item from the shopping cart in the database
  $user_id = $_SESSION["user_id"];
  $query = "DELETE FROM shoppingcart WHERE user_id = $user_id AND product_id = $product_id";
  mysqli_query($connection, $query);
}
echo "<script>location.href='home.php?type=login'</script>";
// Redirect to the shopping cart page
exit();

?>
