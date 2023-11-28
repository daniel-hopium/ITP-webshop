<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>

    <?php
        include '../includes/head.php';
    require_once('../../config/dbaccess.php');
    if(!isset($_SESSION['username'])) {
        header('Location: home.php');
    }

    $db_obj = new mysqli($host, $user, $password, $database);

    $username = $_SESSION['username'];
    $currentUser = mysqli_query($db_obj, "SELECT users.*, address.*  FROM users  JOIN address ON users.id = address.user_id
    WHERE users.username = '$username';"  );
    $currentUser =($currentUser->fetch_assoc());
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    if ($_GET['change'] == 'pw') {
        include '../includes/profile_change/password_change.php';
    
    } elseif ($_GET['change'] == 'email') {
        include '../includes/profile_change/email_change.php';
    
    } elseif ($_GET['change'] == 'name') {
        include '../includes/profile_change/name_change.php';
    
    } elseif ($_GET['change'] == 'username') {
        include '../includes/profile_change/username_change.php';
    
    }   elseif ($_GET['change'] == 'address') {
    include '../includes/profile_change/address_change.php';

}

    include '../includes/footer.php';
    ?>

</body>

</html>