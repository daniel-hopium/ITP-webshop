<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news";

$conn = new mysqli($servername, $username, $password, $dbname); //create connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$title = $_POST["title"];
$content = $_POST["content"];

// Insert the data into the database
$stmt = $conn->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content);
$stmt->execute();

// Close the database connection
$stmt->close();
$conn->close();
?>
