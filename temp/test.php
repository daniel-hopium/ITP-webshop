
<?php
// Include configuration file  
// Product Details 
// Minimum amount is $0.50 US 
$itemName = "Demo Product"; 
$itemPrice = 25;  
$currency = "USD";  
 
/* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51N4JDqKociCd3jZw1DK7PbhElcW3hyUZabvKNScmSr590lEz53xcv1ZDMacNnuEQFZpaTeHydVR5SmHoFox7dk1V00dI9LwiCf'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51N4JDqKociCd3jZw7W1SBvS4ASB4n3h3RgHmmXfgS1OSLnLpIp0wUwsVYVSqvi0D9Gc7SgTSjFwZk7gNb9g73zry00dnqiurRg'); 
  
// Database configuration  
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', 'root');  
define('DB_NAME', 'stripe-test'); 
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
</body>

</html>
