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
        echo "<script>location.href='login.php'</script>";
        exit();
    }

    $user_id = $_SESSION["user_id"];
    $product_id = intval($_POST["product_id"]);
    $quantity = intval($_POST["quantity"]);

    //Update Products
    $updateProductsQuery = "UPDATE products SET Stock = Stock - $quantity WHERE id = $product_id";
    mysqli_query($connection, $updateProductsQuery);


    // Check if the product already exists in the shopping cart for the user
    $query = "SELECT * FROM shoppingcart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Product already exists in the shopping cart, update the quantity
        $row = mysqli_fetch_assoc($result);
        $existingQuantity = intval($row['quantity']);
        $newQuantity = $existingQuantity + $quantity;

        $updateQuery = "UPDATE shoppingcart SET quantity = '$newQuantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";

        if (mysqli_query($connection, $updateQuery)) {
            echo "<script>location.href='prod_display.php'</script>";
            exit();
        } else {
            // Display an error message
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        // Product does not exist in the shopping cart, insert a new entry
        $insertQuery = "INSERT INTO shoppingcart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";

        if (mysqli_query($connection, $insertQuery)) {
            echo "<script>location.href='prod_display.php'</script>";
            exit();
        } else {
            // Display an error message
            echo "Error: " . mysqli_error($connection);
        }
    }
}


