<?php

// Connect to the database
include '../includes/head.php';
require_once('../../config/dbaccess.php');


$connection = new mysqli($host, $user, $password, $database);

// Check for errors
if (mysqli_connect_errno()) {
  die("Database connection failed: " .
    mysqli_connect_error() .
    " (" . mysqli_connect_errno() . ")"
  );
}

// Check if a product has been added to the cart
if (isset($_POST["product_id"]) && isset($_POST["quantity"])) {
  // Check if the user is logged in
  if (!isset($_SESSION["user_id"])) {
    // If the user is not logged in, redirect to the login page
    echo "<script>location.href='home.php?type=login'</script>";
    exit();
  }

  $user_id = $_SESSION["user_id"];
  $product_id = intval($_POST["product_id"]);
  $quantity = intval($_POST["quantity"]);

  // Insert the product into the shopping cart table
  $query = "INSERT INTO shoppingcart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
  var_dump($_SESSION);
  
  if (mysqli_query($connection, $query)) {
    echo "<script>location.href='prod_display.php'</script>";
    
    exit();
  } else {
    // Display an error message
    echo "Error: " . mysqli_error($connection);
  }
}
?>
