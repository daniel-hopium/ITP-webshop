<?php
// Include configuration file  
require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    include '/Applications/MAMP/htdocs/ITP-webshop/inc/includes/head.php';
    require_once('/Applications/MAMP/htdocs/ITP-webshop/config/dbaccess.php');
    $connection = new mysqli($host, $user, $password, $database);
    $itemName = "Product";



    /* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */


    // Retrieve the items in the cart from the database
    $user_id = $_SESSION["user_id"];
    $query = "SELECT shoppingcart.quantity, products.id, products.name, products.price FROM shoppingcart INNER JOIN products ON shoppingcart.product_id = products.id WHERE shoppingcart.user_id = $user_id";
    $result = mysqli_query($connection, $query);

    // Initialize variables for the order summary and total

    $order_total = 0;

    // Check if the cart is empty
    if (mysqli_num_rows($result) > 0) {
        // Retrieve the products in the cart from the database
        while ($row = mysqli_fetch_assoc($result)) {
            // Calculate the total price for the product
            $total_price = $row["price"] * $row["quantity"];
            // Add the total price to the order total
            $order_total += $total_price;
        }
    } else {
        // If the cart is empty, display a message
        echo "<p>Your cart is empty. Please add some products.</p>";
    }

    // Close the database connection
    mysqli_close($connection);
    $itemPrice = $order_total;




    ?>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Charge <?php echo '$' . $itemPrice; ?> with Stripe</h3>

            <!-- Product Info -->
            <p><b>Item Name:</b> <?php echo $itemName; ?></p>
            <p><b>Price:</b> <?php echo '$' . $itemPrice . ' ' . $currency; ?></p>
        </div>
        <div class="panel-body">
            <!-- Display status message -->
            <div id="paymentResponse" class="hidden"></div>

            <!-- Display a payment form -->
            <form id="paymentFrm" class="hidden">
                <div class="form-group">
                    <label for="name">NAME</label>
                    <input type="text" id="name" class="form-control" placeholder="Enter name" required="" autofocus="">
                </div>
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter email" required="">
                </div>

                <div id="paymentElement">
                    <!--Stripe.js injects the Payment Element-->
                </div>

                <!-- Form submit button -->
                <button id="submitBtn" class="btn btn-success">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="buttonText">Pay Now</span>
                </button>
            </form>

            <!-- Display processing notification -->
            <div id="frmProcess" class="hidden">

            </div>

            <!-- Display re-initiate button -->
            <div id="payReinit" class="hidden">

            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Stripe JS library -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="./checkout.js" STRIPE_PUBLISHABLE_KEY="<?php echo STRIPE_PUBLISHABLE_KEY; ?>" defer></script>
    <?php
    include '/Applications/MAMP/htdocs/ITP-webshop/inc/includes/footer.php';
    ?>
</body>

</html>