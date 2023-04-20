<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    
  <?php
   include '../includes/head.php'
  ?> 
  </head>
  <body class="d-flex  flex-column min-vh-100">
    <div class="text-center login site-font-color">
      <form method="post" action="login.php" style="max-width:350px;margin:auto">
          <img  class="mt-4" src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png"
          height="72" alt="Logo">
          <h1 class=" h3 mb-3 ">Anmeldung</h1>

          <div class="form-floating shadow mb-2">
            <input type="text" name="emailOrUsername" id="emailOrUsername" placeholder="Email oder Username" required autofocus class="form-control mt-1">
            <label for="emailOrUsername" class="">Email oder Username</label>
          </div>

          <div class="form-floating shadow">
            <input type="password" name="password" id="floatingPassword" placeholder="Passwort" class="form-control mt-1">
            <label for="floatingPassword" class="">Passwort</label> 
          </div>
     
          <div class="mt-3 d-grid shadow">
          <button type="submit" class="btn btn-lg btn-primary btn-block"><h1 class="h4">Anmelden</h1></button>
          </div>
        </form>

        <div class="col mt-2">
          <a href="registration.php" class="site-font-color" >Noch nicht registriert?</a>
        </div>
    </div>

    <div class="container h4 text-center mt-4 site-font-color">
    <?php
      require_once ('../../config/dbaccess.php');

      if(isset($_SESSION['username']))
      {

          echo "<script>location.href='landing_page.php'</script>";

      } else {
      if (isset($_POST['emailOrUsername'])) {
        $emailOrUsername = $_POST['emailOrUsername'];
        $typedPassword = $_POST['password'];

        $db_obj = new mysqli($host, $user, $password, $database);

        $emailOrUsernameExist = mysqli_query($db_obj, "SELECT * FROM users WHERE useremail = '$emailOrUsername' OR username ='$emailOrUsername' ");
        $active = mysqli_query($db_obj, "SELECT status FROM users WHERE useremail = '$emailOrUsername' OR username ='$emailOrUsername' ");
        $active = ($active->fetch_assoc());

        if (mysqli_num_rows($emailOrUsernameExist) < 1) {
          echo "Ungültiger Username oder Email!";
        } else if ($active['status'] == 'inactive') {
          echo "Ihr Account ist nicht aktiv!";
        } else {
          // finds old hashed passwort and checks via password_verify
          $hashvalue = mysqli_query($db_obj, "SELECT password FROM users WHERE useremail =  '$emailOrUsername' OR username =  '$emailOrUsername'");
          $hashvalue = ($hashvalue->fetch_assoc());
          $hashvalue = ($hashvalue['password']);

          if (password_verify($typedPassword, $hashvalue)) {
            $username = mysqli_query($db_obj, "SELECT username FROM users WHERE useremail =  '$emailOrUsername' OR username =  '$emailOrUsername'");
            $username = ($username->fetch_assoc());
            $username = ($username['username']);

            $_SESSION['username'] = $username;
            echo "<script>location.href='home.php?type=login'</script>";
          } else {
            echo "Falsches Passwort!";
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