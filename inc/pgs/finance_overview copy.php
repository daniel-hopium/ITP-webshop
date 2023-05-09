<!DOCTYPE html>
<html lang="en">

<head>
  <title>Finanzübersicht</title>

  <?php
        include '../includes/head.php';
  if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) {
      header('Location: home.php');
  }
  require_once('../../config/dbaccess.php');
  ?>

</head>

<body class="d-flex flex-column min-vh-100">

  <div class="container site-font-color text-center">
    <h1 class="h1 mt-5">Userübersicht:</h1>

    <?php

  $userID = $currentUser['id'];
  $db_obj = new mysqli($host, $user, $password, $database);
                
  $sql =  "SELECT * FROM users ORDER BY id ASC";
  $result = $db_obj->query($sql);

  echo '<div class="table-responsive col-md-12">
    <table class="table table-striped"> 
    <tr class="h6"> 
        <td>ID</td> 
        <td>Anrede</td> 
        <td>Name</td> 
        <td>Vorname</td> 
        <td>Username</td> 
        <td>Email</td> 
        <td>Newsletter</td> 
        <td>Rolle</td>  
        <td></td> 
    </tr>';


  while ($row = $result->fetch_assoc()) {
      $field1name = $row["id"];
      $field2name = $row["form_of_adress"];
      $field3name = $row["name"];
      $field4name = $row["surname"];
      $field5name = $row["username"];
      $field6name = $row["useremail"];
      $field7name = $row["has_newsletter"];
      $field8name = $row["role"];
      $field10name = "<a class='site-font-color' href='user_overview_change.php?user=$field1name' method='POST'>ändern</a>";

      echo '<tr> 
                <td>'.$field1name.'</td> 
                <td>'.$field1name.'</td> 
                <td>'.$field2name.'</td> 
                <td>'.$field3name.'</td> 
                <td>'.$field4name.'</td> 
                <td>'.$field5name.'</td> 
                <td>'.$field6name.'</td>
                <td>'.$field7name.'</td>
                <td>'.$field8name.'</td>
                <td>'.$field10name.'</td>
            </tr>';
            
  }
  echo "</table></div>";
  ?>
  </div>

  <?php
   include '../includes/footer.php';
  ?>

</body>

</html>