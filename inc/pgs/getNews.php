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

// Get the articles from the database
$sql = "SELECT * FROM articles ORDER BY id DESC";
$result = $conn->query($sql);

$articles = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
  }
}

// Close the database connection
$conn->close();

// Return the articles as JSON
header("Content-Type: application/json");
echo json_encode($articles);
?>
