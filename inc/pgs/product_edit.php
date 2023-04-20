<?php
// Check if the user is logged in and is an admin

// Connect to the database
include '../includes/head.php';
require_once('../../config/dbaccess.php');

if(!isset($_SESSION['username'])) header('Location: landing_page.php');

// Create a new mysqli object
$db_obj = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($db_obj->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $db_obj->connect_error;
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the product ID from the URL parameter
  $productId = $_GET['id'];

  // Get the form data
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Update the product in the database
  $sql = 'UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?';
  $stmt = $db_obj->prepare($sql);
  $stmt->bind_param('ssdi', $name, $description, $price, $productId);
  $stmt->execute();

  // Redirect back to the edit product page
  header('Location: product_edit.php?id=' . $productId);
  exit();
}

// Get the product ID from the URL parameter
$productId = $_GET['id'];

// Get the product from the database
$sql = 'SELECT * FROM products WHERE id = ?';
$stmt = $db_obj->prepare($sql);
$stmt->bind_param('i', $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Close the database connection
$db_obj->close();
?>

<h1>Edit Product</h1>

<form method="post" action="product_edit.php?id=<?php echo $productId; ?>">
  <div>
    <label for="name">Product Name:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
  </div>
  <div>
    <label for="description">Product Description:</label>
    <textarea name="description" required><?php echo $product['description']; ?></textarea>
  </div>
  <div>
    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
  </div>
  <input type="submit" value="Save">
</form>
