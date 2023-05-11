 <?php

    // Product Details 
    // Minimum amount is $0.50 US 

    $itemName = "Demo Product";
    $itemPrice = 99999;
    $currency = "USD";


    /* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */
    define('STRIPE_API_KEY', 'sk_test_51N6SJxFTxKF1xWdrwQpmt9ojVCixFP9XkU2dQcKoaxcmLFJtelPxhaPHP6qcqo8EtlbDevqkztEBWI1jPKgalKtn00sW5Kd5Jy');
    define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51N6SJxFTxKF1xWdrqlwAOgvLoQnW4eOedmBpWUHVUyEE3opfu4GMtrrsqmnPSOTFdctUd3zALwgFeiFUTvJDA2ZQ00GI6IPChH');

    // Database configuration 
    // $host = "localhost";
    // $user = "webshop_user";
    // $password = "admin";
    // $database = "webshop";
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'webshop_user');
    define('DB_PASSWORD', 'admin');
    define('DB_NAME', 'webshop');

    


    ?> 