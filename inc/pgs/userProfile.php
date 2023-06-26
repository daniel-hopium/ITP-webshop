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

  $user = $_SESSION['username'];
    
  $currentUser = mysqli_query($db_obj, "SELECT users.*, address.*  FROM users  JOIN address ON users.id = address.user_id
  WHERE users.username = '$user';"  );
  $currentUser =($currentUser->fetch_assoc());
  ?>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="container site-font-color">
    <div class="row mt-5 col-md-12">
      <div class="card card-bg shadow-2-strong card-registration mt-3 p-2 flex-column "
        style="border-radius: 15px; max-width: 600px;">
        <div class="">
          <a href="order_overview.php" target="">
            <button class="btn btn-lg secondary-bg-color btn-block secondary-color col-12">My Orders</button>
          </a>
        </div>
      </div>
      <div class="card card-bg shadow-2-strong card-registration mt-3 p-2 flex-column "
        style="border-radius: 15px; max-width: 600px;">
        <div class="col-md-6">
          <h1 class="h1">My Profile</h1>

          <div class="site-font-color">
            <h5 class="mt-4">
              <?php echo $currentUser['form_of_adress']." ".$currentUser['name']." ".$currentUser['surname'];?>
            </h5>
            <h5 class="">Birth Date:
              <?php echo $currentUser['birth_date']; ?>
            </h5>
            <h5>Newsletter:
              <?php if ($currentUser['has_newsletter']) {
                  echo "Yes";
              } else {
                  echo "No";
              }  ?>
            </h5>
            <a href="user_profile_change.php?change=name" method="post" class="site-font-color">Change Data</a>
          </div>

          <div class="site-font-color">
            <h3 class="mt-4">Username:</h3>
            <h5 class="">
              <?php echo $currentUser['username'];?>
            </h5>
            <a href="user_profile_change.php?change=username" method="post" class="site-font-color">Change Username</a>

          </div>

          <div class="site-font-color">
            <h3 class="mt-4">Email:</h3>
            <h5 class="">
              <?php echo $currentUser['useremail'];?>
            </h5>
            <a href="user_profile_change.php?change=email" method="post" class="site-font-color">Change Email</a>
          </div>
          <a href="user_profile_change.php?change=pw" method="post" class="site-font-color">Change Password</a>

          <div class="site-font-color">
            <h3 class="mt-4">Address:</h3>
            <h5 class="">
              <?php
               echo $currentUser['street']. "<br>";
               echo $currentUser['city'] ." ";
               echo $currentUser['state']."<br>";
               echo $currentUser['zip_code'] ." ";
              echo $currentUser['country'];?>
            </h5>
            <a href="user_profile_change.php?change=address" method="post" class="site-font-color">Change Address</a>
          </div>
         

        </div>
      </div>
    </div>
  </div>

  <?php
 include '../includes/footer.php';
  ?>
</body>

</html>