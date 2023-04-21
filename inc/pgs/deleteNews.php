<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the article ID from the URL parameter
$article_id = $_GET["id"];

// Delete the article from the database
$stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();

// Close the database connection
$stmt->close();
$conn->close();
?>

