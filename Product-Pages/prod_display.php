<!-- Style vorerst in php -->
<!DOCTYPE html>
<html lang="en">

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
			<div class="col mb-4">
				<div class="card h-100">
					<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Computer 1">
					<div class="card-body">
						<h2 class="card-title text-center mb-3">Computer 1</h2>
						<p class="card-text">Beschreibung für Computer 1. Hier können Details über das Produkt stehen.</p>
						<a href="prod_details.php" class="btn btn-primary">Details ansehen</a>
					</div>
				</div>
			</div>
			<div class="col mb-4">
				<div class="card h-100">
					<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Computer 2">
					<div class="card-body">
						<h2 class="card-title text-center mb-3">Computer 2</h2>
						<p class="card-text">Beschreibung für Computer 2. Hier können Details über das Produkt stehen.</p>
						<a href="prod_details.php" class="btn btn-primary">Details ansehen</a>
					</div>
				</div>
			</div>
			<div class="col mb-4">
				<div class="card h-100">
					<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Computer 3">
					<div class="card-body">
						<h2 class="card-title text-center mb-3">Computer 3</h2>
						<p class="card-text">Beschreibung für Computer 3. Hier können Details über das Produkt stehen.</p>
						<a href="prod_details.php" class="btn btn-primary">Details ansehen</a>
					</div>
				</div>
			</div>
			<!-- Weitere Produkte hier hinzufügen -->
		</div>
	</div>

	<?php
	include '../inc/includes/footer.php';
	?>

	<!-- Bootstrap 5 JS (optional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>