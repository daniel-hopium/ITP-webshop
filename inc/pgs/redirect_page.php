<!doctype html>
<html lang="en">
  <head>
    <title>Weiterleitung</title>
    
  <?php
  include '../includes/head.php';

  //checks the message and redirects dynamically
  if ($_GET['type'] == 'login'){
    $text1 = "Wir heißen Sie herzlich Wilkommen!";
    $text2 = "Sie haben sich erfolgreich angemeldet!";
    $destination = "zur Startseite weitergeleitet...";
    $destinationPage = "home.php";
}
  else if ($_GET['type'] == 'profile'){
    $text1 = "Erfolg!";
    $text2 = "Sie haben ihre Kontodaten erfolgreich bearbeitet!";
    $destination = "zu ihrer Profilseite weitergeleitet...";
    $destinationPage = "userProfile.php";
  }
  else if ($_GET['type'] == 'registration'){
    $text1 = "Wir heißen Sie herzlich Wilkommen!";
    $text2 = "Sie haben sich erfolgreich registriert!";
    $destination = "zur Loginseite weitergeleitet...";
    $destinationPage = "login.php";
  }
  else if ($_GET['type'] == 'contact'){
    $text1 = "Sie haben uns erfolgreich kontaktiert!";
    $text2 = "Wir melden uns so bald wie möglich!";
    $destination = "zur Startseite weitergeleitet...";
    $destinationPage = "home.php";
  }

  else if ($_GET['type'] == 'userchange'){
    $text1 = "Daten erfolgreich verändert!";
    $text2 = "";
    $destination = "zur Userverwaltung weitergeleitet...";
    $destinationPage = "user_overview.php";
  }

  else if ($_GET['type'] == 'blogNews'){
    $text1 = "Blog erfolgreich gepostet";
    $text2 = "";
    $destination = "zur Startseite weitergeleitet...";
    $destinationPage = "home.php";
  }

  header("refresh:6;url=$destinationPage");
  ?> 
  </head>
  <body class="d-flex  flex-column min-vh-100">
 
  <?php
    include '../includes/redirect.php';
    include '../includes/footer.php';
  ?>
  </body>
</html>