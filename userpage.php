<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h1>User Page</h1>
    <hr>
    <?php

    // Start session
    session_start();

    // Get user data
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];

    // Check if user is logged in
    if (!$user_id || !$username || !$email || !$address) {
      echo "<p>You are not logged in. <a href='login.html'>Click here to log in.</a></p>";
      exit();
    }

    // Check if form is submitted
    if (isset($_POST['submit'])) {
      $new_username = $_POST['username'];
      $new_email = $_POST['email'];
      $new_address = $_POST['address'];

      // Check if password is correct
      if (password_verify($_POST['password'], $_SESSION['password'])) {

        // Update user data in session
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;
        $_SESSION['address'] = $new_address;

        echo "<div class='alert alert-success' role='alert'>User data updated successfully.</div>";
      } else {
        echo "<div class='alert alert-danger' role='alert'>Incorrect password.</div>";
      }
    }
    ?>

    <p>Welcome, <?php echo $username; ?>!</p>
    <form action="userphp.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
      </div>
      <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
      </div>
      <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>
      <div class="form-group">
        <label for="new_password_repeat">Confirm new Password</label>
        <input type="password" class="form-control" id="new_password_repeat" name="new_password_repeat" required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
    </form>
    <br>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
