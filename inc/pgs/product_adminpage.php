<!DOCTYPE html>
<html lang="en">

<head>
<?php
// Connect to the database
include '../includes/head.php';
require_once('../../config/dbaccess.php');

if (!isset($_SESSION['username'])) {
  header('Location: home.php');
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>

<style>
  .sortable {
    cursor: pointer;
  }
</style>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="container my-4">
    <?php

    // Create a new mysqli object
    $db_obj = new mysqli($host, $user, $password, $database);

    // Check for connection errors
    if ($db_obj->connect_errno) {
      echo 'Failed to connect to MySQL: ' . $db_obj->connect_error;
      exit();
    }

    // Get all the sellers
    $sql = 'SELECT * FROM sellers';
    $stmt = $db_obj->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $sellers = $result->fetch_all(MYSQLI_ASSOC);

    // Get all the categories
    $sql = 'SELECT * FROM categories';
    $stmt = $db_obj->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = $result->fetch_all(MYSQLI_ASSOC);

    // Check if a category is selected
    $selectedCategoryId = null;
    if (isset($_GET['category_id'])) {
      $selectedCategoryId = $_GET['category_id'];
    }

    // Display the category selector
    echo '<div class="mb-3">';
    echo '<label for="category-select">Select Category:</label>';
    echo '<select class="form-control" id="category-select" onchange="changeCategory()">';
    echo '<option value="">All Categories</option>';
    foreach ($categories as $category) {
      $selected = ($category['id'] == $selectedCategoryId) ? 'selected' : '';
      echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
    }
    echo '</select>';
    echo '</div>';

    // Check if a seller is selected
    if (isset($_GET['seller_id'])) {
      // Get the selected seller's products
      $sql = 'SELECT * FROM products WHERE seller_id = ?';
      if ($selectedCategoryId) {
        $sql .= ' AND category_id = ?';
      }
      $stmt = $db_obj->prepare($sql);
      if ($selectedCategoryId) {
        $stmt->bind_param('ii', $_GET['seller_id'], $selectedCategoryId);
      } else {
        $stmt->bind_param('i', $_GET['seller_id']);
      }
      $stmt->execute();
      $result = $stmt->get_result();
      $products = $result->fetch_all(MYSQLI_ASSOC);

     
       // Display the products in a table
       echo '<table class="table table-striped">';
       echo '<thead><tr><th>Name</th><th>Description</th><th><a href="#" class="sortable" onclick="sortTable(2)">Price</a></th><th>Discount</th><th>Stock</th><th>Category</th><th>Action</th></tr></thead>';
       echo '<tbody>';
       foreach ($products as $product) {
           echo '<tr>';
           echo '<td>' . $product['name'] . '</td>';
           echo '<td>' . $product['description'] . '</td>';
           echo '<td>' . $product['price'] . '</td>';
           echo '<td>' . $product['Discount'] . '</td>';
           echo '<td>' . $product['Stock'] . '</td>';
           echo '<td>' . getCategoryName($product['category_id']) . '</td>';
           echo '<td><div class="btn-group" role="group" aria-label="Product Actions"><a href="#" onclick="editProduct(' . $product['id'] . ')" class="btn btn-primary">Edit</a><a href="#" onclick="deleteProduct(' . $product['id'] . ')" class="btn btn-danger">Delete</a></div></td>';
           echo '</tr>';
       }
       echo '</tbody>';
       echo '</table>';
    } else {
      // Display a list of all the sellers
      echo '<h1 class="h2"> Current Seller List:</h1>
      <ul class="list-group">';
      foreach ($sellers as $seller) {
        echo '<li class="list-group-item"><a href="?seller_id=' . $seller['id'] . '">' . $seller['name'] . '</a></li>';
      }
    }
    echo '</ul>';

    // Function to get the category name based on the category ID
    function getCategoryName($categoryId)
    {
      global $categories;
      foreach ($categories as $category) {
        if ($category['id'] == $categoryId) {
          return $category['name'];
        }
      }
      return 'N/A';
    }

    // Close the database connection
    $db = null;
    ?>
  </div>

  <script>
    // JavaScript functions for editing and deleting products
    function editProduct(productId) {
      window.location.href = 'product_edit.php?id=' + productId;
    }

    function deleteProduct(productId) {
      if (confirm('Are you sure you want to delete this product?')) {
        // Make an AJAX request to delete the product
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              alert('Product deleted successfully.');
              // Refresh the page to show the updated product list
              location.reload();
            } else {
              alert('Error: ' + xhr.status);
            }
          }
        };
        xhr.open('DELETE', 'product_delete.php?id=' + productId);
        xhr.send();
      }
    }

    // Function to change the selected category
    function changeCategory() {
      var selectedCategoryId = document.getElementById('category-select').value;
      var currentUrl = window.location.href;
      var baseUrl = currentUrl.split('?')[0];
      var sellerId = getUrlParameter('seller_id');
      var newUrl = baseUrl + '?seller_id=' + sellerId;
      if (selectedCategoryId) {
        newUrl += '&category_id=' + selectedCategoryId;
      }
      window.location.href = newUrl;
    }

    // Function to get the value of a URL parameter
    function getUrlParameter(name) {
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
      var results = regex.exec(window.location.href);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
    // Function to sort the table by the specified column
function sortTable(column) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.querySelector('.table');
    switching = true;

    // Get the current sorting direction for the column
    var sortDirection = table.getAttribute('data-sort-direction');
    if (!sortDirection || sortDirection === 'desc') {
        sortDirection = 'asc';
    } else {
        sortDirection = 'desc';
    }

    // Set the sorting direction in the table attribute
    table.setAttribute('data-sort-direction', sortDirection);

    while (switching) {
        switching = false;
        rows = table.getElementsByTagName('tr');

        // Loop through all table rows except the header
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            // Get the two elements to compare: current row and the next row
            x = rows[i].getElementsByTagName('td')[column];
            y = rows[i + 1].getElementsByTagName('td')[column];

            // Check if the two elements should switch places based on the sorting direction
            if (sortDirection === 'asc') {
                if (parseFloat(x.innerText) > parseFloat(y.innerText)) {
                    shouldSwitch = true;
                    break;
                }
            } else if (sortDirection === 'desc') {
                if (parseFloat(x.innerText) < parseFloat(y.innerText)) {
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch) {
            // Swap the rows and set the switching flag to true
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
  </script>
<?php 
include '../includes/footer.php';
?>
</body>

</html>
