<?php

// Start session
session_start();

// Connect to database
$host = 'localhost';
$dbname = 'webshop';
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if user exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch();
if (!$user || !password_verify($password, $user['password'])) {
  echo "<script>alert('Invalid username or password.');</script>";
  echo "<script>window.location.href = 'login.html';</script>";
  exit();
}

// Store user ID in session
$_SESSION['user_id'] = $user['id'];

// Redirect to user page
echo "<script>window.location.href = 'user.php';</script>";
exit();

?>