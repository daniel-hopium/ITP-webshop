<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/x-icon" href="/Webshop/res/img/favicon.png">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href=".\..\..\res\css\styles.css" rel="stylesheet"  type="text/css">
    
<?php
    // Session start
    session_start();

    // Different navbars dependent if logged in or not
    if(isset($_SESSION['username'])){
      include 'nav_logged_in.php';
    }
    else{
      include 'nav_logged_out.php';
    }
  ?> 
