<?php
include '../includes/head.php';
require_once('../../config/dbaccess.php');

if (!isset($_SESSION['username'])) {
  header('Location: home.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Product</title>
</head>

<body class="d-flex flex-column min-vh-100">
 

  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php
        // Check if the user is logged in and is an admin

        // Connect to the database
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
          $Discount = $_POST['Discount'];
          $Stock = $_POST['Stock'];

          // Update the product in the database
          $sql = 'UPDATE products SET name = ?, description = ?, price = ?, Discount = ?, Stock = ? WHERE id = ?';
          $stmt = $db_obj->prepare($sql);
          $stmt->bind_param('ssddii', $name, $description, $price, $Discount, $Stock, $productId);
          $stmt->execute();

          // Redirect back to the edit product page
          echo "<script>location.href='product_edit.php?id=" . $productId . "'</script>";

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

        <h1 class="text-center">Edit Product</h1>

        <form method="post" action="product_edit.php?id=<?php echo $productId; ?>">
          <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $product['name']; ?>" required>
          </div>
          <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea class="form-control" name="description" required><?php echo $product['description']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
          </div>
          <div class="form-group">
            <label for="Discount">Discount:</label>
            <input type="number" class="form-control" name="Discount" step="0.01" value="<?php echo $product['Discount']; ?>">
          </div>
          <div class="form-group">
            <label for="Stock">Stock:</label>
            <input type="number" class="form-control" name="Stock" step="1" value="<?php echo $product['Stock']; ?>">
          </div>
          <div class="text-center">
            <input type="submit" class="btn btn-primary m-4 col-4" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>

</html>
