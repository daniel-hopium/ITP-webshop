<?php session_start(); ?>
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
$category_id = "";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Electronics-Webshop</title>

</head>

<body>
    <div class="container py-4">
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
            <button type="submit" class="btn secondary-bg-color btn-block secondary-color mt-2">Filter</button>
        </form>


        <h1 class="text-center mb-4">
            <?php echo $category_name; ?>
        </h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            <?php
            // Überprüfen, ob eine Kategorie-ID als Parameter übergeben wurde
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
            }
            if (isset($_GET['category_id']) && $category_id >= 1 && $category_id <= 15) {
                $category_id = $_GET['category_id'];

                // SQL-Abfrage zum Abrufen der Produkte aus der Datenbank
            
                $sql = "SELECT p.id, p.name, p.description, p.price, p.Discount, p.Stock, pi.image_path
            FROM products p
            LEFT JOIN product_images pi ON p.id = pi.product_id
            WHERE p.category_id = $category_id";

                $result = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $img = $row['image_path'];
                    $stock = intval($row['Stock']);

                    // Retrieve the discount value from the same table
                    $discount = $row['Discount'];

                    // Calculate the discounted price
                    $discountedPrice = $price - ($price * $discount / 100);

                    echo '<div class="col mb-4">';
                    echo '<div class="card h-100">';
                    if ($img != NULL) {
                        echo '<img src=' . $img . ' class="card-img-top" alt="' . $name . '">';
                    } else {

                        echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $name . '" class="card-img-top" alt="' . $name . '">';
                    }
                    echo '<div class="card-body">';
                    echo '<h2 class="card-title text-center mb-3">' . $name . '</h2>';
                    echo '<p class="card-text">' . $description . '</p>';
                    echo '<form method="post" action="addtocart.php">';
                    echo '<a href="prod_details.php?id=' . @$id . '" class="btn secondary-bg-color btn-block secondary-color ms-auto">Details</a>';
                    echo '<div class="input-group my-1">';
                    echo '<label class="input-group-text" for="quantity-' . $id . '">Quantity:</label>';
                    echo $stock == 0 ?
                        '<input type="number" class="form-control" id="quantity-' . $id . '" name="quantity" min="1" value="0" disabled>'
                        :
                        '<input type="number" class="form-control" id="quantity-' . $id . '" name="quantity" min="1" value="1" max=' . $stock . '>';
                    echo '</div>';
                    echo '<input type="hidden" name="product_id" value="' . $id . '">';
                    echo $stock == 0 ?
                        '<button type="submit" class="btn secondary-bg-color btn-block secondary-color disabled">Sold Out</button>'
                        :
                        '<button type="submit" class="btn secondary-bg-color btn-block secondary-color">Add to Shoppingcart</button>';
                    echo '</form>';
                    echo '<span class="text-end">€ ' . number_format($discountedPrice, 2, ',', '.') . '</span>'; // Display the discounted price
                    echo '</div></div></div>';
                }
            } else {
                // Keine Kategorie-ID übergeben, alle Produkte anzeigen
                // SQL-Abfrage zum Abrufen der Produkte aus der Datenbank
            
                $sql = "SELECT p.id, p.name, p.description, p.price, p.Discount, p.Stock, pi.image_path
            FROM products p
            LEFT JOIN product_images pi ON p.id = pi.product_id";
                $result = mysqli_query($connection, $sql);

                // Schleife zum Anzeigen der Produkte
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $img = $row['image_path'];
                    $stock = intval($row['Stock']);


                    // Retrieve the discount value from the same table
                    $discount = $row['Discount'];

                    // Calculate the discounted price
                    $discountedPrice = $price - ($price * $discount / 100);

                    echo '<div class="col mb-4">';
                    echo '<div class="card h-100">';
                    if ($img != NULL) {
                        echo '<img src=' . $img . ' class="card-img-top" alt="' . $name . '">';
                    } else {

                        echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $name . '" class="card-img-top" alt="' . $name . '">';
                    }
                    echo '<div class="card-body">';
                    echo '<h2 class="card-title text-center mb-3">' . $name . '</h2>';
                    echo '<p class="card-text">' . $description . '</p>';
                    echo '<form method="post" action="addtocart.php">';
                    echo '<a href="prod_details.php?id=' . @$id . '" class="btn secondary-bg-color btn-block secondary-color ms-auto">Details</a>';
                    echo '<div class="input-group my-1">';
                    echo '<label class="input-group-text" for="quantity-' . $id . '">Quantity:</label>';
                    echo $stock == 0 ?
                        '<input type="number" class="form-control" id="quantity-' . $id . '" name="quantity" min="1" value="0" disabled>'
                        :
                        '<input type="number" class="form-control" id="quantity-' . $id . '" name="quantity" min="1" value="1" max=' . $stock . '>';
                    echo '</div>';
                    echo '<input type="hidden" name="product_id" value="' . $id . '">';
                    echo $stock == 0 ?
                        '<button type="submit" class="btn secondary-bg-color btn-block secondary-color disabled">Out of Stock</button>'
                        :
                        '<button type="submit" class="btn secondary-bg-color btn-block secondary-color">Add to Shoppingcart</button>';
                    echo '</form>';
                    echo '<span class="text-end">€ ' . number_format($discountedPrice, 2, ',', '.') . '</span>'; // Display the discounted price
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

</body>

</html>