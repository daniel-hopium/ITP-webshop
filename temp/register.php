<?php

// Start session
session_start();

// Check if form is submitted
if (isset($_POST['submit'])) {

  // Get form data
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if passwords match
  if ($password !== $confirm_password) {
    echo "<div class='alert alert-danger' role='alert'>Passwords do not match.</div>";
    $_SESSION['form_data'] = $_POST;
    header('refresh:5;url=register.html');
    exit();
  }

  // Connect to database
  $host = 'localhost';
  $dbname = 'webshop';
  $username = 'root';
  $password = '';
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

  // Check if username or email already exist in database
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    echo "<div class='alert alert-danger' role='alert'>Username or email already exists.</div>";
    $_SESSION['form_data'] = $_POST;
    header('refresh:5;url=register.html');
    exit();
  }
  else {
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $stmt = $conn->prepare("INSERT INTO users (name, surname, username, email, address, password) VALUES (:name, :surname, :username, :email, :address, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
      echo "<div class='alert alert-success' role='alert'>Registration successful.</div>";
      header('refresh:5;url=login.html');
      exit();
    }
    else {
      echo "<div class='alert alert-danger' role='alert'>Registration failed. Please try again later.</div>";
      $_SESSION['form_data'] = $_POST;
      header('refresh:5;url=register.html');
      exit();
    }
  }

}

?>
