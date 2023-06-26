<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>

    <?php
    include '../includes/head.php';
    ?>

</head>
<?php
    require_once('../../config/dbaccess.php');

	$db_obj = new mysqli($host, $user, $password, $database);
    $sql = "SELECT * FROM blog_news ORDER BY ID DESC LIMIT 2";
    $result = $db_obj->query($sql);
    
    $blog_ids = [];
    while ($row = $result->fetch_assoc()) {
        // Prepend the ID to the beginning of the array
        array_unshift($blog_ids, $row["id"]);
    }
    
    // Keep only the first three IDs
    $blog_ids = array_slice($blog_ids, 0, 2);
    ?>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <h2 class="h2 mt-4">DISCOUNTS</h2>
        <div class="row ">
            <div class="col-md-6">
                <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="newsBlog_user.php?id=<?php echo $blog_ids[0]; ?>">
                                    <img src="../../res/img/sale2.jpg" class="d-block w-100" alt="Image 1">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="newsBlog_user.php?id=<?php echo $blog_ids[0]; ?>">
                                    <img src="../../res/img/sale2.jpg" class="d-block w-100" alt="Image 2">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="newsBlog_user.php?id=<?php echo $blog_ids[0]; ?>">
                                    <img src="../../res/img/sale2.jpg" class="d-block w-100" alt="Image 3">
                                </a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel1"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel1"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="newsBlog_user.php?id=<?php echo $blog_ids[1]; ?>">
                                <img src="../../res/img/sale3.jpg" class="d-block w-100" alt="Image 4">
                            </a>
                        </div>
                        <a href="newsBlog_user.php?id=<?php echo $blog_ids[1]; ?>">
                            <div class="carousel-item">
                                <img src="../../res/img/sale3.jpg" class="d-block w-100" alt="Image 5">
                        </a>
                    </div>
                    <a href="newsBlog_user.php?id=<?php echo $blog_ids[1]; ?>">
                        <div class="carousel-item">
                            <img src="../../res/img/sale3.jpg" class="d-block w-100" alt="Image 6">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    </div>


    <h2 class="h2 mt-4">NEW ARRIVALS</h2>
    <div class="col-md-12 ">
        <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="prod_details.php?id=69">
                        <img src="../../res/img/new-1.jpg" class="d-block w-100" alt="Image 1">
                        <div class="carousel-caption h5">
                            The new Look of the Retro 15 inspires the World!
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="prod_details.php?id=63">
                        <img src="../../res/img/dog.jpg" class="d-block w-100" alt="Image 2">
                        <div class="carousel-caption h5">
                            The New IPAD PRO 11 arrived !
                        </div>
                    </a>
                </div>
            </div>
        </div>



        
        <h2 class="h2 mt-4"><?php if ($role == "customer")
        echo "Recommendations for you!";
        else {
    echo "Interesting Products" ;
} ?>
        </h2>
        <div id="myCarousel" class="carousel slide my-4" data-bs-ride="carousel">
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="prod_details.php?id=62">
                                <img src="../../res/img/laptop-1.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="prod_details.php?id=71">
                                <img src="../../res/img/laptop-2.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="prod_details.php?id=70">
                                <img src="../../res/img/laptop-3.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="prod_details.php?id=69">
                                <img src="../../res/img/monitor-1.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="prod_details.php?id=63">
                                <img src="../../res/img/tablet-1.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="prod_details.php?id=65">
                                <img src="../../res/img/tablet-2.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="prod_details.php?id=64">
                                <img src="../../res/img/tablet-3.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="prod_details.php?id=67">
                                <img src="../../res/img/printer-1.jpg" class="img-fluid" alt="Image 1">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Left and right controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </button>
        </div>

    </div>
    </div>

    <?php
 include '../includes/footer.php';
    ?>

</body>

</html>