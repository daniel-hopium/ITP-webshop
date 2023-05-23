<?php
require_once('../../config/dbaccess.php');
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Elektronik-Webshop</title>
	<!-- Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

	<?php
        include '../includes/head.php';
?>

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
	<form method="post" action="addtocart.php">
		<div class="container py-4">
			<h1 class="text-center mb-4">
				<?php echo htmlspecialchars($product['name']); ?>
			</h1>
			<div class="row">
				<div class="col-md-6 mb-4">
					<img src="https://via.placeholder.com/600x400/2D2D2D/FFFFFF/?text=Produktbild"
						class="img-fluid rounded" alt="Produktbild">
				</div>
				<div class="col-md-6 mb-4">
					<div class="card h-100">
						<div class="card-body">
							<h2 class="card-title mb-4">Beschreibung</h2>
							<p class="card-text">
								<?php echo htmlspecialchars($product['description']); ?>
							</p>
							
							</ul>
							<h2 class="card-title mt-5 mb-4">Preis</h2>
							<p class="card-text display-4">
								<?php
                                // Retrieve the discount value from the same table
                                $discount = $product['Discount'];
                                
                                // Calculate the discounted price
                                $discountedPrice = $product['price'] - ($product['price'] * $discount / 100);
                                
                                echo number_format($discountedPrice, 2, ',', '.');
                                ?>
								€
							</p>


							<div class="input-group mb-3">
								<label class="input-group-text" for="quantity">Quantity:</label>
								<input type="number" class="form-control" id="quantity" name="quantity" min="1"
									value="1">
							</div>
							<input type="hidden" name="user_id"
								value="<?php echo $user_id; ?>">
							<input type="hidden" name="product_id"
								value="<?php echo $product['id']; ?>">

							<button type="submit" class="btn btn-primary">In den Warenkorb</button>

						</div>
					</div>
				</div>
			</div>
		</div>
	</form>


	<?php
    include '../includes/footer.php';
?>

	<!-- Bootstrap 5 JS (optional) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
