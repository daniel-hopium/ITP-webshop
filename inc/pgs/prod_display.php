<!-- Style vorerst in php -->
<!DOCTYPE html>
<html lang="en">


<?php
        include '../includes/head.php';
    ?> 


<?php
// Verbindung zur Datenbank herstellen
require_once('../../config/dbaccess_test.php');
$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
	die("Verbindung zur Datenbank konnte nicht hergestellt werden.");
}
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

	<?php
	include '../inc/includes/head.php';
	?>
</head>

<body>
	<div class="container py-4">
		<h1 class="text-center mb-4">Computer</h1>
		<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
			<?php
			// Überprüfen, ob eine Kategorie-ID als Parameter übergeben wurde
			if (isset($_GET['category_id'])) {
				$category_id = $_GET['category_id'];

				// SQL-Abfrage zum Abrufen der Produkte aus der Datenbank
				$sql = "SELECT id, name, description, price FROM products WHERE category_id = $category_id";
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
					echo '<a href="prod_details.php?id=' . @$id . '" class="btn btn-primary ms-auto">Details ansehen</a>';
					echo '<span class="text-end">€ ' . number_format($price, 2, ',', '.') . '</span>';
					echo '</div></div></div>';
				}
			} else {
				// Keine Kategorie-ID übergeben, alle Produkte anzeigen
				// SQL-Abfrage zum Abrufen der Produkte aus der Datenbank
				$sql = "SELECT name, description, price FROM products";
				$result = mysqli_query($connection, $sql);

				// Schleife zum Anzeigen der Produkte
				while ($row = mysqli_fetch_assoc($result)) {
					$name = $row['name'];
					$description = $row['description'];
					$price = $row['price'];

					echo '<div class="col mb-4">';
					echo '<div class="card h-100">';
					echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $name . '" class="card-img-top" alt="' . $name . '">';
					echo '<div class="card-body">';
					echo '<h2 class="card-title text-center mb-3">' . $name . '</h2>';
					echo '<p class="card-text">' . $description . '</p>';
					echo '<a href="prod_details.php?id=' . @$id . '" class="btn btn-primary ms-auto">Details ansehen</a>';
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
	include '../inc/includes/footer.php';
	?>

	<!-- Bootstrap 5 JS (optional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>