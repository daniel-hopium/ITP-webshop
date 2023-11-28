  <?php
  //checks the message and redirects dynamically
  if ($_GET['type'] == 'login') {
      $text1 = "Welcome!";
      $text2 = "You have successfully logged in!";
      $destination = "redirecting to the homepage...";
      $destinationPage = "home.php";
  } elseif ($_GET['type'] == 'profile') {
      $text1 = "Success!";
      $text2 = "You have successfully edited your account details!";
      $destination = "redirecting to your profile page...";
      $destinationPage = "userProfile.php";
  } elseif ($_GET['type'] == 'registration') {
      $text1 = "Welcome!";
      $text2 = "You have successfully registered!";
      $destination = "redirecting to the login page...";
      $destinationPage = "login.php";
  } elseif ($_GET['type'] == 'contact') {
      $text1 = "You have successfully contacted us!";
      $text2 = "We will get back to you as soon as possible!";
      $destination = "redirecting to the homepage...";
      $destinationPage = "home.php";
  } elseif ($_GET['type'] == 'userchange') {
      $text1 = "Data successfully changed!";
      $text2 = "";
      $destination = "redirecting to the user management...";
      $destinationPage = "user_overview.php";
  } elseif ($_GET['type'] == 'blogNews') {
      $text1 = "Blog successfully posted";
      $text2 = "";
      $destination = "redirecting to the homepage...";
      $destinationPage = "home.php";
  } elseif ($_GET['type'] == 'order_success') {
      $id= $_GET['id'];
      $text1 = "Order placed successfully";
      $text2 = "";
      $destination = "redirecting to the order overview...";
      $destinationPage = "order_overview_details.php?id=".$id;
  }

  header("refresh:6;url=$destinationPage");
  ?>
  
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Redirection</title>

</head>

<body class="d-flex flex-column min-vh-100">

  <?php
  include '../includes/head.php';
  include '../includes/redirect.php';
  include '../includes/footer.php';
  ?>
</body>

</html>
