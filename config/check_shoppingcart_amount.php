<?php
// Checks if admin so navbar enables admin only tabs
require_once('dbaccess.php'); //to retrieve connection details

$db_obj = new mysqli($host, $user, $password, $database);

if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
}

// Filters out role of current user
// if(isset($_SESSION['username']))

$query = "SELECT SUM(quantity) AS totalQuantity FROM shoppingcart";
$result = mysqli_query($db_obj, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalQuantity = $row['totalQuantity'];

    $currentShoppingcartAmount = $totalQuantity;
}