<!-- Style vorerst in php -->
<!DOCTYPE html>
<html lang="en">


<?php
        include '../includes/head.php';
    ?> 


<?php
// Verbindung zur Datenbank herstellen
require_once('../../config/dbaccess.php');
$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
	die("Verbindung zur Datenbank konnte nicht hergestellt werden.");
}


// Set the category name variable


$category_name = "All Products";


?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Elektronik-Webshop</title>
	<!-- Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<style>
		.card {
			height: 100%;
		}

		.card-body {
			display: flex;
			flex-direction: column;
		}

		.card-text {
			text-align: left;
			flex-grow: 1;
		}

		.btn {
			align-self: flex-start;
		}
	</style>

</head>

<body>
<form action="" method="get" class="mb-4">
  <label for="category_id" class="form-label">Select a category:</label>
  <select id="category_id" name="category_id" class="form-select">
    <option value="">All</option>
    <?php
      // SQL-Abfrage zum Abrufen der Kategorien aus der Datenbank
      $sql = "SELECT id, name FROM categories";
      $result = mysqli_query($connection, $sql);

      // Schleife zum Anzeigen der Kategorien
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];

        // Überprüfen, ob diese Kategorie bereits ausgewählt wurde
        $selected = "";
        if (isset($_GET['category_id']) && $_GET['category_id'] == $id) {
          $selected = "selected";
		  $category_name = $name;
        }

        echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
      }
    ?>
  </select>
  <button type="submit" class="btn btn-primary mt-2">Filter</button>
</form>

	<div class="container py-4">
	<h1 class="text-center mb-4"><?php echo $category_name; ?></h1>

		<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
			<?php
			// Überprüfen, ob eine Kategorie-ID als Parameter übergeben wurde
			$category_id = $_GET['category_id'];
			if (isset($_GET['category_id']) && $category_id >= 1  && $category_id <= 15) {
				

				// SQL-Abfrage zum Abrufen der Produkte aus der Datenbank
				
				$sql = "SELECT id, name, description, price FROM products WHERE category_id = $category_id";
				$result = mysqli_query($connection, $sql);

				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id'];
					$name = $row['name'];
					$description = $row['description'];
					$price = $row['price'];
					
					echo '<div class="col mb-4">';
					echo '<div class="card h-100">';
					echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $name . '" class="card-img-top" alt="' . $name . '">';
					echo '<div class="card-body">';
					echo '<h2 class="card-title text-center mb-3">' . $name . '</h2>';
					echo '<p class="card-text">' . $description . '</p>';
					echo '<form method="post" action="addtocart.php">';
					echo '<a href="prod_details.php?id=' . @$id . '" class="btn btn-primary ms-auto">Details ansehen</a>';
					echo '<div class="input-group mb-3">';
					echo '<label class="input-group-text" for="quantity-' . $id . '">Quantity:</label>';
					echo '<input type="number" class="form-control" id="quantity-' . $id . '" name="quantity" min="1" value="1">';
					echo '</div>';
					echo '<input type="hidden" name="product_id" value="' . $id . '">';
					echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
					echo '</form>';
					echo '<span class="text-end">€ ' . number_format($price, 2, ',', '.') . '</span>';
					echo '</div></div></div>';
				}
				
				
			} else {
				// Keine Kategorie-ID übergeben, alle Produkte anzeigen
				// SQL-Abfrage zum Abrufen der Produkte aus der Datenbank
				
				$sql = "SELECT id,name, description, price FROM products";
				$result = mysqli_query($connection, $sql);

				// Schleife zum Anzeigen der Produkte
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id'];
					$name = $row['name'];
					$description = $row['description'];
					$price = $row['price'];

					echo '<div class="col mb-4">';
					echo '<div class="card h-100">';
					echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $name . '" class="card-img-top" alt="' . $name . '">';
					echo '<div class="card-body">';
					echo '<h2 class="card-title text-center mb-3">' . $name . '</h2>';
					echo '<p class="card-text">' . $description . '</p>';
					echo '<form method="post" action="addtocart.php">';
					echo '<a href="prod_details.php?id=' . @$id . '" class="btn btn-primary ms-auto">Details ansehen</a>';
					echo '<div class="input-group mb-3">';
					echo '<label class="input-group-text" for="quantity-' . $id . '">Quantity:</label>';
					echo '<input type="number" class="form-control" id="quantity-' . $id . '" name="quantity" min="1" value="1">';
					echo '</div>';
					echo '<input type="hidden" name="product_id" value="' . $id . '">';
					echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
					echo '</form>';
					echo '<span class="text-end">€ ' . number_format($price, 2, ',', '.') . '</span>';
					echo '</div></div></div>';
				}
			}

			// Verbindung zur Datenbank schließen
			mysqli_close($connection);
			?>

		</div>
	</div>

	<?php
	include '../includes/footer.php';
	?>

	<!-- Bootstrap 5 JS (optional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>