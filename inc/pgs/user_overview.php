<!DOCTYPE html>
<html lang="en">

<head>
  <title>User Overview</title>

  <?php
  include '../includes/head.php';
  if (!isset($_SESSION['username']) || ($_SESSION['username'] != 'admin')) {
    header('Location: home.php');
  }
  require_once('../../config/dbaccess.php');
  ?>

  <style>
    /* Add this CSS block to set the text color to white */
    body {
      color: white;
    }

    table.table {
      color: black;
      /* Reset the color for table contents */
    }
  </style>

</head>

<body class="d-flex flex-column min-vh-100">

  <div class="container site-font-color text-center">
    <h1 class="h1 mt-5">User Overview</h1>

    <?php

    $userID = $currentUser['id'];
    $db_obj = new mysqli($host, $user, $password, $database);

    $sql = "SELECT * FROM users ORDER BY id ASC";
    $result = $db_obj->query($sql);

    echo '<div class="table-responsive col-md-12">
    <table class="table table-striped">
      <thead class="h6 thead-dark">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Name</th>
          <th>Firstname</th>
          <th>Username</th>
          <th>Email</th>
          <th>Newsletter</th>
          <th>Role</th>
          <th></th>
        </tr>
      </thead>
      <tbody>';

    while ($row = $result->fetch_assoc()) {
      $field1name = $row["id"];
      $field2name = $row["form_of_adress"];
      $field3name = $row["name"];
      $field4name = $row["surname"];
      $field5name = $row["username"];
      $field6name = $row["useremail"];
      $field7name = $row["has_newsletter"];
      $field8name = $row["role"];
      $field10name = "<a class='btn btn-dark secondary-bg-color' href='user_overview_change.php?user=$field1name' method='POST'>Edit</a>";


      echo '<tr>
              <td class="align-middle">' . $field1name . '</td>
              <td class="align-middle">' . $field2name . '</td>
              <td class="align-middle">' . $field3name . '</td>
              <td class="align-middle">' . $field4name . '</td>
              <td class="align-middle">' . $field5name . '</td>
              <td class="align-middle">' . $field6name . '</td>
              <td class="align-middle">' . $field7name . '</td>
              <td class="align-middle">' . $field8name . '</td>
              <td class="align-middle">' . $field10name . '</td>
            </tr>';

    }
    echo "</tbody></table></div>";
    ?>
  </div>

  <?php
  include '../includes/footer.php';
  ?>

</body>

</html>