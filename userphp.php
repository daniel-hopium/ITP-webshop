<?php

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}

// Connect to database
$host = 'localhost';
$dbname = 'webshop';
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Get user data from database
$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch();

// Check if form is submitted
if (isset($_POST['submit'])) {

  // Get form data
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $new_password_repeat = $_POST['new_password_repeat'];

  // Validate current password
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->bindParam(':username', $_SESSION['username']);
  $stmt->execute();
  $user = $stmt->fetch();
  $hashed_password = $user['password'];
  if (!password_verify($current_password, $hashed_password)) {
    echo "<div class='alert alert-danger' role='alert'>Incorrect current password. Please try again.</div>";
    exit();
  }

  // Validate new password
  if (!empty($new_password)) {
    if ($new_password !== $new_password_repeat) {
      echo "<div class='alert alert-danger' role='alert'>New passwords do not match. Please try again.</div>";
      exit();
    }
    else {
      $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET password = :password WHERE username = :username");
      $stmt->bindParam(':password', $new_password_hashed);
      $stmt->bindParam(':username', $_SESSION['username']);
      $stmt->execute();
      echo "<div class='alert alert-success' role='alert'>Password changed successfully.</div>";
    }
  }

  // Update user data in database
  $stmt = $conn->prepare("UPDATE users SET name = :name, surname = :surname, email = :email, address = :address WHERE username = :username");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':surname', $surname);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':address', $address);
  $stmt->bindParam(':username', $_SESSION['username']);

  if ($stmt->execute()) {
    echo "<div class='alert alert-success' role='alert'>Profile updated.</div>";
    // Refresh user data
    $user['name'] = $name;
    $user['surname'] = $surname;
    $user['email'] = $email;
    $user['address'] = $address;
  }
  else {
    echo "<div class='alert alert-danger' role='alert'>Profile update failed. Please try again later.</div>";
  }

}

// Set variables for form fields
$name = $user['name'];
$surname = $user['surname'];
$email = $user['email'];
$address = $user['address'];

?>