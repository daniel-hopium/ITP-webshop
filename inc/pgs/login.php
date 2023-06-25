<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>

  <?php
   include '../includes/head.php'
  ?>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="text-center login site-font-color">
    <form method="post" action="login.php" style="max-width:350px;margin:auto">
      <img class="mt-4" src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png"
        height="72" alt="Logo">
      <h1 class=" h3 mb-3 ">Log in</h1>

      <div class="form-floating shadow mb-2">
        <input type="text" name="emailOrUsername" id="emailOrUsername" placeholder="Email or Username" required
          autofocus class="form-control mt-1">
        <label for="emailOrUsername" class="">Email or Username</label>
      </div>

      <div class="form-floating shadow">
        <input type="password" name="password" id="floatingPassword" placeholder="Password" class="form-control mt-1">
        <label for="floatingPassword" class="">Password</label>
      </div>

      <div class="mt-3 d-grid shadow">
        <button type="submit" class="btn btn-lg secondary-bg-color btn-block secondary-color">
          <h1 class="h4">Log in</h1>
        </button>
      </div>
    </form>

    <div class="col mt-2">
      <a href="registration.php" class="site-font-color">Not registered yet?</a>
    </div>
  </div>

  <div class="container h4 text-center mt-4 site-font-color">
    <?php
      require_once('../../config/dbaccess.php');

  if(isset($_SESSION['username'])) {

      echo "<script>location.href='home.php'</script>";

  } else {
      if (isset($_POST['emailOrUsername'])) {
          $emailOrUsername = $_POST['emailOrUsername'];
          $typedPassword = $_POST['password'];

          $db_obj = new mysqli($host, $user, $password, $database);

          $emailOrUsernameExist = mysqli_query($db_obj, "SELECT * FROM users WHERE useremail = '$emailOrUsername' OR username ='$emailOrUsername' ");
          $active = mysqli_query($db_obj, "SELECT status FROM users WHERE useremail = '$emailOrUsername' OR username ='$emailOrUsername' ");
          $active = ($active->fetch_assoc());

          if (mysqli_num_rows($emailOrUsernameExist) < 1) {
              echo "Invalid username or email!";
          } elseif ($active['status'] == 'inactive') {
              echo "Your account is inactive!";
          } else {
              // finds old hashed password and checks via password_verify
              $hashvalue = mysqli_query($db_obj, "SELECT password FROM users WHERE useremail =  '$emailOrUsername' OR username =  '$emailOrUsername'");
              $hashvalue = ($hashvalue->fetch_assoc());
              $hashvalue = ($hashvalue['password']);

              if (password_verify($typedPassword, $hashvalue)) {
                  $user = mysqli_query($db_obj, "SELECT id, username, seller_id FROM users WHERE useremail = '$emailOrUsername' OR username = '$emailOrUsername'");
                  $user = $user->fetch_assoc();
          
                  $_SESSION['user_id'] = $user['id'];
                  $_SESSION['username'] = $user['username'];
                  $_SESSION['seller_id'] = $user['seller_id'];

                  echo "<script>location.href='home.php?type=login'</script>";
              } else {
                  echo "Incorrect password!";
              }
          }
      }
  }
  ?>
  </div>

  <?php
 include '../includes/footer.php';
  ?>
</body>

</html>
