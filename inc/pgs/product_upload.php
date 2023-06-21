<!DOCTYPE html>
<html>

<head>
  <title>Upload Products</title>

  <?php
        include '../includes/head.php';
  require_once('../../config/dbaccess.php');
      
  if(!isset($_SESSION['username'])) {
      header('Location: home.php');
  }

  $db_obj = new mysqli($host, $user, $password, $database);
       

  $currentUser = $_SESSION['username'];
  $currentUser = mysqli_query($db_obj, "SELECT * FROM users WHERE username = '$currentUser' ");
  $currentUser =($currentUser->fetch_assoc());
  $sql = 'SELECT * FROM categories';
  $result = $db_obj->query($sql);
  $categories = array();
  while ($row = $result->fetch_assoc()) {
      $categories[] = $row;
  }
  ?>

</head>

<body>
  <form method="post" action="product_upload.php" enctype="multipart/form-data">
    <div>
      <label for="name">Product Name:</label>
      <input type="text" name="name" required>
    </div>
    <div>
      <label for="description">Product Description:</label>
      <textarea name="description" required></textarea>
    </div>
    <div>
      <label for="price">Price:</label>
      <input type="number" name="price" step="0.01" required>
    </div>
    <div>
      <label for="category_id">Category:</label>
      <select name="category_id" required>
        <option value="">-- Select a Category --</option>
        <?php
        foreach ($categories as $category) {
            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
        }
  ?>
      </select>
    </div>
    <div>
      <label for="image">Product Image:</label>
      <input type="file" name="image" accept="image/*" required>
    </div>
    <input type="submit" value="Upload">
  </form>

  <?php
    // Process the form data and insert the product into the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sellerId = $currentUser['seller_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $imagePath = './../../res/img/' . uniqid() . '_' . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $sql = 'INSERT INTO products (seller_id, category_id, name, description, price) VALUES (?, ?, ?, ?, ?)';
                $stmt = $db_obj->prepare($sql);
                $stmt->bind_param('iisdi', $sellerId, $category_id, $name, $description, $price);
                $stmt->execute();

                $productId = $db_obj->insert_id;

                $sql = 'INSERT INTO product_images (product_id, image_path) VALUES (?, ?)';
                $stmt = $db_obj->prepare($sql);
                $stmt->bind_param('is', $productId, $imagePath);
                $stmt->execute();

                echo '<p>Product uploaded successfully.</p>';
            } else {
                echo '<p>There was an error uploading the product image.</p>';
            }
        } else {
            echo '<p>Please select a product image to upload.</p>';
        }
    }
            
          
            
    // Close the database connection
    $db_obj->close();
  ?>


<?php 
include '../includes/footer.php';
?>
</body>

</html>