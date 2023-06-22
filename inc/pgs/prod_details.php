<?php
require_once('../../config/dbaccess.php');
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$product_id = $_GET['id'];
$sql = "SELECT p.*, pi.image_path
FROM products p
LEFT JOIN product_images pi ON p.id = pi.product_id
WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$img =  $product['image_path'];

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	
	<title>Elektronik-Webshop</title>
	
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

<body class="d-flex flex-column min-vh-100">
	<form method="post" action="addtocart.php">
		<div class="container py-4">
			<h1 class="text-center mb-4">
				<?php echo htmlspecialchars($product['name']); ?>
			</h1>
			<div class="row">
				<div class="col-md-6 mb-4">
					<?php
					if($img != NULL)
					{
						echo '<img src='.$img.' class="card-img-top" alt="' . $product['name'] . '">';
					}
					else{
	
						echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $product['name'] . '" class="card-img-top" alt="' . $name . '">';
					}
					?>
						
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

							<button type="submit" class="btn secondary-bg-color btn-block secondary-color">In den Warenkorb</button>

						</div>
					</div>
				</div>
			</div>
		</div>
	</form>


	<?php
    include '../includes/footer.php';
?>

</body>

</html>
