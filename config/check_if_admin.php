<?php
// Checks if admin so navbar enables admin only tabs
    require_once ('dbaccess.php'); //to retrieve connection details

    $db_obj = new mysqli($host, $user, $password, $database);

    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }

    // Filters out role of current user
    $currentUser = $_SESSION['username'];
        $currentUser = mysqli_query($db_obj, "SELECT role, id FROM users WHERE username = '$currentUser' ");
        $currentUser =($currentUser->fetch_assoc());
        $role = $currentUser['role'];

?>
