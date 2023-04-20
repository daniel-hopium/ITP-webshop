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
</head>

<body>
	<div class="container py-4">
		<h1 class="text-center mb-4">Produktname</h1>
		<div class="row">
			<div class="col-md-6 mb-4">
				<img src="https://via.placeholder.com/600x400/2D2D2D/FFFFFF/?text=Produktbild" class="img-fluid rounded" alt="Produktbild">
			</div>
			<div class="col-md-6 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h2 class="card-title mb-4">Beschreibung</h2>
						<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non enim justo, lobortis ac nisi vel, efficitur elementum purus. Ut vestibulum, libero vel vestibulum lobortis, metus risus feugiat leo, eget lobortis risus quam et leo. Aliquam id efficitur neque. Suspendisse vel dui ac nisi mollis laoreet. Integer ac elit sodales, efficitur quam eget, lobortis quam. Fusce imperdiet dolor quis lorem ullamcorper laoreet. Donec gravida, elit ut auctor porttitor, ipsum elit hendrerit urna, vel bibendum metus nulla in quam. Donec ullamcorper purus vitae mi sagittis, id lacinia urna pretium.</p>
						<h2 class="card-title mt-5 mb-4">Details</h2>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Prozessor: Intel Core i7-11700K</li>
							<li class="list-group-item">Grafikkarte: NVIDIA GeForce RTX 3080</li>
							<li class="list-group-item">RAM: 16 GB DDR4</li>
							<li class="list-group-item">Festplatte: 1 TB SSD</li>
						</ul>
						<h2 class="card-title mt-5 mb-4">Preis</h2>
						<p class="card-text display-4">999,00 €</p>
						<a href="#" class="btn btn-primary">In den Warenkorb</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap 5 JS (optional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>