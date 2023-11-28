<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kontakt</title>

    <?php
    include '../includes/head.php';
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="display-1">Welcome to the Help Page for Our Webshop!</h1>
                <p class="lead text-muted">Here you will find answers to frequently asked questions (Q&A) to help you with the use of our webshop. If you have any further questions, please feel free to contact us.</p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h2>Q&A - Frequently Asked Questions</h2>
                <ol>
                    <li><b>How can I place an order?</b><br> To place an order, please follow these steps:
                        <ol>
                            <li>Search for the desired item using the search bar or categories.</li>
                            <li>Click on the item to view more information.</li>
                            <li>Select the desired variant (if applicable) and quantity.</li>
                            <li>Click "Add to Cart" or "Buy Now".</li>
                            <li>Go to the shopping cart and review your order.</li>
                            <li>Click "Proceed to Checkout" and follow the instructions for payment.</li>
                        </ol>
                    </li>
                    <li><b>What payment methods are accepted?</b><br> We accept various payment methods, including credit cards (Visa, Mastercard, American Express), PayPal, and bank transfers. Simply choose the preferred payment method during the checkout process.</li>
                    <li><b>How long does shipping take?</b><br> The shipping duration depends on your location and the chosen shipping method. Typically, the delivery time within the country is X days and internationally it is X to X days. Please note that international shipments may experience delays due to customs clearance.</li>
                </ol>
            </div>
            <div class="col-lg-6 col-12">
                <h2>&nbsp;</h2>
                <ol start="4">
                    <li><b>Can I cancel or modify my order?</b><br> Cancellation or modification of an order is possible as long as it has not been shipped yet. Contact our customer service immediately and provide your order number to receive assistance.</li>
                    <li><b>How can I check the status of my order?</b><br> Once your order has been shipped, you will receive a shipping confirmation email with a tracking link. You can use this link to track the current status of your order. Alternatively, you can also log in to your user account and view the order history.</li>
                    <li><b>What is the return policy?</b><br> We offer a return policy. If you are not satisfied with your item, you can return it within X days of receipt. Please note that certain items may be excluded from returns. For more information, please refer to our return policy.</li>
                    <li><b>How do I contact customer service?</b><br> You can reach our customer service via email at support@example.com or by phone at XXX-XXXXX. Our team is available to assist you and will process your inquiry as soon as possible.</li>
                </ol>
            </div>
        </div>
    </div>
</body>


<?php
include '../includes/footer.php';
?>

</html>
